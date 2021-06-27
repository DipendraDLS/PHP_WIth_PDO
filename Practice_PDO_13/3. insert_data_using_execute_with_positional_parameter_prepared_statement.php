<?php 

$dsn = "mysql:host=localhost; dbname=test_db;";
$db_user = "root";
$db_password = "";


try {         
	
	$conn = new PDO($dsn,$db_user ,$db_password);     //create Database connection using PDO

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo "Connected to Database !!!"."<hr><br>";
} 

catch (Exception $e) {
	
	echo "Connection to Database FAILED !!! " .$e->getMessage();
}


try{
    //Using Anonymous Positional Parmeter 
    $sql = "INSERT INTO student (Name, Roll, Address) VALUES (?, ?, ?)";

    //prepare statement
    $result = $conn->prepare($sql);

    //execute the prepared statement
    $result->execute(array('Ali', 105, 'Delhi')); //bind ko concept use nagarda execute ma yesari array banayera pass garnu parcha.


    /* //execute using varaible and values
        $name = "Dipu";
        $roll = 106;
        $address = "Kalimati";
        $result->execute(array($name, $roll, $address));
    */

    echo $result->rowCount(). " Row inserted";
}
catch(PDOException $e){
    echo $e->getMessage();
}

//close prepared statement
unset($result);

//close connection
$conn = null;
?>