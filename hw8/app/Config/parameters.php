<?php
use HW8\App\ConfigStore;
/**
 * Блок настроек подлючения к БД
 */
ConfigStore::addItem('driver'   , 'mysql');
ConfigStore::addItem('host'     , '192.168.1.15');
ConfigStore::addItem('database' , 'hw8');
ConfigStore::addItem('username' , 'root');
ConfigStore::addItem('password' , '');
ConfigStore::addItem('charset'  , 'UTF8');
ConfigStore::addItem('collation', 'utf8_unicode_ci');
ConfigStore::addItem('prefix'   , '');
/**
 * Базовый namespace к контроллерам
 */
ConfigStore::addItem('controllerBasePath', '\\HW8\\App\\App\\Controller\\');