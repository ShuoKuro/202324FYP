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
$pk = $_POST["pk"];

$table = "url";

$stmt = mysqli_prepare($conn, "UPDATE url SET TITLE=?, URL=?, LUPDATE=NOW() WHERE PK=?");
mysqli_stmt_bind_param($stmt, "ssi", $title, $url, $pk);
$result = mysqli_stmt_execute($stmt);
if (!$result) {
    die("Query error");
}

mysqli_close($conn);
header('Location: ../../Page/Logined/linkShow.php');
unset($_SESSION['editPK']);
?>