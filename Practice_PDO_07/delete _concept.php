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

        //simple delete concept
        $sql = "DELETE From student WHere id = 1"; //database ma vayeko id no. 1 lai delete gaar vanni sql statement ho.
        $affected_row = $conn->exec($sql);
        echo $affected_row."Row deleted Sucessfully<br>";

    }
    catch(PDOException $e) //this 'e' is an object that helps programmer to know for what reason exception is being occured.
     {
        echo "connection failed" . $e->getMessage();

    }
?>