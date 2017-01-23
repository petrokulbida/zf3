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

namespace UserTest\Controller;

use User\Controller\IndexController;
use User\Form\SignInForm;
use User\Service\IndexService;
use UserTest\Bootstrap;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Http\PhpEnvironment\{
    Request,
    Response
};
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\View\Model\{JsonModel,ViewModel};


class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            Bootstrap::getApplicationConfig()
        );

        parent::setUp();
    }

    /**
     *
     */
    protected function initIdentity()
    {
        $userIndexService = Bootstrap::getServiceManager()->get(IndexService::class);

        $formData = [
            'email' => 'fff@mail.ru',
            'password' => '228'
        ];

        $userIndexService->authenticate($formData);
    }

    /**
     * @see IndexController::indexAction()
     */
    public function testIndexAction()
    {
        $this->initIdentity();

        $this->dispatch('/user/index');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('User');
        $this->assertControllerName('User\Controller\IndexController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('user-index');
        $this->assertActionName('index');
    }

    /**
     * @see IndexController::signInAction()
     */
    public function testSignInAction()
    {
        $form = new SignInForm();
        $form->prepare();

        $this->dispatch('/user/index/sign-in', 'POST',
            [
                'email' => 'fff@mail.ru',
                'password' => '228',
                'csrf' => $form->get('csrf')->getValue()
            ]
        );

        $this->assertResponseStatusCode(302);
        $this->assertModuleName('User');
        $this->assertControllerName('User\Controller\IndexController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('user-index');
        $this->assertActionName('sign-in');

        $this->assertRedirectTo('/');
    }
}
