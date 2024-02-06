<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importing the db connect file _dbconnect.php
    include './php_utils/_dbConnect.php';

    //Getting data from the form and storing it in the variables
    $Email = $_POST["email"];
    $password = md5($_POST["password"]);

    // Making the query to fetch all the rows where username and password are the inputted ones
    $sql = "SELECT * FROM `users` WHERE `email` = '$Email' AND `password` = '$password'";

    //Running the sql query
    $result = mysqli_query($conn, $sql);

    //Storing the number of rows fetched
    $num = mysqli_num_rows($result);

    //Checking if the row with the given details are fetched or not
    if ($num == 1) { //If Yes then
        session_start(); //Start the session

        $_SESSION['loggedin'] = true; //Setting loggedin variable as true
        $_SESSION['username'] = $Email; //Storing the variable

        header("Location: todoList.php"); //On successfull login the page gets redirected to welcome.php
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
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</body>

</html>