<html>

 <head>
<!-- Favicon-->
 <link rel="icon" href="website_favicon.ico" type="image/png" sizes="16x16">
<!-- Favicon end -->
        <title></title>

        <style>

body {

padding-top: 50px;

}

.thumbnail {

position:relative;

overflow:hidden;

}

.caption {

position:absolute;

top:-100%;

right:0;

background:rgba(66, 139, 202, 0.75);

width:100%;

height:100%;

padding:2%;

text-align:center;

color:#fff !important;

z-index:2;

-webkit-transition: all 0.5s ease-in-out;

-moz-transition: all 0.5s ease-in-out;

-o-transition: all 0.5s ease-in-out;

-ms-transition: all 0.5s ease-in-out;

transition: all 0.5s ease-in-out;

}

.thumbnail:hover .caption {

top:0%;

}

.container {

border: 3px solid;

border-radius: 10px;

margin-top: 15px;

margin-bottom: 15px;

padding-top: 50px;

}

.mycenter{

text-align: center;

}

</style>

        

        <!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!-- Optional theme -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>

    

    <body>

        


            <div class="container">

                    <div><h1 class="mycenter">Floor Plan</h1></div><br>

                      <div class="row">

                          <div class="col-xs-4 col-sm-4 col-md-4"> 

                              <div class="thumbnail">

                                  <div class="caption">

                                      <h4>Warehouse</h4>

                                      <p>Click here for analytics</p>

                                      

                                  </div>

                                  <img src="https://dummyimage.com/500x650/a3a3a3/a3a3a3.png" alt="..."> <!--500x650 placeholder-->

                              </div>

                          </div>

                        

                          <div class="col-xs-4 col-sm-4 col-md-4"> 

                              <div class="thumbnail">

                                  <div class="caption">

                                      <h4>Room 1</h4>

                                      <p>Click here for analytics</p>

                                      <p><a href="floorlayout2.php?switch=1&state=1" class="label label-danger">ON</a>

                                      <a href="floorlayout2.php?switch=1&state=0" class="label label-default">OFF</a></p>

                                  </div>

                                  <img src="https://dummyimage.com/500x200/a3a3a3/a3a3a3.png" alt="..."><!--500x200 placeholder-->

                              </div>

                              <br>

                              <br>

                              <br>

                              <br>

                              <br>

                              <br>

                              <br>

                              <div class="thumbnail">

                                <div class="caption">

                                    <h4>Room 4</h4>

                                    

                                    <p><a href="floorlayout2.php?switch=4&state=1" class="label label-danger">ON</a>

                                    <a href="floorlayout2.php?switch=4&state=0" class="label label-default">OFF</a></p>

                                </div>

                                <img src="https://dummyimage.com/500x200/a3a3a3/a3a3a3.png" alt="..."><!--500x200 placeholder-->


                            </div>

                          </div>

                  

                          <div class="col-xs-4 col-sm-4 col-md-4"> 

                             

                            <div class="thumbnail">

                                  <div class="caption">

                                      <h4>Room 2</h4>

                                      
                                      <p><a href="floorlayout2.php?switch=2&state=1" class="label label-danger">ON</a>

                                      <a href="floorlayout2.php?switch=2&state=0" class="label label-default">OFF</a></p>

                                  </div>

                                  <img src="https://dummyimage.com/500x300/a3a3a3/a3a3a3.png" alt="..."><!--500x300 placeholder-->


                              </div>

                              <div class="thumbnail">

                                <div class="caption">

                                    <h4>Room 3</h4>

                                    <p>Click here for analytics</p>

                                    <p><a href="floorlayout2.php?switch=3&state=1" class="label label-danger">ON</a>

                                    <a href="floorlayout2.php?switch=3&state=0" class="label label-default">OFF</a></p>

                                </div>

                                <img src="https://dummyimage.com/500x300/a3a3a3/a3a3a3.png" alt="..."><!--500x300 placeholder-->

                            </div> 

                          </div>

                        </div>

                        

                    

                    

                </div><!-- /.container -->

    </body>


</html>


<?php
////////////////////////////////////// initialise sql variables/////////////////////////////////
include('connect.php');

///////////////////////////////////////variables //////////////

$id=0;
$s1=0; $ls1=0; $switchno=0;
$s2=0; $ls2=0; $stateno=0;
$s3=0; $ls3=0;
$s4=0; $ls4=0;
$s5=0; $ls5=0;

$switch=0;
$state=0;
$last_id=0;
$id=0;
$update=false; //to check if get request has been made

////////////////////////// getting last ID////////////////////////////////////////

$sql= "SELECT MAX(id) FROM sw";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
$conn->close();
echo "<br>";
echo "Last entry was ";
echo $last_id;


///////////////////////////get data associated to id no///////////////////////////////////////////////////
// Create connection
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


echo"<p>php running started</p>";
if (isset($_GET['switch'])) //$_SERVER['REQUEST_METHOD'] === 'GET' 
{
    $update=true;
    echo"<br>";
    echo"for switch ";
    echo $_GET["switch"];
    $switchno=$_GET["switch"];

    echo" entered values is ";
    echo $_GET["state"]; 
    $stateno=$_GET["state"];

}
else
{
$update=false;
}
$s1= $ls1;
$s2= $ls2;
$s3=$ls3;
$s4=$ls4;
$s5=$ls5;


if($update==true)
{
 echo "<br>";
 echo"updating switch ";
 echo $switchno;
 echo " with ";
 echo $stateno;

 switch ($switchno) {
    case 1:
        $s1=$stateno;
        break;
    case 2:
        $s2=$stateno;
        break;
    case 3:
        $s3=$stateno;
        break;
    case 4:
        $s4=$stateno;
        break;
    case 5:
        $s5=$stateno;
        break;
    case 6:
        $s1=$s2=$s3=$s4=$s5=$stateno;
    }

 // Create a new connection
 $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO sw (sw1, sw2, sw3, sw4, sw5)
                          VALUES ($s1, $s2, $s3, $s4, $s5 )";

    if ($conn->query($sql) === TRUE) 
    {
      echo "<br>";
      echo "Record updated successfully";
    } 
    else 
    {
    echo "<br>";
    echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
