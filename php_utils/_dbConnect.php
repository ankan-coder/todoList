<?php

$DBserver = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "todolist";

$conn = mysqli_connect($DBserver, $DBusername, $DBpassword, $DBname);

if (!$conn) {
    die('Error' . mysqli_connect_error());
}
