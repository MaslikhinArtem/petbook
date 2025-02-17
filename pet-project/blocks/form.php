<div class="form_auth" align="center" style="border-radius: 20px;border:solid 1px; padding:5% 5% 1% 5%;margin:5% 30% 5% 30%;background-color: #D18B47">
    <form method="post" action="<?php echo $file_form?>">
        <h1><?php echo $title_name?></h1>
        <?php if ($title_name == "Регистрация") // Если на странице регистрации
        {
            echo '<input type="text" name="name" placeholder="Введите имя"><br>';

        } ?>
        <input type="text" name="login" placeholder="Введите логин"><br>
        <input type="password" name="password" placeholder="Введите пароль"><br>
        <div class="g-recaptcha" data-sitekey="6Lc9wtMqAAAAAESh8FumQo9NrQ2_YP0V0xtZcDmx"></div>
        <div class="textdanger" id="recaptchaError"> </div>
        <input type="submit" class="btn btn-success" value="Отправить" style="background-color: #FAFAE7;border:solid 3px; color: #50473e; margin: 10px;">
    </form>
        <?php 
            if ($title_name == "Вход") // Если на странице входа
            {
                echo '<p><a href="registration.php" style="color: black;">зарегистрироваться</a></p>';
            }
            else // Если на странице регистрации
            {
                    echo '<p><a href="entrance.php" style="color: black;">войти</a></p>';
            }
            if (isset($_SESSION["msg_password"])) // Если есть сообщение об ошибке
            {
                echo '<p class="msg"> ' . $_SESSION['msg_password'] . '</p>';
                unset($_SESSION['msg_password']);
            }

        ?>
</div>