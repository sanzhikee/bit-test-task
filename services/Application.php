<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 21:55
 */

namespace App\services;

use App\components\helpers\PasswordHelper;
use App\controllers\IndexController;
use App\models\Transaction;
use App\models\User;
use MysqliDb;

/**
 * Class Application
 * @package services
 */
class Application
{
    /**
     * @var \MysqliDb $database
     */
    public $database;
    
    /**
     * @var User|null $user
     */
    public $user = null;
    
    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (PHP_SAPI != 'cli') {
            session_start();
        }
        $this->database = new MysqliDb($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['databaseName']);
        
        if (isset($_SESSION['authId'])) {
            $this->user = (new User())->getAccountById($_SESSION['authId']);
        }
    }
    
    /**
     * @throws \Exception
     */
    public function run()
    {
        $result = (new IndexController())->actionError(404, 'Page not found');
        
        if ($_SERVER['REQUEST_URI'] == '/') {
            if (is_null($this->user)) {
                $result = (new IndexController())->actionLogin();
            } else {
                $result = (new IndexController())->actionIndex($this->user);
            }
        }
        
        session_write_close();
        echo $result;
        exit;
    }
    
    /**
     * @throws \Exception
     */
    public function migrate()
    {
        $hasTables = $this->database->query('SHOW TABLES;');
        if (empty($hasTables)) {
            $this->database->query("CREATE TABLE `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `name` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              `balance` double default 0 not null
            ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
            
            $this->database->query("CREATE TABLE `transactions` (
              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `user_id` int(11) NOT NULL,
              `amount` double default 0 not null,
              `date` timestamp default NOW()
            ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
            
            $this->database->query("ALTER TABLE `transactions` ADD CONSTRAINT `fk-transaction-to-user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT");
            
            $hash = PasswordHelper::createPasswordFromString('123');
            $this->database->query("INSERT INTO users (name, email, password, balance) VALUES ('Sanzhar', 'sanzhar.sarsenbi@gmail.com', '$hash', 100)");
        } else {
            throw new \Exception('Migration already set');
        }
    }
    
    /**
     * @param $second
     * @throws \Exception
     */
    public function test($second)
    {
        while (true) {
            if ($second == date('s')) {
                $res = (new Transaction())->newTransaction(1, 55);
                echo ($res ? "Получилось" : "Нет") . "\n";
                return;
            }
            sleep(0.001);
        }
    }
}
