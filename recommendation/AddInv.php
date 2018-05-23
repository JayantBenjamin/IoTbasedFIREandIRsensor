<html>
<head>
<title>Add Product</title>
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
    form{
        margin-left:50px;
    }

    button{
        padding: 5px;
    }
</style>
</head>
<body>
   <div class="container-fluid abc">
       
   </div>
   <nav class="navbar navbar-default" data-spy="affix" data-offset-top="195" style="background-color: white; width: 100%;">
     <div class="navbar-header">
       
     </div>
     <div class="col-sm-12">
         <h2>Enter products here:</h2>
  </nav>

<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<br>
<p>
Enter Product :
<input type = "text" name = "prod"><br/><br>
Enter Quantity :
<input type = "number" name = "qt"><br/>
<?php
///////Creds//////
$servername = "localhost";
$username = "id638125_teamiotmumbai";
$password = "MumbaiIOT";
$dbname = "id638125_databaseiot";
/////////Variables///////////////////
$prod="";
$qt=0;

$last_id=0;
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
$conn->close();
echo "<br>";
//echo "Last entry was <br>";
//echo $last_id;

/////////////////////////////////Radio Head////////////////////////////////////

echo "<br>";
echo "Select Warehouse:";
echo "<br>";
echo "<br>";
while($last_id>0)
{
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
 if ($conn->connect_error) 
 {
    die("Connection failed: " . $conn->connect_error);
 } 

 $sql = "SELECT * FROM warehouse_entry";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) 
 {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        
        $lsp=$row["wrh"];
        echo "<input type=\"radio\" name=\"wrh\" value=\"";
        echo $lsp;
        echo"\">";
        echo $lsp;
        echo "<br>";
        echo "<br>";
        }
    }
 }
	else 
	{
    	echo "0 results";
	}

	$last_id--;
  $conn->close();
}
?>



<br> <input type = "submit" value = "Submit">
</p>
</form>
<p><a href="index.php">Back to warehouse listings</a></p>
</body>
</html>
<?php
if(!empty($_POST["prod"]))
{
    $prod=$_POST["prod"];
    echo "<br>";
    echo "The entry is ";
    
}
if(!empty($_POST["qt"]))
{
    $qt=$_POST["qt"];
    echo "of quantity  ";
    echo $qt;
    
}
if(!empty($_POST["wrh"]))
{
    echo " at ";
    echo $fname;
    $fname=$_POST["wrh"];
}


///////////////////////////////////update///////////

//echo "<br>Entering ".$qt." ".$prod." (s)";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$str1="INSERT INTO ";
$str2=" (Product_name, Qt) VALUES ( ";
$sql="";
$str3=" );";
$sql=$str1.$fname.$str2."'".$prod."'"." , ".$qt.$str3;
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "<br> <br>New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
</body>
</html>