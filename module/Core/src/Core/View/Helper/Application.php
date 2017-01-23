<?php
/**
 * Application
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package library
 */

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Application extends AbstractHelper
{
    const VERSION = 1;

    /**
     * @var boolean
     */
    static $isInitialized = false;

    /**
     * @var array
     */
    private $pathJavaScripts = [
        '/application/js/msgModal.js',
//        '/application/js/loader.js',

//        '/application/js/ajaxSetup.js',
        '/application/js/modal.js',
        '/application/js/bootstrap-msg.js',

        '/application/js/helper.js',
        '/application/js/main.js',

    ];

    /**
     * @var array
     */
    private $pathStylesheets = [
        '/application/css/yf.css',
        '/application/css/bootstrap-msg.css'
    ];

    /**
     * @return string
     */
    public function __invoke()
    {
        if (self::$isInitialized) {
            return '';
        }

        foreach ($this->pathStylesheets as $pathStylesheet) {
            $this->getView()->headLink()->appendStylesheet($pathStylesheet . '?v' . self::VERSION);
        }

        foreach ($this->pathJavaScripts as $pathJavaScript) {
            $this->getView()->headScript()->appendFile($pathJavaScript . '?v' . self::VERSION);
        }

        self::$isInitialized = true;
    }
}