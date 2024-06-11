<?php
session_start();

include_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = isset($_SESSION['employee_id']) ? $_SESSION['employee_id'] : null;
    $header = isset($_POST['header']) ? pg_escape_string($_POST['header']) : null;
    $note = isset($_POST['note']) ? pg_escape_string($_POST['note']) : null;

    if ($employeeId !== null && $header !== null && $note !== null) {
        $query = "INSERT INTO note (employee_id, header, note, created_at) VALUES ($employeeId, '$header', '$note', NOW())";
        $result = pg_query($db, $query);

        if ($result) {
            echo "Заметка добавлена успешно.";
        } else {
            echo "Ошибка при добавлении заметки.";
        }
    } else {
        echo "Необходимо указать все значения (employee_id, header, note).";
    }

 // Redirect back to the profile page
 header("Location: profile.php");
 exit;

}
?>