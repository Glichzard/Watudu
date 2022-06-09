<?php

require "../db.php";

$query = "SELECT * FROM tasks ORDER BY id DESC";
$result = $conn -> query($query);
while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
    <div class="task">
        <?php
        if($row["id"] == $_GET["id"]) { ?>
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
                <button onclick="deleteTask(<?= $row['id']?>)"><i class="fa-solid fa-trash"></i>   Borrar</button>
            </div>
        <?php } else { ?>
            <div class="top">
                <h2><?= $row["title"]?></h2>
                <span>ID: <?= $row["id"]?></span>
            </div>
            <div class="desc">
                <p><?= $row["description"]?></p>
            </div>
            <div class="footer">
                <button onclick="loadTasks(<?= $row['id']?>)"><i class="fa-solid fa-pen"></i> Editar</button>
            </div>
        <?php }
        ?>
    </div>
<?php }

?>