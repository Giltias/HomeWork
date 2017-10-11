<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Document</title>
</head>
<body>
<table>
    <tbody>
    <?php
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 10; $j++) {
            $res = $i * $j;
            if (($i % 2 === 0) && ($j % 2 === 0)) {
                $res = "(" . $res . ")";
            } elseif (($i % 2 === 1) && ($j % 2 === 1)) {
                $res = "[" . $res . "]";
            }
            echo "<td>{$i} x {$j} = {$res}</td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>