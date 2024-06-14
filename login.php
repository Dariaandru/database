<?php
session_start();


if (isset($_SESSION["registered"]) && $_SESSION["registered"]) {
    echo "<p class='message'>Вы успешно зарегистрировались. Пожалуйста, войдите в систему.</p>";
    unset($_SESSION["registered"]);
} else {
    echo "<p class='message'>Нет аккаунта? <a href='register.php'>Зарегистрируйтесь</a>.</p>";
}





// Проверка, авторизован ли пользователь
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    header("Location: profile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];

    // Подключение к базе данных PostgreSQL
    $conn = pg_connect("host=localhost dbname=postgres user=postgres password=123");

    // Получение данных пользователя из таблицы employee1
    $query = "SELECT id FROM employee1 WHERE email = '$email' AND first_name = '$first_name'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        $employeeId = $user["id"];

        // Установка сессионных переменных
        $_SESSION["logged_in"] = true;
        $_SESSION["employee_id"] = $employeeId;
        $_SESSION["email"] = $email;
        $_SESSION["first_name"] = $first_name;

        // Сохранение employeeId в отдельном файле
        $file = 'employeeId.txt';
        file_put_contents($file, $employeeId);

        // Перенаправление на страницу профиля
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Неверный логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
   
    <title>Вход</title>
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
    <main class="login">
        <div class="tools"><a class="button1 tools" href="index.php">Главная</a></div>
        <h1>Вход</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required><br><br>
            <input class="button1" type="submit" value="Войти">




        </form>
    </main>
    <footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
</body>
</html>