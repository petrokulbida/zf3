<?php
/**
 * application.config
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
return [
    'modules' => [
        'Zf2Whoops',
        'Core',
        'User',
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor'
        ],
        'config_glob_paths' => [
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ]
    ]
];
