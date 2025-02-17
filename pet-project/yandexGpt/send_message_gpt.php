<?php
session_start();
require_once 'yandex_api.php';
$response = new YandexGPT();
$_SESSION['response_gpt'] = $response->gptAnswer($_POST['message'])["result"]["alternatives"][0]['message']['text'];
header('Location: Yandexgpt.php');




?>