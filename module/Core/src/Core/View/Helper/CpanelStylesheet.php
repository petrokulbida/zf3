<?php
/**
 * CpanelStylesheet
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package library
 */

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CpanelStylesheet extends AbstractHelper
{

    /**
     * @var integer
     */
    const VERSION = 1;

    /**
     * @var boolean
     */
    static $isInitialized = false;

    /**
     * @var array
     */
    private $pathStylesheets = [
        /* Bootstrap 3.3.6 */
        '/cpanel/bootstrap/css/bootstrap.min.css',

        /* Font Awesome */
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',

        /* Ionicons */
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',

        /* Theme style */
        '/cpanel/dist/css/AdminLTE.min.css',

        /* AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. */
        '/cpanel/dist/css/skins/_all-skins.min.css',

        /* iCheck */
        '/cpanel/plugins/iCheck/flat/blue.css',

        /* Morris chart */
        '/cpanel/plugins/morris/morris.css',

        /* jvectormap */
        '/cpanel/plugins/jvectormap/jquery-jvectormap-1.2.2.css',

        /* Date Picker */
        '/cpanel/plugins/datepicker/datepicker3.css',

        /* Daterange picker */
        '/cpanel/plugins/daterangepicker/daterangepicker.css',

        /* bootstrap wysihtml5 - text editor */
        '/cpanel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
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
            $this->getView()->headLink()->appendStylesheet($pathStylesheet . '?' . self::VERSION);
        }

        self::$isInitialized = true;
    }
}