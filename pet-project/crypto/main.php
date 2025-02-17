<?php 
$title_name = "Курсы валют";
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user']))
{
    header('Location: /pet-project/index.php');
    exit();
}
