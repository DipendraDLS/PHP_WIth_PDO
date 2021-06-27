<?php
    
    //well managed connection format..
    $dsn= "mysql:host=localhost; dbname=test_db;"; //dsn means data source name.
    $db_user= "root";
    $db_password = ""; // if no any password set in database then leave it as blank.

    $conn = new PDO($dsn, $db_user, $db_password);

    if($conn){
        echo "connection established";
    }
?>