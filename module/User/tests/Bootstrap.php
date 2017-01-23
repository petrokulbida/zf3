<?php
/**
 * Bootstrap
 *
 * @link https://fanatov37@bitbucket.org/fanatov37/zf2.git for the canonical source repository
 * @copyright Copyright (c) 2015 YouFold. (http://youfold.info)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User PHpUnit
 */
namespace UserTest;

use Core\Extension\PHPUnit\Bootstrap as CoreBootstrap;

/* todo need use autoload for it */
require_once dirname(__DIR__) . '../../Core/src/Core/Extension/PHPUnit/Bootstrap.php';

class Bootstrap extends CoreBootstrap
{
    /**
     * (non-PHPDoc)
     *
     * You can override this method. It's for example.
     *
     * @return array
     */
    protected function getModules() : array
    {
        return [
            'Core',
            'User'
        ];
    }

    /**
     * @return array
     */
    public function getNamespace() : array
    {
        return [
            __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
        ];
    }
}

Bootstrap::init();
Bootstrap::chroot();