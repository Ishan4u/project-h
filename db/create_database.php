<?php
    include '../components/connect.php';

    $sql = "CREATE DATABASE harshi";

      if($con->query($sql) === TRUE){
        echo "Database created successfully";
      }
      else{
        echo "error creating table : " . $con->error ;
      }

      $con->close();
?>