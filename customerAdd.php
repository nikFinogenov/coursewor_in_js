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
            <input type="text" name="first_name" placeholder="Ім'я"/>
            <input type="text" name="last_name" placeholder="Прізвище"/>
            <input type="text" name="company_name" placeholder="Назва компанії"/>
            <input type="text" name="email" placeholder="Email"/>
            <input type="text" name="phone_number" placeholder="Телефонний номер"/>
            <button type="submit" name="submit">Додати</button>
        </div>
    </form>
</body>
</html>
