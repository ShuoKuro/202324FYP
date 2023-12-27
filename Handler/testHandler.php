<?php

include("../db.php");

$UserID = $_POST["UserID"];
$Amount = $_POST["Amount"];
$EXPDate = $_POST["EXPDate"];
$StartDate = date('Y-m-d');
$table = "paymentreceipts";
$PayStatus = 0;
$Remark = "";

$sql = "INSERT INTO $table (UserID, Amount, EXPDate, StartDate, PayStatus, Remark) VALUES ('$UserID', '$Amount', '$EXPDate', '$StartDate', '$PayStatus', '$Remark')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header('Location: ../index.php');

?>