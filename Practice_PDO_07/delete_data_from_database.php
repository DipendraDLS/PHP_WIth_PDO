<!-- yaha insert gani ko ni code cha and delete garni ko pani code cha -->


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

    //Insert data 
    if(isset($_REQUEST['submit'])){
        //checking for empty fields
        if(($_REQUEST['name']== "") || ($_REQUEST['roll']== "") || ($_REQUEST['address']== "")){
            echo "<small>Fill all the fields</small><hr>";
        }
        else
        {
          $name = $_REQUEST['name'];
          $roll = $_REQUEST['roll'];
          $address = $_REQUEST['address'];

          $sql= "INSERT INTO student(Name, Roll, Address) VALUES ('$name', '$roll', '$address')";
          $affected_row = $conn-> exec($sql);
          echo $affected_row ." Row affected<br>";
        }
    }

    //*********************************delete data ko code balla suru vo. ***************************************************************

    if(isset($_REQUEST['delete'])){
        //when delete button is pressed.
        $sql= "DELETE FROM student where  id = {$_REQUEST['id']}"; //yo id ma tyo type = "hidden" name='id' vanni bata value auncha. 
        $affected_row = $conn-> exec($sql);
        echo $affected_row ." Row Deleted.<br>";
    }


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
    <title>delete_data_from_database.</title>
</head>
<body>
    
        <form action = ""  method="POST">

            <label>Name:</label>
            <input type="text" name="name">

            <label>Roll:</label>
            <input type="text" name="roll">

            <label>Address:</label>
            <input type="text" name="address">

            <button type="submit" name="submit">Submit</button>
        </form>

    <div>
        <?php

            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result->rowCount()>0){

                echo "<table border=1 cellspacing=0>";
                echo "<thead>";
                        echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Name</th>";
                            echo "<th>Roll</th>";
                            echo "<th>Address</th>";
                            echo "<th>Action</th>";
                        echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    while($row= $result->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                            echo "<td>".$row['id']."</td>";    
                            echo "<td>".$row['Name']."</td>";    
                            echo "<td>".$row['Roll']."</td>";    
                            echo "<td>".$row['Address']."</td>";   
                            //yaha yeuta delete vanni button banayeko
                            echo '<td>  
                                        <form action = "" method = "POST">
                                            <input type= "hidden" name="id" value = ' .$row["id"]. '>
                                            <input type = "submit" name = "delete" value = "Delete">                                     
                                        </form>                            
                                  </td>'; 
                                  //id ma hidden tarika le database bata id auncha and then delete press gara id pass huncha mathi php ma
                                  // lekheko cha.
                                  

                        echo "</tr>";
                    }
                echo "</tbody>";
                echo "</table>";
            }           
             else{
                     echo "0 Results.";  
                 } 
        ?>
    </div>
<?php $conn = null; ?>
</body>
</html>