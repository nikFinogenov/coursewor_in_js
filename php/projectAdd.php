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
    <form method="get">
        <div class="add-container">
            <input type="text" name="name" placeholder="Назва проєкту" />
            <input type="datetime-local" name="deadline" placeholder="Дедлайн" />
            <textarea name="description" placeholder="Опис"></textarea>
            <input type="text" name="budget" placeholder="Бюджет" />
            <input type="text" name="customer_id" placeholder="Клієнт" />
            <button type="submit" name="submit">Додати</button>
        </div>
    </form>
    <?php
        if (isset($_GET['submit'])) {
            $nameform = $_GET['name'];
            $deadlineform = $_GET['deadline'];
            $descriptionform = $_GET['description'];
            $budgetform = $_GET['budget'];
            $customer_idform = $_GET['customer_id'];
            $urlform = $_GET['url'];
            try {
                $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $db->prepare("INSERT INTO project (name, deadline, description, budget, customer_id, url) VALUES (:name, :deadline, :description, :budget, :customer_id, :url)");
                $stmt->bindParam(':name', $nameform);
                $stmt->bindParam(':deadline', $deadlineform);
                $stmt->bindParam(':description', $descriptionform);
                $stmt->bindParam(':budget', $budgetform);
                $stmt->bindParam(':customer_id', $customer_idform);
                $stmt->bindParam(':url', $urlform);
                $stmt->execute();
                header('Location: http://localhost/coursework/projects.php');
                exit(); 
            } catch (PDOException $e) {
                echo "Помилка: " . $e->getMessage();
            }
            $db = null;
        }
    ?>
</body>
</html>
