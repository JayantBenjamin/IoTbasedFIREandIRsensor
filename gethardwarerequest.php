<?php
$today = date("d/m/Y");
$html="";
//echo $today;
//echo "<br> time code <br>";
$day=($today[0]-'0')*10+($today[1]-'0');
$month=($today[3]-'0')*10+($today[4]-'0');
$year=($today[6]-'0')*1000+($today[7]-'0')*100+($today[8]-'0')*10+($today[9]-'0');
//echo "GMT date is ".$day."/".$month."/".$year."<br>";
$t=time();
//echo($t . "<br>");
//echo(date("Y-m-d",$t));
//echo "<br> gmdate <br>";
$time=(gmdate("H:i:s", $t));
//echo "<br> ".$time."<br>";
$hr=($time[0]-'0')*10+($time[1]-'0');
$min=($time[3]-'0')*10+($time[4]-'0');
$sec=($time[6]-'0')*10+($time[7]-'0');
//echo "GMT time is ".$hr.":".$min.":".$sec."<br>";
$min=$min+30;
if($min>60)
{
    $min=$min-60;
    $hr=$hr+1;
}
$hr=$hr+5;
if($hr>=24)
{
    $hr=$hr-24;
    $day=$day+1;
}
//echo "Added 5:30 hence ";
switch ($month) {
    case '1':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
    case '2':
        if($year%4==0)
        {
            if($day>29)
            {
                $day=$day-29;
                $month++;
            }
        }
        else
        {
            if($day>28)
            {
                $day=$day-28;
                $month++;
            }
        }
        break;
        case '3':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
        case '4':
        if($day>30)
        {
            $day=$day-30;
            $month++;
        }
        break;
        case '5':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
        case '6':
        if($day>30)
        {
            $day=$day-30;
            $month++;
        }
        break;
        case '7':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
        case '8':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
        case '9':
        if($day>30)
        {
            $day=$day-30;
            $month++;
        }
        break;
        case '10':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;
        case '11':
        if($day>30)
        {
            $day=$day-30;
            $month++;
        }
        break;
        case '12':
        if($day>31)
        {
            $day=$day-31;
            $month++;
        }
        break;

    
    default:
        echo "server date error";
        break;
}
?>
<?php
$date2=$day*100+$month;
$time2=$hr*100+$min;
$update1=false;
$update2=false;
$update3=false;

//////////////////////////////////////////////Sensor Get Requests ////////////////////////////////////
echo "t1,h,t2,f,p <br>";
$temp1=0;$hum=0;$fire=0; $temp2=0;$pir=0;
if(!empty($_GET["t1"]))
{
$temp1=$_GET["t1"];
$update1=true;
}
if(!empty($_GET["h"]))
{
$hum=$_GET["h"];
$update1=true;
}
if(!empty($_GET["f"]))
{
$fire=$_GET["f"];
$update2=true;
if($fire==1)
 {
     echo "Hey fire?";
$html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/Mail/mail2.php');
 
 $html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/Website/floorlayout2.php?switch=3&state=1');
 
//$html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/SendAlertMsg.php?a=1');         
 }
}
if(!empty($_GET["t2"]))
{
$temp2=$_GET["t2"];
$update1=true;

}
if(!empty($_GET["p"]))
{
 $pir=$_GET["p"];
 $update3=true;
 if($pir==1)
 {
     echo "Hey IR?";
     $html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/Mail/mail3.php');
 
 $html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/Website/floorlayout2.php?switch=4&state=0');
 //$html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/SendAlertMsg.php?a=2');    
     
 }
 
}

//echo"<br>z ".$temp1." ".$hum." ".$fire." ".$temp2." ".$pir;
////////////////////////////////////// initialise sql variables/////////////////////////////////

$last_id=0;
//////////////////////////////////////   Create connection

// $sql= "SELECT MAX(id) FROM sensw";
// $result = $conn->query($sql);
// $max_public_id = mysqli_fetch_row($result);
// $last_id = $max_public_id[0];
///////////////////////////get date data associated to id no///////////////////////////////////////////////////

// $sql = "SELECT * FROM sensw";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) 
// {
//     // output data of each row
//     while($row = $result->fetch_assoc()) 
//     {
//       if($row["id"]==$last_id)
//       { 
//         $se1=$row["se1"];
//         $se2=$row["se2"];
//         $se3=$row["se3"];
//         $se4=$row["se4"];
//         $se5=$row["se5"];
//         $time=$row["time1"];
//         $date=$row["date1"];
//       }
     
//     }
// }

// else 
// {
//     echo "0 results for date";
// }
//////////new connection///////////////////
// Check connection
include('connect.php');

///////////////////////////////////////////////////// update sensors //////////////////////////////////////////
$se1=$temp1;
$se2=$hum;
$se3=$temp2;

 $sql = "INSERT INTO sensw (date1, time1, se1, se2, se3)
                    VALUES ($date2, $time2, $se1, $se2, $se3)";

if($update1==true)
{
   
   if ($conn->query($sql) === TRUE) 
    {
      
      echo "OK";
      echo "<br>";
      echo $se1." ".$se2." ".$se3;
      echo "<br>";
      echo "Date: ".$day."/".$month." Time: ".$hr.":".$min;

    } 
    else 
    {
    echo "<br>";
    echo "Error updating record: " . $conn->error;
    }

   
}

if($update2==true)
{
   $sql = "INSERT INTO fire (date1, time1, fire)
                    VALUES ($date2, $time2,$fire)";
   if ($conn->query($sql) === TRUE) 
    {
      echo "<br>";
      echo "OK";
      echo "<br>";
      echo "f=".$fire;
      echo "<br>";
      echo "Date: ".$day."/".$month." Time: ".$hr.":".$min;
        ////////////////////////////mail/
        $html = file_get_contents('http://jayantbenjamin.000webhostapp.com/SIEShack/Mail/mail2.php');
        //echo $html;
    } 
    else 
    {
    echo "<br>";
    echo "Error updating record: " . $conn->error;
    }

   
}
if($update3==true)
{
   $sql = "INSERT INTO pir (date1, time1, pir)
                    VALUES ($date2, $time2,$pir)";
   if ($conn->query($sql) === TRUE) 
    {
      echo "<br>";
      echo "OK";
      echo "<br>";
      echo "p=".$pir;
      echo "<br>";
      echo "Date: ".$day."/".$month." Time: ".$hr.":".$min;
        ////////////////////////////mail/
        
    } 
    else 
    {
    echo "<br>";
    echo "Error updating record: " . $conn->error;
    }

   
}

 $conn->close(); 
 $update1=false;  
$update2=false;
$update3=false; 
?>