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

namespace UserTest\Service;

use PHPUnit\Framework\TestCase;
use User\Controller\IndexController;
use User\Form\SignInForm;
use User\Service\IndexService;
use UserTest\Bootstrap;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Http\PhpEnvironment\{
    Request,
    Response
};
use Zend\ServiceManager\ServiceManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\View\Model\{JsonModel,ViewModel};


class IndexServiceTest extends TestCase
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @see IndexService::authenticate()
     */
    public function testAuthenticate()
    {
        $this->serviceManager = Bootstrap::getServiceManager();

        $userIndexService = $this->serviceManager->get(IndexService::class);

        $formData = [
            'email' => 'fff@mail.ru',
            'password' => '228'
        ];

        $authenticationResultArray = $userIndexService->authenticate($formData);

        $this->assertEquals(true, $authenticationResultArray['success']);
    }
}
