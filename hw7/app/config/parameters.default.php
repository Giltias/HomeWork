<?php
use DZ06\App\Classes\DBConfig;

/**
 * Блок настроек подлючения к БД
 */
DBConfig::addItem('driver'  , 'mysql');
DBConfig::addItem('host'    , 'localhost');
DBConfig::addItem('dbname'  , 'burgers');
DBConfig::addItem('charset' , 'UTF8');
DBConfig::addItem('user'    , 'root');
DBConfig::addItem('password', '');

/**
 * Блок настроек подключения к почте
 */
DBConfig::addItem('mailUser'  , '');
DBConfig::addItem('mailPass'  , '');

DBConfig::addItem('controllerBasePath', '\\HW7\\App\\Controller\\');
