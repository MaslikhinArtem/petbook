<?php
$title_name = "Мессенджер";

require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: ../vendor/entrance.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title_name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .wrapper {
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            height: 100vh;
        }
        .profale {
            border: 5px rgb(166, 166, 166) solid;
            display: flex;
            height: 70vh;
            width: 60vw;
            background-color: rgb(50, 50, 50);
            margin: 4%;
            border-radius: 20px;
            overflow: hidden;
        }
        .profale-left {
            border-right: 1px #D18B47 solid;
            width: 30%;
            background-color: #D18B47;
        }
        .profale-right {
            border-left: 1px #D18B47 solid;
            width: 70%;
            position: relative;
            height: 100%;
        }
        .message-form{
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            border: #D18B47 1px solid;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #D18B47;
        }
        .message-form input {
            width: 80%;
            border: none;
            border-radius: 10px;
            padding: 5px;
            bottom: 0;
        }
        .message-form button {
            border: none;
            border-radius: 10px;
            padding: 5px;
            background-color:rgb(211, 211, 147);
            cursor: pointer;
        }
        .messages {
            height: 88%;
            overflow-y: auto;
            padding: 10px;
        }
        .profale-about {
            border-bottom: 2px #D18B47 solid;
            padding: 15px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FAFAE7;
        }
        .accounts {
            padding: 5px;
        }
    
        .account {
            padding: 10px;
            border-bottom: 1px #D18B47 solid;
            display: flex;
            align-items: center;
            background-color: #FAFAE7;
            color: #D18B47;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: background-color 0.3s ease;
        }
        .account:hover {
            background-color: #D18B47;
            color: #FAFAE7
        }
        .account i {
            margin-right: 10px;
            color: #D18B47;
        }
        .account div {
            flex-grow: 1;
        }
        .message {
            width: fit-content;
            background-color: #D18B47;
            color: #FAFAE7;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
        }
        .message.my {
            align-self: flex-end;
            background-color: #D18B47;
            margin-right: 10px;
            margin-left: auto;
        }
        .message.buddy {
            align-self: flex-start;
            background-color: #FAFAE7;
            color: #D18B47;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="profale">
            <div class="profale-left">
                <div class="profale-about" style="color: #D18B47;">Привет! <?php echo $_SESSION['user']['name'];?></div>
                <div class="accounts">
                    <?php 
                    $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
                    if ($mysql->connect_error) {
                        die("Connection failed: " . $mysql->connect_error);
                    }
                    $accounts_name = $mysql->query("SELECT `name`, `id` FROM `users`");
                    while ($user = $accounts_name->fetch_assoc()) {
                        if ($user['name'] == $_SESSION['user']['name']) {
                            $user['name'] = 'Избранное';
                        }
                        echo '<div class="account">';
                        echo '<div>' . '<i class="fa-regular fa-user"><a href=massanger.php?id=' . $user['id'] . '></i>' . '   ' . htmlspecialchars($user['name']) . '</a></div>';
                        echo '</div>';
                    }
                    $mysql->close();
                    ?>
                    </div>
                    </div>
            <div class="profale-right">
                <div class="messages">
                <?php
                $mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
                if ($mysql->connect_error){
                    die("Connection failed: " . $mysql->connect_error);
                }

                $stmt = $mysql->prepare("SELECT * FROM `messanger` WHERE `sender_id` = ? OR `recipient_id` = ?");
                $stmt->bind_param("ii", $_SESSION['user']['id'], $_SESSION['user']['id']);
                $stmt->execute();
                if (isset($_GET['id'])) {
                    $_SESSION['recipient_id'] = $_GET['id'];
                }
                else {
                    $_GET['id'] = $_SESSION['recipient_id'];
                }
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($message = $result->fetch_assoc()) {
                        if ($message['sender_id'] == $_SESSION['user']['id'] && $message['recipient_id'] == $_GET['id']) {
                            echo '<div class="message my">' . htmlspecialchars($message['message']) . '</div>';
                        }
                        elseif ($message['sender_id'] == $_GET['id'] && $message['recipient_id'] == $_SESSION['user']['id']) {
                            echo '<div class="message buddy">' . htmlspecialchars($message['message']) . '</div>';
                        }
                    }
                }
                ?>

                </div>
                <?php
                ?>
                <form class="message-form" method="post" action="send_message.php">
                    <input type="text" placeholder="Введите сообщение" name="message" required>
                    <button type="submit">Отправить</button>
                </form>

            </div>
                </div>
        </div>
    </div>

</body>
</html>

<?php
require_once '../blocks/footer.php';
?>