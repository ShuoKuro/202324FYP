<html>

<head>
    <title>FYP TEST System</title>
    <meta charset="utf-8">
</head>

<body>
    <?php
    session_start(); // 开始会话
    
    if (isset($_SESSION['query_result'])) { // 检查会话变量是否存在
        $row = $_SESSION['query_result'];
        $keys = array_keys($row);
        $values = array_values($row);

        echo "<table border='1'>";
        echo "<tr>";
        for ($i = 0; $i < count($keys); $i++) {
            echo "<th>{$keys[$i]}</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 0; $i < count($values); $i++) {
            echo "<td>{$values[$i]}</td>";
        }
        echo "</tr>";
        echo "</table>";
    } else {
        echo "No results";
    }
    ?>

</body>

</html>