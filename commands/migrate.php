<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 22:07
 */

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../services/Application.php');

$config = require(__DIR__ . '/../config/main.php');

$app = new App\services\Application($config);
$app->migrate();
