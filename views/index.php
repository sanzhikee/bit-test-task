<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2018-12-09
 * Time: 21:20
 *
 * @var App\models\User $user
 * @var boolean|null $result
 * @var array $transactions
 */
?>
<div class="wrapper fadeInDown">
    <h1 class="fadeIn first">
        Привет <?= $user->account['name'] ?>,
    </h1>

    <h3 class="fadeIn first">
        на твоем счету: <?= $user->account['balance'] ?>
    </h3>

    <div id="formPay" class="form">
        <div class="fadeIn second">
            <h4>
                Перевести денег вникуда?
            </h4>
        </div>
        <form method="post">
            <input type="number" id="number" class="fadeIn third" name="amount" placeholder="Сумма">
            <input type="submit" class="fadeIn fourth" value="вывести" id="confirm">
            
            <?php if (!is_null($result)) { ?>
                <div class="alert alert-warning">
                    <?= $result ? "Деньги списаны" : "Во время транзакции произошла ошибка"; ?>
                </div>
            <?php } ?>
        </form>
    </div>

    <div class="form secondForm">
        <div class="fadeIn second">
            <h4>
                Транзакции
            </h4>
        </div>

        <table class="table table-striped table-bordered">
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Сумма
                </td>
                <td>
                    Время
                </td>
            </tr>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td>
                        <?= $transaction['id'] ?>
                    </td>
                    <td>
                        <?= $transaction['amount'] ?>
                    </td>
                    <td>
                        <?= $transaction['date'] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
