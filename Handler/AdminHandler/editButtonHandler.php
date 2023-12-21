<?php
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['USERID'])) {
    $_SESSION['editPK'] = $_GET['USERID'];
    header('Location: ../../Page/AdminLogined/userUpdate.php');
    exit();
}
?>