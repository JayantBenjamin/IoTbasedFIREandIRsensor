<html>
<head>
<title>IoTmumbai</title>
	<meta charset="utf-8">
	<meta lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body{
      color: #33b5e5;
      background: white;
    }
    a{
    color: #33b5e5;
    text-decoration: none !important;
    }
    a:hover{
    color: black !important;  
    }
    .affix {
    top: 0;
    width: 100%;
    z-index: 1;
    }
    .affix + .container{
    padding-top: 70px;
    }
    .page-header{
    border-color: #33b5e5;
    }
    ul.nav li.dropdown > ul.dropdown-menu{
    visibility:hidden;
    display:block;
    opacity:0;
    -webkit-transform:perspective(400) rotate3d(1,0,0,-90deg);
    -webkit-transform-origin:50% 0;
    -webkit-transition:500ms;
    -moz-transition:500ms;
    -o-transition:500ms;
    transition:500ms;
    }
    @media only screen and (min-width:768px){
    ul.nav li.dropdown:hover > ul.dropdown-menu{
    visibility:visible;
    opacity:1;
    display: block;
    background: #ccc;
    -webkit-transform:perspective(400) rotate3d(0,0,0,0);
    }
    }
    @media only screen and (max-width: 767px) {
    .abc {
    display: inline;
    margin-top: 0px;
    position: absolute;
    top: 0.02%;
    z-index: 5;
    }
    }
    .website-name{
    margin-top: 2%;
    }
     @media only screen and (max-width:1000px) {
    .d1{
    margin-left: 0% !important;
    }
    }
    .error {
        color: #FF0000;
    }    
    .container1 {
        width: 50%;
        background: white;
        margin: 10px auto;
        position: relative;
        text-align:center;
        font-size: 16px;
    }
    table {
        color:  #33b5e5;
        border-collapse: collapse;
        width: 50%;
    }
    th, td {
        color:  #33b5e5;
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    tr:hover{
        background-color:#f5f5f5
    }
</style>
</head>
<body>
   <div class="container-fluid abc">
       <h2 class="website-name" style="color: #33b5e5;"><a href="index.html"><center>IOTmumbai</center></a></h2>
   </div>
     
     
   

<br><br><br>
<div style=" margin-left:1%; margin-top:-2%;">
<div style="color:#33b5e5; margin-bottom:-2%; font-size:20px;"><center>Add new warehouse:</center></div>
<br><br>
<center>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<input type = "text" name = "newWa" style="width:170px; border-radius:5px; height:35px;" placeholder="Warehouse-Name">
<button type = "submit" value = "Submit" style="border:0px; width:75px; height:35px; margin-left:1%; border-radius:5px;"><b>ADD</b></button>
</form></center>
</div>

<center><p><a href="AddInv.php">Add Products</a></p></center>
<br><br>
</body>
</html>

<?php
$bool = false;

$fname ="";
if(!empty($_POST["newWa"]))
{
 $fname = $_POST["newWa"];   
}

if($fname!="")
{
$bool = true;
}
/// Add Warehouse 

////////////////////////////////////// initialise sql variables/////////////////////////////////
$servername = "localhost";
$username = "id638125_teamiotmumbai";
$password = "MumbaiIOT";
$dbname = "id638125_databaseiot";

////////////////////////// getting last ID////////////////////////////////////////
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
$sql= "SELECT MAX(id) FROM warehouse_entry";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
//$conn->close();
echo "<br>";
echo "Total Warehouses: ";
echo $last_id;
echo "<br>";

$last_id++;
if($bool==true)
{
echo "<br>Entered Warehouse:".$fname;
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO warehouse_entry (wrh) VALUES ('$fname');";


if ($conn->query($sql) === TRUE) {
   // echo "<br> <br>New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
// $conn->close();
// }
//// Create new table 
// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
} 
// echo "Connection Made";
// sql to create teble
	 $str1="CREATE TABLE ";
     $str2=$fname;
     $str3="( ID int NOT NULL AUTO_INCREMENT, Product_name varchar(255) NOT NULL, Qt int, PRIMARY KEY (ID));";
     $sql=$str1.$str2.$str3;
     echo "<br>";
     //echo $sql;

if ($conn->query($sql) === TRUE) {
   // echo "Table created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

//$conn->close();

///Display All the values you have added

//$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($conn,"SELECT * FROM warehouse_entry");
echo "<br>";
echo "<table><tr><th>Serial Number</th><th>Warehouses</th></tr>";
//echo " <table><tr><th>Serial Number</th><th>Product Name</th></tr>";

while($row = mysqli_fetch_array($result))
{   
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td><a href=\"ViewInv.php?fname=".$row['wrh']."\">" . $row['wrh'] . "</a></td>";
	// <a href="https://www.youtube.com"> abc </a>
	echo "</tr>";
}

echo "</table>";
mysqli_close($conn);
?>
