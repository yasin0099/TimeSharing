<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
</head>
<div class="pull-right"><a href="logout.php" class="btn btn-default btn-sm active">Logout</a> </div>



<?php
require_once("session.php");
if($_SESSION["type"]!="admin")
{
	header('Location: index.php');
}

$con = mysql_connect("localhost","root","");
if(!$con)
	die("Could not connect to DB");
mysql_select_db("dwdm_project",$con);
	if(isset($_POST["verify"]))
	{
		$name= $_POST["na"];
		$q1="UPDATE  `dwdm_project`.`shopuser` SET  `verify` =  '1' WHERE  `shopuser`.`name` =  '$name';";
		mysql_query($q1);
	}
	if(isset($_POST["remove"]))
	{
		$name= trim($_POST["na"]);
		$q2= "DELETE FROM `dwdm_project`.`shopuser` WHERE `shopuser`.`name` ='$name'; ";
		mysql_query($q2);
	}

?>

<html>
<head>

</head>
<body>
<h1 align="center">Home</font></h1>
<form method="POST" action="admin.php">
<?php


$q = "SELECT * FROM admin WHERE uname = '{$_SESSION["name"]}' ";
		$data = mysql_query($q);
		while($r= mysql_fetch_assoc($data))
		{
			echo '<h1>Hello '.$r["uname"].'</h1></br>';
		}

$q = "SELECT * FROM shopuser";
		$data = mysql_query($q);
		while($r= mysql_fetch_assoc($data))
		{
			if($r["verify"]=='0')
			{
?>
			<input type="text" name="na" value="<?=$r["name"]?>" />
			<?php
			
			echo 'Email: '.$r["email"].'</br>';
			echo '<img src="uploads/'.$r["image"].'" width="120px" height="120px" class="img-thumbnail" /></td></tr></br>';
			
			?>
			<input type="submit" class="btn btn-success btn-xs"  name="verify" value="APPROVE" />
			<input type="submit" class="btn btn-danger btn-xs" name="remove" value="DELETE" /><hr>
<?php	
			}
		}

?>

<div id="result" align="center"></div><br><br>

</form>
</body>
</html>
        