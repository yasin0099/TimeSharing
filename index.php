<!DOCTYPE html>
<html lang="en">
<head>
  <title>Time Sharing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <style>
  #a1 {
    text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
	
}
  </style
</head>
<h1 id="a1" align="center">Time sharing</h1>

<?php require_once("session.php");?>


<?php
	$error=0;
	
	//$_SESSION['i']=4;
	if($error==0)
	{
		if(isset($_POST["rsubmit"]))
		{	
			$uname=mysql_real_escape_string(trim($_POST["uname"]));
			$pass=mysql_real_escape_string(trim($_POST["pass"]));
			$email=mysql_real_escape_string(trim($_POST["email"]));
			$pic= mysql_real_escape_string(trim($_FILES["pix"]["name"]));
			
			//$pic_type=explode("/",($_FILES['pix']['type']));
			$t=time().".png";
			if(move_uploaded_file($_FILES["pix"]["tmp_name"], "uploads/".$t))
			$con = mysql_connect('localhost','root','');
			if(!$con)
				die("Could not connect to Database");
			mysql_select_db("dwdm_project",$con);
			$q = "INSERT INTO shopuser  VALUES ('$uname','$pass','$email','$t','0','$_SESSION[i]')";
			$_SESSION['i']=$_SESSION['i']+1;
			mysql_query($q);
					echo "<div class='alert alert-success' role='alert'><h1> Registration Successful </h1></div>";
	
		}
	}
				else echo "<h1> Registration unsuccessful </h1>";
	
	if(isset($_POST["lsubmit"]))
	{
	
		$name=trim($_POST["name"]);
		$pass=trim($_POST["loginpass"]);
		$con = mysql_connect('localhost','root','');
	
		if(!$con)
			die("Could not connect to Database");
	
		mysql_select_db("dwdm_project",$con) or die("cannot select DB");
	
	
		$q= "SELECT * FROM admin WHERE uname='$name' AND password='$pass'";
		$r= "SELECT * FROM shopuser WHERE name='$name' AND password='$pass' AND verify=1";
		$rs = mysql_query($q);
		$sr = mysql_query($r);
	
		if( mysql_num_rows($rs) == 1)
		{
			$_SESSION["type"]="admin";
			$_SESSION["name"] = $name;
			header('Location: admin.php');
		}
		
		else if( mysql_num_rows($sr) == 1)
		{
			$_SESSION["type"]="user";
			$_SESSION["name"] = $name;
			header('Location: user.php');
		}
		
		else 
		{
			echo "<div class='alert alert-warning alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Warning!</strong> Wrong Name or Password.</div> ";
		}
}

?>

<script type="text/javascript">

	function validateform()
	{
		var x=document.getElementById("uname").value;
		var y=document.getElementById("pass").value;
		if(x==null || x=="")
		{
			document.getElementById("uerror").innerHTML="<div>Username can not be left blank</div>";
			<?php $error=1; ?>
			return false;
		}
		else if(x.length<6)
		{
			document.getElementById("uerror").innerHTML="<div>Username must be at least 6 digits</div>";
			<?php $error=1; ?>
			return false;
		}
		else
		{
			document.getElementById("uerror").innerHTML="";
			<?php $error=0; ?>
		}
		
		if(y.length<4)
		{
			document.getElementById("perror").innerHTML="<span>Password Strength:</span><span> Weak</span>";
			<?php $error=1; ?>
			return false;
		}
		else(y.length>8 && y.search(/[A-Z]/) >= 0 && y.search(/[0-9]/) >=0)
		{
			document.getElementById("perror").innerHTML="<span>Password Strength:</span><span> Strong</span>";
			<?php $error=0; ?>
			return true;
		}
		
		var x=document.getElementById("email").value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			document.getElementById("eerror").innerHTML="<div>Invalid Email Address</div>";
			<?php $error=1; ?>
			return false;
		}
		else 
		{
			document.getElementById("eerror").innerHTML="<div>Valid email</div>";
			<?php $error=0; ?>
			return true;
		}
	}
	
	  function ValidateFileUpload() {
        var fuData = document.getElementById('pic');
        var FileUploadPath = fuData.value;

        if (FileUploadPath == '') {
	alert("Please upload an image");
	<?php $error=1; ?>
	return false;
        } else {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

	if (Extension == "png" || Extension == "jpg") 
	{
			if (fuData.files && fuData.files[0]) 
			{
				var reader = new FileReader();
				reader.onload = function(e)
				{
					$('#blah').attr('src', e.target.result);
				}
				reader.readAsDataURL(fuData.files[0]);
			}
		<?php $error=0; ?>
		return true;
            } 

	else {
               
	       alert("Photo only allows file types of  PNG And JPG.");
	       <?php $error=1; ?>
		return false;
            }
        }
    }

</script>
<style type="text/css">
  body { background: #F8FDFF; }
  #a2:hover{
	  background: #5cb85c;
  }
  
</style>

<div>
<form class="form-signin" action="index.php" method="post" enctype="multipart/form-data">
<table align="center">
<h1 align="center">User Sign Up </h1>
<tr>
<td> Name: </td><td><input class="form-control" type="text" id="uname" name="uname" onkeyup="return validateform()" /></td><td id="uerror"> </td></tr>
<tr>
<td>Password: </td><td><input class="form-control" type="password" id="pass" name="pass" onkeyup="return validateform()"/> </td> <td id="perror"> </td></tr>
<tr>
<td>E-mail: </td><td><input class="form-control" type="text" name="email" id="email" onkeyup="return validateform()" onclick="return validatename()" /></td><td id="eerror"> </td></tr>
<tr>
<td>Picture: </td> <td> <input class="form-control" type="file" name="pix" id="pic" onchange="return ValidateFileUpload()"/> </td> </tr> 
<tr>
<td></td><td><input class="btn btn-primary  " value="Register" type="submit" name="rsubmit" onclick="return validateform();return ValidateFileUpload()" id="a2" />
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Login</button></td>
</tr>
</table>
</div>
<hr>

<div class="container"align="center">
    <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
          <table align="center">

<tr>
<td> <input class="form-control" type="text" name="name" placeholder="Name"/></td></tr>
<tr>
<td><input class="form-control" type="password" name="loginpass" placeholder="Password" /></td></tr>
<tr>
<td> <input class="btn btn-primary btn-md btn-block" type="submit" name="lsubmit" value="Login"/> </td></tr>
</table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>




</form>

