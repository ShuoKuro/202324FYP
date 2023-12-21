<?php
include("../../Page/db.php");
session_start();

if (!isset($_SESSION['loginDetail'])) {
    header('Location: ../../login.php');
    exit();
}

$loginDetail = $_SESSION['loginDetail'] ?? '';

$USERNAME = $_POST["USERNAME"];
$PASSWORD = $_POST["PASSWORD"];
$REPASSWORD = $_POST["REPASSWORD"];
$EMAIL = $_POST["EMAIL"];
$pk = $_POST["pk"];
$error_message = '';

if ($USERNAME == '') {
    $error_message = '用户名不能为空';
    $errorCode = 1;
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $USERNAME)) {
    $error_message = '用户名只能包含字母、数字和下划线';
    $errorCode = 1;
} elseif (strlen($USERNAME) < 8 || strlen($USERNAME) > 20) {
    $error_message = '用户名长度必须在 8 到 20 个字符之间';
    $errorCode = 1;
} elseif ($EMAIL == '') {
    $error_message = '邮箱不能为空';
    $errorCode = 1;
} elseif (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
    $error_message = '邮箱格式不正确';
    $errorCode = 1;
} elseif ($PASSWORD == '') {
    $error_message = '密码不能为空';
    $errorCode = 1;
} elseif (strlen($PASSWORD) < 8) {
    $error_message = '密码长度不能少于 8 个字符';
    $errorCode = 1;
} elseif ($REPASSWORD == '') {
    $error_message = '确认密码不能为空';
    $errorCode = 1;
} elseif ($PASSWORD != $REPASSWORD) {
    $error_message = '两次输入的密码不一致';
    $errorCode = 1;
}

if ($error_message == '') {
    $query = "UPDATE user SET USERNAME='$USERNAME', PASSWORD='$PASSWORD', EMAIL='$EMAIL' WHERE USERID=$pk";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error");
    }

    mysqli_close($conn);
    header('Location: ../../Page/AdminLogined/userUpdate.php');
    unset($_SESSION['editPK']);
}


if ($error_message != '') {
    session_start();
    $_SESSION['error_message'] = $error_message;
    header('Location: ../../Page/AdminLogined/userUpdate.php');
    exit;
}
?>