<?php
/**
 * module.config
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core;

use Core\Controller\IndexController;

return [
    'router' => [
        'routes' => [

            'home' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[1-9][0-9]*'
                    ],
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],

            'core-index' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/core/index[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[1-9][0-9]*'
                    ],
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ]
];