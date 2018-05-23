<?php
include('connect.php');

///////////////////////////////////////variables //////////////
$last_id=0;
$id=0;

$ls1=$ls2=$ls3=$ls4=$ls5=0;

////////////////////////// getting last ID////////////////////////////////////////

$sql= "SELECT MAX(id) FROM sensw";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
$conn->close();

///////////////////////////get data associated to id no///////////////////////////////////////////////////


$id=$last_id;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM sensw";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        
        $ls1=$row["se1"];
        $ls2=$row["se2"];
        $ls3=$row["se3"];
        
      }
     
    }
}

else 
{
    echo "0 results";
}
$sql= "SELECT MAX(id) FROM sw";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];


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
        
        $lsw1=$row["sw1"];
        $lsw2=$row["sw2"];
        $lsw3=$row["sw3"];
        $lsw4=$row["sw4"];
        
      }
     
    }
}

else 
{
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Favicon-->
 <link rel="icon" href="website_favicon.ico" type="image/png" sizes="16x16">
<!-- Favicon end -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
           ['Label', 'Value'],
          ['Temperature', 80],
          ['Humidity', 55],
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IIOT PROJECT</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="form.html">IoT Admin Panel</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="#" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
        <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
          </li>
        
          
                    <li  >
                        <a  href="blank.html"><i class="fa fa-square-o fa-3x"></i> About the project</a>
                    </li> 		
					 <li  >
                        <a  href="form.html"><i class="fa fa-edit fa-3x"></i> Log in </a>
                    </li>       
                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="floorlayout2.php" target="_blank"><i class="fa fa-qrcode fa-3x"></i> Floor Layout</a>
                    </li>
               <li  >
                        <a href="chart.php"><i class="fa fa-bar-chart-o fa-3x"></i> Analytics</a>
                    </li> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2> 
                     <div class="text-box" > 
                        <h3 colour=black>Monitoring Parameters </h3>
                        <h5>Data procured from the online server 000webhost </h5>
                        </div> 
                        
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    
                    
               
                <div class="col-md-3 col-sm-6 col-xs-6">   
      <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-dashboard fa-x"></i>
                </span>
                <div class="text-box" >
               <p class="text-muted">Temperature Sensor Room1</p>
                    <p class="main-text"><?php echo $ls1;?></p>
                </div>
             </div>
         </div>
                  <div class="col-md-3 col-sm-6 col-xs-6">           
      <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-dashboard fa-x"></i>
                </span>
                <div class="text-box" >
                <p class="text-muted">Warehouse Humidity Sensor</p>
                    <p class="main-text"><?php echo $ls2;?></p>
        </div>
             </div>
         </div> 
                    <div class="col-md-3 col-sm-6 col-xs-6">           
      <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-dashboard fa-x"></i>
                </span>
                <div class="text-box" >
                 <p class="text-muted">Temperature Sensor Room3</p>
                    <p class="main-text"><?php echo $ls3;?></p>
                </div>
             </div>
         </div>
                   

      </div>
                 <!-- /. ROW  -->
                <hr />   
                 <H3>Switch Status</H3>          
                 <div class="col-md-3 col-sm-6 col-xs-6">   
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="glyphicon glyphicon-off"></i>
                </span>
                <div class="text-box" >
                <p class="text-muted">Switch 1</p>
                    <p class="main-text"><?php if($lsw1==0) {echo "LOW";} else echo"HIGH"; ?></p>
                </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="glyphicon glyphicon-off"></i>
                </span>
                <div class="text-box" >
                 <p class="text-muted">Switch 2</p>
                    <p class="main-text"><?php if($lsw2==0) {echo "LOW";} else echo"HIGH"; ?></p>
                   </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="glyphicon glyphicon-off"></i>
                </span>
                <div class="text-box" >
                <p class="text-muted">Switch 3</p>
                    <p class="main-text"><?php if($lsw3==0) {echo "LOW";} else echo"HIGH"; ?></p>
                </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="glyphicon glyphicon-off"></i>
                </span>
                <div class="text-box" >
                <p class="text-muted">Switch 4</p>
                    <p class="main-text"><?php if($lsw4==0) {echo "LOW";} else echo"HIGH"; ?></p>
                </div>
             </div>
             <div class="text-box" >
                <!-- <p class="text-muted">Shift to Smart Inventory Recommendations 👉🏻</p>
                    <p class="main-text"><a href="http://jayantbenjamin.000webhostapp.com/SIEShack/recommendation">Recommendations Interface</a></p> -->
                </div>
             </div>
             
              

            </div>
                 <!-- /. ROW  -->
                <hr />  


               
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
