<?php

namespace Burgers\App\Classes;

require_once "DBConfig.php";
require_once __DIR__ . "/../helpers/parameters.php";

use Burgers\App\Classes\DBConfig;


/**
 * Класс-обвертка над PDO
 *
 * Class DB
 * @package Burgers\App\Classes
 */
class DB
{
    /**
     * @var \PDO
     */
    private $dbn;

    /**
     * @var
     */
    private static $instance;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->dbn = new \PDO(DBConfig::setDSN(), DBConfig::$user, DBConfig::$password);
        $this->dbn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Возвращает объект PDO
     *
     * @return DB
     */
    public static function connect()
    {
        if (empty(self::$instance)) {
           self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Обвертка над подготовкой и запуском запросов
     *
     * @param $sql
     * @param array $args
     * @param string $errText
     * @return bool|\PDOStatement
     */
    public function run($sql, $args = [], $errText = '')
    {
        $stmt = $this->dbn->prepare($sql);
        if (!empty($args)) {
            foreach ($args as $arg) {
                $stmt->bindParam(':' . $arg[0], $arg[1]);
            }
        }
        try {
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $errText . $e->getMessage();
            return false;
        }
        return $stmt;
    }

    /**
     *  Определение ID последнего INSERT
     *
     * @return string
     */
    public function lastInsId()
    {
        return $this->dbn->lastInsertId();
    }
}