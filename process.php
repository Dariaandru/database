<?php
session_start();

// Establish a connection to the database
$db = pg_connect("host=localhost dbname=postgres user=postgres password=123");

// Retrieve the input values from the form
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$cityName = $_POST['city_name'];
$email = $_POST['email'];

// Check if the user already exists in the database
$query = "SELECT id FROM employee1 WHERE email = '$email'";
$result = pg_query($db, $query);

if (pg_num_rows($result) > 0) {
	// Redirect back to the registration page
	echo "<p class='message'>Пользователь с таким email уже зарегистрирован.</p>";
	$_SESSION['registered'] = false;
    header("Location: register.php");
    exit();
}

// Insert the new user into the database
$query = "INSERT INTO employee1 (first_name, last_name, city_name, email) VALUES ('$firstName', '$lastName', '$cityName', '$email')";
$result = pg_query($db, $query);

if ($result) {
    // Set a session variable to indicate that the user has registered successfully
    $_SESSION['registered'] = true;
    // Redirect to the login page
    header("Location: login.php");
    exit();
} else {
    echo "<p class='message'>Ошибка при регистрации.</p>";
}

pg_close($db);
?>
