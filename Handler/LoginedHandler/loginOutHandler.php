<?php
session_start();
if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}
unset($_SESSION['loginDetail']);
unset($_SESSION['name']);
header('Location: ../../index.php');
exit();
?>