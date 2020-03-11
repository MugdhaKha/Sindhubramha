<?php

session_start();

class Login{
	private $con;
	function __construct(){

			require_once 'includes/DbConnect.php';

			$db=new DbConnect();

			$this->con=$db->connect();
			$this->login($_POST['Name'],$_POST['Password']);
	}

	function login($name,$password){

		$password=md5($password);
		$sql="SELECT id FROM `operator` WHERE name='".$name."' AND password='".$password."'";
		$result=mysqli_query($this->con,$sql);
		$value=mysqli_fetch_object($result);
		if(mysqli_num_rows($result)==1){
			
			$_SESSION['opid']=$value->id;
			header("Location: addParticipant.php"); /* Redirect browser */
		}else{
			 $msg= "Invalid Name or Password";
			 echo "<script type='text/javascript'>alert('".$msg."');</script>";
		}

	}
}


if($_SERVER['REQUEST_METHOD']=='POST')
	$abcd=new Login();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
  	<title>SindhuBrahma 2018</title>
  	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
  .w3-card-4{
  	  background: linear-gradient(to right, #ff4000 , #ffbf00);
  	  border-radius: 25px;
  	  text-align: center;
      align-items: center;
  }
  .btn-default{
  	  background-color: #ffffff;
  	  color: #000000 !important;
  }
  .grad{
  	background-image: -webkit-linear-gradient(left, #ff0000, #ffbf00); /* For Chrome and Safari */
    background-image:    -moz-linear-gradient(left, #ff0000, #ffbf00); /* For old Fx (3.6 to 15) */
    background-image:     -ms-linear-gradient(left, #ff0000, #ffbf00); /* For pre-releases of IE 10*/
    background-image:      -o-linear-gradient(left, #ff0000, #ffbf00); /* For old Opera (11.1 to 12.0) */
    background-image:         linear-gradient(to right, #ff0000, #ffbf00); /* Standard syntax; must be last */
    color:transparent;
    -webkit-background-clip: text;
    background-clip: text;
  }
</style>

</head>
<body id="myPage" data-offset="60">
<div class="row" align="center">
	<br>
<h1 align="center" class="grad">SindhuBramha 2018</h1>
</div>
<div class="row" align="center">
<br><br><br>
	<div class="col-md-4"></div>
		<div class="center">
			<div class="col-md-4">
				<div class="w3-container" align:"center">
					<div class="w3-card-4" align="center">
					<br><br>
					<div class="w3-container w3-center">
					<div class="col-lg-3"></div>
					<img class="img-responsive" src="logo.jpg" height="150px" width="150px" align="center" /><br><br>
					<form class="form-inline" action="index.php" method="post">
					<div class="form-group has-feedback">
					<input type="text" name="Name" class="form-control" placeholder="Enter username" style="width:300px">
					<i class="glyphicon glyphicon-user form-control-feedback"></i>
					</div><br><br>
					<div class="form-group has-feedback">
					<input type="password" class="form-control" name="Password" placeholder="Enter password" style="width:300px">
					<i class="glyphicon glyphicon-lock form-control-feedback"></i>
					</div><br><br>
					<button class="btn btn-default" type="submit" style="width:300px">Submit</button>
					</form>
					<br><br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>