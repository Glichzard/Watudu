<?php

require "db.php";

$taskId = $_GET["id"];

$query = "UPDATE tasks SET done = 1 WHERE id = $taskId";
$conn -> query($query);

?>