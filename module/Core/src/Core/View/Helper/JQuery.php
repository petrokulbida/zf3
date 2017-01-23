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

class JQuery extends AbstractHelper
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
    private $pathJavaScripts = [

        /* jquery 2.2.3 */
        '/cpanel/plugins/jQuery/jquery-2.2.3.min.js',

        /* jQuery UI 1.11.4 */
        'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
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

        $content.= '<script>$.widget.bridge(\'uibutton\', $.ui.button);</script>';

        self::$isInitialized = true;

        return $content;
    }
}