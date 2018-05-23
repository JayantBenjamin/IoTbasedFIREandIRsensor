<html>
<head>
<title>Tab Example</title>
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
    button
    {
    margin:1%;
    margin-left:225px;
    padding:1%;
    border-radius: 5px;
    background: white;
    }
    table
    {
    color:  #33b5e5;
    border-collapse: collapse;
    width: 50%;
    margin:1%;
    margin-bottom:3%;
    }
    th, td 
    {
    color:  #33b5e5;
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    }
    tr:hover{
        background-color:#f5f5f5;
    }
</style>
</head>
<body>
   <div class="container-fluid abc">
       <h2 class="website-name" style="color: #33b5e5;"><a href="index.html">IOT Mumbai</a></h2>
   </div>
   
<p style="color: #33b5e5; margin-top:1%; margin-left:1%; font-size:18px;">
Inventory Selected : <?php if(!empty($_GET["fname"]))
{
    echo $_GET["fname"];
}  ?><br></p>
<?php

$wrh="";
if(!empty($_GET["fname"]))
{
    $wrh=$_GET["fname"];
}

///////Creds//////
$servername = "localhost";
$username = "id638125_teamiotmumbai";
$password = "MumbaiIOT";
$dbname = "id638125_databaseiot";
/////////////getting all elements////////

$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$str1="SELECT * FROM ";
$str2=$str1.$wrh;
//echo $str2;      // This is the query 
$result = mysqli_query($con, $str1.$wrh);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}


echo "<table><tr><th>Product</th><th>Quantity</th></tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	//echo "<td>" . $row['Product_name'] . "</td>";
	
    echo "<td><a href=\"recom.php?product=".$row['Product_name']."\">".$row['Product_name']." </a></td>";
	echo "<td>" . $row['Qt'] . "</td>"; // Change link
	// <a href="https://www.youtube.com"> abc </a>
	echo "</tr>";
}

echo "</table>";
mysqli_close($con);
echo "<br>";
?>
<button type=button><a href="AddInv.php">Add Products</a></button>
</body>
</html>


