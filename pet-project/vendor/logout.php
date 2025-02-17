<?php // выход из личного кабинета
session_start();
unset($_SESSION['user']);
header('Location: ../index.php');
?>