<?php
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

test1();


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

test3();