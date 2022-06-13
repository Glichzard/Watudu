<div class="header">
    <div class="order">
        <button onclick="sorter('recent')">Reciente <i id="recentIndicator" class="fa-solid fa-angle-down"></i></button>
        <button onclick="sorter('lastMod')">Fecha de modificacion <i class="fa-solid fa-angle-down"></i></button>
        <label for="share-filter">Compartido</label>
        <input type="checkbox" id="share-filter" onchange="sorter(3)">
    </div>
    <div class="title">
        <h3>Tareas</h3>
    </div>
</div>

<?php

require "../db.php";

$query = "SELECT * FROM tasks WHERE status = 0 ORDER BY {$_GET['filter']} {$_GET['order']}";
echo $query;
$result = $conn -> query($query);

if($result -> num_rows == 0) echo "<h2>No hay tareas pendientes</h2>";

while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
    <div class="task">
        <?php if($row["id"] == $_GET["id"]) { ?>
        <div class="top">
            <input type="text" value="<?= $row['title']?>" placeholder="Nuevo titulo" id="newTitle">
            <span>ID: <?= $row["id"]?></span>
        </div>
        <div class="desc">
            <textarea id="newDesc" rows="5" placeholder="Nueva descripcion"><?= $row['description']?></textarea>
        </div>
        <div class="footer">
            <button onclick="loadTasks()"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            <button onclick="task(<?= $row['id']?>, true)"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <button onclick="actTask(<?= $row['id']?>, 'deleteTask')" class="red"><i class="fa-solid fa-trash"></i>   Borrar</button>
        </div>
        <?php } if($row["id"] != $_GET["id"]) { ?>
        <div class="top">
            <h2><?= $row["title"]?></h2>
            <span>ID: <?= $row["id"]?></span>
        </div>
        <div class="desc">
            <p><?= $row["description"]?></p>
        </div>
        <div class="footer">
            <button onclick="loadTasks(<?= $row['id']?>)"><i class="fa-solid fa-pen"></i> Editar</button>
            <button onclick="actTask(<?= $row['id']?>, 'doneTask')" class="green">Hecho <i class="fa-solid fa-check"></i></button>
        </div>
        <?php } ?>
    </div>
    <?php
}

?>

<details>
    <summary id="done-tasks">Tareas realizadas</summary>
    <div class="done-tasks">
    <?php
    $query = "SELECT * FROM tasks WHERE status = 1 ORDER BY id DESC";
    $result = $conn -> query($query);

    if($result -> num_rows == 0) echo "<h2>No hay tareas realizadas</h2>";

    while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
        <div class="task done">
            <?php if($row["id"] == $_GET["id"]) { ?>
            <div class="top">
                <input type="text" value="<?= $row['title']?>" placeholder="Nuevo titulo" id="newTitle">
                <span>ID: <?= $row["id"]?></span>
            </div>
            <div class="desc">
                <textarea id="newDesc" rows="5" placeholder="Nueva descripcion"><?= $row['description']?></textarea>
            </div>
            <div class="footer">
                <button onclick="loadTasks()" title="Cancelar"><i class="fa-solid fa-xmark"></i></button>
                <button onclick="task(<?= $row['id']?>, true)" title="Guardar"><i class="fa-solid fa-floppy-disk"></i></button>
                <button onclick="actTask(<?= $row['id']?>, 'deleteTask')" class="red">Borrar <i class="fa-solid fa-trash"></i></button>
            </div>
            <?php } if($row["id"] != $_GET["id"]) { ?>
            <div class="top">
                <h2><?= $row["title"]?></h2>
                <span>ID: <?= $row["id"]?></span>
            </div>
            <div class="desc">
                <p><?= $row["description"]?></p>
            </div>
            <div class="footer">
                <button onclick="loadTasks(<?= $row['id']?>)"><i class="fa-solid fa-pen"></i></button>
                <button onclick="actTask(<?= $row['id']?>, 'returnTask')" class="yellow">Devolver <i class="fa-solid fa-arrow-turn-up"></i></button>
            </div>
        <?php } ?>
        </div>
    <?php }
    ?>
    </div>
</details>