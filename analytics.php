<?php
////////////////////////////////////// initialise sql variables/////////////////////////////////


$last_id=0;
$id=0;
$day=0; $month=0; $day2=0;
$i=0;$data=0;
$timel=0;
//$dayprev=-1;

$today = array();
$ttime = array();
$yest  = array();
$ytime = array();
///////////////////////////////////////http variables//////////////
$col="";
$bool=true;
if(!empty($_GET["y"])) ////Important
{ 
  $col=$_GET["y"];
}
switch ($col) {
	case "temperature1":
		echo "Showing Temperature analytics for Room1";
		$col="se1";
		break;
	
	case "humidity":
		echo "Showing Humidity analytics";
		$col="se2";
		break;
        case "temperature2":
		echo "Showing Temperature analytics for Room 3";
		$col="se3";
		break;
	
	default:
		echo "<center>";
		$bool=false;
		echo "<br> <a href=\"http://orion-racing.com/private/Website/BEproject/analytics.php?y=humidity\"> Click here for Humidity </a>";
        echo "<br> <a href=\"http://orion-racing.com/private/Website/BEproject/analytics.php?y=temperature1\"> Click here for Temperature in Room 1</a>";
        echo"<br>";
echo "<br> <a href=\"http://orion-racing.com/private/Website/BEproject/analytics.php?y=temperature2\"> Click here for Temperature in Room 3</a>";
        echo"<br>";
		break;
}
/////////////////////////////////// getting last ID////////////////////////////////
// Create connection
if($bool==true)
{
include('connect.php');
$sql= "SELECT MAX(id) FROM sensw";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
///////////////////////////get date data associated to id no///////////////////////////////////////////////////

$id=$last_id;
//echo $id;
//echo "<br>";
$sql = "SELECT * FROM sensw";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$id)
      { 
        $day=$row["date1"];
      }
     
    }
}

else 
{
    echo "0 results for date";
}
echo "we got ";
$day2=$day;
echo $day;
echo" ";
$month=$day%100;
$day=($day-$month)/100;
echo "The date is ";
echo $day;
echo " ";
echo "The month is ";
echo $month;
echo "<br>";
echo "The yesterday's date is ";
echo $day-1;
echo "<br>";
///////////////////////////get sensor data associated to id no///////////////////////////////////////////////////

$id=$last_id;
$i=0;
$sql = "SELECT time1, ".$col." FROM sensw WHERE date1 = $day2";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
    	
    		$today[$i]=$row[$col];
    		$ttime[$i]=$row["time1"];
    		$i++;
    		
       }
}

else 
{
    echo " 0 results for array ";
    echo $sql;
}

echo "<br>";
echo " This is today ";
var_dump($today);
echo " ";
//var_dump($ttime);
echo " ";
echo "And the no. of elements is ";
$timel=sizeof($ttime);
echo $timel;

$day=$day-1;
$day2=$day*100+$month;
$i=0;
$sql = "SELECT time1, ".$col." FROM sensw WHERE date1 = $day2";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
    	
    		$yest[$i]=$row[$col];
    		$ytime[$i]=$row["time1"];
    		$i++;
    		
       }
}

else 
{
    echo " 0 results for array ";
    echo $sql;
}

echo "<br>";
echo "This is yesterday <br> ";
var_dump($yest);
echo "<br>";
var_dump($ytime);
echo "<br> <a href=\"http://jayantbenjamin.000webhostapp.com/SIEShack/Website/chart.php?y=humidity"> Click here for Humidity </a>";
echo "<br> <a href=\"http://jayantbenjamin.000webhostapp.com/SIEShack/Website/chart.php?y=temperature1"> Click here for Temperature in Room 1 </a>";
echo "<br> <a ="http://jayantbenjamin.000webhostapp.com/SIEShack/Website/chart.php?y=temperature2"> Click here for Temperature in Room 3 </a>";
echo "<br>";
echo "<br>";
}
?>

<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Time of Day');
      data.addColumn('number', <?php $day =$day+1; echo "'".$day."/".$month."'" ?>);
      data.addColumn('number', <?php $day =$day-1; echo "'".$day."/".$month."'" ?>);
    

      data.addRows([
        <?php
        $i=0;
        for ($i=0;$i<$timel;$i++) 
        {
            $ttime[$i]=$ttime[$i]/100;
            echo "[".$ttime[$i].", ".$today[$i].", ".$yest[$i]."],";   
        }
        
        ?>
        // [1,  37.8, 80.8],
        // [2,  30.9, 69.5],
        // [3,  25.4,   57],
        // [4,  11.7, 18.8],
        // [5,  11.9, 17.6],
        // [6,   8.8, 13.6],
        // [7,   7.6, 12.3],
        // [8,  12.3, 29.2],
        // [9,  16.9, 42.9],
        // [10,  16.9, 42.9],
        // [11,  16.9, 42.9],
        // [12,  16.9, 42.9],
        // [13,  16.9, 42.9],
        // [14,  16.9, 42.9],
        // [15,  16.9, 42.9],
        // [16,  16.9, 42.9],
        // [17,  16.9, 42.9],
        // [18,  16.9, 42.9],
        // [19,  16.9, 42.9],
        // [20,  16.9, 42.9],
        // [21,  16.9, 42.9],
        // [22,  16.9, 42.9],
        // [23,  16.9, 42.9],
        // [24,  16.9, 42.9],
       
      ]);


      var options = {
        chart: {
          title: 'Daily analysis',
          subtitle: 'from the wireless sensor IoT network'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
</head>
<body>
<br>
  <div id="line_top_x"></div>
</body>
</html>

