<?php
/**
 * FirePHPFactory
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
use \Zend\Log\Writer\FirePhp as FirePhpWriter;
use \Zend\Log\Writer\FirePhp\FirePhpBridge;

require_once 'vendor/firephp/FirePHP.php';

class FirePHPFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Logger
     */
    public function createService(ServiceLocatorInterface $serviceLocator): Logger
    {
        $logger = new Logger();

        $writer = new FirePhpWriter(new FirePhpBridge(new \FirePHP()));

        $logger->addWriter($writer);

        return $logger;
    }
}