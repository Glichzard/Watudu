<?php

require "../db.php";

$query = "DELETE FROM tasks WHERE id = {$_GET['id']}";
$conn -> query($query);

?>