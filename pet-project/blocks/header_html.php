<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title_name)?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://kit.fontawesome.com/5ffd4e4605.js" crossorigin="anonymous"></script>
  </head>
<body style="background-color: #FAFAE7;">
<div id="content">
<nav class="navbar navbar-expand-lg bg-body-tertiary p-200" data-bs-theme="dark">
  <div class="container-fluid p-2" style="background-color: #D18B47;">
    <a class="navbar-brand" href="../../pet-project/index.php" style="border: 1px solid; border-radius: 10px;padding:3px;"><i class="fa-solid fa-comment" style="color: #FAFAE7;"></i>   petbook</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Профиль
          </a>
            <?php if (isset($_SESSION['user'])) // Проверка на авторизацию
            {
              echo '<ul class="dropdown-menu dropdown-menu-end Profile_dropdown_entrance">';
              echo '<li><a class="dropdown-item" href=""><i class="fa-solid fa-user fa-2xl" style="border: 1px solid #FAFAE7; border-radius: 20px;padding:20%; background-color: #FAFAE7; color: black;"></i></a></li>';
              echo '<li><a class="dropdown-item" href="" style="color: green;">' . $_SESSION["user"]['login'] . '</a></li><i class="fa-light fa-pen-to-square"></i>';
              echo '<hr>';
              echo '<li><a class="dropdown-item" href="">' . $_SESSION["user"]['name'] . '   ' .'<i class="fa-solid fa-pen-to-square"></i>' . '</a></li>';
              echo '<li><a class="dropdown-item" href="/pet-project/vendor/logout.php" style="color: red;">Выйти</a></li>';
              echo '</ul>';
            }
            else // Если не авторизован
            {
              echo '<ul class="dropdown-menu dropdown-menu-end Profile_dropdown">';
              echo '<li><a class="dropdown-item" href="/pet-project/vendor/entrance.php">Войти</a></li>';
              echo '<li><a class="dropdown-item" href="/pet-project/vendor/registration.php">Зарегистрироваться</a></li>';
              echo '</ul>';
            }
            ?>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
