<?php
/**
 * ErrorLogAddFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Factory\Entity\StoredFunction;

use Core\Entity\StoredFunction\ErrorLogAdd;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class ErrorLogAddFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ProductAdd
     */
    public function createService(ServiceLocatorInterface $serviceLocator): ErrorLogAdd
    {
        return new ErrorLogAdd($serviceLocator);
    }
}