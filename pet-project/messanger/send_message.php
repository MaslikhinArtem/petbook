<?php
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: ../vendor/registration.php');
    exit();
}
$message = $_POST['message'];
$mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
$stmt = $mysql->prepare("INSERT INTO `messanger` (`message`, `sender_id`, `recipient_id`) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $message, $_SESSION['user']['id'], $_SESSION['recipient_id']);
$stmt->execute();
$stmt->close();
$mysql->close();
header("Location: massanger.php?id=" . $_SESSION['recipient_id']);

?>