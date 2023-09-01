<?php

require "db.php";

$taskId = $_GET["id"];

$query = "DELETE FROM tasks WHERE id = $taskId";
$conn -> query($query);

?>