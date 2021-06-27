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
          $name = $_REQUEST['name'];
          $roll = $_REQUEST['roll'];
          $address = $_REQUEST['address'];

          $sql= "UPDATE student SET Name = '$name', Roll= '$roll', Address= '$address' WHERE id ={$_REQUEST['id']}"; //yaha id tala update button bata auncha id hidden tarika le.
          $affected_row = $conn-> exec($sql); //exec($sql) le sql statement lincha teslai execute garauncha and then return garcha katiwota
                                                // row effected vayo vanera.
          echo $affected_row ." Row Updated Sucessfully<br>";
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
            $sql= "SELECT * FROM student WHERE id= {$_REQUEST['id']}"; //SELECT gareko and id dynamically generate vayerako cha edit button ma cha concept tala. 
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
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
<?php $conn = null; ?>
</body>
</html>