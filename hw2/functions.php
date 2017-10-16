<?php
/*================ ЗАДАНИЕ #1 ==========================*/
function formArrStrForTask1()
{
    $resultArr = [];
    $count = rand(0, 3); //определяем количество Lorem текста
    if ($count === 0) {
        return $resultArr; //возвращаем пустой массив
    }
    //подавляем предупреждения при помощи оператора управления ошибками @
    $content = @file_get_contents('http://loripsum.net/api/$count/short/plaintext'); //получаем Lorem текст
    $resultArr = explode(".", trim($content));
    if ($content === false) {
        return array('Hello, World!', 'My name is Viktor!'); //если сайт недоступен или мы намеренно делаем ошибку в пути, то возвращаем обычный массив
    }
    return $resultArr;
}

function task1($arrStr, $implode = false)
{
    if (empty($arrStr)) {
        return "Не задан массив строк!";
    }
    if ($implode) {
        return implode(".", $arrStr);
    }
    return "<p>" . implode("</p><p>", $arrStr) . "</p>";
}
/*================ КОНЕЦ ЗАДАНИЯ #1 ==========================*/

/*================ ЗАДАНИЕ #2 ==========================*/
function task2($arr, $action) {
    $sign = '';
    $actions = ['sum', 'sub', 'mul', 'div'];
    if (empty($arr)) {
        return "Не задан массив чисел!";
    }
    if (empty($action)) {
        return "Не задано действие";
    }
    if (!in_array($action, $actions)) {
        return "Неизвестное действие";
    }
    $result = 0;
    foreach ($arr as $key => $value) {
        if (!is_numeric($value)) {
            return "Один или несколько элементов массива не являются числами";
        }
        if ($key === 0) {
            $result += $value;
        } else {
            switch ($action) {
                case 'sum':
                    $result += $value;
                    $sign = "+";
                    break;
                case 'sub':
                    $result -= $value;
                    $sign = "-";
                    break;
                case 'mul':
                    $result *= $value;
                    $sign = "*";
                    break;
                case 'div':
                    if ($key > 0 && $value === 0) {
                        return "Деление на ноль невозможно!";
                    }
                    $result /= $value;
                    $sign = "/";
                    break;
            }
        }
    }
    return implode(" " . $sign . " ", $arr) . " = " . $result;
}
/*================ КОНЕЦ ЗАДАНИЯ #2 ==========================*/

/*================ ЗАДАНИЕ #3 ==========================*/
function task3($action, ...$numbers) {
    $eval = implode(" " . $action . " ", $numbers);
    return $eval . " = " . eval('return ' . $eval . ';');
}
/*================ КОНЕЦ ЗАДАНИЯ #3 ==========================*/

/*================ ЗАДАНИЕ #4 ==========================*/
function task4($num1, $num2) {
    if (!is_int($num1) || !is_int($num2)) {
        return "Введен некорректный тип данных! Введите целые числа!";
    }
    if ($num1 < 1 || $num2 < 1) {
        return "Введено отрицательное число";
    }
    $res = '<table>';
    for ($i = 1; $i <= $num1; $i++) {
        $res .= "<tr>";
        for ($j = 1; $j <= $num2; $j++) {
            $result = $i * $j;
            $res .= "<td>$i x $j = $result</td>";
        }
        $res .= "</tr>";
    }
    return $res . "</table>";
}
/*================ КОНЕЦ ЗАДАНИЯ #4 ==========================*/

/*================ ЗАДАНИЕ #5 ==========================*/
function task5_1($string) {
    $lStr = mb_strtolower(str_replace(" ", "", $string), 'utf-8');
    $reverse = implode('', array_reverse(preg_split('//u', $lStr)));
    if ($lStr === $reverse) {
        return true;
    }
    return false;
}
/*================ КОНЕЦ ЗАДАНИЯ #5 ==========================*/

/*================ ЗАДАНИЕ #6 ==========================*/
function task6() {
    return 'Текущая дата/время: ' . date('d.m.Y H:i') . PHP_EOL . '<br>' .
           'Unix-time время соответствующее 24.02.2016 00:00:00 - ' . strtotime('24 february 2016 00:00:00');
}
/*================ КОНЕЦ ЗАДАНИЯ #6 ==========================*/

/*================ ЗАДАНИЕ #7 ==========================*/
function task7() {
    $strKarl = 'Карл у Клары украл Кораллы';
    $strSoda = 'Две бутылки лимонада';
    return $strKarl . ' без заглавных К - ' . str_replace('К', '', $strKarl) . PHP_EOL . '<br>' .
           $strSoda . ' меняем Две на Три - ' . str_replace('Две', 'Три', $strSoda) . PHP_EOL . '<br>' .
           str_replace('Кораллы', mb_strtolower(str_replace('Две', 'Три', $strSoda)), $strKarl);
}
/*================ КОНЕЦ ЗАДАНИЯ #7 ==========================*/

/*================ ЗАДАНИЕ #8 ==========================*/
/**
 * Функция формирует строку с данными по пакету
 * Может выдать пакет формата NX вместо RX
 *
 * @return string
 */
function task8_1() {
    $control = random_int(0, 3);
    $packageName = 'RX';
    $packageProperty = ['packets', 'errors', 'dropped', 'overruns', 'frame'];
    if ($control === 0) {
        $packageName = 'NX';
    }
    shuffle($packageProperty);
    $result = '';
    foreach ($packageProperty as $property) {
        $result .= ' ' . task8_2($property);
    }
    return $packageName . $result;
}

/**
 * Используется для генерации чисел для свойств пакета
 *
 * @param $propertyName
 *
 * @return string
 */
function task8_2($propertyName) {
    $int = ($propertyName === 'packets') ? random_int(10, 5000) : random_int(0, 3);
    $int = ($propertyName === 'packets' && ($int % 2 === 0)) ? ')' : $int;
    return $propertyName . ':' . $int;
}

function task8($str) {
    echo $str  . PHP_EOL . '<br>';
    $packageProperty = array(
        'packets'  => null,
        'errors'   => null,
        'dropped'  => null,
        'overruns' => null,
        'frame'    => null);
    if (empty($str)) {
        return 'Пакет не доставлен';
    }
    if (strpos($str, "RX") === false) {
        return 'Доставлен пакет формата отличного от RX';
    }
    if (preg_match('/\:\)/', $str)) {
        require_once 'smile.php';
        return '<pre>' . $smile . '</pre>';
    }

    foreach (array_keys($packageProperty) as $property) {
        if (preg_match('/' . $property . ':(\d)*/', $str, $arr)) {
            if (preg_match('/(\d)+/', $arr[0], $arrDigit)) {
                $packageProperty[$property] = $arrDigit[0];
            }
        }
    }

    if ($packageProperty['packets'] > 1000) {
        return 'Сеть есть!';
    }

    return 'Пакетов менее 1000: ' . $packageProperty['packets'];
}
/*================ КОНЕЦ ЗАДАНИЯ #8 ==========================*/

/*================ ЗАДАНИЕ #9 ==========================*/
function task9($fileName) {
    if (!file_exists('test.txt')) {
        exec('touch test.txt');
        file_put_contents('test.txt', 'Hello, World!');
    }
    if (!file_exists($fileName)) {
        echo "Файла с именем $fileName не существует";
        return false;
    }
    echo file_get_contents($fileName);
    return true;
}
/*================ КОНЕЦ ЗАДАНИЯ #9 ==========================*/

/*================ ЗАДАНИЕ #10 ==========================*/
function task10() {
    try {
        $fp = fopen('anothertest.txt', 'wb+');
        fwrite($fp, 'Hello again!');
        fclose($fp);
        echo file_get_contents('anothertest.txt');
    } catch (Exception $exception) {
        echo $exception->getMessage();
        return false;
    }
    return true;
}
/*================ КОНЕЦ ЗАДАНИЯ #10 ==========================*/