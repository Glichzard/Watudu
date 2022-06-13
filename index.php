<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b3d0c1c7c6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
    <title>Denon't</title>
</head>
<body>
    <div class="topnav">
        <h1>Watudu AJAX</h1>
        <span>Version: 1.2</span>
    </div>
    <div class="content">
        <div class="create-task">
            <div class="add-field">
                <span>Titulo</span>
                <input type="text" id="title">
            </div>
            <div class="add-field">
                <span>Descripcion</span>
                <textarea type="text" id="desc"></textarea>
            </div>
            <button id="createTask">Añadir</button>
        </div>
        <div id="tasks">

        </div>
    </div>
</body>
<script src="scripts/main.js"></script>
</html>