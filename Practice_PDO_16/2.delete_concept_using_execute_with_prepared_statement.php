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

//Using named parameter
$sql = "DELETE FROM student WHERE id = :id";

//prepare statement
$result = $conn->prepare($sql);

//varaible and values
$id = 14;

//execute statement
$result->execute(array(":id" => $id));

echo $result->rowCount()." Row deleted";

// close connection.
$conn = null;

?>