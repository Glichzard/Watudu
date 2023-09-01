<?php

require "db.php";

$query = "SELECT * FROM tasks WHERE done = 1 ORDER BY date ASC";
$result = $conn -> query($query);
while($row = $result -> fetch_array(MYSQLI_ASSOC)) { ?>
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <?php if($row["urgent"] == "true" || $row["title"] != "") { ?>
                <h5 class="card-title">
                    <?= $row["title"]?>
                    <div class="badge-container">
                        <?php
                            echo $row["urgent"] == "true" ? '<span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="This task was urgent">URGENT</span>' : "";
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
                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete task" onclick="deleteTask(<?= $row['id']?>)">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <button type="button" class="btn btn-primary" onclick="pendientTask(<?= $row['id']?>)">
                    Mark as pendient <i class="fa-solid fa-arrow-turn-up"></i>
                </button>
                </div>
            </div>
        </div>
    </div>
<?php }

if($result -> num_rows == 0) { ?>
    <div class="alert alert-primary" role="alert">
        You dont have any task!
    </div>
<?php }

?>