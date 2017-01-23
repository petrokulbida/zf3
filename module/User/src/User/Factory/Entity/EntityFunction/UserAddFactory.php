<?php
/**
 * UserAddFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Factory\Entity\EntityFunction;

use User\Entity\EntityFunction\UserAdd;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

/**
 * Class GetUserDataFactory
 *
 * @package Operator\Factory\Service
 */
class UserAddFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return UserAdd
     */
    public function createService(ServiceLocatorInterface $serviceLocator): UserAdd
    {
        return new UserAdd($serviceLocator);
    }
}