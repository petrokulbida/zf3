<?php
/**
 * Adapter
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */

namespace Core\Auth;

use Spav\Entity\MySql\AbstractStoredFunction;
use User\Entity\EntityFunction\GetUserData;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class Adapter implements AdapterInterface
{
    /**
     * @var string
     */
    const ERROR_AUTHENTICATE = 'error_authenticate';

    /**
     * @var string
     */
    private $messageError;

    /**
     * @var AbstractStoredFunction
     */
    private $userDataEntity;

    /**
     * Adapter constructor.
     *
     * @param GetUserData $userDataEntity
     */
    public function __construct(GetUserData $userDataEntity)
    {
        $this->userDataEntity = $userDataEntity;
    }

    /**
     * (non-PHPDoc)
     * @see Zend_Auth_Adapter_Interface::authenticate()
     */
    public function authenticate()
    {
        $identity = $this->getIdentity();

        //todo need refactoring
        switch ($identity) {
            case self::ERROR_AUTHENTICATE :
                return new Result(Result::FAILURE, $identity, [$this->messageError]);
                break;
            default :
                return new Result(Result::SUCCESS, $identity);
                break;
        }
    }

    /**
     * (non-PHPDoc)
     * @return array|string
     */
    protected function getIdentity()
    {
        $userDataEntityResult = $this->userDataEntity->execute();

        if (!$userDataEntityResult['success']) {
            $this->messageError = $userDataEntityResult['message'];

            return self::ERROR_AUTHENTICATE;
        }

        return [
            'userId' => $userDataEntityResult['data']['user_id'],
            'userEmail' => $userDataEntityResult['data']['user_email'],
            'usePhoneNumber' => $userDataEntityResult['data']['user_phone']
        ];
    }
}