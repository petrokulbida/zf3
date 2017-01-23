<?php
/**
 * module.config
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User;

use User\Controller\IndexController;

return [
    'router' => [
        'routes' => [

            'user-index' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/user/index[/:action][/:id]',
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
        ]
    ]
];