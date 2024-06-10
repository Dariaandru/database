<?php
session_start();


if (isset($_SESSION["registered"]) && $_SESSION["registered"]) {
    echo "<p>Вы успешно зарегистрировались. Пожалуйста, войдите в систему.</p>";
    unset($_SESSION["registered"]);
}





if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    header("Location: profile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];

    $conn = pg_connect("host=localhost dbname=postgres user=postgres password=123");

    $query = "SELECT * FROM employee1 WHERE email = '$email' AND first_name = '$first_name'";
    $result = pg_query($query);

    if (pg_num_rows($result) > 0) {
        $_SESSION["logged_in"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["first_name"] = $first_name;
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Неверный логин или пароль.";
    }

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
                <!-- <li><a href="index.php">Главная</a></li> -->
                <!-- <li><a href="login.php">Вход</a></li> -->
                <!-- <li><a href="register.php">Регистрация</a></li> -->
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
</body>
</html>