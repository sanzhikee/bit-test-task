<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2018-12-09
 * Time: 22:08
 */

namespace App\components;

abstract class Model
{
    /**
     * @var \MysqliDb
     */
    public $db;
    
    /**
     * Model constructor.
     * @var \MysqliDb|null $db
     */
    public function __construct($db = null)
    {
        if (is_null($db)) {
            $config = require(__DIR__ . '/../config/main.php');
            $this->db = new \MysqliDb($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['databaseName']);
        } else {
            $this->db = $db;
        }
    }
}
