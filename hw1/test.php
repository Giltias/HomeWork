<?php

/*================ ЗАДАНИЕ #1 =========================*/
echo "************ ЗАДАНИЕ #1 **************" . PHP_EOL;
$name = 'Виктор';
$age = 28;
echo "Меня зовут: $name" . PHP_EOL;
echo "Мне $age лет" . PHP_EOL;
echo "\"!|\\/'\"\\" . PHP_EOL . PHP_EOL;

/*================ ЗАДАНИЕ #2 ==========================*/
echo "************ ЗАДАНИЕ #2 **************" . PHP_EOL;
$pictures = 80;
$felt = 23;
$pencil = 40;
$step1 = $felt + $pencil;
$paints = $pictures - $step1;
$task = "На школьной выставке $pictures рисунков. $felt из них выполнены фломастерами, $pencil карандашами," .
    "а остальные - красками. Сколько рисунков, выполненные красками, на школьной выставке?";
$solution_step1_text = "Первым действием находим количество рисунков, сделанных при помощи фломастера и карандаша: $step1 шт.";
$solution_step2_text = "Вторым действием находим разницу между общим количеством рисунков и фломастеров с карандашами: $paints шт.";
$answer = "Ответ: $paints рисунков нарисовано красками";
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
$age = rand(-5, 150);
//$age = -5; //для проверки неизвестного дня
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
echo "Вам $age $age_text, а значит ";
if ($age >= 18 && $age <= 65) {
    echo "Вам еще работать и работать";
} elseif ($age > 65) {
    echo "Вам пора на пенсию";
} elseif ($age >= 1 && $age <= 17) {
    echo "Вам еще рано работать";
} else {
    echo "Неизвестный возраст";
}
echo PHP_EOL . PHP_EOL;

/*================ ЗАДАНИЕ #5 ==========================*/
echo "************ ЗАДАНИЕ #5 **************" . PHP_EOL;
$day = rand(1, 10);
echo "{$day} - ";
switch ($day) {
    case 1:case 2:case 3:case 4:case 5: echo "это рабочий день"; break;
    case 6:case 7: echo "это выходной день"; break;
    default: echo "неизвестный день"; break;
}
echo PHP_EOL . PHP_EOL;

/*================ ЗАДАНИЕ #6 ==========================*/
echo "************ ЗАДАНИЕ #6 **************" . PHP_EOL;
$bmw = array(
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year"  => 2015
);
$toyota = array(
    "model" => "Camry",
    "speed" => 130,
    "doors" => 4,
    "year"  => 2016
);
$opel = array(
    "model" => "Corsa",
    "speed" => 90,
    "doors" => 3,
    "year"  => 2009
);
$cars = array(
    "bmw" => $bmw,
    "toyota" => $toyota,
    "opel" => $opel
);
foreach (array_keys($cars) as $car_key) {
    echo "CAR " . $car_key . PHP_EOL;
    echo implode(" ", $cars[$car_key]) . PHP_EOL . PHP_EOL;
}

/*================ ЗАДАНИЕ #8 ==========================*/
echo "************ ЗАДАНИЕ #8 **************" . PHP_EOL;
$str = "1 2 3 4 5 6 7 8 9";
echo $str . PHP_EOL;
$arrFromStr = explode(" ", $str);
//echo implode(" ", array_reverse($arrFromStr)); //вариант проще, но не по заданию
//echo implode(" ", array_reverse(preg_split('//u', $str))); //еще вариант не по заданию
print_r($arrFromStr);
$cnt = count($arrFromStr);
$i = 0;
while ($cnt > 0 && $cnt > $i) {
    $cnt--;
    $tmp = $arrFromStr[$cnt];
    $arrFromStr[$cnt] = $arrFromStr[$i];
    $arrFromStr[$i] = $tmp;
    $i++;
}
//$arrFromStr = $tmp;
echo implode('_', $arrFromStr);
