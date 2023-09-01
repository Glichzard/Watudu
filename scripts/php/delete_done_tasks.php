<?php

require "db.php";

$query = "DELETE FROM tasks WHERE done = 1";
$conn -> query($query);

?>