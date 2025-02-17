<?php 
$title_name = "YandexGPT";
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: ../vendor/entrance.php');
    exit();
}
?>

<head>
    <link rel="stylesheet" href="../assets/yandex.css">
</head>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo $title_name;?></h1>

        <div class="card">
            <div class="card-header" >
                Ответ бота
            </div>
            <div class="card-body response-container">
                <ul class="list-group" id="botResponses"  >
                    <!-- Пример ответа -->
                    <li class="list-group-item" style="min-height: 5vw;">
                    <?php 
                        if (isset($_SESSION['response_gpt']))
                        {
                            echo '<strong>' . htmlspecialchars($_SESSION['response_gpt']) . '</strong>';
                            unset($_SESSION['response_gpt']);
                        }
                        ?>
                        
                    </li>
                </ul>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form method="post" action="send_message_gpt.php">
                    
                    <div class="mb-3">
                        <label for="userMessage" class="form-label">Ваше сообщение</label>
                        <textarea class="form-control" id="userMessage" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Отправить</button>
                </form>
            </div>
        </div>

    </div>

<?php
require_once '../blocks/footer.php';
?>

