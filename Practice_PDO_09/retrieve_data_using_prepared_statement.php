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
    $sql = "SELECT * From student";

    //prepare statement
    $result = $conn->prepare($sql);

    //execute the prepared statement.
    $result->execute(); // parameter dinu parena becz ayyerako cha data gayerako chaina.

    //Fetch Data using while loop

    // while($row = $result->fetch(PDO::FETCH_ASSOC)){

    //     echo "ID:".$row['id'] . "Name:" . $row['Name']. "Roll:". $row['Roll']. "Address:". $row['Address'] . "<br>"; 

    // }

    // Bind by column number using bindColumn() function.
    $result->bindColumn(1,$id);         //database ko column 1 lai id vanni varaible sanga bind gareko ho
    $result->bindColumn(2,$name);       //database ko column 2 lai name vanni varaible sanga bind gareko ho
    $result->bindColumn(3,$roll);       //database ko column 3 lai roll vanni varaible sanga bind gareko ho
    $result->bindColumn(4,$address);    //database ko column 4 lai address vanni varaible sanga bind gareko ho
    
    while($result->fetch(PDO::FETCH_BOUND)){
        echo "ID:" . $id . "Name:" . $name . "Roll:" .$roll . "Address:" . $address . "<br><br>";
    }
    
 }

 catch(PDOException $e){
     echo $e->getMessage();

 }

//close connection
unset($result);

//close connection
$conn = null;


?>