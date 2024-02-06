<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
}

include './php_utils/_dbConnect.php';

$loggedinEmail = $_SESSION['username'];

$sql = "SELECT * FROM `users` WHERE `email`='$loggedinEmail'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error running the query!' . mysqli_error($conn));
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = htmlspecialchars($row['image']);
        $loggedinUsername = $row['username'];
        $loggedinname = $row['name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform different actions based on the button clicked
        switch ($action) {
            case 'add':
                $Task = $_POST['task'];
                $Username = $_POST['username'];

                // Check whether the username exists in the database table
                $sql_taskexists = "SELECT * FROM `tasks` WHERE `username` ='$Username' AND `task` = '$Task'";
                $result = mysqli_query($conn, $sql_taskexists);
                $numExistsRows = mysqli_num_rows($result);

                if ($numExistsRows > 0) {
                    $duplicate_task_error = "Task Exists!";
                } else {
                    $sql_inserttask = "INSERT INTO tasks (`username`, `task`) VALUES ('$Username', '$Task')";
                    $result_inserttask = mysqli_query($conn, $sql_inserttask);

                    if ($result_inserttask) {
                        $insertTask_result = "Task Added!";
                    } else {
                        $insertTask_error =  "Error adding task!";
                    }
                }
                break;
            case 'edit':
                $tid = $_POST['id'];
                header('Location: taskEdit.php?tid=' . $tid . '');
                break;
            case 'dlt':
                if (isset($_POST['id'])) {
                    $tid = $_POST['id'];
                    $tid = mysqli_real_escape_string($conn, $tid);
                    $dltSQL = "DELETE FROM `tasks` WHERE `sno` = '$tid'";
                    $dltResult = mysqli_query($conn, $dltSQL);

                    $renumberSQL = "SET @count = 0";
                    $renumberResult = mysqli_query($conn, $renumberSQL);

                    $updateSQL = "UPDATE `tasks` SET `sno` = @count:= @count + 1";
                    $updateResult = mysqli_query($conn, $updateSQL);
                }
                break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './php_utils/_bootstapInit.php'; ?>
    <title>TodoList</title>
</head>

<body>
    <?php require './php_utils/_nav.php'; ?>

    <div class="container fs-1 w-50 text-center">
        <img class="rounded-circle" src="<?php echo  $imagePath; ?>" alt="" height="50px" width="50px">
        Hello, <?php echo $loggedinname; ?>!! &#128075;
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <form class="p-5" action="./todoList.php" method="post">
                    <div class="container">
                        <?php if (isset($duplicate_task_error)) {
                            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $duplicate_task_error . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
                        } ?>
                        <?php if (isset($insertTask_error)) {
                            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $insertTask_error . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                   ';
                        } ?>
                        <?php if (isset($insertTask_result)) {
                            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                        ' . $insertTask_result . '
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
                        } ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="task" placeholder="Enter task...">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="username" value="<?php echo $loggedinUsername; ?>">
                                <button type="submit" class="btn btn-outline-primary" name="action" value="add">Add Task</button>
                            </div>
                        </div>
                </form>

                <div class="container d-flex mt-3 flex-column align-items-center">
                    <?php

                    $sql_tasks = "SELECT * FROM `tasks` WHERE `username` ='$loggedinUsername' ORDER By `time` DESC";
                    $task_result = mysqli_query($conn, $sql_tasks);
                    $taskCount = mysqli_num_rows($task_result);

                    if ($taskCount > 0) {
                        while ($tasks = mysqli_fetch_array($task_result)) {
                            echo '
                                <div class="alert bg-warning justify-space-between w-50  d-flex justify-content-between align-items-center">
                                    <strong>
                                        ' . $tasks['task'] . '
                                    </strong>
                                    <form action="todoList.php" method="POST">
                                        <input type="hidden" value=' . $tasks['sno'] . ' name="id">
                                        <button type="submit" value="edit" name="action" class="btn btn-outline-dark text-dark">Edit</button>
                                        <button type="submit" value="dlt" name="action" class="btn btn-outline-dark text-dark">Delete</button>
                                    </form>
                                </div>
                            ';
                        }
                    } else {
                        echo '  
                            <div class="alert bg-warning w-50 text-center">
                                <strong>
                                    Oops!! No tasks here...
                                </strong>
                            </div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>