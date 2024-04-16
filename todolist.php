<?php
include "service/connection.php";
include "service/select.php";
include "service/insert.php";
include "service/delete.php";
include "service/update.php";
session_start();

$message_add_task = "";
$message_edit_task = "";
$message_delete_task = "";

// insert task into db
if (isset($_POST["addtask"])) {
    $value_task = htmlspecialchars($_POST['task']);

    $sql_add_task = $insert->selectTable($table_name = "task", $condition = "(user_id, value_task) VALUES ('{$_SESSION["user_id"]}', '$value_task')");
    $result_add_task = $connected->query($sql_add_task);
    $result_add_task ? $message_add_task = "Task successfull added" : $message_add_task = "Failed";
}

// select task
if (isset($_SESSION['is_login'])) {
    $sql_select_task = $select->selectTable($table_name = "task", $fields = "*", $condition = "WHERE user_id={$_SESSION['user_id']} ORDER BY task_id DESC");
    $result_select_task = $connected->query($sql_select_task);
}

// edit task
if (isset($_POST['editTask'])) {
    $target_task = $_POST["task-id"];
    $edited_task = $_POST['edited-task'];
    $sql_edit_task = $update->selectTable($table_name = "task", $condition = "value_task = '$edited_task' WHERE task_id = $target_task");
    $result_edit_task = $connected->query($sql_edit_task);
    $result_edit_task ? $message_edit_task = "Task edited" : false;
    header("location: todolist.php");
}

// delete task
if (isset($_POST['deleteTask'])) {
    $target_task = $_POST["task-id"];
    $sql_delete_task = $delete->select_table($table_name = "task", $condition = "WHERE task_id = $target_task");
    $result_delete_task = $connected->query($sql_delete_task);
    $result_delete_task ? $message_delete_task = "Task deleted" : false;
    header("location: todolist.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Tugasqw</title>
</head>

<body>
    <!-- hero start -->
    <div class="todolist-hero p-2">
        <!-- navbar start -->
        <?php include "layout/navbar.php" ?>
        <!-- navbar end -->
        <div id="liveAlertPlaceholder">
            <?= $message_add_task ?>
        </div>
        <div class="container-task p-3 mx-auto my-3 d-flex justify-content-center rounded-3 shadow">
            <!-- card task start -->
            <div class="card-task p-4 border-5 rounded-3 shadow-sm">
                <h4>To Do List</h4>
                <!-- Trigger Modal Add Task Start -->
                <div class="add-task d-flex gap-1" data-bs-toggle="modal" data-bs-target="#modalAddtask">
                    <img src="assets/icon/plus-solid.svg" alt="plus icon">
                    <p>New Task</p>
                </div>
                <!-- Trigger Modal Add Task Start -->
                <!-- Modal Add Task Start -->
                <div class="modal fade" id="modalAddtask" tabindex="-1" aria-labelledby="modalAddtaskLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalAddtaskLabel">Add Task</h1>
                                </div>
                                <div class="modal-body">
                                    <label for="task" class="form-label">Add new task</label>
                                    <input type="text" name="task" class="form-control" id="task" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                    <button type="submit" name="addtask" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal Add Task End -->
                <!-- List Task Start -->
                <div id="input-container">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <?php $counter = 1;
                        while (isset($result_select_task) ? $data_task = $result_select_task->fetch_assoc() : false) { ?>
                            <div class="list-task">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" id="checkbox-<?= $counter ?>" type="checkbox"
                                            aria-label="Checkbox for following text input"
                                            onchange="toggleChecked(<?= $counter ?>)">
                                    </div>
                                    <input type="text" class="form-control" id="textTask-<?= $counter ?>"
                                        aria-label="Text input with checkbox" name="task-value"
                                        value="<?= $data_task['value_task'] ?>" readonly>
                                    <!-- trigger edit task -->
                                    <div class="input-group-text bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-edit-<?= $data_task['task_id'] ?>">
                                        <img src="./assets/icon/pen-solid.svg" alt="pen icon">
                                    </div>
                                    <!-- trigger delete task -->
                                    <div class="input-group-text bg-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-<?= $data_task['task_id'] ?>">
                                        <img src="./assets/icon/trash-solid.svg" alt="trash icon">
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Task Start -->
                            <div class="modal fade" id="modal-edit-<?= $data_task['task_id'] ?>" tabindex="-1"
                                aria-labelledby="modal-edit-<?= $data_task['task_id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="modal-edit-<?= $data_task['task_id'] ?>Label">Edit Task</h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="edited-task"
                                                        value="<?= $data_task['value_task'] ?>">
                                                </div>
                                                <input type="hidden" name="task-id" value="<?= $data_task['task_id'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    aria-label="Close">Cancel</button>
                                                <button type="submit" name="editTask" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal Edit Task End -->

                            <!-- Modal Delete Task Start -->
                            <div class="modal fade" id="modal-delete-<?= $data_task['task_id'] ?>" tabindex="-1"
                                aria-labelledby="modal-delete-<?= $data_task['task_id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="modal-delete-<?= $data_task['task_id'] ?>Label">Delete Task</h1>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-dark">Are you serious want to delete this task?</p>
                                                <input type="hidden" name="task-id" value="<?= $data_task['task_id'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    aria-label="Close">No</button>
                                                <button type="submit" name="deleteTask" class="btn btn-danger">Yes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal Delete Task End -->
                            <?php $counter++;
                        } ?>
                    </form>
                </div>
                <!-- List Task End -->
                <script>
                    function toggleChecked(counter) {
                        const checkbox = document.getElementById('checkbox-' + counter);
                        const textInput = document.getElementById('textTask-' + counter);
                        if (checkbox.checked) {
                            textInput.style.textDecoration = "line-through";
                        } else {
                            textInput.style.textDecoration = "none";
                        }
                    }
                </script>
            </div>
            <!-- card task end -->
        </div>
    </div>
    <!-- hero end -->
    <!-- js -->
    <script src="assets/js/main.js"></script>
    <!-- bootstrap -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>