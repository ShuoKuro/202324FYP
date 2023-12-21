<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$loginDetail = $_SESSION['loginDetail'] ?? '';

$EMAIL = $_POST["EMAIL"];
$pk = $_POST["pk"];
$error_message = '';

if ($EMAIL == '') {
    $error_message = '邮箱不能为空';
} elseif (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
    $error_message = '邮箱格式不正确';
}

if ($error_message == '') {
    $stmt = mysqli_prepare($conn, "UPDATE user SET EMAIL=? WHERE USERID=?");
    mysqli_stmt_bind_param($stmt, "si", $EMAIL, $pk);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        die("Query error");
    }

    mysqli_close($conn);
    header('Location: ../../Page/Logined/modifyInfo.php');
    unset($_SESSION['editEM']);
}
if ($error_message != '') {
    $_SESSION['error_message'] = $error_message;
    header('Location: ../../Page/Logined/modifyInfo.php');
    exit;
}
?>