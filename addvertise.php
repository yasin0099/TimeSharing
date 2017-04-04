<!DOCTYPE html>
<html lang="en">
<head>
  <title>Time Sharing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
  <style>
h1 {
    color: white;
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
	
}
#a1 {
    width: 500px;
    height: 70px;
    padding: 15px;
    background-color: #CCF5FF;
    box-shadow: 10px 10px;	
}
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}
</style>
</head>

<?php
	require_once("session.php");

if($_SESSION["type"]!="user")
{
	header('Location: index.php');
}

$con = mysql_connect("localhost","root","");
if(!$con)
	die("Could not connect to DB");
mysql_select_db("dwdm_project",$con);
echo "<div class='pull-right'><a href='user.php' class='btn btn-default btn-sm active'>Back</a> </div>";
echo "<h1 class='text-center'><div id='a1' class='span7 center' >::::A D V E R T I S I N G::::</div></h1><hr/>";

// ........................................
$q = "SELECT * FROM home";
$data = mysql_query($q);
//print_r($data);

$qq = 'select shopuser.name from shopuser, home where home.user_id=shopuser.id';
$dd = mysql_query($qq);
while($r= mysql_fetch_assoc($data)) {
	//print_r($r);
	/////////////////////////////////////////////
	
	$rr= mysql_fetch_assoc($dd);
		
		
	
	echo "<div class='panel panel-info'>";
	
	echo "<div class='panel-heading'><h3 class='panel-title'>".$r['Name']."<span class='badge' align='right' style='color:yellow'>".$rr['name']."</span>"."</h3></div>";
	echo "<div class='panel-body'>";
	echo "Location: " . $r['Location'];
	echo "<br/>";
	echo "Address: ". $r['Address'];
	echo "<br/>";
	echo "Available Share: ". $r['Available_share'];
	echo "<br/>";
	echo "Price: ". $r['Default_price'];
	echo "<br/>";
	echo "Space: ". $r['space'] . " SQFT";
	echo "<br/>";
	echo "Floor: ". $r['no_of_floor'];
	echo "<br/>";
	echo "Bathroom: ". $r['bathroom'];
	echo "<br/>";
	echo "Description: ". $r['description'];
	echo "<br/>";
	echo "Furnished: ". $r['furnished'];
	echo "<br/>";
	echo "Parking: ". $r['parking'];
	echo "<br/>";
	echo "Servant: ". $r['servant'];
	echo "</div>";
	echo"</div>";
	
	
}



?>