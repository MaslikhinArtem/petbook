<?php

$title_theme_forum = $_POST['title'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');

    // Проверка подключения
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    }

    // Подготовка и выполнение запроса
    $stmt = $mysql->prepare("INSERT INTO `forum_topic` (`name`) VALUES (?)");
    $stmt->bind_param("s", $title_theme_forum);

    if ($stmt->execute()) {
        // Перенаправление на страницу форума после успешной вставки
        header('Location: forum.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Закрытие подготовленного выражения и соединения
    $stmt->close();
    $mysql->close();
}   
header('Location: forum.php');


?>