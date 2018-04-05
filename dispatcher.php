<?php

//include_once (dirname(__FILE__) . '/Webroot/index.php');

$url = '';

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

var_dump($url);
echo "c'est le parser";