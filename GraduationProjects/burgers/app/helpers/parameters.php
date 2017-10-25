<?php
require_once __DIR__ . "/../classes/DBConfig.php";

use Burgers\App\Classes\DBConfig;

DBConfig::$driver   = 'mysql';
DBConfig::$host     = 'localhost';
DBConfig::$dbname   = 'burgers';
DBConfig::$charset  = 'UTF8';
DBConfig::$user     = 'root';
DBConfig::$password = '';