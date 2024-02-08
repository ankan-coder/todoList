<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './php_utils/_dbConnect.php';

    $Email = $_POST["email"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM `users` WHERE `email` = '$Email' AND `password` = '$password'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        session_start();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $Email;

        header("Location: todoList.php");
        exit;
    } else { //If No then
        $success_status = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskBuddy - Login</title>
    <?php require './php_utils/_bootstapInit.php'; ?>
</head>

<body>
    <?php require './php_utils/_nav.php'; ?>


    <div class="container">
        <form class="p-5" action="./login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control border-dark" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control border-dark" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</body>

</html>