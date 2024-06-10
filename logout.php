<?php
session_start();

// Очистка сессии
session_destroy();

// Перенаправление на главную страницу
header("Location: index.php");
exit();
?>