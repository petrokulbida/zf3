<?php
/**
 * UserAdd
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Entity\EntityFunction;

use Spav\Entity\MySql\LanguageInterface;
use Spav\Entity\MySql\ParamInterface;
use Spav\Entity\MySql\StoredFunction\BindExecute;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Stdlib\ArrayObject;

class UserAdd extends BindExecute implements ParamInterface, LanguageInterface
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * (non-PHPDoc)
     *
     * @see BindExecute::getFunction()
     *
     * @return string
     *
     */
    protected function getFunction() : string
    {
        return 'user_add';
    }

    /**
     * @param ArrayObject $paramObject
     *
     * @return UserAdd
     */
    public function setParams(ArrayObject $paramObject) : self
    {
        $this->email = $paramObject->email;
        $this->password = $paramObject->password;
        $this->phoneNumber = $paramObject->phoneNumber;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            [ParameterContainer::TYPE_STRING => $this->email],
            [ParameterContainer::TYPE_STRING => $this->password],
            [ParameterContainer::TYPE_STRING => $this->phoneNumber]
        ];
    }
}