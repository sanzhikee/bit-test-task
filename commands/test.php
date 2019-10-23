<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-24
 * Time: 01:20
 */
echo date('s')."\n";
$second = readline("Enter second: ");

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../services/Application.php');

$config = require(__DIR__ . '/../config/main.php');

$app = new App\services\Application($config);
$app->test($second);
