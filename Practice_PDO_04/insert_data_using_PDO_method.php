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
    echo "Connection established"."<br>";

    $name = 'Dipendra';
    $roll = '106';
    $address = 'Nepal';

    $sql = "INSERT INTO student (Name, Roll, Address) VALUES ('$name','$roll', '$address')";
    $affected_row = $conn->exec($sql); //exec yeuta inbuilt PHP function ho jasle SQL statement haru lai run garauncha.
    echo $affected_row ." Row effected";


}
catch(PDOException $e) //this 'e' is an object that helps programmer to know for what reason exception is being occured.
 {
    echo "connection failed" . $e->getMessage();

 }





?>