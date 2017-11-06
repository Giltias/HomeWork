<?php
namespace HW4\App\Models;


/**
 * Класс, содержащий конфигурацию
 *
 * Class DBConfig
 * @package HW4\App\Models
 */
class DBConfig
{
    /**
     * @var
     */
    public static $driver;

    /**
     * @var
     */
    public static $host;

    /**
     * @var
     */
    public static $dbname;

    /**
     * @var
     */
    public static $charset;

    /**
     * @var
     */
    public static $user;

    /**
     * @var
     */
    public static $password;

    /**
     * @return string
     */
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