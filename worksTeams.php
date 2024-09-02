<?php
    $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
    $team = [];
    if ($query = $db->query("SELECT * FROM team")) {
        $team = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());
    }

    $employee = [];
    if ($query = $db->query("SELECT * FROM employee")) {
        $employee = $query->fetchAll(PDO::FETCH_ASSOC);
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
                <li><a href="http://localhost/coursework/worksProjects.php">Проєкти</a></li>
                <li><a href="http://localhost/coursework/time.php">Таблиця часу</a></li>
                <li><a href="http://localhost/coursework/worksTeams.php">Команди</a></li>
                <li><a href="http://localhost/coursework/worksEmployees.php">Працівники</a></li>
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
        </div>
    </div>
    <?php foreach($team as $team_data): ?>
        <div class="team">
            <p><span><?= htmlspecialchars($team_data['name']) ?></span></p>
            <div class="team-container">
                <p><span>Дата створення команди:</span> <?= htmlspecialchars($team_data['start_data']) ?></p>
                <p><span>Проєкт, над яким працює команда:</span> <?= htmlspecialchars($team_data['project_id']) ?></p>
                <div class="employees">
                    <?php foreach($employee as $employee_data): ?>
                        <?php if($employee_data['team_id'] == $team_data['team_id']): ?>
                            <div class="employees-container" onclick="redirectToSearch('<?= htmlspecialchars($employee_data['first_name']) ?>', '<?= htmlspecialchars($employee_data['last_name']) ?>')">
                                <img width=100px src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdM-CPt8gi8dApiyMnk7Si03ILg5FE9j0dPA&s" alt="">
                                <p><span><?= htmlspecialchars($employee_data['first_name']. ' ' . $employee_data['last_name']) ?></span></p>
                                <p><?= htmlspecialchars($employee_data['position']) ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div> 
        </div>
    <?php endforeach; ?>
    <script>
    function redirectToSearch(firstName, lastName) {
        const searchQuery = encodeURIComponent(firstName + ' ' + lastName);
        window.location.href = `http://localhost/coursework/search.php?search-input=${searchQuery}`;
    }
    </script>
</body>
</html>
