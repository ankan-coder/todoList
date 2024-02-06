<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './php_utils/_dbConnect.php';

    $Name = $_POST['name'];
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Password = md5($_POST['password']);
    $CPassword = md5($_POST['cpassword']);


    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];


    $image_path = "profilePics/" . $filename;

    // Check whether the username exists in the database table
    $sql_checkusername = "SELECT * FROM `users` WHERE `username` ='$Username' OR `email` = '$Email'";
    $result = mysqli_query($conn, $sql_checkusername);
    $numExistsRows = mysqli_num_rows($result);

    if ($numExistsRows > 0) {
        $duplicate_username_error = "The Username or Email already exists!";
    } else {
        if (($Password === $CPassword) && move_uploaded_file($tempname, $image_path)) {
            $sql_insertdetails = "INSERT INTO users (`name`, `username`, `email`, `password`, `image`) VALUES ('$Name', '$Username', '$Email', '$Password', '$image_path')";
            $result_insertdetails = mysqli_query($conn, $sql_insertdetails);

            if ($result_insertdetails) {
                $insertDetials_result = "Successfully signed up! You can now log in.";
            } else {
                $insertDetails_error =  "Error signing up!";
            }
        } else if ($Password != $CPassword) {
            $password_error = "Passwords don't match!";
        } else if (!move_uploaded_file($tempname, $image_path)) {
            $photoUploadError = "Error uploading the photo!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskBuddy - Register</title>
    <?php require './php_utils/_bootstapInit.php'; ?>
    <script src="./userValidation.js"></script>
</head>

<body>
    <?php require './php_utils/_nav.php'; ?>


    <div class="container">
        <?php if (isset($duplicate_username_error)) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $duplicate_username_error . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
        } ?>
        <?php if (isset($photoUploadError)) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $photoUploadError . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                   ';
        } ?>
        <?php if (isset($insertDetials_result)) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                        ' . $insertDetials_result . '
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
        } ?>
        <?php if (isset($insertDetails_error)) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $insertDetails_error . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                   ';
        } ?>
        <?php if (isset($password_error)) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                        ' . $password_error . '
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                   ';
        } ?>
        <form class="p-5" action="signup.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required name="name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" required name="username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="image" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>
    </div>

</body>

</html>