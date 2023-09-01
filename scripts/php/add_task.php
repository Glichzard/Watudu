<?php

require "db.php";

$title = $_POST["title"];
$desc = $_POST["desc"];
$urgent = $_POST["urgent"];

$title = $conn -> real_escape_string($title);
$desc = $conn -> real_escape_string($desc);

if($desc == null) return;

$query = "INSERT INTO tasks (title, description, urgent) VALUES ('$title', '$desc', '$urgent')";
$result = $conn -> query($query);

echo $result;

?>