<?php

include("../Page/db.php");

$userName = $_POST["userName"];
$password = $_POST["password"];
$rePassword = $_POST["rePassword"];
$email = $_POST["email"];
$error_message = '';

$table = "user";

if ($userName == '') {
    $error_message = '用户名不能为空';
    $errorCode = 1;
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $userName)) {
    $error_message = '用户名只能包含字母、数字和下划线';
    $errorCode = 1;
} elseif (strlen($userName) < 8 || strlen($userName) > 20) {
    $error_message = '用户名长度必须在 8 到 20 个字符之间';
    $errorCode = 1;
} elseif ($email == '') {
    $error_message = '邮箱不能为空';
    $errorCode = 1;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = '邮箱格式不正确';
    $errorCode = 1;
} elseif ($password == '') {
    $error_message = '密码不能为空';
    $errorCode = 1;
} elseif (strlen($password) < 8) {
    $error_message = '密码长度不能少于 8 个字符';
    $errorCode = 1;
} elseif ($rePassword == '') {
    $error_message = '确认密码不能为空';
    $errorCode = 1;
} elseif ($password != $rePassword) {
    $error_message = '两次输入的密码不一致';
    $errorCode = 1;
}

if ($error_message == '') {
    $stmt = mysqli_prepare($conn, "INSERT INTO $table (USERNAME, PASSWORD, EMAIL) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $userName, $password, $email);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die("Query error");
    } else {
        echo "$userName is inserted into the table";
    }

    mysqli_close($conn);
    header('Location: ../login.php');
}

if ($error_message != '') {
    session_start();
    $_SESSION['error_message'] = $error_message;
    $_SESSION['errorCode'] = $errorCode;
    $_SESSION['userName'] = $userName;
    $_SESSION['email'] = $email;
    header('Location: ../signUp.php');
    exit;
}
?>