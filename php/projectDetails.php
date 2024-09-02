<?php
    $db = new PDO("mysql:host=localhost;dbname=control_projects", "root", "");
    $project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $project = [];
    if ($query = $db->prepare("SELECT * FROM full_information_about_project WHERE project_id = ?")) {
        $query->execute([$project_id]);
        $project = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());
    }
    $info = [];
    if ($query = $db->prepare("SELECT name, description, status FROM task WHERE project_id = ?")) {
        $query->execute([$project_id]);
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());
    }
    $teams = [];
    if ($query = $db->prepare("SELECT name FROM team WHERE project_id = ?")) {
        $query->execute([$project_id]);
        $teams = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="information">
        <div class="container">   
            <p><span>Назва проєкту:</span> <?=$project['name']?></p>
            <p><span>Замовник: </span><?=$project['first_name'] . ' ' . $project['last_name']?></p>
            <p><span>Дедлайн: </span><?=$project['deadline']?></p>
            <p><span>Бюджет: </span><?=$project['budget']?></p>
            <p><span>Опис: </span><?=$project['description']?></p>
            <p><span>Статус: </span><?=$project['status']?></p>
        </div>
        <div class="container">  
            <p><span>Команди:</span></p>
            <ul>
                <?php foreach($teams as $data): ?>
                    <li><a href="http://localhost/coursework/teams.php"><?=$data['name']?></a></li>
                <?php endforeach; ?>  
            </ul>
        </div>
    </div>
    <form method="get">
        <div class="addItem-container">
            <input type="text" name="name" placeholder="Завдання"/>
            <input type="text" name="description" placeholder="Опис"/>
            <button type="submit" name="submit">Додати</button>
        </div>
    </form>
    <table class="styled-table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Завдання</td>
            <td>Опис</td>
            <td>Статус</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $counter = 1;
        foreach($info as $row): ?>
            <tr>
                <td><?=$counter?></td>
                <?php foreach($row as $data): ?>
                    <td><?=$data?></td>
                <?php endforeach; ?>
                <td><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="25" height="25" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">
                        <metadata>
                        Created by potrace 1.16, written by Peter Selinger 2001-2019
                        </metadata>
                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        fill="#5a7b9e" stroke="none">
                        <path d="M1990 5100 c-212 -77 -360 -295 -360 -532 l0 -58 -247 0 c-137 0
                        -277 -5 -313 -10 -185 -27 -345 -180 -379 -366 -6 -32 -11 -143 -11 -248 0
                        -170 2 -194 20 -230 32 -65 61 -80 162 -84 l87 -4 5 -31 c3 -18 8 -82 11 -144
                        l6 -112 -206 -3 -206 -3 -40 -42 c-36 -39 -39 -47 -39 -99 0 -67 25 -115 73
                        -142 27 -14 66 -18 235 -20 l202 -3 0 -27 c1 -15 38 -657 84 -1427 90 -1529
                        82 -1442 149 -1484 l34 -21 1307 0 c1435 0 1340 -4 1386 60 28 40 23 -27 116
                        1567 l78 1332 201 3 c179 3 204 5 233 23 97 59 97 206 0 265 -30 18 -51 20
                        -225 20 l-193 0 5 58 c3 31 7 96 11 144 l6 86 88 4 c100 3 129 18 161 78 17
                        31 19 59 19 245 0 157 -4 226 -15 270 -46 177 -193 309 -371 335 -38 5 -180
                        10 -316 10 l-248 0 0 73 c0 209 -119 401 -305 493 l-79 39 -535 2 c-512 2
                        -538 2 -591 -17z m1050 -296 c51 -24 103 -71 127 -118 9 -17 18 -64 21 -103
                        l5 -73 -628 0 -628 0 5 68 c9 128 84 218 201 242 23 5 224 8 447 7 388 -2 407
                        -3 450 -23z m1026 -630 c60 -44 69 -67 72 -185 l4 -109 -1576 0 -1576 0 0 88
                        c0 48 5 104 11 124 10 39 60 87 101 100 13 3 679 5 1480 5 1454 -2 1457 -2
                        1484 -23z m-201 -681 c-7 -94 -185 -3126 -185 -3159 l0 -24 -1112 2 -1113 3
                        -91 1555 c-50 855 -93 1588 -96 1628 l-4 72 1304 0 1303 0 -6 -77z"/>
                        <path d="M1785 3251 c-34 -20 -58 -53 -68 -91 -6 -24 87 -2321 98 -2408 10
                        -84 66 -132 153 -132 61 0 109 30 136 84 19 38 18 50 -33 1249 -57 1337 -48
                        1246 -121 1294 -42 29 -122 31 -165 4z"/>
                        <path d="M2480 3248 c-18 -13 -41 -39 -51 -58 -18 -33 -19 -86 -19 -1245 0
                        -1159 1 -1212 19 -1245 57 -108 219 -108 273 0 17 33 18 113 18 1250 0 1195 0
                        1216 -20 1248 -44 72 -152 96 -220 50z"/>
                        <path d="M3180 3248 c-70 -48 -63 29 -119 -1293 -28 -660 -48 -1211 -44 -1225
                        9 -37 41 -78 73 -95 44 -23 121 -19 160 8 73 48 64 -43 121 1294 51 1199 52
                        1211 33 1249 -40 81 -150 112 -224 62z"/>
                        </g>
                    </svg>
                </td>
            </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
