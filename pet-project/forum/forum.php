<?php 
$title_name = "Форум";
require_once '../blocks/header_html.php';
if (!isset($_SESSION['user'])) {
    header('Location: ../vendor/entrance.php');
    exit();
}
?>

    <div class="container mt-5">
        <h1 class="text-center"><?php echo $title_name; ?></h1>
        
        <!-- Раздел для создания новой темы -->
        <div class="card mb-4">
            <div class="card-header">
                Создать новую тему
            </div>
            <div class="card-body">
                <form method="post" action="create_topic.php">
                    <div class="mb-3">
                        <label for="topicTitle" class="form-label">Название темы</label>
                        <input type="text" class="form-control" id="topicTitle" name="title" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>
        </div>

        <!-- Раздел для отображения тем -->
        <div class="card">
            <div class="card-header">
                <?php 
$mysql = new mysqli('localhost', 'root', 'root', 'bd_pet');
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$stmt = $mysql->prepare("SELECT * FROM `forum_topic`");
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($theme = $result->fetch_assoc()) {
        echo '<li class="list-group-item">';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<a href="theme.php?id=' . $theme['id'] . '" class="text-decoration-none">' . htmlspecialchars($theme['name']) . '</a>';
        echo '<span class="badge bg-primary rounded-pill">Новое</span>';
        echo '</div>';
        echo '</li>';
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $mysql->error;
}

$mysql->close();
                ?>
            </div>
        </div>
    </div>


<?php
require_once '../blocks/footer.php';
?>
