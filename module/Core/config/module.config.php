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

use Core\Auth\Storage\UserSession;
use Core\Controller\{
    IndexController
};
use Core\Entity\StoredFunction\ErrorLogAdd;
use Core\Factory\Controller\IndexControllerFactory;
use Core\Factory\Entity\StoredFunction\ErrorLogAddFactory;
use Core\Factory\Extension\FirePHPFactory;
use Core\Factory\Extension\LogFactory;
use Core\Factory\Handler\ErrorHandlerFactory;
use Core\Factory\Service\IndexServiceFactory;
use Core\Factory\Service\LocaleServiceFactory;
use Core\Handler\ErrorHandler;
use Core\Service\IndexService;
use Core\Service\LocaleService;
use Spav\Mail;
use Zend\Authentication\AuthenticationService;
use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Log\LoggerAbstractServiceFactory;
use Zend\Mvc\Service\TranslatorServiceFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

return [
    'controllers' => [
        'invokables' => [
        ],
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
        ]
    ],
    'service_manager' => [
        'abstract_factories' => [
            StorageCacheAbstractServiceFactory::class,
            LoggerAbstractServiceFactory::class
        ],
        'invokables' => [
            UserSession::class => UserSession::class,
            AuthenticationService::class => AuthenticationService::class
        ],
        'factories' => [
            'translator' => TranslatorServiceFactory::class,

            'log' => LogFactory::class,
//            'log' => FirePHPFactory::class,

            ErrorHandler::class => ErrorHandlerFactory::class,

            Mail::class => function(ServiceLocatorInterface $sm) {
                return new Mail($sm);
            },

            IndexService::class => IndexServiceFactory::class,
            LocaleService::class => LocaleServiceFactory::class,

            ErrorLogAdd::class => ErrorLogAddFactory::class,

            //todo need for PHPUnit. You must load global.php config for it.
            \Zend\Db\Adapter\Adapter::class => \Zend\Db\Adapter\AdapterServiceFactory::class
        ]
    ],

//todo need for PHPUnit. You must load global.php config for it.
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=yf;host=localhost',
        'username' => 'root',
        'password' => '140666',
        'driver_options' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
        ]
    ],

    'log' => [
        'stream' => '/home/fan/workspace/zf2.local/data/logs/logger.log'
    ]
];
