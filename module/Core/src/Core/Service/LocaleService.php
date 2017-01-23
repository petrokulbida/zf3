<?php
/**
 * LocaleService
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */
namespace Core\Service;

use Spav\ServiceManager\ServiceManager;
use Zend\Http\Header\SetCookie;

class LocaleService extends ServiceManager
{
    /**
     * @return array
     */
    public function getLocaleList() : array
    {
        $config  = $this->getConfig();

        /** @var array $localeList */
        $localeList = $config['translator']['list'];

        return $localeList;
    }

    /**
     * @param $locale
     *
     * @return SetCookie
     */
    public function setLocale($locale)
    {
        /** @var array $localeList */
        $localeList = $this->getLocaleList();

        if (array_key_exists($locale, $localeList)) {
            $cookie = new SetCookie();
            $cookie->setName('locale')
                ->setValue($localeList[$locale])
                ->setPath('/')
            ;

            return $cookie;
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentLocale() : string
    {
        $translator = $this->getTranslator();

        return $translator->getTranslator()->getLocale();
    }

    /**
     * @param $locale
     *
     * @return bool
     */
    public function isCurrentLocale($locale)
    {
        if ($locale === $this->getCurrentLocale()) {
            return true;
        }

        return false;
    }
}