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

}
catch(PDOException $e) //this 'e' is an object that helps programmer to know for what reason exception is being occured.
 {
    echo "connection failed" . $e->getMessage();

}

//********************************************* Mathi ko  sabai coonection Establish ko code h0************************************************ */
//Managed Method to Retrieve Data From Database.

$sql = "SELECT * FROM student";
$result= $conn->query($sql);

    foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row)
    {
        echo " ID: " .$row['id']. "<br>"." Name: ". $row['Name']. "<br>"." Roll: ".$row['Roll']."<br>"." Address:".$row['Address']."<br><br>";

    }
