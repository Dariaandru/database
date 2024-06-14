<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="buttons">
                <a class="button" href="index.php">Главная</a>
                <a class="button" href="logout.php">Выход</a>
                <a class="button" href="profile.php">Создать заметку</a>
            </div>
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
$query = "SELECT id, header, note, created_at FROM note WHERE employee_id = $employeeId";
$result = pg_query($db, $query);

if (pg_num_rows($result) > 0) {
    echo "<h1 align='center'>Мои Заметки</h1>";
    echo "<div class='notes'>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<div class='note'>";
        echo "<a href='delete_note.php?id=" . $row['id'] . "' class='delete-link'>Delete</a>";
        echo "<h3 class='header'>" . $row['header'] . "</h3>";
        echo "<p class='text'>" . $row['note'] . "</p>";
        $createdAt = $row['created_at'];
$dateTime = new DateTime($createdAt);
$formattedTime = $dateTime->format("d.m.Y H:i");
// echo $formattedTime;
echo "<p class='time'>" . $formattedTime . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p class='none'>У вас нет заметок.</p>";
}

pg_close($db);
?>


