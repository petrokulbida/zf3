<?php
/**
 * Bootstrap
 *
 * @link https://fanatov37@bitbucket.org/fanatov37/zf2.git for the canonical source repository
 * @copyright Copyright (c) 2015 YouFold. (http://youfold.info)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core PHPUnit
 */

namespace Core\Extension\PHPUnit;

use Spav\PHPUnit\AbstractBootstrap;

require_once dirname(__DIR__) .
    '../../../../../../vendor/spav/src/PHPUnit/AbstractBootstrap.php';

class Bootstrap extends AbstractBootstrap
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
            'Core'
        ];
    }

    /**
     * @return array
     */
    public function getNamespace() : array
    {
        return [
            __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__
        ];
    }

    /**
     * @return string
     */
    protected function getConfigGlobPaths(): string
    {
        return dirname($this->findParentPath('module')) . '/config/autoload';
    }
}