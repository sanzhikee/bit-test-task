<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 21:52
 */
require(__DIR__ . '/../vendor/autoload.php');

$config = require(__DIR__ . '/../config/main.php');

$app = new App\services\Application($config);
$app->run();
