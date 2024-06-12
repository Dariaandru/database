<?php
session_start();

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    echo "<div class='buttons'>";
    echo "<p ><a class='button' href='logout.php'>Выйти</a></p>";
    echo "<p><a class='button' href='profile.php'>Личный кабинет</a></p>";
    echo "</div>";
} else {
    echo "<p>Вы не авторизованы. Пожалуйста, <a href='login.php'>войдите</a> или <a href='register.php'>зарегистрируйтесь</a>.</p>";
}

// Establish a connection to the database
$db = pg_connect("host=localhost dbname=postgres user=postgres password=123");

// Execute a query to retrieve the notes
$query = "SELECT employee1.first_name, note.header, note.note, note.created_at FROM note INNER JOIN employee1 ON note.employee_id = employee1.id";
$result = pg_query($db, $query);

if (pg_num_rows($result) > 0) {
    echo "<h2 class='title'>Главная</h2>";
    echo "<div class='notes'>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<div class='note'>";
        // echo "<li>";
        echo "<h3 class='first_name'>" . $row['first_name'] . "</h3>";
        echo "<div class='body_note'>";
        echo "<h3 class='header'>" . $row['header'] . "</h3>";
        
        echo "<p class='text'>" . $row['note'] . "</p>";
        echo "</div>";
        echo "<p class='time'>" . $row['created_at'] . "</p>";
        // echo "</li>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Нет заметок.</p>";
}

pg_close($db);








?>

<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">
    <header>
        <nav>
            <ul>
                <!-- <li><a href="index.php">Главная</a></li> -->
                <!-- <li><a href="login.php">Вход</a></li> -->
                <!-- <li><a href="register.php">Регистрация</a></li> -->
            </ul>
        </nav>
    </header>
    <main>
        <!-- <h1>Главная</h1> -->
        <!-- Содержимое главной страницы -->
    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</body>
</html>