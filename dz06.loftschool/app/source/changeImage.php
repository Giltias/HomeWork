<?php
require '../../vendor/autoload.php';

use DZ06\App\Classes\ImageClass;

$photo = $_FILES['photo'];
if (!empty($photo['name'])) {
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($photo['tmp_name']);

    $allowedExt = array('gif', 'png', 'jpg');
    $filename = $photo['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($detectedType, $allowedTypes) && in_array($ext, $allowedExt)) {
        $image = new ImageClass($photo['tmp_name']);
        echo  $image->setChange();
    }
}