<?php
namespace Burgers\App\Classes;


class DBConfig
{
    public static $driver;

    public static $host;

    public static $dbname;

    public static $charset;

    public static $user;

    public static $password;

    public static function setDSN()
    {
        $dsn = '%s:host=%s;dbname=%s;charset=%s';
        return sprintf(
            $dsn,
            self::$driver,
            self::$host,
            self::$dbname,
            self::$charset);
    }
}