<?php
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: ../vendor/registration.php');
    exit();
}
$message = $_POST['message'];
$theme_id = $_POST['theme_id'];
$user_id = $_SESSION['user']['id'];
$mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
$stmt = $mysql->prepare("INSERT INTO `forum_message` (`message`, `theme_id`, `author_id`) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $message, $theme_id, $user_id);
$stmt->execute();
$stmt->close();
$mysql->close();
header("Location: theme.php?id=$theme_id");
