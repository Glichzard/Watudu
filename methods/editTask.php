<?php

require "../db.php";

$query = "UPDATE tasks SET title = '{$_POST['title']}', description = '{$_POST['desc']}' WHERE id = {$_POST['id']}";

if(empty($_POST["title"]) || empty($_POST["desc"])) {
    echo json_encode(array("success" => false, "emptyNewTitle" => empty($_POST["title"]),"emptyNewDesc" => empty($_POST["desc"])));
    die();
}

$conn -> query($query);
echo json_encode(array("success" => true));

?>