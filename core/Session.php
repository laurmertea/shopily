<?php

namespace App\Core;

/**
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class Session
{
    const STARTED = true;
    const NOT_STARTED = false;

    private $state = self::NOT_STARTED;
    private static $instance;

    public function __construct()
    {
        
    }

    public static function getInstance()
    {
        if (! isset(self::$instance)) self::$instance = new self;

        self::$instance->start();

        return self::$instance;
    }

    public function start()
    {
        if ($this->state === self::NOT_STARTED) $this->state = session_start();

        return $this->state;
    }

    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }

    public function __get($name)
    {
        return ($_SESSION[$name]) ?? "{$name} not set.";
    }

    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }

    public function destroy()
    {
        if ($this->state === self::STARTED) {
            $this->state = !session_destroy();
            unset($_SESSION);

            return !$this->state;
        }

        return false;
    }
}
