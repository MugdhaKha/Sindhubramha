<?php

session_start();

class Register{

  private $con;

  function __construct(){
    require_once 'includes/DbConnect.php';

      $db=new DbConnect();

      $this->con=$db->connect();
  }

  function addParticipant($fname,$mname,$lname,$village,$taluka,$district,$state,$gender,$opid){
    $stmt=$this->con->prepare("INSERT INTO `participant` (`fname`, `mname`, `lname`, `village`, `taluka`, `district`,`state`, `gender`, `regtime`, `Opid`) VALUES (?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP, ?)");

      $stmt->bind_param("ssssssssi",$fname,$mname,$lname,$village,$taluka,$district,$state,$gender,$opid);
      $sql="SELECT pid FROM `participant` WHERE fname='".$fname."' AND mname='".$mname."' AND lname='".$lname."'";
      $result=mysqli_query($this->con,$sql);
      $value=mysqli_fetch_object($result);

      if($value==null){
        $stmt->execute();
        $result=mysqli_query($this->con,$sql);
        $value=mysqli_fetch_object($result);
        echo "<script type='text/javascript'>alert('Registration ID:- ".$value->pid."');</script>";
      /* $sql1="SET @num := 0;
        UPDATE `participant` SET `pid` = (@num+1);";
        echo $sql1;
        $result=mysqli_query($this->con,$sql1);
        echo $this->con->error;*/
      }else if($value->pid>0){
        echo "<script type='text/javascript'>alert(' Participant Exists at ID:- ".$value->pid."');</script>";
      }else{
        echo $this->con->error;
        exit;
      }
  }  
}
if($_SERVER['REQUEST_METHOD']=='POST'){

    $ua=new Register();
    if($_POST['gender']=="Select Gender"||$_POST['state']=="Select State"){

    }else{
    $ua->addParticipant($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['village'],$_POST['taluka'],$_POST['district'],$_POST['state'],$_POST['gender'],$_SESSION['opid']);
  }
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
  	<title>Sindhubramha 2018</title>
  	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	</head>

  	<style type="text/css">

  		.navbar{
  			background: linear-gradient(to right, #ff4000 , #ffbf00);
  			color: white;
  			padding: 3px;
  		}  		
  		li a {
  			color: white !important;
  		}
  		li a:hover {
  			background-color: #ff4000 !important;
  			color: black !important;
  		}
  		img {
  			margin-top: 8px;
  			color: white !important;
  		}
  		p {
  			margin-top: 4px;
  			padding: 4px;
  			font-size: 1.5em;
  		}
  		select{
  			background-color: white;
  			color: black;
  			border-radius: 5px;
  			border-color: grey;
  		}
  		.w3-card-4{
      background-image: -webkit-linear-gradient(left, #FD7B00, #FDCF00); /* For Chrome and Safari */
      background-image:    -moz-linear-gradient(left, #FD7B00, #FDCF00); /* For old Fx (3.6 to 15) */
      background-image:     -ms-linear-gradient(left, #FD7B00, #FDCF00); /* For pre-releases of IE 10*/
      background-image:      -o-linear-gradient(left, #FD7B00, #FDCF00); /* For old Opera (11.1 to 12.0) */
      background-image:         linear-gradient(to right, #FD7B00, #FDCF00); /* Standard syntax; must be last */
  		align-items: center;
  		margin-top: 100px;
  	  border-radius: 25px;
  }
  	</style>
  	<body>

  	<!--Navbar-->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
    	<li><img src="logo.jpg" height="30dp" width="30dp"/></li>
    	<li><p>Sindhubramha 2018</p></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="addParticipant.php"><span class="glyphicon glyphicon-pencil" style="font-size:1em">Register</span></a></li>
      	<li><a href="search.php"><span class="glyphicon glyphicon-search" style="font-size:1em">Search</span></a></li>
        <li><a href="index.php"><span class="glyphicon glyphicon-log-out" style="font-size:1em">Logout</span></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="row" align="center">
<br><br><br>
	<div class="col-md-1"></div>
			<div class="col-md-10" align="center">
				<div class="w3-container">
					<div class="w3-card-4">
					<br><br>
					<div class="w3-container">
					<form class="form-inline" action="addParticipant.php" method="POST">
					<div class="form-group has-feedback">
					<input type="text" name="fname" class="form-control" placeholder="First name" required="true" style="width:210px">
					</div>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="mname" placeholder="Middle name" required="true" style="width:210px">
					</div>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="lname" placeholder="Last name" required="true" style="width:210px">
					</div><br><br>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="village" placeholder="Village" required="true" style="width:210px">
					</div>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="taluka" placeholder="Taluka" required="true" style="width:210px">
					</div><br><br>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="district" placeholder="District" required="true" style="width:210px">
					</div><br><br>
					<select style="width: 210px; height: 30px;" id="state" name="state">
						<option style="color: grey !important;" value="null">Select State</option>
						<option value="MH">Maharashtra</option>
						<option value="KA">Karnataka</option>
						<option value="GA">Goa</option>
					</select><br><br>
          <div class="form-group has-feedback">
          <select style="width: 210px; height: 30px;", id="gender" name="gender">
            <option style="color: grey !important;" value="null">Select Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
          </div>
          <br><br>
					<button class="btn btn-default" type="submit" style="width:300px">Submit</a></button>
					</form><br><br>
					</div>
				</div>
			</div>
	</div>
</div>

</body>
</html>