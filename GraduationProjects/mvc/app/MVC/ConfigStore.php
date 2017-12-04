<?php
namespace MVC\MVC;

/**
 * Класс-контейнер с конфигурацией
 *
 * Class ConfigStore
 * @package MVC\MVC
 */
/**
 * Class ConfigStore
 * @package MVC\MVC
 */
class ConfigStore
{
    /**
     * @var array
     */
    private static $items = [];

    /**
     * @param $key
     * @param $value
     */
    public static function addItem($key, $value)
    {
        self::$items[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function getItem($key)
    {
        return self::$items[$key];
    }

    /**
     * @param $key
     * @return bool
     */
    private static function isSetItem($key)
    {
        return !empty(self::$items[$key]);
    }

    /**
     * @param $string
     * @return array
     */
    public static function getArrayByKeys($string)
    {
        $arr = [];

        if (!empty($string)) {
            $arrKeys = array_map('trim', explode(',', $string));
            foreach ($arrKeys as $key) {
                $arr[$key] = self::getItem($key);
            }
        }

        return $arr;

    }
}