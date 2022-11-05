<?php

$host = "localhost";
$user = "root";
$password = "";
$db_name = "tenant-system";

$conn = mysqli_connect($host, $user, $password, $db_name);
if (!$conn) {
    die("Error Connecting to the database" . mysqli_connect_error());
}