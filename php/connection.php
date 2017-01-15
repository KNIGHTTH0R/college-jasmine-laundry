<?php
    // Local
    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $database = "db_jasmine_laundry";

    // Azure
    $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
    $user = "b11e7dbec83707";
    $pass = "efd5017c";
    $database = "db_jasmine_laundry";
    
    $connection = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>