<?php
    // connecting to database.
    
   // This is withtin a single line which looks messy one.
    $conn = new PDO("mysql:host=localhost; dbname=test_db;" ,"root", "");
    
    if($conn){
        echo "connection established";
    }
?>
