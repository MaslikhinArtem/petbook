<?php // обработка данных метод POST
if (isset($_POST['name'])){
    $name = $_POST['name'];
    
}
$login = $_POST['login'];
$password = md5($_POST['password']);

?>