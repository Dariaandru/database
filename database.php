database.php:
<?php
$host        = "host = dariaandru.github.io";
$port        = "port = 5432";
$dbname      = "dbname = postgres";
$credentials = "user = postgres password=123";
$db = pg_connect( "$host $port $dbname $credentials");
?>

