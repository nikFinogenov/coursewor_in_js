<?php
    $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
    $search = isset($_GET['search-input']) ? trim($_GET['search-input']) : '';
    $info = [];
    if ($search) {
        $nameParts = explode(' ', $search);
        if (count($nameParts) == 2) {
            $firstName = $nameParts[0];
            $lastName = $nameParts[1];
            $stmt = $db->prepare("SELECT * FROM full_information_about_employees WHERE (first_name = :first_name AND last_name = :last_name) OR position LIKE :search");
            $stmt->execute([':first_name' => $firstName, ':last_name' => $lastName, ':search' => '%' . $search . '%']);
        } else {
            $stmt = $db->prepare("SELECT * FROM full_information_about_employees WHERE first_name LIKE :search OR last_name LIKE :search OR position LIKE :search OR email LIKE :search OR phone_number LIKE :search OR messenger LIKE :search OR hard_skils LIKE :search OR soft_skils LIKE :search OR name LIKE :search");
            $stmt->execute([':search' => '%' . $search . '%']);
        }
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        if ($query = $db->query("SELECT * FROM full_information_about_employees")) {
            $info = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($db->errorInfo());
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
            <button onclick="window.location.href='employeeAdd.php'">+</button>    
        </div>
    </div>
    <?php if ($info): ?>
        <?php foreach($info as $row): ?>
            <div class="resume">
                <div class="resume-img">
                    <img width=100px src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdM-CPt8gi8dApiyMnk7Si03ILg5FE9j0dPA&s" alt="">
                </div>
                <div class="resume-container">
                    <h2><?=$row['first_name']. ' ' . $row['last_name']?></h2>
                    <p><span>Посада:</span> <?=$row['position']?></p>
                    <p><span>Email:</span> <?=$row['email']?></p>
                    <p><span>Номер телефону:</span> <?=$row['phone_number']?></p>
                    <p><span>Месенджер:</span> <?=$row['messenger']?></p>
                    <p><span>Hard skils:</span> <?=$row['hard_skils']?></p>
                    <p><span>Soft skils:</span> <?=$row['soft_skils']?></p>
                    <p><span>Локація:</span> <?=$row['location']?></p>
                    <p><span>Команда:</span> <?=$row['name']?></p>
                </div>
            </div>
        <?php endforeach; ?>        
        <?php else: ?>
            <p class="main">Результатів на запит "<?= htmlspecialchars($search) ?>" не знайдено.</p>
    <?php endif; ?>
</body>
</html>