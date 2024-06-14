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
    echo "<div class='header-profile'>";
        echo "<div class='profile'>";
            echo "<p>Добро пожаловать, <span class='name'>" . $_SESSION["first_name"] . "</span>!</p>";
            echo "<p>Вы вошли в систему как <span class='name'>" . $_SESSION["email"] . "</span>.</p>";
        echo "</div>";
        echo "<a class='button1' href='logout.php'>Выйти</a>";
        echo "<a class='button1' href='index.php'>Главная</a>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body">
    <header>
        <nav>
            <ul>
                <!-- <li><a href="index.php">Главная</a></li> -->
                <!-- <li><a href="profile.php">Личный кабинет</a></li> -->
                <!-- <li><a href="logout.php">Выйти</a></li> -->
            </ul>
        </nav>
    </header>
    <main class="main">
        <h1>Личный кабинет</h1>
        <!-- Содержимое личного кабинета -->
         <h2>Добавить заметку</h2>

        

        <form method="POST" action="add_note.php">
    <label for="header">Заголовок заметки:</label>
    <input class="input-note1" type="text" id="header" maxlength="255" name="header" required >
    <br><br>
    <div class="text-note">

        <label for="note">Текст заметки:</label>
        <textarea class="input-note" id="note" name="note" required></textarea>
    </div>

    <!-- Add the hidden input field for the id -->
    <input type="hidden" name="id" value="<?php echo $_SESSION['employee_id']; ?>">
<br><br>
    <input  class="button1" type="submit" value="Добавить заметку">
</form>

<button class="button1" onclick="window.location.href='notes.php'">Показать заметки</button>

    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</body>
</html>