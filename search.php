<style>
h1 {
    color: white;
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
</style>


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
echo "<h1 align='center'>::::S E A R C H::::</h1><br/><hr/>";

?>

<!DOCTYPE html>
<html>
	<head>
  <title>Time Sharing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
</head>
	<body>
	<form method="POST" action="search.php" class="form-group has-success">
		<table>
	<tr>
		<td>Location:</td>
		<td><input type='text' name='location' id='location'/></td>
		<td>Priority: 
			<select name='location_id' id='location_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>Bid Starts:</td>
		<td><input type='text' name='bid_start' id='bid_start'/></td>
		<td>Priority: 
			<select name='bid_start_id' id='bid_start_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Space:</td>
		<td><input type='text' name='space' id='space'/>SQFT</td>
		<td>Priority: 
			<select name='space_id' id='space_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>#Floors:</td>
		<td><input type='text' name='floors' id='floors'/></td>
		<td>Priority: 
			<select name='floor_id' id='floor_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>#Bathroom:</td>
		<td><input type='text' name='bathroom' id='bathroom'/></td>
		<td>Priority: 
			<select name='bathroom_id' id='bathroom_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Furnished:</td>
		<td><input type='text' name='furnished' id='furnished'/></td>
		<td>Priority: 
			<select name='furnished_id' id='furnished_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Parking:</td>
		<td><input type='text' name='parking' id='parking'/></td>
		<td>Priority: 
			<select name='parking_id' id='parking_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Servant:</td>
		<td><input type='text' name='servant' id='servant'/></td>
		<td>Priority: 
			<select name='servant_id' id='servant_id'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			</select>
		</td>
	</tr>
	
		</table>
		<input type='submit' name='submit' value='Search'  class="btn btn-info"/>
		<form method="POST" action="user.php">
		
		<?php
			if( isset($_POST['submit']) )  {
				//print_r($_POST);
				$loc = $bid = $spc = $flr = $bth = $frn = $prk = $srv = "";
				$cnt = 0;
				
				$q = 'select * from home';
				
				if($_POST['location'] != "") {
					$loc = ' Location='."'".$_POST['location']."'";
					if( $cnt != 0 ) $q = $q . ' and ' . $loc;
					else $q = $q . ' where ' . $loc;
					$cnt++;
				}
				if($_POST['bid_start'] != "") {
					$bid = ' bid_start<='.$_POST['bid_start'];
					if( $cnt != 0 ) $q = $q . ' and ' . $bid;
					else $q = $q . ' where ' . $bid;
					$cnt++;
				}
				if($_POST['space'] != "") {
					$spc = ' space<='.$_POST['space'];
					if( $cnt != 0 ) $q = $q . ' and ' . $spc;
					else $q = $q . ' where ' . $spc;
					$cnt++;
				}
				if($_POST['floors'] != "") {
					$flr = ' floors='.$_POST['floors'];
					if( $cnt != 0 ) $q = $q . ' and ' . $flr;
					else $q = $q . ' where ' . $flr;
					$cnt++;
				}
				if($_POST['bathroom'] != "") {
					$bth = ' bathroom>='.$_POST['bathroom'];
					if( $cnt != 0 ) $q = $q . ' and ' . $bth;
					else $q = $q . ' where ' . $bth;
					$cnt++;
				}
				if($_POST['furnished'] != "") {
					$frn = ' furnished='.$_POST['furnished'];
					if( $cnt != 0 ) $q = $q . ' and ' . $frn;
					else $q = $q . ' where ' . $frn;
					$cnt++;
				}
				if($_POST['parking'] != "") {
					$prk = ' parking='.$_POST['parking'];
					if( $cnt != 0 ) $q = $q . ' and ' . $prk;
					else $q = $q . ' where ' . $prk;
					$cnt++;
				}
				if($_POST['servant'] != "") {
					$srv = ' servant='.$_POST['servant'];
					if( $cnt != 0 ) $q = $q . ' and ' . $srv;
					else $q = $q . ' where ' . $srv;
					$cnt++;
				}
				
				//print($q);
				// if( $cnt != 0 ) $q = $q . ' where '.$loc.' and '.$bid.' and '.$spc.' and '.$flr
					// .' and '.$bth.' and '.$frn.' and '.$prk.' and '.$srv;
					//echo $q;
				$dd = mysql_query($q);
				if( mysql_num_rows($dd) > 0 ) {
					echo "<table class='table table-hover'>";
					echo "<th class='info'>ID</th><th class='info'>Name</th><th class='info'>Location</th><th class='info'>Address</th><th class='info'>Available_share</th><th class='info'>Default_price</th><th class='info'>space</th>";
					echo "<th class='info'>no_of_floor</th><th class='info'>bathroom</th><th class='info'>description</th><th class='info'>furnished</th><th class='info'>parking</th><th class='info'>servant</th><th class='info'>user_id</th>";
					while($rr= mysql_fetch_assoc($dd)) {
						echo "<tr>";
						echo "<td>".$rr['ID']."</td>";
						echo "<td>".$rr['Name']."</td>";
						echo "<td>".$rr['Location']."</td>";
						echo "<td>".$rr['Address']."</td>";
						echo "<td>".$rr['Available_share']."</td>";
						echo "<td>".$rr['Default_price']."</td>";
						echo "<td>".$rr['space']."</td>";
						echo "<td>".$rr['no_of_floor']."</td>";
						echo "<td>".$rr['bathroom']."</td>";
						echo "<td>".$rr['description']."</td>";
						echo "<td>".$rr['furnished']."</td>";
						echo "<td>".$rr['parking']."</td>";
						echo "<td>".$rr['servant']."</td>";
						echo "<td>".$rr['user_id']."</td>";
						echo "</tr>";
						
					}
					echo "</table>";
				}
			}
		?>
	</body>
</html>