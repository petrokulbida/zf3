<?php
/**
 * LogFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */

namespace Core\Factory\Extension;

use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class LogFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Logger
     */
    public function createService(ServiceLocatorInterface $serviceLocator): Logger
    {
        $config = $serviceLocator->get('config');
        $stream = $config['log']['stream'];

        $writer = new Stream($stream);

        $logger = new Logger();

        $logger->addWriter($writer);

        return $logger;
    }
}