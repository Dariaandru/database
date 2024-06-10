<?php
session_start();

if (isset($_SESSION["registered"]) && $_SESSION["registered"]) {
    echo "<p>Вы успешно зарегистрировались. Пожалуйста, войдите в систему.</p>";
    unset($_SESSION["registered"]);
}






if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];

    // Подключаемся к базе данных PostgreSQL
    $conn = pg_connect("host=localhost dbname=postgres user=postgres password=123");

    if (!$conn) {
        die("Ошибка подключения к базе данных: " . pg_last_error());
    }

    // Проверяем, существует ли пользователь с указанными данными в базе данных
    $query = "SELECT id FROM employee1 WHERE email = '$email' AND first_name = '$first_name'";
    $result = pg_query($conn, $query);

    if ($result && pg_num_rows($result) > 0) {
        // Получаем идентификатор пользователя из результата
        $row = pg_fetch_assoc($result);
        $user_id = $row["id"];

        // Сохраняем идентификатор пользователя в сессии
        $_SESSION["user_id"] = $user_id;

        // Перенаправляем на личный кабинет
        header("Location: profile.php");
        exit();
    } else {
        // Неверные данные для входа или пользователь не зарегистрирован
        $error_message = "Неверный email или first_name, или пользователь не зарегистрирован";
    }

    // Закрываем соединение с базой данных
    pg_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="login.php">Вход</a></li>
                <li><a href="register.php">Регистрация</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Вход</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required><br><br>
            <input type="submit" value="Войти">
        </form>
    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</html>