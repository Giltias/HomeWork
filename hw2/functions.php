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
    $reverse = join('', array_reverse(preg_split('//u', $lStr)));
    if ($lStr === $reverse) {
        return true;
    }
    return false;
}

/*================ КОНЕЦ ЗАДАНИЯ #5 ==========================*/


