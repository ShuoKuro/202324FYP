<?php
session_start();
if (!isset($_SESSION['query_result'])) {
    header('Location: ./index.php');
    exit();
}
function alert($message)
{
    echo "<script>alert('$message');
          window.history.back();
          window.close();
          </script>";
    session_destroy();
}
?>

<html>

<head>
    <title>FYP TEST System</title>
    <meta charset="utf-8">
</head>

<body>
    <div style="width: 80%; height: 80%; border: 1px solid black; padding: 10px; margin: auto;">
        <div style="height:30%; display: flex; align-items: center; justify-content: center;">
            <h1 style="text-align:center; font-size: 5em">Payment Advice</h1>
        </div>

        <?php
        $now = date('Y-m-d');
        $result = $_SESSION['query_result'];
        if (!is_array($result)) {
            alert("找不到该项目");
            exit();
        } elseif ($result["EXPDate"] < $now) {
            alert("已过期");
            exit();
        } elseif ($result["PayStatus"] != 0) {
            alert("已完成付款");
            exit();
        } else {
            #region 测试输出
            $keys = array('Student Bill Account No :', 'Name : ', 'Course :', '', 'Payment Due Date :', 'Amount :');
            $values = array($result['UserID'], 'Chan Da Wen', 'Higher Diploma in Telecommunications and Networking', '(IT114103)', $result['EXPDate'], $result['Amount']);
            echo "<table border='0' style='width:100%;'>";
            for ($i = 0; $i < count($keys); $i++) {
                echo "<tr>";
                echo "<th style='width:33%; text-align:right; padding: 10px 0;'>{$keys[$i]}</th>";
                echo "<td style='text-align:left; padding: 10px 0;'>&nbsp;&nbsp;{$values[$i]}</td>";
                echo "</tr>";
            }
            echo "</table>";
            #endregion
        
        }
        session_destroy();
        ?>

        <div style="height:20%; display: flex; align-items: center; justify-content: center;">
            <h1 style="text-align:center;">Payment Successful</h1>
        </div>

    </div>
</body>




</html>