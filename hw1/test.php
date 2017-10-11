<?php

/*================ ЗАДАНИЕ #1 =========================*/
echo "************ ЗАДАНИЕ #1 **************" . PHP_EOL;
$name = 'Виктор';
$age = 28;
echo "Меня зовут: {$name}" . PHP_EOL;
echo "Мне {$age} лет" . PHP_EOL;
echo "\"!|\\/'\"\\" . PHP_EOL . PHP_EOL;

/*================ ЗАДАНИЕ #2 ==========================*/
echo "************ ЗАДАНИЕ #2 **************" . PHP_EOL;
$pictures = 80;
$felt = 23;
$pencil = 40;
$step1 = $felt + $pencil;
$paints = $pictures - $step1;
$task = "На школьной выставке {$pictures} рисунков. {$felt} из них выполнены фломастерами, {$pencil} карандашами," .
    "а остальные - красками. Сколько рисунков, выполненные красками, на школьной выставке?";
$solution_step1_text = "Первым действием находим количество рисунков, сделанных при помощи фломастера и карандаша: {$step1} шт.";
$solution_step2_text = "Вторым действием находим разницу между общим количеством рисунков и фломастеров с карандашами: {$paints} шт.";
$answer = "Ответ: {$paints} рисунков нарисовано красками";
echo $task . PHP_EOL . $solution_step1_text . PHP_EOL .
     $solution_step2_text . PHP_EOL . $answer . PHP_EOL . PHP_EOL;

/*================ ЗАДАНИЕ #3 ==========================*/
echo "************ ЗАДАНИЕ #3 **************" . PHP_EOL;
define(FAVORITE_GROUP, 'Bon Jovi');
$const_set = defined('FAVORITE_GROUP') ? 'Константа существует' : 'Константа не существует';
echo $const_set . PHP_EOL;
echo "Значение константы: " . FAVORITE_GROUP . PHP_EOL;
//FAVORITE_GROUP = 'IOWA';                                  //так вызывается ошибка
define('FAVORITE_GROUP', 'IOWA');                           //а так ничего не меняется
echo "Измененное значение константы: " . FAVORITE_GROUP . PHP_EOL . PHP_EOL;    //вывод: Bon Jovi круче!

/*================ ЗАДАНИЕ #4 ==========================*/
echo "************ ЗАДАНИЕ #4 **************" . PHP_EOL;
$age = rand(1, 150);
switch ($age % 10) {
    case 1: $age_text = 'год';
            break;
    case 2:
    case 3:
    case 4: $age_text = 'года';
            break;
    default: $age_text = 'лет';
             break;
}
echo "Вам {$age} {$age_text}, а значит ";
if ($age >= 18 && $age <= 65) {
    echo "Вам еще работать и работать";
} elseif ($age > 65) {
    echo "Вам пора на пенсию";
} elseif ($age >= 1 && $age <= 17) {
    echo "Вам еще рано работать";
} else {
    echo "Неизвестный возраст";
}
echo PHP_EOL;