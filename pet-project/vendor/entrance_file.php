<?php
// вход в личный кабинет и проверка на существование пользователя
session_start();
require 'connect.php';
require '../captcha.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $captcha = new Captcha();
    $captcha_response = $captcha->verify($_POST['g-recaptcha-response']); // проверка капчи

    if ($captcha_response->success) {

        $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
        $stmt = $mysql->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?"); // подготовка запроса
        $stmt->bind_param("ss", $login, $password); // привязка параметров
        $stmt->execute(); // выполнение запроса
        $result = $stmt->get_result(); // получение результата

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = [  // запись данных в сессию
                "id" => $user['id'],
                "name" => $user['name'],
                "login" => $user['login']
            ];
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['msg_password'] = 'Неверный логин или пароль';  // сообщение об ошибке
            header('Location: entrance.php');
            exit();
        }

        
    }
else {
        // CAPTCHA не прошла проверку
        $_SESSION['msg_password'] = 'Подтвердите, что вы не робот';
        header('Location: entrance.php');
        exit();
    }
}
?>