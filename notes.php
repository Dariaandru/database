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
    echo "<ul>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<li>";
        echo "<h3>" . $row['header'] . "</h3>";
        echo "<p>" . $row['note'] . "</p>";
        echo "<p>" . $row['created_at'] . "</p>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>У вас нет заметок.</p>";
}

pg_close($db);
?>