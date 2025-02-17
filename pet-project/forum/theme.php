<?php 
$title_name = "Тема";
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: entrance.php');
    exit();
}

if (isset($_GET['id'])) {
    $theme_id = $_GET['id'];

} else {
    header('Location: forum.php');
    exit();
}

$mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$stmt = $mysql->prepare("SELECT `name` FROM `forum_topic` WHERE `id` = ?");
$stmt->bind_param("i", $theme_id);
$stmt->execute();
$result = $stmt->get_result();
$theme = $result->fetch_assoc();
$theme_title = htmlspecialchars($theme['name']);

$stmt->close();
$mysql->close();
?>
<head>
    <style>
        .form-message {
            max-width: 500px;
            display: flex;
            flex-direction: row;
            margin: 0 auto;
            position: absolute;
            left: 0;
            max-height: 15vw;
            overflow: hidden;
        }
        .theme{
            display: flex;
            flex-direction: column;
            margin: 10px;
            align-items: center;
            border: 2px solid #2de;
            border-radius: 10px;
            overflow: hidden;
            white-space: nowrap;
        }
        .window{
            max-height: 60vh;
            overflow-y: auto;
            margin: 60px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #ccc;
        }
    </style>
</head>
        
    <div class="container mt-5">
        <h1 class="text-center"><?php echo $theme_title; ?></h1>
        
        <!-- Раздел для создания нового сообщения -->
        <div class="card mb-4 form-message">
            <div class="card-body">
                <form method="post" action="create_forum_message.php">
                    <input type="hidden" name="theme_id" value="<?php echo $theme_id; ?>">
                    <div class="mb-3">
                        <textarea class="form-input" name="message" placeholder="Текст сообщения"></textarea>
                    </div>
                    <div name="<?php echo $theme_id ?>"></div>
                    <button class="btn btn-success" type="submit">Отправить</button>
                </form>
            </div>
        </div>
        <div>
                <div class="window">
                    <?php 
                    $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
                    if ($mysql->connect_error) {
                        die("Connection failed: " . $mysql->connect_error);
                    }
                    $stmt = $mysql->prepare("SELECT `author_id`, `message`, `theme_id` FROM `forum_message` WHERE `theme_id` = ?");
                    $stmt->bind_param("i", $theme_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($message = $result->fetch_assoc()) {
                        $author_id = $message['author_id'];
                        $message_text = htmlspecialchars($message['message']);
                        $stmt2 = $mysql->prepare("SELECT `name` FROM `users` WHERE `id` = ?");
                        $stmt2->bind_param("i", $author_id);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $author = $result2->fetch_assoc();
                        $author_name = htmlspecialchars($author['name']);
                        echo "<div class='theme'>";
                        echo "<div class='author'>$author_name</div>";
                        echo "<div class='message'>$message_text</div>";
                        echo "</div>";
                        $stmt2->close();
                    }
                    ?>
                </div>
            </div>





<?php
require_once '../blocks/footer.php';


?>