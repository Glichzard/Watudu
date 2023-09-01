<?php

require "db.php";

$taskId = $_GET["id"];

$query = "UPDATE tasks SET done = 0 WHERE id = $taskId";
$conn -> query($query);

?>