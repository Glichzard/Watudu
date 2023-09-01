<?php

require "db.php";

$taskId = $_GET["taskId"];

$query = "SELECT * FROM tasks WHERE id = $taskId";
$result = $conn -> query($query);

$result = $result -> fetch_array(MYSQLI_ASSOC);
$result = json_encode($result);

echo $result;
    
?>