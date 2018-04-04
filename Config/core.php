<?php 
include_once (dirname(__FILE__) . '/db.php');

//variables to connect to the DB through db.php singleton
$connect = DB::getInstance();
$GLOBALS['pdo'] = $connect::connectDB();

?>