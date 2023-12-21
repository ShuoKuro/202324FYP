<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$loginDetail = $_SESSION['loginDetail'] ?? '';

$title = $_POST["title"];
$url = $_POST["url"];

$table = "url";

$stmt = mysqli_prepare($conn, "INSERT INTO $table (TITLE, URL, USERID, LUPDATE) VALUES (?, ?, ?, ?)");
$current_datetime = date('Y-m-d H:i:s');
mysqli_stmt_bind_param($stmt, "ssss", $title, $url, $loginDetail, $current_datetime);
$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die("Query error");
}

mysqli_close($conn);
header('Location: ../../Page/Logined/linkSave.php');

?>