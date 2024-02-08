<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit; // Always exit after a header redirect
}

include './php_utils/_dbConnect.php';

$tid = null;
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($tid === null) {
        exit;
    }

    $updatedTask = $_POST['task'];

    // Check whether the entered task is the same as the existing task
    $sql_taskexists = "SELECT * FROM `tasks` WHERE `id` = ?";
    $stmt = $conn->prepare($sql_taskexists);
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetchedRow = $result->fetch_assoc();

    if (($fetchedRow['task'] != $updatedTask) && ($updatedTask != "")) {
        $sql_updatetask = "UPDATE `tasks` SET `task` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql_updatetask);
        $stmt->bind_param("si", $updatedTask, $tid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $insertTask_result = "Task Updated!";
            header('Location: ./todoList.php');
            exit;
        } else {
            $insertTask_error = "Error updating task!";
        }
    } else {
        $taskUpdateError = "Can't update to the same task";
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './php_utils/_bootstapInit.php'; ?>
    <title>Update Task</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TaskBuddy</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./todoList.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="container">
            <?php
            $sql = "SELECT task FROM `tasks` WHERE `id` = $tid";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

            echo  "<div class='container text-center fs-1'>Editing Task - \"$row[task]\" </div>";
            ?>
        </div>
        <form action="taskEdit.php<?php if ($tid !== null) echo '?tid=' . $tid; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group d-flex m-5">
                <input type="text" class="form-control border-primary" id="task" aria-describedby="emailHelp" value="<?php echo $row['task'] ?>" name="task">
                <button type="submit" class="btn btn-primary mx-2">Update</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>