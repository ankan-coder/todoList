<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskBuddy</title>
    <?php require './php_utils/_bootstapInit.php'; ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TaskBuddy</a>
        </div>
    </nav>
    <div class="d-flex m-6 pt-5 justify-content-evenly">
        <div class="col-5 ml-5 mt-5 d-flex align-middle flex-column">
            <div class="row-12 fs-1 mt-4">
                Welcome to TaskBuddy &#128075;
            </div>
            <div class="row-12 fs-4 mt-3 mb-3">
                Your Personal Productivity Companion for Efficient Task Management
            </div>
            <div class="row-12 fs-6 mt-1">
                TaskBuddy offers seamless task management with an intuitive interface. Stay organized and boost productivity effortlessly. Log out hassle-free with our user-friendly navigation. Your ultimate task companion.
            </div>
            <div class="w-50 fs-6 mt-5 d-flex justify-content-between">
                <a class="btn btn-primary" href="./signup.php">Sign Up</a>
                <a class="btn btn-success" href="./login.php">Log In</a>
            </div>
        </div>
        <div class="col-5 ml-5 mt-5">
            <div class="image-responsive">
                <img class="w-100" src="./Images/image.jpg" alt="image">
            </div>
        </div>
    </div>
</body>

</html>