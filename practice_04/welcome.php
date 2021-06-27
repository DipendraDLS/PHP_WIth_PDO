<?php
    
    session_start();
    echo "<h1>Welcome!!</h1><br>";

    echo "Your username is:". $_SESSION['username']."<br>";
    echo "Your password is:". $_SESSION['password']."<br>";

    session_destroy();
    
    if(isset($_REQUEST['logout'])){
    //    unset  ($_SESSION['username']);
       header('location: use_of_session.php');
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
        <form action="" method="POST-">
            <input type="submit" value="logout" name="logout">
        </form>
    
</body>
</html>
