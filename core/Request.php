<?php

namespace App\Core;

/**
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class Request
{
    public static function uri()
    {
        return trim(parse_url(explode('.', $_SERVER['REQUEST_URI'])[0], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
