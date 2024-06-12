<?php
session_start();

if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location: login.php");
    exit();
}

// Проверяем, не превышено ли максимальное количество попыток входа
if (isset($_SESSION["login_attempts"]) && $_SESSION["login_attempts"] >= 3) {
    echo "<p>Вы слишком много раз попытались войти в систему. Пожалуйста, попробуйте позже.</p>";
} else {
    echo "<p>Добро пожаловать, " . $_SESSION["first_name"] . "!</p>";
    echo "<p>Вы вошли в систему как " . $_SESSION["email"] . ".</p>";
    echo "<p><a href='logout.php'>Выйти</a></p>";
}

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
                <!-- <li><a href="profile.php">Личный кабинет</a></li> -->
                <!-- <li><a href="logout.php">Выйти</a></li> -->
            </ul>
        </nav>
    </header>
    <main>
        <h1>Личный кабинет</h1>
        <!-- Содержимое личного кабинета -->

        

        <form method="POST" action="add_note.php">
    <label for="header">Заголовок заметки:</label>
    <input type="text" id="header" maxlength="255" name="header" required >

    <label for="note">Текст заметки:</label>
    <textarea id="note" name="note" required></textarea>

    <!-- Add the hidden input field for the id -->
    <input type="hidden" name="id" value="<?php echo $_SESSION['employee_id']; ?>">

    <input type="submit" value="Добавить заметку">
</form>

<button onclick="window.location.href='notes.php'">Показать заметки</button>

    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</body>
</html>