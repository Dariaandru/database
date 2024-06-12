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
                <li><a href="logout.php">Выход</a></li>
                <li><a href="profile.php">Личный кабинет</a></li>
            </ul>
        </nav>
    </header>

</body>
</html>








<?php
session_start();

$employeeId = $_SESSION['employee_id'];

// Establish a connection to the database
$db = pg_connect("host=localhost dbname=postgres user=postgres password=123");

// Execute a query to retrieve the notes for the employee
$query = "SELECT header, note, created_at FROM note WHERE employee_id = $employeeId";
$result = pg_query($db, $query);

if (pg_num_rows($result) > 0) {
    echo "<h2>Заметки</h2>";
    echo "<div class='notes'>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<div class='note'>";
        echo "<h3 class='header'>" . $row['header'] . "</h3>";
        echo "<p class='text'>" . $row['note'] . "</p>";
        echo "<p class='time'>" . $row['created_at'] . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>У вас нет заметок.</p>";
}

pg_close($db);
?>


