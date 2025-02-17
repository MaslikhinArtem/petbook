<?php // регистрация с вводом в базу данных
session_start();
require_once 'connect.php';
require '../captcha.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $captcha = new Captcha();
    $captcha_response = $captcha->verify($_POST['g-recaptcha-response']);
    $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');


    if ($captcha_response->success) {
        // CAPTCHA прошла проверку
        $mysql->query("INSERT INTO `users` (`name`, `login`, `password`) VALUES ('$name', '$login', '$password')");  // ввод данных в базу данных
        $_SESSION['user'] = [  // запись данных в сессию
            "id" => $mysql->insert_id,
            "name" => $name,
            "login" => $login
        ];
    } else {
        // CAPTCHA не прошла проверку
        $_SESSION['msg'] = 'Подтвердите, что вы не робот';
    }
}
$mysql->close();
header('Location: ../index.php');

?>

