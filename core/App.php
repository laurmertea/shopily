<?php

namespace App\Core;

use Exception;

class App
{
    protected static $registry;

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function isset($key)
    {
        return array_key_exists($key, static::$registry);
    }

    public static function get($key)
    {
        if (! array_key_exists($key, static::$registry)) 
            throw new Exception("No {$key} bound in container!");

        return static::$registry[$key];
    }

    public static function unset($key)
    {
        unset(static::$registry[$key]);
    }
}
