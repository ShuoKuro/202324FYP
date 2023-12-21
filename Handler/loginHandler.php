<?php

include("../Page/db.php");

$username = $_POST["userName"];
$password = $_POST["password"];
$error_message = '';
$table = "user";
$adminTable = "admin";

$stmt = mysqli_prepare($conn, "SELECT USERNAME,DISABLE FROM $table WHERE USERNAME = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
$userNameResult = mysqli_stmt_execute($stmt);
if (!$userNameResult) {
    die("Query error");
}
$userNameResult = mysqli_stmt_get_result($stmt);

$stmt = mysqli_prepare($conn, "SELECT USERNAME FROM $adminTable WHERE USERNAME = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
$adminNameResult = mysqli_stmt_execute($stmt);
if (!$adminNameResult) {
    die("Query error");
}
$adminNameResult = mysqli_stmt_get_result($stmt);

if (!$userNameResult || !$adminNameResult) {
    die("Query error");
} else {

    $row = mysqli_fetch_row($userNameResult);
    $adimnRow = mysqli_fetch_row($adminNameResult);

    if ($row != null) {
        if ($row[0] == $username && ($row[1] == 0)) {
            $query = "SELECT PASSWORD FROM $table WHERE USERNAME='$username'";
            $passwordResult = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($passwordResult);
            if (($row[0] == $password)) {
                $query = "SELECT USERID,USERNAME FROM $table WHERE USERNAME='$username'";
                $current_datetime = date('Y-m-d H:i:s');
                $changeLLT = "UPDATE $table SET LLOGIN='$current_datetime' WHERE USERNAME='$username'";
                $loginDetailResult = mysqli_query($conn, $query);
                $changeLLTResult = mysqli_query($conn, $changeLLT);
                $row = mysqli_fetch_row($loginDetailResult);
                session_start();
                $_SESSION['loginDetail'] = $row[0];
                $_SESSION['name'] = $row[1];
                header('Location: ../Page/Logined/home.php');
                mysqli_close($conn);
                exit;
            } else {
                $error_message = '输入错误';
            }
        }
    } else {
        $error_message = '输入错误';
    }

    if ($adimnRow != null) {
        if ($adimnRow[0] == $username) {
            $query = "SELECT PASSWORD FROM $adminTable WHERE USERNAME='$username'";
            $passwordResult = mysqli_query($conn, $query);
            $adimnRow = mysqli_fetch_row($passwordResult);
            if ($adimnRow[0] == $password) {
                $query = "SELECT USERID,USERNAME FROM $adminTable WHERE USERNAME='$username'";
                $loginDetailResult = mysqli_query($conn, $query);
                $adimnRow = mysqli_fetch_row($loginDetailResult);
                session_start();
                $_SESSION['loginDetail'] = $adimnRow[0];
                $_SESSION['name'] = $adimnRow[1];
                header('Location: ../Page/AdminLogined/adminHome.php');
                mysqli_close($conn);
                exit;
            } else {
                $error_message = '输入错误';
            }
        }
    } else {
        $error_message = '输入错误';
    }

}
if ($error_message != '') {
    session_start();
    $_SESSION['error_message'] = $error_message;
    $_SESSION['username'] = $username;
    header('Location: ../login.php');
    exit;
}
mysqli_close($conn);

?>