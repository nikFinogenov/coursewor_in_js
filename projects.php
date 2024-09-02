<?php
$db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
$project = [];
if ($query = $db->query("SELECT * FROM full_information_about_project")) {
    $project = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    print_r($db->errorInfo());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документ</title>
    <link rel="stylesheet" href="static/styles/style.css">
</head>

<body>
    <header>
        <div class="top_menu">
            <ul>
                <li><a href="http://localhost/coursework/projects.php">Проєкти</a></li>
                <li><a href="http://localhost/coursework/time.php">Таблиця часу</a></li>
                <li><a href="http://localhost/coursework/teams.php">Команди</a></li>
                <li><a href="http://localhost/coursework/employees.php">Працівники</a></li>
                <li><a href="http://localhost/coursework/customers.php">Клієнти</a></li>
                <li><a href="http://localhost/coursework/log.php">Вихід</a></li>
            </ul>
        </div>
    </header>
    <div class="main">
        <button class="add" onclick="window.location.href='projectAdd.php'"><p>+</p></button>
        <?php foreach($project as $data): ?>
            <button class="button_project" onclick="window.location.href='projectDetails.php?id=<?=$data['project_id']?>'">
                <?=$data['name']?>
                <p><?=$data['first_name'] . ' ' . $data['last_name']?></p>
                <h2><?=$data['status']?></h2>
                <h3><?=$data['deadline']?></h3>
            </button>
        <?php endforeach; ?>
    </div>
</body>

</html>
