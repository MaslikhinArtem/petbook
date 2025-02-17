<?php // вход в личный кабинет
$file_form = "entrance_file.php";
$title_name = "Вход";
$css_file = "assets/main.css";

require("../blocks/header_html.php");
?>
<head>
    <link rel="stylesheet" href="../assets/main.css">
</head>
<?php
if (isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();

}
require("../blocks/form.php");
require("../blocks/footer.php")

?>