<?php
/**
 * IndexController
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */

namespace User\Controller;

use User\Service\IndexService;
use Spav\Controller\Action;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Http\PhpEnvironment\{
    Request,
    Response
};
use Zend\View\Model\{JsonModel,ViewModel};

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
        if (!$this->identity()) {
            $this->pageNotFound();
        }

        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function signInAction()
    {
        /** @var Request $request */
        $request  = $this->getRequest();

        $signInForm = $this->service->getSignInForm();

        if ($request->isPost()) {

            $signInForm->setData($request->getPost());

            $signIn = $this->service->signIn();

            if (isset($signIn['success'])) {
                if ($signIn['success']) {

                    return $this->redirect()->toRoute('home');
                } else {
                    $this->flashMessenger()->addErrorMessage($signIn['message']);
                }
            }
        }

        $this->layout('layout/hold-transition');

        $viewModel = new ViewModel();
        $viewModel->setVariable('signInForm', $signInForm);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function signUpAction()
    {
        /** @var Request $request */
        $request  = $this->getRequest();

        $signUpForm = $this->service->getSignUpForm();

        if ($request->isPost()) {

            $signUpForm->setData($request->getPost());

            $signUp = $this->service->signUp();

            if (isset($signUp['success'])) {
                if ($signUp['success']) {
                    $this->flashMessenger()->addSuccessMessage($signUp['message']);

                    return $this->redirect()->toRoute('user-index', ['action' => 'sign-in']);

                } else {
                    $this->flashMessenger()->addErrorMessage($signUp['message']);
                }
            }
        }

        $this->layout('layout/hold-transition');

        $viewModel = new ViewModel();
        $viewModel->setVariable('signUpForm', $signUpForm);

        return $viewModel;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function signOutAction()
    {
        if ($this->identity()) {
            $this->service->clearIdentity();
        }

        return $this->redirect()->toRoute('home');
    }
}
