<?php
/**
 * GetUserDataFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Factory\Entity\EntityFunction;

use User\Entity\EntityFunction\GetUserData;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

/**
 * Class GetUserDataFactory
 *
 * @package Operator\Factory\Service
 */
class GetUserDataFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return GetUserData
     */
    public function createService(ServiceLocatorInterface $serviceLocator): GetUserData
    {
        return new GetUserData($serviceLocator);
    }
}