<?php
require_once __DIR__ . "/../models/DBConfig.php";

use HW4\App\Models\DBConfig;

DBConfig::$driver   = 'mysql';
DBConfig::$host     = 'localhost';
DBConfig::$dbname   = 'hw4';
DBConfig::$charset  = 'UTF8';
DBConfig::$user     = 'root';
DBConfig::$password = '';