<?php
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$_SESSION['editPW'] = "1";
header('Location: ../../Page/Logined/modifyInfo.php');
exit();

?>