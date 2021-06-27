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
    //Using named Parmeter 
    $sql = "INSERT INTO student (Name, Roll, Address) VALUES (:name, :roll, :address)";

    //prepare statement
    $result = $conn->prepare($sql);

    //Bind parameter to prepared statement
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':roll', $roll, PDO::PARAM_INT);
    $result->bindParam(':address', $address, PDO::PARAM_STR);

    //varaibles and values
    $name= "Bina";
    $roll = 107;
    $address = "Newroad";

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