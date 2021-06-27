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
    $sql = "SELECT * From student WHERE id = ?"; //:id  is the named Parameter.

    //prepare statement
    $result = $conn->prepare($sql);

  
    //Bind Parameter
    $result ->bindValue(1, 3); //'1' vannale chai database ko column '1'  (i.e id) lai '3' vanni id sanga bind gareko ho.      
                               //binvalue() le parameter both value and varaible lincha but hamiley ahile value batai pass gareko i.e 3.
                              //but we can even pass it as:
                                 //$id  = 3;    and then 
                                // $result ->bindValue(1, $id); 

 

    //execute the prepared statement.
    $result->execute();//parameter dinu parena becz ayyerako cha data gayerako chaina.

    
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