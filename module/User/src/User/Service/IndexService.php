<?php
/**
 * IndexService
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Service;

use Core\Auth\Storage\UserSession;
use User\Entity\EntityFunction\GetUserData;
use User\Entity\EntityFunction\UserAdd;
use User\Form\SignInForm;
use User\Form\SignUpForm;
use Spav\ServiceManager\ServiceManager;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;

use Core\Auth\Adapter as CoreAuthAdapter;
use Zend\Stdlib\ArrayObject;

class IndexService extends ServiceManager
{
    /**
     * @param array $signUpData
     *
     * @return array
     */
    public function userAdd(array $signUpData)
    {
        $email = $signUpData['email'];
        $password = $signUpData['password'];
        $phoneNumber = $signUpData['phone'];

        /** @var UserAdd $userAdd */
        $userAdd = $this->get(UserAdd::class);

        $arrayObject = new ArrayObject();
        $arrayObject->setFlags(ArrayObject::ARRAY_AS_PROPS);

        $arrayObject->offsetSet('email', $email);
        $arrayObject->offsetSet('password', $password);
        $arrayObject->offsetSet('phoneNumber', $phoneNumber);

        return $userAdd->setParams($arrayObject)->execute();
    }

    /**
     *
     */
    protected function sendVarifiEmail()
    {

    }

    /**
     * @return SignInForm
     */
    public function getSignInForm() : SignInForm
    {
        return $this->get(SignInForm::class);
    }

    /**
     * @return SignUpForm
     */
    public function getSignUpForm() : SignUpForm
    {
        return $this->get(SignUpForm::class);
    }

    /**
     * @return bool|array
     */
    public function signIn()
    {
        /** @var SignInForm $signInForm */
        $signInForm = $this->get(SignInForm::class);

        if (!$signInForm->isValid()) {
            return false;
        }

        return $this->authenticate($signInForm->getData());
    }

    /**
     * @return bool|array
     */
    public function signUp()
    {
        /** @var SignUpForm $signUpForm */
        $signUpForm = $this->get(SignUpForm::class);

        if (!$signUpForm->isValid()) {
            return false;
        }

        $signUpData = $signUpForm->getData();

        $userAdd = $this->userAdd($signUpData);

        if ($userAdd['success']) {
            $this->sendVarifiEmail();
        }

        return $userAdd;
    }

    /**
     * @param array $formData
     *
     * @return array
     */
    public function authenticate(array $formData)
    {
        /** @var GetUserData $userDataEntity */
        $userDataEntity = $this->get(GetUserData::class);

        $arrayObject = new ArrayObject();
        $arrayObject->setFlags(ArrayObject::ARRAY_AS_PROPS);

        $arrayObject->offsetSet('email', $formData['email']);
        $arrayObject->offsetSet('password', $formData['password']);

        $userDataEntity->setParams($arrayObject);

        $coreAuthAdapter = new CoreAuthAdapter($userDataEntity);

        /** @var AuthenticationService $authenticationService */
        $authenticationService = $this->get(AuthenticationService::class);

        /** @var UserSession  $userSession */
        $userSession = $this->get(UserSession::class);

        $authenticationService->setStorage($userSession);

        $authenticationResult = $authenticationService->authenticate($coreAuthAdapter);

        switch ($authenticationResult->getCode()) {
            case Result::SUCCESS:
                $authenticationResultArray = ['success' => true];

                break;

            default:
                $authenticationResultArray = [
                    'success' => false,
                    'needSignature' => false,
                    'message' => $authenticationResult->getMessages()[0]
                ];

                break;
        }

        return $authenticationResultArray;
    }

    /**
     * (non-PHPDoc)
     */
    public function clearIdentity()
    {
        /** @var AuthenticationService $authService */
        $authService = $this->get(AuthenticationService::class);

        $authService->clearIdentity();
    }
}