<?php
    //start session
    session_start();

    //set session variables.
     $_SESSION['username'] = "dipendra";
     $_SESSION['password'] = "123456";
    
    //accessing session varaible.
    echo $_SESSION['username']."<br>";
    echo $_SESSION['password']."<br>";
 
    //unset session varaible
    //unset($_SESSION['username']);

    //session destroy
    // session_destroy();
    
?>