<?php
/**
 * Created by PhpStorm.
 * User: sanzhikee
 * Date: 2019-10-23
 * Time: 23:00
 *
 * @var array $error
 */
?>
<div class="wrapper fadeInDown">
    <div id="formLogin" class="form">
        <!-- Login Form -->
        <form method="post">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Пароль">
            <input type="submit" class="fadeIn fourth" value="Войти">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <?=$error?>
                </div>
            <?php } ?>
        </form>
    </div>
</div>
