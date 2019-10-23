<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 22:01
 */
(new \Dotenv\Dotenv(__DIR__ . "/../"))->load();

return [
    'db' => [
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'databaseName' => getenv('DB_NAME')
    ],
];
