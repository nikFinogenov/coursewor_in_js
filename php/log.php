<?php
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];  
    try {
        $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $stmt = $db->prepare("SELECT * FROM users WHERE login = ? LIMIT 1");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($user['password'] === $password) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['type_user'] = $user['type_user'];
                
                if ($user['customer_id']) {
                    $customer_id = $user['customer_id'];
                    header("Location: myProjects.php?id=$customer_id");
                    exit;
                } else {
                    $error_message = 'Немає відповідного клієнта для цього користувача';
                }
            } else {
                $error_message = 'Невірний логін або пароль';
            }
        } else {
            $error_message = 'Невірний логін або пароль';
        }
    } catch (PDOException $e) {
        die("Помилка підключення до бази даних: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Керування ІТ проєктами - Авторизація</title>
    <link rel="stylesheet" href="static/styles/style.css">
</head>
<body>
    <div class="login">
        <div class="formbox">
            <form action="" method="POST">
                <h2>Авторизація</h2>
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bx-user'></i>
                    </span>
                    <input type="text" name="login" required>
                    <label for="">Логін</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bx-lock-alt'></i>
                    </span>
                    <input type="password" name="password" required>
                    <label for="">Пароль</label>
                </div>
                <!-- Optional: Remember me checkbox -->
                <button class="btn" type="submit">Увійти</button>
            </form>
        </div>
    </div>
</body>
</html>
