<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['USERID'])) {
    $pk = $_GET['USERID'];
    $query = "DELETE FROM user WHERE USERID=$pk";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query error");
    }
    header('Location: ../../Page/AdminLogined/userUpdate.php');
    exit();
}
?>