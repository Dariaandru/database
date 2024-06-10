<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Подключаемся к базе данных PostgreSQL
$conn = pg_connect("host=localhost dbname=postgres user=postgres password=123");

if (!$conn) {
    die("Ошибка подключения к базе данных: " . pg_last_error());
}

// Получаем информацию о пользователе из базы данных
$query = "SELECT first_name, email FROM employee1 WHERE id = " . $_SESSION["user_id"];
$result = pg_query($conn, $query);

if ($result && pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $first_name = $row["first_name"];
    $email = $row["email"];
} else {
    // Пользователь не найден в базе данных
    session_destroy();
    header("Location: login.php");
    exit();
}

pg_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="profile.php">Личный кабинет</a></li>
                <li><a href="logout.php">Выход</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Личный кабинет</h1>
        <p>Привет, <?php echo $first_name; ?>!</p>
        <p>Ваша почта: <?php echo $email; ?></p>
    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</html>