<?php
    session_start();

    if(!isset($_SESSION['username'])){
        
        if(isset($_REQUEST['uname']) || isset($_REQUEST['pass'])){
        
            $username = $_REQUEST['uname'];
            $password = $_REQUEST['pass'];

            $_SESSION['username']= $username;
            $_SESSION['password']= $password;
            header('location: welcome.php');

        }
    }else{
        header('location: welcome.php');
    }   

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Real world use of Session. </h1>

    <form method="POST" action="">
        username: <input type="text" name="uname" required><br><br>
        password: <input type="password" name="pass" required><br><br>
        <input type="submit" value="login" name="login">
    </form>

</body>
</html>