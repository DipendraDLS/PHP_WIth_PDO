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

  }
  
  catch(PDOException $e) //this 'e' is an object that helps programmer to know for what reason exception is being occured.
 {
    echo "connection failed" . $e->getMessage();

 }


 try{

    //sql statement
    $sql = "SELECT * From student WHERE id = ?"; //?  is the positional Parameter.

    //prepare statement
    $result = $conn->prepare($sql);

    //yaha bind ko kunai concept nai chaindaina:- write sql, prepare it and execute it

    //execute the prepared statement. 
    $result->execute(array(3));//As we haven't used bind concept so we need to pass the array. '3' vaneko yaha id ho.   

    
    $row = $result->fetch(PDO::FETCH_ASSOC);

    echo "ID:".$row['id'] . "Name:" . $row['Name']. "Roll:". $row['Roll']. "Address:". $row['Address'] . "<br>"; 
  
     
    
 }

 catch(PDOException $e){
     echo $e->getMessage();

 }

//close connection
unset($result);

//close connection
$conn = null;


?>