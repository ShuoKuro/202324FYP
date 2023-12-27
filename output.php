<?php
session_start();
if (!isset($_SESSION['query_result'])) {
    header('Location: ./index.php');
    exit();
}
?>

<html>

<head>
    <title>FYP TEST System</title>
    <meta charset="utf-8">
</head>

<body>
    <?php
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

    unset($_SESSION['query_result']);
    ?>
</body>

</html>