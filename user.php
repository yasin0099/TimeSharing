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

$id = '';
?>

<html>
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
<body>
<h1 class='text-center'><div id='a1' class='span7 center' >::::Welcome::::</div></h1>
<div class="pull-right"><a href="logout.php" class="btn btn-primary btn-sm active">Logout</a> </div>
<h3 ><a  href="addvertise.php" class="btn btn-warning">Advertise</a> </h3>
<h3 ><a  href="search.php" class="btn btn-info">Search</a> </h3>
<form method="POST" action="user.php">
<?php
$q = "SELECT * FROM shopuser WHERE name = '{$_SESSION["name"]}' ";
		$data = mysql_query($q);
		//print_r($data);
		while($r= mysql_fetch_assoc($data))
		{
			echo '<img src="uploads/'.$r["image"].'" width="120px" height="120px" /></td></tr></br>';
			echo '<h1>Hello '.$r["name"].'</h1></br>';
			echo 'Email: '.$r["email"].'</br>';
			//echo 'IDDDD:'.$r['id'];
			$id = $r['id'];
			if($r["verify"] == 1)
			{
				echo 'Verified';
			}
			else
				echo 'Not Verified';
		}

?>

<div id="result" align="center"></div><br><br>


<table>
	<tr>
		<td>Name:</td>
		<td><input type='text' name='name' id='name'/></td>
	</tr>
	<tr>
		<td>Location:</td>
		<td><input type='text' name='location' id='location'/></td>
	</tr>
	<tr>
		<td>Address:</td>
		<td><input type='text' name='address' id='address'/></td>
	</tr>
	<tr>
		<td>Bid Starts:</td>
		<td><input type='text' name='bid_start' id='bid_start'/></td>
	</tr>
	<tr>
		<td>Space:</td>
		<td><input type='text' name='space' id='space'/>SQFT</td>
	</tr>
	<tr>
		<td>#Floors:</td>
		<td><input type='text' name='floors' id='floors'/></td>
	</tr>
	<tr>
		<td>#Bathroom:</td>
		<td><input type='text' name='bathroom' id='bathroom'/></td>
	</tr>
	<tr>
		<td>Furnished:</td>
		<td><input type='text' name='furnished' id='furnished'/></td>
	</tr>
	<tr>
		<td>Parking:</td>
		<td><input type='text' name='parking' id='parking'/></td>
	</tr>
	<tr>
		<td>Servant:</td>
		<td><input type='text' name='servant' id='servant'/></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><input type='text' name='description' id='description'/></td>
	</tr>
</table>
<input type='submit' name='submit' value='Submit'/>
</form>

<?php
	if( isset($_POST['submit']) ) {
		//print_r($_POST);
		$q = "INSERT INTO `dwdm_project`.`home` (`ID`, `Name`, `Location`, 
		`Address`, `Available_share`, `Default_price`, `space`, `no_of_floor`, 
		`bathroom`, `description`, `furnished`, `parking`, `servant`, `user_id`)
		VALUES ('', '".$_POST['name']."', '".$_POST['location']."', '".$_POST['address']."',
		'100', '".$_POST['bid_start']."', '".$_POST['space']."', '".$_POST['floors']."', 
		'".$_POST['bathroom']."', '".$_POST['description']."', '".$_POST['furnished']."', 
		'".$_POST['parking']."', '".$_POST['servant']."', '".$id."');";
		$data = mysql_query($q);
	}
?>

</body>
</html>
        