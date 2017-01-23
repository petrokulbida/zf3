<?php
/**
 * IndexController
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */

namespace Core\Controller;

use Core\Service\IndexService;
use Core\Service\TestFunctionService;
use Spav\Controller\Action;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Dom\Query;
use Zend\Http\Header\SetCookie;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Log\Logger;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

use Zend\Db\Adapter\Adapter as ZendAdapter;
class IndexController extends Action
{
    /**
     * @var IndexService
     */
    private $service;

    /**
     * IndexController constructor.
     *
     * @param IndexService $service
     */
    public function __construct(IndexService $service)
    {
        $this->service = $service;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * @see localeAction()
     *
     * @return ViewModel|bool
     */
    public function localeAction()
    {
        /** @var Response $response */
        $response = $this->getResponse();

        /** @var Request $request */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            $response->setStatusCode(Response::STATUS_CODE_404);

            return false;
        }

        $locale = strval($this->params()->fromPost('locale'));

        $localeService = $this->service->getLocaleService();

        $locale = $localeService->setLocale($locale);

        if ($locale instanceof SetCookie) {
            $headers = $response->getHeaders();
            $headers->addHeader($locale);
        }

        return new JsonModel(['success' => true]);
    }
}
