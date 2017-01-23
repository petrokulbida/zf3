<?php
/**
 * CpanelJs
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package library
 */

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CpanelJs extends AbstractHelper
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
     * //todo need move romote js to local path
     * @var array
     */
    private $pathJavaScripts = [

        /* Bootstrap 3.3.6 */
       '/cpanel/bootstrap/js/bootstrap.min.js',

        /* Morris.js charts */
       'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',

       '/cpanel/plugins/morris/morris.min.js',

        /* Sparkline */
       '/cpanel/plugins/sparkline/jquery.sparkline.min.js',

        /* jvectormap */
       '/cpanel/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',

       '/cpanel/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',

        /* jQuery Knob Chart */
       '/cpanel/plugins/knob/jquery.knob.js',

        /* daterangepicker */
       'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',

       '/cpanel/plugins/daterangepicker/daterangepicker.js',

        /* datepicker */
       '/cpanel/plugins/datepicker/bootstrap-datepicker.js',

        /* Bootstrap WYSIHTML5 */
       '/cpanel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',

        /* Slimscroll */
       '/cpanel/plugins/slimScroll/jquery.slimscroll.min.js',

        /* FastClick */
       '/cpanel/plugins/fastclick/fastclick.js',

        /* AdminLTE App */
       '/cpanel/dist/js/app.min.js'
    ];

    /**
     * @return string
     */
    public function __invoke()
    {
        if (self::$isInitialized) {
            return '';
        }

        $content = '';

        foreach ($this->pathJavaScripts as $pathJavaScript) {
            $content .= sprintf(
                '<script type="text/javascript" src="%s"></script>',
                $pathJavaScript . '?v' . self::VERSION
            );
            $content .= PHP_EOL;
        }

        self::$isInitialized = true;

        return $content;
    }
}