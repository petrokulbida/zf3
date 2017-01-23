<?php
/**
 * IndexControllerFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */

namespace User\Factory\Controller;

use User\Controller\IndexController;
use User\Service\IndexService;
use Zend\ServiceManager\{FactoryInterface, ServiceLocatorInterface};

class IndexControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param \Zend\Mvc\Controller\ControllerManager|ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) : IndexController
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        /** @var IndexService $service */
        $service = $serviceManager->get(IndexService::class);

        return new IndexController($service);
    }
}