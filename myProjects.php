<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }
// try {
    $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
    $project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $db->prepare("SELECT * FROM full_information_about_project WHERE customer_id = ?");
    $stmt->execute([$project_id]);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     die("Помилка підключення до бази даних: " . $e->getMessage());
// }
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проєкти</title>
    <link rel="stylesheet" href="static/styles/style.css">
</head>
<body>
    <header>
        <div class="top_menu">
            <ul>
                <li><a href="http://localhost/coursework/log.php">Вихід</a></li>
            </ul>
        </div>
    </header>
    <div class="main">
        <?php foreach ($projects as $project): ?>
            <div class="project-card">
                <button class="button_project" onclick="window.location.href='myProjectDetails.php?id=<?= $project['project_id'] ?>'">
                    <?= $project['name'] ?>
                    <p><?= $project['first_name'] . ' ' . $project['last_name'] ?></p>
                    <h2><?= $project['status'] ?></h2>
                    <h3><?= $project['deadline'] ?></h3>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
