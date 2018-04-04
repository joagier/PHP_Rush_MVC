<?php 
include_once (dirname(__FILE__) . '/db.php');
include_once (dirname(__FILE__) . '/../Models/Users.php');

//variables to connect to the DB through db.php singleton
$connect = DB::getInstance();
$GLOBALS['pdo'] = $connect::connectDB();

$user = new Users();
?>