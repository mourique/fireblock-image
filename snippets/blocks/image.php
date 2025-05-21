<?php
    /** @var \Kirby\Cms\Block $block */
    $caption = $block->caption();
    $crop = $block->crop()->isTrue();
    $link = $block->link();
    $max_width = $block->max_width();
    $ratio = $block->ratio()->or('auto');
    $image_height_mobile = $block->image_height_mobile()->or('auto');
    $hpos    = $block->horizontal_positon();
$vpos    = $block->vertical_positon();
$pulled_out = $block->pulled_out()->toBool();
    $src = null;
    $sizes = "(min-width: 1125px) calc(" . round(100 / (12 / 12), 0) . "vw), 100vw";
    if ($block->location() == 'web') {
        $src = $block->src()->esc();
    } elseif ($image = $block->image()->toFile()) {
        $alt = $image->alt();
        $src = $image->url();
    }
    ?>

<div class="block block-media block-<?= $block->type() ?> <?= e($block->hide_on_mobile()->toBool(), "hide-on-mobile") ?> <?= e($pulled_out, "pulled-out-block") ?>" style="max-width: <?= $max_width ?>">
    <?php if ($src): ?>
        <figure <?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>
                style=" --padding-top:<?= $block->padding_top() ?>;
                        --padding-right:<?= $block->padding_right() ?>;
                        --padding-bottom:<?= $block->padding_bottom() ?>;
                        --padding-left:<?= $block->padding_left() ?>;
                        --margin-top:<?= $block->margin_top() ?>;
                        --margin-right:<?= $block->margin_right() ?>;
                        --margin-bottom:<?= $block->margin_bottom() ?>;
                        --margin-left:<?= $block->margin_left() ?>;
                        ">

            <?php if ($link->isNotEmpty()): ?><a href="<?= Str::esc($link->toUrl()) ?>"><?php endif; ?>

                <div class="img-wrapper" style="--image-height-mobile: <?= $image_height_mobile ?>vh">
                <?php if ($caption->isNotEmpty() && $block->caption_inside()->toBool() == true) : ?>
                    <figcaption class="<?= $block->caption_size()->or('') ?>">
                        <?= str_replace("|", "&shy;", $caption) ?>
                    </figcaption>
                <?php endif; ?>
                    <picture>
                        <source
                                data-srcset="<?= $image->srcset('webp') ?>"
                                sizes="<?= $sizes ?>"
                                type="image/webp"
                                loading="lazy"
                        >
                        <img
                                style="--aspect-ratio:<?= $ratio ?>;object-position: <?= $hpos ?> <?= $vpos ?>;"
                                src="<?= $image->thumbhashUri() ?>"
                                loading="lazy" 
                                data-srcset="<?= $image->srcset() ?>"
                                sizes="<?= $sizes ?>"
                                data-sizes="auto"
                                width="<?= $image->resize(1800)->width() ?>"
                                height="<?= $image->resize(1800)->height() ?>"
                                alt="<?= $alt->esc() ?>"
                        >
                    </picture>
                </div>

                <?php if ($caption->isNotEmpty() && $block->caption_inside()->toBool() == false) : ?>
                    <figcaption class="<?= $block->caption_size()->or('') ?>">
                        <?= str_replace("|", "&shy;", $caption->permalinksToUrls()) ?>
                    </figcaption>
                <?php endif; ?>

                <?php if ($link->isNotEmpty()): ?></a><?php endif ?>

        </figure>
    <?php endif ?>

</div>
