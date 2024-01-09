<html>

<head>
    <title>FYP TEST System</title>
    <meta charset="utf-8">
</head>

<body>
    Campus INPUT FORM
    <form action="./Handler/testHandler.php" method="post">

        <br>
        <label for="UserID">StudentID:(BY TEST ACCOUNT: 0000000000)</label>
        <br>
        <input type="text" name="UserID" value="0000000000">
        <br>

        <br>
        <label for="Amount">Amount:</label>
        <br>
        <input type="text" name="Amount">
        <br>

        <br>
        <label for="EXPDate">EXPDate:</label>
        <br>
        <input type="date" name="EXPDate">
        <br>

        <br>
        <input type="submit" value="submit">
    </form>
    <hr>

    <?php
    #region 测试输出
    include("./db.php");
    $table = "paymentreceipts";
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        $header = false;
        while ($row = mysqli_fetch_assoc($result)) {
            if (!$header) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<th>{$key}</th>";
                }
                echo "</tr>";
                $header = true;
            }
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "没有找到结果";
    }
    #endregion
    ?>

    <hr>
    Campus FIND

    TESY1:
    http://localhost/202324FYP/Handler/testFindHandler.php?ReceiptID=1
    <br>
    TEST过期:
    http://localhost/202324FYP/Handler/testFindHandler.php?ReceiptID=5

</body>

</html>