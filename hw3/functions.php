<?php
/*================ ЗАДАНИЕ #1 ==========================*/
function test1() {
    $file = 'data.xml';
    if (!file_exists($file)) {
        echo 'Нет исходного файла xml';
        return false;
    }
    $orderAttributes = simplexml_load_string(file_get_contents($file));

    $orderDate = date_create_from_format('Y-m-d', $orderAttributes['OrderDate']);
    $str = sprintf("<h1>Order #%s from %s</h1>", $orderAttributes['PurchaseOrderNumber'], date_format($orderDate, 'd.m.Y'));
    foreach ($orderAttributes->Address as $address) {
        $str .= sprintf('<div><h3>Address %s</h3>', $address['Type']);
        $str .= sprintf('<p>%s<br>%s<br>%s %s %s<br>%s</p>',
            $address->Name,
            $address->Street,
            $address->City,
            $address->State,
            $address->Zip,
            $address->Country);
        $str .= '</div>';
    }
    $str .= sprintf('<i>Note to the courier: %s</i>', $orderAttributes->DeliveryNotes);

    $str .= '<div><h3>Order details</h3>';
    $str .= '<table style="border-collapse: collapse;">
                <thead style="background: #d3d3d3; font-weight: bold;">
                    <tr>
                        <td style="padding: 10px; border: 1px solid black;">Product Name</td>
                        <td style="padding: 10px; border: 1px solid black;">Part Number</td>
                        <td style="padding: 10px; border: 1px solid black;">Quantity</td>
                        <td style="padding: 10px; border: 1px solid black;">Price</td>
                        <td style="padding: 10px; border: 1px solid black;">Overall price</td>
                        <td style="padding: 10px; border: 1px solid black;">Ship date</td>
                        <td style="padding: 10px; border: 1px solid black;">Comment</td>
                    </tr>
                </thead>
                <tbody>';
    foreach ($orderAttributes->Items->Item as $item) {
        $str .= sprintf('<tr>
                    <td style="padding: 10px; border: 1px solid black;">%s</td>
                    <td style="padding: 10px; border: 1px solid black;">%s</td>
                    <td style="padding: 10px; border: 1px solid black;">%s</td>
                    <td style="padding: 10px; border: 1px solid black;">%s$</td>
                    <td style="padding: 10px; border: 1px solid black;">%.2f$</td>
                    <td style="padding: 10px; border: 1px solid black;">%s</td>
                    <td style="padding: 10px; border: 1px solid black;">%s</td>
                </tr>',
                $item->ProductName,
                $item['PartNumber'],
                $item->Quantity,
                $item->USPrice,
                number_format((float)$item->USPrice * (float)$item->Quantity, 2),
                empty($item->ShipDate) ? '---' : $item->ShipDate,
                empty($item->Comment) ? '---' : $item->Comment
            );
    }
    $str .= '</tbody></table></div>';
    echo $str;
    return true;
}
/*================ КОНЕЦ ЗАДАНИЯ #1 ==========================*/

/*================ ЗАДАНИЕ #2 ==========================*/
/**
 * Создает массив случайных чисел со вложенными массивами макс. количество 2 штуки
 *
 * @return array
 */
function createRandomArr() {
    $count = random_int(5, 10);
    $countInArray = random_int(1, 2);
    $arrInner = [];
    $arr = [];
    $countElemInInnerArray = 0;
    for ($i = 0; $i < $count; $i++) {
        if (random_int(0, 1) === 1 && $countInArray > 0) {
            $countElemInInnerArray  = random_int(2, 5);
            for ($j = 0; $j < $countElemInInnerArray; $j++) {
                array_push($arrInner, random_int(1, 100));
            }
            array_push($arr, $arrInner);
            $countInArray--;
        }
        array_push($arr, random_int(1, 100));
    }
    return $arr;
}

/**
 * Случайным образом выбирает менять массив или нет
 * Меняет переданный в параметрах массив
 *
 * @param $arrFromOutput
 */
function checkChanges(&$arrFromOutput) {
    if (random_int(0, 1) === 1) {
        foreach ($arrFromOutput as $key => &$value) {
            if ($key % 2 === 1) {
                if (is_array($value)) {
                    foreach ($value as &$item) {
                        $item++;
                    }
                } else {
                    $value--;
                }
            }
        }
    }
}

/**
 * Выводит на экран результат сравнения файлов (массивов) output и output2
 *
 * @param $arr
 * @param $str1
 * @param $str2
 */
function printDiffs($arr, $str1, $str2) {
    if (empty($arr)) {
        echo 'Файлы output.json и output2.json идентичны<br>';
    } else {
        echo "Содержимое файлов JSON<br>";
        echo "<table style='border-collapse: collapse'>
                <tbody>
                    <tr>
                        <td style='border: 1px solid black; padding: 10px;'>output.json</td>
                        <td style='border: 1px solid black; padding: 10px;'>$str1</td>
                    </tr>    
                    <tr>
                        <td style='border: 1px solid black; padding: 10px;'>output2.json</td>
                        <td style='border: 1px solid black; padding: 10px;'>$str2</td>
                    </tr>
                </tbody>
              </table>";
        echo 'Файлы output.json и output2.json имеют следующие различия:<br>';
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

function test2() {
    $arr = createRandomArr();
    $jsonArr = json_encode($arr);

    $fp = fopen('output.json', 'wb+');
    fwrite($fp, $jsonArr);
    fclose($fp);

    $arrFromOutput = json_decode(file_get_contents('output.json'));
    checkChanges($arrFromOutput);
    $fp = fopen('output2.json', 'wb+');
    fwrite($fp, json_encode($arrFromOutput));
    fclose($fp);

    $jsonFromOutput  = file_get_contents('output.json');
    $jsonFromOutput2 = file_get_contents('output2.json');
    $arrFromOutput   = json_decode($jsonFromOutput);
    $arrFromOutput2  = json_decode($jsonFromOutput2);
    $arrDiff = array_diff($arrFromOutput, $arrFromOutput2);
    printDiffs($arrDiff, $jsonFromOutput, $jsonFromOutput2);
}
/*================ КОНЕЦ ЗАДАНИЯ #2 ==========================*/

/*================ ЗАДАНИЕ #3 ==========================*/
function test3() {
    $arr = [];
    $cnt = random_int(50, 200);
    $filename = 'test.csv';
    for ($i = 0; $i < $cnt; $i++) {
        array_push($arr, random_int(1, 100));
    }
    $fp = fopen($filename, 'wb+');
    fputcsv($fp, $arr);
    fclose($fp);
    $fp = fopen($filename, 'rb');
    $data = fgetcsv($fp);
    fclose($fp);
    $result = 0; $sum = 0;
    $cntData = count($data);
    foreach ($data as $datum) {
        $sum += $datum;
        if ($datum % 2 === 0) {
            $result += $datum;
        }
    }
    echo "Сумма четных чисел = $result<br>Сумма всех чисел = $sum<br>Всего чисел - $cntData";
    return true;
}
/*================ КОНЕЦ ЗАДАНИЯ #3 ==========================*/

/*================ ЗАДАНИЕ #4 ==========================*/
function test4() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');
    $json = curl_exec($ch);
    curl_close($ch);
    $dataArr = json_decode($json, true);
    $filters = ['title', 'pageid'];
    $result = array_filter(
        $dataArr['query']['pages'][15580374],
        function ($key) use ($filters) { return in_array($key, $filters); },
        ARRAY_FILTER_USE_KEY
        );
    echo "Title - " . $result['title'] . '<br>';
    echo "PageId - " . $result['pageid'] . '<br>';
}
/*================ КОНЕЦ ЗАДАНИЯ #4 ==========================*/