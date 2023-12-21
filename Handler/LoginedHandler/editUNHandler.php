<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$loginDetail = $_SESSION['loginDetail'] ?? '';

$USERNAME = $_POST["USERNAME"];
$pk = $_POST["pk"];
$error_message = '';

if ($USERNAME == '') {
    $error_message = '用户名不能为空';
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $USERNAME)) {
    $error_message = '用户名只能包含字母、数字和下划线';
} elseif (strlen($USERNAME) < 8 || strlen($USERNAME) > 20) {
    $error_message = '用户名长度必须在 8 到 20 个字符之间';
}

if ($error_message == '') {
    $stmt = mysqli_prepare($conn, "UPDATE user SET USERNAME=? WHERE USERID=?");
    mysqli_stmt_bind_param($stmt, "si", $USERNAME, $pk);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        die("Query error");
    }

    mysqli_close($conn);
    header('Location: ../../Page/Logined/modifyInfo.php');
    unset($_SESSION['editUN']);
}
if ($error_message != '') {
    $_SESSION['error_message'] = $error_message;
    header('Location: ../../Page/Logined/modifyInfo.php');
    exit;
}
?>