<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "FYPsystem";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("DB connnection error");
}
date_default_timezone_set('Asia/Hong_Kong');
?>