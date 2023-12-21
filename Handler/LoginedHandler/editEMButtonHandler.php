<?php
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}


$_SESSION['editEM'] = "1";
header('Location: ../../Page/Logined/modifyInfo.php');
exit();

?>