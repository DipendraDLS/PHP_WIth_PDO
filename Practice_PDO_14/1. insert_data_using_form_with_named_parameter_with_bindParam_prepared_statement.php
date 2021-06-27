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
          $sql = "INSERT INTO student (Name, Roll, Address) VALUES (:name, :roll, :address)";
         
          //Prepare the statement
          $result = $conn->prepare($sql);

          //Bind parameter to prepared statement
          $result->bindParam(':name', $name, PDO::PARAM_STR); //$name vanni varaible sanga sql ma jani :name sanga bind garaideko ho.
          $result->bindParam(':roll', $roll, PDO::PARAM_INT);   //$roll vanni varaible sanga sql ma jani :roll sanga bind garaideko ho.
          $result->bindParam(':address', $address, PDO::PARAM_STR); //$address vanni varaible sanga sql ma jani :address sanga bind garaideko ho.
          

          //varaibles and values
          $name = $_REQUEST['name'];
          $roll = $_REQUEST['roll'];
          $address = $_REQUEST['address'];
 
          //execute the prepared statement
          $result->execute();
          
          echo $result->rowCount(). " Row inserted";

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
<?php
    //connection close.
    $conn = null;
?>
</html>