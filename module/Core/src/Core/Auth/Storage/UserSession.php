<?php
/**
 * UserSession
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package Core
 */

namespace Core\Auth\Storage;

use Zend\Authentication\Storage;
use Zend\Session\SessionManager;

class UserSession extends Storage\Session
{

    /**
     * @var UserSession
     */
    private static $instance;

    /**
     * Sets session storage options and initializes session namespace object
     *
     * @param  mixed $namespace
     * @param  mixed $member
     * @param  SessionManager $manager
     */
    public function __construct($namespace = null, $member = null, SessionManager $manager = null)
    {
        parent::__construct($namespace, $member, $manager);
        self::$instance = $this;
    }

    /**
     * @return UserSession|boolean
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            return false;
        }
        return self::$instance;
    }

    /**
     * @return mixed|boolean
     */
    public static function getIdentity()
    {
        $instance = self::getInstance();

        return $instance ? $instance->read() : null;
    }
}