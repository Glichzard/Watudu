<?php

require "../db.php";

$query = "UPDATE tasks SET status = 0 WHERE id = {$_GET['id']}";
$conn -> query($query)

?>