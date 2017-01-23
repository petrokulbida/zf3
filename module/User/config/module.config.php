<?php
/**
 *
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
use User\Entity\EntityFunction\GetUserData;
use User\Entity\EntityFunction\UserAdd;
use User\Factory\Controller\IndexControllerFactory;
use User\Factory\Entity\EntityFunction\GetUserDataFactory;
use User\Factory\Entity\EntityFunction\UserAddFactory;
use User\Factory\Service\IndexServiceFactory;
use User\Form\SignInForm;
use User\Form\SignUpForm;
use User\Service\IndexService;

return [
    'controllers' => [
        'invokables' => [],
        'factories' => [
            IndexController::class => IndexControllerFactory::class
        ]
    ],

    'service_manager' => [
        'abstract_factories' => [],

        'invokables' => [
            SignInForm::class => SignInForm::class,
            SignUpForm::class => SignUpForm::class
        ],

        'factories' => [
            IndexService::class => IndexServiceFactory::class,

            GetUserData::class => GetUserDataFactory::class,
            UserAdd::class => UserAddFactory::class,
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view',
        ],
    ],
];
