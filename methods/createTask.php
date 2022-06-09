<?php

require "../db.php";

$query = "INSERT INTO tasks (title, description) VALUES ('{$_POST['title']}', '{$_POST['desc']}')";

if(empty($_POST["title"]) || empty($_POST["desc"])) {
    echo json_encode(array("success" => false, "emptyTitle" => empty($_POST["title"]),"emptyDesc" => empty($_POST["desc"])));
    die();
}

$conn -> query($query);
echo json_encode(array("success" => true));

?>