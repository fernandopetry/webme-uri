<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';

$test = new Webme\Url\Generator(dirname(__FILE__));

echo $test->getURL();
