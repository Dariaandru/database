<?php
session_start();

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    echo "<p><a href='logout.php'>Выйти</a></p>";
    echo "<p><a href='profile.php'>Личный кабинет</a></p>";
} else {
    echo "<p>Вы не авторизованы. Пожалуйста, <a href='login.php'>войдите</a> или <a href='register.php'>зарегистрируйтесь</a>.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
        <h1>Главная</h1>
        <!-- Содержимое главной страницы -->
    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</body>
</html>