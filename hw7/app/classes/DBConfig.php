<?php
namespace HW7\App\Classes;

/**
 * Класс, содержащий конфигурацию
 *
 * Class DBConfig
 * @package HW7\App\Classes
 */
class DBConfig
{
    private static $items = [];

    public static function addItem($key, $value)
    {
        self::$items[$key] = $value;
    }

    public static function getItem($key)
    {
        return self::$items[$key];
    }

    private static function isSetItem($key)
    {
        return !empty(self::$items[$key]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public static function setDSN()
    {
        if (self::isSetItem('driver') && self::isSetItem('host') &&
            self::isSetItem('dbname') && self::isSetItem('charset')) {
            $dsn = '%s:host=%s;dbname=%s;charset=%s';
            return sprintf(
                $dsn,
                self::getItem('driver'),
                self::getItem('host'),
                self::getItem('dbname'),
                self::getItem('charset')
            );
        } else {
            throw new \Exception('Не установлены основные параметры для подключения к базе данных');
        }
    }
}