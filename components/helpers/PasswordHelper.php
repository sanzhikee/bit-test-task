<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 23:19
 */

namespace App\components\helpers;

class PasswordHelper
{
    /**
     * @param $password
     * @return bool|string
     * @throws \Exception
     */
    public static function createPasswordFromString($password)
    {
        /* @noinspection PhpUndefinedConstantInspection */
        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
        
        return $hash;
    }
    
    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function validatePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
