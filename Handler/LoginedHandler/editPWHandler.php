<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$loginDetail = $_SESSION['loginDetail'] ?? '';

$PASSWORD = $_POST["PASSWORD"];
$REPASSWORD = $_POST["REPASSWORD"];
$pk = $_POST["pk"];
$error_message = '';

if ($PASSWORD == '') {
    $error_message = '密码不能为空';
} elseif (strlen($PASSWORD) < 8) {
    $error_message = '密码长度不能少于 8 个字符';
} elseif ($REPASSWORD == '') {
    $error_message = '确认密码不能为空';
} elseif ($PASSWORD != $REPASSWORD) {
    $error_message = '两次输入的密码不一致';
}

if ($error_message == '') {
    $stmt = mysqli_prepare($conn, "UPDATE user SET PASSWORD=? WHERE USERID=?");
    mysqli_stmt_bind_param($stmt, "si", $PASSWORD, $pk);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        die("Query error");
    }

    mysqli_close($conn);
    header('Location: ../../Page/Logined/modifyInfo.php');
    unset($_SESSION['editPW']);
}
if ($error_message != '') {
    $_SESSION['error_message'] = $error_message;
    header('Location: ../../Page/Logined/modifyInfo.php');
    exit;
}
?>