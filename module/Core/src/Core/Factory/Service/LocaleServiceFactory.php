<?php
/**
 * LocaleServiceFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Factory\Service;

use Core\Service\LocaleService;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class LocaleServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return LocaleService
     */
    public function createService(ServiceLocatorInterface $serviceLocator): LocaleService
    {
        return new LocaleService($serviceLocator);
    }
}