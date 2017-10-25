<?php
require_once "../classes/User.php";

use Burgers\App\Classes\User;

$user = new User();

//$user->deleteUser(1);
//$user->deleteUser(2);
//
//$user->addUser('sadssad@asda.asd', 'jkahsdjka');
//$user->addUser('asdadssad@123.asd', 'jkahsdjka');

echo $user->existsUser('asdadssad@123.asd');