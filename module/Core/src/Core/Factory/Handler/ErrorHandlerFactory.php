<?php
/**
 * ErrorHandlerFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Factory\Handler;

use Core\Handler\ErrorHandler;
use Zend\Log\Logger;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class ErrorHandlerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ErrorHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator): ErrorHandler
    {
        /** @var Logger $logger */
        $logger = $serviceLocator->get('log');

        return new ErrorHandler($logger);
    }
}