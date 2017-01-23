<?php
/**
 * ErrorLogAdd
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Entity\StoredFunction;

use Spav\Entity\MySql\ParamInterface;
use Spav\Entity\MySql\StoredFunction\BindExecute;
use Spav\Entity\MySql\StoredFunction\Execute;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Stdlib\ArrayObject;

class ErrorLogAdd extends /*BindExecute*/ Execute implements ParamInterface
{
    /**
     * @var int
     */
    private $sqlState;
    /**
     * @var int
     */
    private $errorNumber;
    /**
     * @var string
     */
    private $errorText;
    /**
     * @var int
     */
    private $userId;

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
        return 'yf_f_error_log_add';
    }

    /**
     * @param ArrayObject $paramObject
     */
    public function setParams(ArrayObject $paramObject)
    {
        $this->sqlState = $paramObject->sqlState;
        $this->errorNumber = $paramObject->errorNumber;
        $this->errorText = $paramObject->errorText;
        $this->userId = $paramObject->userId;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            [ParameterContainer::TYPE_INTEGER => $this->sqlState],
            [ParameterContainer::TYPE_INTEGER => $this->errorNumber],
            [ParameterContainer::TYPE_STRING => $this->errorText],
            [ParameterContainer::TYPE_INTEGER => $this->userId]
        ];
    }
}