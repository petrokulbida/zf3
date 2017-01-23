<?php
/**
 * IndexServiceFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Factory\Service;

use Core\Service\IndexService;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class IndexServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return IndexService
     */
    public function createService(ServiceLocatorInterface $serviceLocator): IndexService
    {
        return new IndexService($serviceLocator);
    }
}