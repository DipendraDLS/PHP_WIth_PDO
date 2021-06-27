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

    //Bind parameter to prepared statement
    $result->bindParam(1, $name, PDO::PARAM_STR);
    $result->bindParam(2, $roll, PDO::PARAM_INT);
    $result->bindParam(3, $address, PDO::PARAM_STR);

    //varaibles and values
    $name= "Ram";
    $roll = 104;
    $address = "Ranchi";

    //execute the prepared statement
    $result->execute();

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