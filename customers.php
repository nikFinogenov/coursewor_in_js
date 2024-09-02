<?php
$db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
$customers = [];
if ($query = $db->query("SELECT * FROM customer")) {
    $customers = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    print_r($db->errorInfo());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="wrapper">
        <div class="search-container">
            <form method="GET" action="search.php">
                <input type="search" name="search-input" placeholder="Пошук" />
                <button type="submit">🔍︎</button>      
            </form> 
            <button>↑↓</button>
            <button onclick="window.location.href='customerAdd.php'">+</button>    
        </div>
    </div>
    <?php foreach($customers as $row): ?>
        <div class="resume">
            <div class="resume-img">
                <img width=100px src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdM-CPt8gi8dApiyMnk7Si03ILg5FE9j0dPA&s" alt="">
            </div>
            <div class="resume-container">
                <h2><?=$row['first_name']. ' ' . $row['last_name']?></h2>
                <p><span>Компанія:</span> <?=$row['company_name']?></p>
                <p><span>Email:</span> <?=$row['email']?></p>
                <p><span>Номер телефону:</span> <?=$row['phone_number']?></p>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>