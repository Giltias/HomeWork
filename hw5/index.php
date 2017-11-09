<?php

use Models\Niva;
use Models\Passat;

require __DIR__ . '/vendor/autoload.php';

$niva = new Niva();
$niva->move(700, 30, 'вперед');

$passat = new Passat();
$passat->move(700, 30, 'назад');