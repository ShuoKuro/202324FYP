<?php
session_start();
include("../db.php");

$ReceiptID = $_GET["ReceiptID"];
$table = "paymentreceipts";

$sql = "SELECT * FROM $table WHERE ReceiptID = '$ReceiptID'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['query_result'] = $row;
    }
} else {
    $_SESSION['query_result'] = "No results";
}

mysqli_close($conn);
header('Location: ../output.php');
?>