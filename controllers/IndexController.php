<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2018-12-09
 * Time: 21:13
 */

namespace App\controllers;

use App\components\Controller;
use App\models\Transaction;
use App\models\User;

/**
 * Class IndexController
 * @package App\controllers
 */
class IndexController extends Controller
{
    /**
     * @var User $user
     * @return false|string
     * @throws \Exception
     */
    public function actionIndex($user)
    {
        $transactionModel = new Transaction();
        
        if (!empty($_POST)) {
            if ($_POST['amount'] != '') {
                $result = $transactionModel->newTransaction($user->account['id'], floatval($_POST['amount']));
                $_SESSION['payResult'] = $result;
                header("Location: /");
            }
        }
    
        $transactions = $transactionModel->getAllUserTransactions($user->account['id']);
        
        $result = null;
        if (isset($_SESSION['payResult'])) {
            $result = $_SESSION['payResult'];
            unset($_SESSION['payResult']);
        }
        
        return $this->render('index', [
            'user' => $user,
            'transactions' => $transactions,
            'result' => $result,
        ]);
    }
    
    /**
     * @return false|string
     * @throws \Exception
     */
    public function actionLogin()
    {
        if (!empty($_POST)) {
            if ($_POST['email'] != '' || $_POST['password']) {
                $user = new User();
                if ($user->validateLogin($_POST['email'], $_POST['password'])) {
                    $_SESSION['authId'] = $user->account['id'];
                    header("Location: /");
                }
                return $this->render('login', ['error' => 'Не верная почта или пароль']);
            }
        }
        return $this->render('login');
    }
    
    /**
     * @param $status
     * @param $message
     * @return false|string
     */
    public function actionError($status, $message)
    {
        return $this->render('error', [
            'status' => $status,
            'message' => $message
        ]);
    }
}
