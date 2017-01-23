<?php
/**
 * GetUserData
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Entity\EntityFunction;

use Spav\Entity\MySql\LanguageInterface;
use Spav\Entity\MySql\StoredFunction\BindExecute;
use Spav\Entity\MySql\StoredFunction\Execute;
use Spav\Entity\MySql\ParamInterface;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Stdlib\ArrayObject;

class GetUserData extends BindExecute implements ParamInterface, LanguageInterface
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
     * (non-PHPDoc)
     *
     * @see BindExecute::getFunction()
     *
     * @return string
     *
     */
    protected function getFunction() : string
    {
        return 'get_user_data';
    }

    /**
     * @param ArrayObject $paramObject
     *
     * @return self
     */
    public function setParams(ArrayObject $paramObject) : self
    {
        $this->email = $paramObject->email;
        $this->password = $paramObject->password;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams() : array
    {
        return [
            [ParameterContainer::TYPE_STRING => $this->email],
            [ParameterContainer::TYPE_STRING => $this->password]
        ];
    }
}