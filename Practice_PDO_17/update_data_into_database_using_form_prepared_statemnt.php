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

    //Update data 
    if(isset($_REQUEST['update'])){
        //checking for empty fields
        if(($_REQUEST['name']== "") || ($_REQUEST['roll']== "") || ($_REQUEST['address']== "")){
            echo "<small>Fill all the fields</small><hr>";
        }
        else
        {
         //using named parameter
         $sql= "UPDATE student SET Name = :name, Roll= :roll, Address= :address WHERE id = :id";  
          
         //prepare statement
         $result= $conn->prepare($sql);

         //varaible and values
          $name = $_REQUEST['name'];
          $roll = $_REQUEST['roll'];
          $address = $_REQUEST['address'];
          $id = $_REQUEST['id'];

          //execute the prepared statement
          $result->execute(array(':name' => $name, ':roll' => $roll, ':address' => $address, ':id' => $id ));

          echo $result->rowCount() ." Row Updated Sucessfully<br>";
        }
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
    <title>Update_data_into_database.</title>
</head>
<body>

    <?php  
        if(isset($_REQUEST['edit'])){// edit button ma click garyo vaney then.

            //using named parameter
            $sql= "SELECT * FROM student WHERE id= :id";
            
            //prepare statement 
            $result = $conn->prepare($sql);

            //varaible and value
            $id = $_REQUEST['id'];

            // execute prepared statement
            $result->execute(array(':id' => $id));
            
            //fetch single row
            $row = $result->fetch(PDO::FETCH_ASSOC);

            //close prepared statement
            unset($result);
        }
    ?>
    <!-- Mathi ko PHP code le matra select gardincha ani tyo select gareko kura lai form ma dekhauna ta paryo so that we can edit that data so.-->
        <form action = ""  method="POST">


            <label>Name:</label>
            <input type="text" name="name" value="<?php if(isset($row['Name'])){echo $row['Name'];} ?>"> <!-- yaha 'value' ma k gareko ta vanda yedi name field ma kei value cha vani show gara display ma dyau tyo field vitra vaneko ho -->

            <label>Roll:</label>
            <input type="text" name="roll"  value="<?php if(isset($row['Roll'])){echo $row['Roll'];} ?>">

            <label>Address:</label>
            <input type="text" name="address" value="<?php if(isset($row['Address'])){echo $row['Address'];} ?>">


            <input type= "hidden" name="id" value="<?php echo $row['id']?>"> <!--value ma particular data ko id ayeko huncha & yo id mathi php ma pass huncha -->
            <button type="submit" name="update">Update</button>

        </form>

    <div>
        <?php

            $sql = "SELECT * FROM student";

            //prepare statement
            $result = $conn->prepare($sql);

            // execute staement

            $result->execute();

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
                            //edit button ko lagi. 
                            echo '<td> 
                                        <form action = "" method = "POST">
                                            <input type= "hidden" name="id" value = ' .$row["id"]. '>
                                            <input type = "submit" name = "edit" value = "Edit">                                     
                                        </form>                            
                                        
                                  </td>';
                                //   <!--yo id mathi sql statement ma kaam auncha -->   
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
<?php 
    //close prepared statement
    unset($result);

    //close connection
    $conn = null; 
?>
</body>
</html> 