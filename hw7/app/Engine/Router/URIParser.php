<?php

namespace HW7\App\Engine\Router;


class URIParser
{
    public static function getURI()
    {
        if ($pos = strpos($_SERVER['REQUEST_URI'], '?')) {
            $uri = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $uri = $_SERVER['REQUEST_URI'];
        }
        return self::trim($uri);
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function trim($uri)
    {
        return strlen($uri) !== 1 ? rtrim($uri, '/') : $uri;
    }
}