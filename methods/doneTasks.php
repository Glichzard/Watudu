<?php

require "../db.php";

$query = "SELECT * FROM tasks WHERE status = 1 ORDER BY id DESC";
$result = $conn -> query($query);

while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
    
<?php }

?>