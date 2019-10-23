<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 23:52
 */

namespace App\models;

use App\components\interfaces\DatabaseModelInterface;
use App\components\Model;

/**
 * Class Transaction
 * @package App\models
 */
class Transaction extends Model implements DatabaseModelInterface
{
    /**
     * @var array|null
     */
    public $transaction = null;
    
    /**
     * @param integer $userId
     * @param double $amount
     * @return boolean
     * @throws \Exception
     */
    public function newTransaction($userId, $amount)
    {
        try {
            $this->db->mysqli()->query("LOCK TABLES users READ, transactions WRITE;");
            $balance = (new User($this->db))->getAccountById($userId)->account['balance'];
            if ($balance > $amount) {
                try {
                    $total = $balance - $amount;
                    $this->db->mysqli()->query("UNLOCK TABLES;");
                    $this->db->mysqli()->query("START TRANSACTION;");
                    $this->db->query("INSERT INTO transactions (user_id, amount) Values($userId, $amount);");
                    $this->db->query("UPDATE users SET balance=$total WHERE id=$userId");
                    $this->db->mysqli()->query("COMMIT;");
                    return true;
                } catch (\Exception $exception) {
                    $this->db->mysqli()->query("ROLLBACK;");
                    return false;
                }
            }
            $this->db->mysqli()->query("UNLOCK TABLES;");
            return false;
        } catch (\Exception $exception) {
            $this->db->mysqli()->query("UNLOCK TABLES;");
            return false;
        }
    }
    
    /**
     * @param $userId
     * @return array
     * @throws \Exception
     */
    public function getAllUserTransactions($userId)
    {
        return $this->db->query("SELECT * FROM transactions WHERE user_id = $userId ORDER BY date DESC");
    }
}
