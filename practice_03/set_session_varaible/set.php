<?php
    //start session
    session_start();

    //set session variables.
    $_SESSION['username'] = "dipendra";
    $_SESSION['password'] = "123456";
    //accessing session varaible.
    echo $_SESSION['username']."<br>";
    echo $_SESSION['password']."<br>";

    

    // varaible within SESSION varaible and accessing it.
    $uname = "Dipendra";
    $_SESSION['name']= $uname;
    //accessing SESSION varaible.
    echo $_SESSION['name'];





    //check session varaible set or not.
    if(isset($_SESSION['name'])){
        echo "<br>Session varable is set and has value:". $_SESSION['name']."<br>";
    }
    else{
        echo "Session varaible is not set";
    }

?>