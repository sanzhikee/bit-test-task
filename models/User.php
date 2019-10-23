<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2018-12-09
 * Time: 21:08
 */

namespace App\models;

use App\components\helpers\PasswordHelper;
use App\components\interfaces\DatabaseModelInterface;
use App\components\Model;

/**
 * Class User
 * @package App\models
 */
class User extends Model implements DatabaseModelInterface
{
    /**
     * @var array|null
     */
    public $account = null;
    
    /**
     * @param $mail
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function validateLogin($mail, $password)
    {
        $account = $this->db->query("SELECT * FROM users WHERE email = '$mail'");
        if (!empty($account)) {
            $this->account = $account[0];
            return PasswordHelper::validatePassword($password, $account[0]['password']);
        }
        
        return false;
    }
    
    /**
     * @param $id
     * @return self
     * @throws \Exception
     */
    public function getAccountById($id)
    {
        $account = $this->db->query("SELECT * FROM users WHERE id = '$id'");
        if (!empty($account)) {
            $this->account = $account[0];
            return $this;
        } else {
            return $this;
        }
    }
}
