<?php
    /** @var \Kirby\Cms\Block $block */
    $caption = $block->caption();
    $link = $block->link();
    $ratio = $block->ratio()->or('auto');
    $image_height_mobile = $block->image_height_mobile()->or('auto');
    $src = null;
    $sizes = "(min-width: 1125px) calc(" . round(100 / (12 / 12), 0) . "vw), 100vw";
    if ($block->location() == 'web') {
        $src = $block->src()->esc();
    } elseif ($image = $block->image()->toFile()) {
        $alt = $image->alt();
        $src = $image->url();
    }
    ?>

<div class="block block-media block-<?= $block->type() ?> <?= e($block->hide_on_mobile()->toBool(), "hide-on-mobile") ?>">
    <?php if ($src): ?>
        <figure <?= Html::attr(['data-ratio' => $ratio], null, ' ') ?>
                >

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
                                style="--aspect-ratio:<?= $ratio ?>;object-position:<?= $image->focus()->or('50% 50%') ?>;"
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
