<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "webevent";

$link = mysqli_connect($host, $user, $pass, $db);
$link->set_charset("utf8");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


?>