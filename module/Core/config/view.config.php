<?php
/**
 * view.config
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core;

use Core\View\Helper\{
    Application,
    CpanelJs,
    CpanelStylesheet,
    JQuery
};

return [
    'translator' => [
        'locale' => 'ru_RU',
        'list' => [
            'ru' => 'ru_RU',
            'eng' => 'en_US'
        ],
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            ]
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/adminLTE/layout.phtml',
            'layout/hold-transition' => __DIR__ . '/../view/layout/adminLTE/layout-hold-transition.phtml',
            'core/index/index' => __DIR__ . '/../view/core/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ],
        'template_path_stack' => [
            'core' => __DIR__ . '/../view'
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],

    'view_helpers' => [
        'invokables' => [
            'cpanelStylesheet' => CpanelStylesheet::class,
            'jquery' => JQuery::class,
            'cpanelJs' => CpanelJs::class,
            'application' => Application::class
        ]
    ]
];
