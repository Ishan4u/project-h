<?php

$server = "localhost:3306";
$user = "root";
$password = "ishan@1999";
$db = "harshi";

// Create connection
$con = new mysqli($server, $user, $password, $db);

// Check connection
if ($con->connect_error) {
    die("connection failed" . $con->connect_error);
}
// echo "connection ok";
?>