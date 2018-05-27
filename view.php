<?php
////////////////////////////////////// initialise sql variables/////////////////////////////////

///////////////////////////////////////variables //////////////
$last_id=0;
$id=0;

$ls1=$ls2=$ls3=$ls4=$ls5=0;

////////////////////////// getting last ID////////////////////////////////////////
// Create connection
include('connect.php');
$sql= "SELECT MAX(id) FROM sw";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
$conn->close();

///////////////////////////get data associated to id no///////////////////////////////////////////////////
// Create connection

$id=$last_id;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM sw";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        
        $ls1=$row["sw1"];
        $ls2=$row["sw2"];
        $ls3=$row["sw3"];
        $ls4=$row["sw4"];
        $ls5=$row["sw5"];
      }
     
    }
}

else 
{
    echo "0 results";
}
$conn->close();
echo "<p><center>";
echo "z";
echo $ls1; echo$ls2; echo$ls3; echo$ls4; echo$ls5;
echo "</p></center>";
?>