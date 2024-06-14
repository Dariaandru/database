<?php
session_start();

$employeeId = $_SESSION['employee_id'];

// Retrieve the note ID from the URL parameter
$noteId = $_GET['id'];

// Establish a connection to the database
$db = pg_connect("host=localhost dbname=postgres user=postgres password=123");

// Execute a query to delete the note
$query = "DELETE FROM note WHERE id = $noteId AND employee_id = $employeeId";
$result = pg_query($db, $query);

if ($result) {
    echo "Заметка удалена успешно.";
} else {
    echo "Ошибка при удалении заметки.";
}

// Redirect back to the notes page
header("Location: notes.php");
exit;
?>