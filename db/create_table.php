<?php
include '../components/connect.php';

$sql = "CREATE TABLE users (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
 )";

if ($con->query($sql) ===  TRUE) {
    echo 'table created successfully';
} else {
    echo 'error creating table :' . $con->error;
}
$con->close();
?>