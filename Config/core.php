<?php 
include_once (dirname(__FILE__) . '/db.php');
include_once (dirname(__FILE__) . '/../Models/Users.php');

$connect = DB::getInstance();
$GLOBALS['pdo'] = $connect::connectDB();

$user = new Users();
?>