<?php
Kirby::plugin('ffeierabend/fireblock-image', [
    'hooks' => [
        // 'system.loadPlugins:after' => function () {
        //     HeaderSnippetManager::register(function () {
        //         return js('media/plugins/ffeierabend/fireblock-image/unlazy.js', ["defer" => true, "init" => true]) . PHP_EOL;
        //     });
        // }
    ],
    'layoutMethods' => [
    ],
    'icons' => [],
    'blueprints' => [
        'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
    ],
    'snippets' => [
        'blocks/image' => __DIR__ . '/snippets/blocks/image.php',
    ],
    'translations' => [
        'en' => [
            'field.blocks.image.name' => 'Image',
        ],
        'de' => [
            'field.blocks.image.name' => 'Bild',
        ],
    ]
]);