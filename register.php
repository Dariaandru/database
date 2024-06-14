

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
  <body class="body">
	<div class="login">

		<div class="buttons b-tools">
			<a class="button" href="index.php">Главная</a>
			<a class="button" href="login.php">Вход</a>
		</div>
		
		<h1>Регистрация</h1>
		<form method="post" action="process.php">
			<div class="input-reg">
				First name:
			<input type="text" name="first_name">
			</div>
			<div class="input-reg">
				Last name:
			<input type="text" name="last_name">
			</div>
			<div class="input-reg">
				City name:
			<input type="text" name="city_name">
			</div>
			<div class="input-reg">
				Email Id:
			<input type="email" name="email">
			</div>
			<input class="button1" type="submit" name="save" value="зарегистрироваться">
		</form>
	</div>
	<footer>
        <p>&copy; 2022 Мой веб-сайт</p>
    </footer>
  </body>
</html>

<?php
session_start();
	if (isset($_SESSION['registered']) && $_SESSION['registered'] == false) {
	echo "<p class='message'>Вы уже зарегистрировались. Пожалуйста, войдите в систему.</p>";
	}
	

?>
