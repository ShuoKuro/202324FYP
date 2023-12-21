<?php
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['pk'])) {
    $_SESSION['editPK'] = $_GET['pk'];
    header('Location: ../../Page/Logined/linkShow.php');
    exit();
}
?>