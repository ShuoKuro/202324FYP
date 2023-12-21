<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['pk'])) {
    $pk = $_GET['pk'];
    $query = "DELETE FROM url WHERE PK=$pk";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query error");
    }
    header('Location: ../../Page/Logined/linkShow.php');
    exit();
}
?>