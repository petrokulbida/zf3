<?php
/**
 * Module
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core;

use Core\Handler\ErrorHandler;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Request;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\I18n\Translator;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

class Module
{
    /**
     * @param MvcEvent $e
     * @return Module
     */
    private function initI18n(MvcEvent $e): Module
    {
        $application = $e->getApplication();

        /** @var Request $request */
        $request = $application->getRequest();

        if ($request instanceof Request) {
            $cookie = $request->getCookie();

            if ($cookie && $cookie->offsetExists('locale')) {
                /** @var Translator $translator */
                $translator  = $application->getServiceManager()->get('translator');

                $locale = $cookie->offsetGet('locale');

                $translator->getTranslator()->setLocale($locale);
            }
        }

        return $this;
    }

    /**
     * @param MvcEvent $event
     */
    private function initErrorHandler(MvcEvent $event)
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $event->getTarget()->getServiceManager();
        /** @var ErrorHandler $errorHandler */
        $errorHandler = $serviceManager->get(ErrorHandler::class);

        /** @var EventManagerInterface $eventManager */
        $eventManager = $event->getTarget()->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR,
            [$errorHandler, 'exceptionHandler']
        );

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR,
            [$errorHandler, 'exceptionHandler']
        );
    }

    /**
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        /** @var EventManagerInterface $eventManager */
        $eventManager = $event->getApplication()->getEventManager();

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->initErrorHandler($event);
        $this->initI18n($event);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/config/router.config.php',
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/view.config.php'
        );
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    'Spav' => __DIR__ . '/../../vendor/spav/src',
                ]
            ]
        ];
    }

    /**
     * (non PHPDoc)
     */
    public function init(ModuleManager $moduleManager)
    {
    }
}
