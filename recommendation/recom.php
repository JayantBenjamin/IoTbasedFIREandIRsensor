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
    .qwe{
        margin:1%;
        font-size:15px;
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
       <h2 class="website-name" style="color: #33b5e5;"><a href="index.html">IOT Mumbai</a></h2>
   </div>
    <div class="qwe">
<?php
$i=0;
 echo "Product Selected: ";
 $product=$_GET["product"];
 echo $product; 
 echo "<br>";
 echo "<br>";
 echo "Online Recommendations: ";
 $str="https://dir.indiamart.com/search.mp?ss=";
 $str1=$str.$product;
 $html = file_get_contents($str1);
 $string="/\w+(:\/\/www.indiamart.com\/proddetail)\/[a-zA-Z0-9_%+-]*.html/";
 preg_match_all($string, $html, $matches);
//preg_match("/\w+(:\/\/www.amazon.in).*[0-9A-Za-z=]/", $input, $matches );
$c = count($matches[0]);
$f=0;
$f = (($c+1)/2);
settype($f, "integer");
echo $f;
echo "<br>";
echo "<br>";
for($i=1;$i<$c+1;$i++)
{
  //$j=$i+1;
  echo "Option ";
  echo "<button><a href=\"".$matches[0][$i]."> View"."</a></button>";
  echo "<br>";
  echo "<br>";
}
?>
 </div>
</body>
</html>