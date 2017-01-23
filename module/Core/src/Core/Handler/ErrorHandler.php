<?php
/**
 * ErrorHandler
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @link https://github.com/riktamtech/zf2-error-handler/tree/master
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Handler;

use Zend\Log\Logger;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ResponseInterface as Response;

class ErrorHandler
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * ErrorHandler constructor.
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        $this->errorHandler();
    }

    /**
     * @param MvcEvent $event
     *
     * @return string|void
     */
    public function exceptionHandler(MvcEvent $event)
    {
        if (!$this->canHandlerError($event)) {
            return;
        }

        $error = $event->getError();

        /** @var ServiceManager $serviceManager */
        $serviceManager = $event->getTarget()->getServiceManager();

        /** @var Logger $logger */
        $logger = $serviceManager->get('log');

        $logText = 'Undefined Error';

        if ($error == Application::ERROR_CONTROLLER_NOT_FOUND) {
            $logText = sprintf('The requested controller %s could not be mapped to an existing controller class',
                $event->getRouteMatch()->getParam('controller')
            );

        } elseif ($error == Application::ERROR_CONTROLLER_INVALID) {
            $logText =  sprintf('The requested controller %s is not dispatchable',
                $event->getRouteMatch()->getParam('controller')
            );

        } elseif ($error == Application::ERROR_ROUTER_NO_MATCH) {
            $logText = 'The requested URL could not be matched by routing';
        }

        $logger->err($logText);
    }

    /**
     * todo need add userId to log
     *
     * for throw exceptions
     *
     *(non PHPDoc)
     */
    public function errorHandler()
    {
        set_error_handler(function($level, $message, $file, $line) {
            $minErrorLevel = error_reporting();

            $errorMessage = sprintf(
                '%s | Line=>%d | %s | Level=>%s | MinErrorLevel=>%s',
                $file,
                $line,
                $message,
                $level,
                $minErrorLevel
            );

            if ($minErrorLevel & $level) {
                $this->logger->err($errorMessage);
            }

            return false;
        });
    }
    
    /**
     * @param MvcEvent $event
     *
*@return bool
     */
    protected function canHandlerError(MvcEvent $event)
    {
        return $event->getError() && !$event->getResult() instanceof Response;
    }
}