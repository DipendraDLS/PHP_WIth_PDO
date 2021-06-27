<?php

//create connection
$dsn= "mysql:host=localhost; dbname=test_db;"; //dsn means data source name.
$db_name="root";
$db_password= "";

//handling the exception
try{
    $conn = new PDO($dsn, $db_name, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // $conn vaney object ma yeuta attribute set gareko so that jati pani 
                                                                    //error reporting  haru huncha tyo exception ko through pass garauney vanera.
    echo "Connection established"."<hr><br>";

    //Insert data 
    if(isset($_REQUEST['submit'])){ //submit button press ta garyo tara filed khali cha vaney database ma janu vayena. so checking.
        //checking for empty fields
        if(($_REQUEST['name']== "") || ($_REQUEST['roll']== "") || ($_REQUEST['address']== "")){
            echo "<small>Fill all the fields</small><hr>";
        }
        else
        {
          $name = $_REQUEST['name']; //form ma name vanni field ma j type garincha tyo $name ma ayera bascha. 
          $roll = $_REQUEST['roll'];  //form ma rollvanni field ma j type garincha tyo $roll ma ayera bascha.
          $address = $_REQUEST['address']; //form ma address vanni field ma j type garincha tyo $address ma ayera bascha.

          $sql= "INSERT INTO student(Name, Roll, Address) VALUES ('$name', '$roll', '$address')";
          $affected_row = $conn-> exec($sql); //exec yeuta inbuilt PHP function ho jasle SQL statement haru lai run garauncha.
          echo $affected_row ." Row affected<br>";
        }
    }
}
catch(PDOException $e) //this 'e' is an object that helps programmer to know for what reason exception is being occured.
 {
    echo "connection failed" . $e->getMessage();

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>insert_data_using_form</title>
</head>
<body>
    
        <form action = ""  method="POST">

            <label>Name:</label>
            <input type="text" name="name">

            <label>Roll:</label>
            <input type="text" name="roll">

            <label>Address:</label>
            <input type="text" name="address">

            <button type="submit" name="submit">Submit</button>
        </form>
</body>
</html>