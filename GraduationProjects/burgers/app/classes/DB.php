<?php

namespace Burgers\App\Classes;

require_once "DBConfig.php";
require_once "../helpers/parameters.php";

use Burgers\App\Classes\DBConfig;


class DB
{
    /**
     * @var \PDO
     */
    private static $dbn;

    public static function connect()
    {
        if (!isset(self::$dbn)) {
            try {
                self::$dbn = new \PDO(DBConfig::setDSN(), DBConfig::$user, DBConfig::$password);
            } catch (\PDOException $exception) {
                echo 'Подключение не удалось: ' . $exception->getMessage();
            }
        }
        return self::$dbn;
    }
}