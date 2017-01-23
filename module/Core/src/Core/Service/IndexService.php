<?php
/**
 * IndexService
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Service;

use Core\Entity\StoredFunction\ErrorLogAdd;
use Product\Entity\StoredProcedure\ChippedIn;
use User\Entity\EntityFunction\GetUserData;
use Spav\ServiceManager\ServiceManager;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Log\Logger;
use Zend\Stdlib\ArrayObject;

class IndexService extends ServiceManager
{
    /**
     * @return LocaleService
     */
    public function getLocaleService() : LocaleService
    {
        return $this->get(LocaleService::class);
    }
}