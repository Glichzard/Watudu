<?php

require "db.php";

$title = $_POST["title"];
$desc = $_POST["desc"];
$urgent = $_POST["urgent"];

$title = $conn -> real_escape_string($title);
$desc = $conn -> real_escape_string($desc);

$taskId = $_GET["id"];

$query = "UPDATE tasks SET title = '$title', description = '$desc', urgent = '$urgent' WHERE id = $taskId";
$result = $conn -> query($query);

echo $result;

?>