<?php
/**
 * IndexControllerFactory
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */

namespace Core\Factory\Controller;

use Core\Controller\IndexController;
use Core\Service\IndexService;
use Core\Service\TestFunctionService;
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