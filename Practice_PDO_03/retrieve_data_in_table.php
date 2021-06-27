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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retrieve Data in Table.</title>
</head>
<body>
    <div>
        <?php

            $sql = "SELECT * FROM student"; //hamilai database ma vayeko sabai data haru nikalnu cha so SELECT Query.
            $result = $conn->query($sql);

            if ($result->rowCount()>0){ //rowcount() vanni inbuilt function le kati wota rows haru cha database ma vanera value return dincha.

                //table ko format nikaleko with html but inside PHP...
                echo "<table border=1 cellspacing=0>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>Roll</th>";
                        echo "<th>Address</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row= $result->fetch(PDO::FETCH_ASSOC)){ //result vanni varaible ma $conn->query($sql) bata database ko data haru select 
                                                               //huncha and then loop lagayera teslai rerieve gareko.
                    echo "<tr>";
                        echo "<td>".$row['id']."</td>";    
                        echo "<td>".$row['Name']."</td>";    
                        echo "<td>".$row['Roll']."</td>";    
                        echo "<td>".$row['Address']."</td>";   
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }else{
                    echo "0 Results.";  
                } 
    ?>

    </div>
    <?php $conn = null; ?> <!--Yo kei haina just connection close gareko matrai ho. just like door open garey pachi close garnu parcha same.-->
</body> 
</html>