<?php

require "db.php";

$query = "SELECT * FROM tasks WHERE done = 0 ORDER BY id DESC";
$result = $conn -> query($query);
while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <?php if($row["urgent"] == "true" || $row["title"] != "") { ?>
                <h5 class="card-title">
                    <?= $row["title"] ?>
                    <div class="badge-container">
                        <?php
                            echo $row["urgent"] == "true" ? '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="This task is urgent">URGENT</span>' : "";
                        ?>
                    </div>
                </h5>
            <?php } ?>
            <p class="card-text"><?= $row["description"]?></p>
            <div class="task-action">
                <div class="date">
                    Created at:
                    <u><?= $row["date"]?></u>
                </div>
                <div class="btn-actons">
                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit task" onclick="editTask(<?= $row['id'] ?>)">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button type="button" class="btn btn-success" onclick="doneTask(<?= $row['id'] ?>)">Done</button>
                </div>
            </div>
        </div>
    </div>
<?php }

if($result -> num_rows == 0) { ?>
    <div class="alert alert-secondary" role="alert">
        You dont have any task!
    </div>
<?php }

?>