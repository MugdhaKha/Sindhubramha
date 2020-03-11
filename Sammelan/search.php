<?php
  
  session_start(); 
  class search{
    private $con;
    public $heading;
    public $tablec;

  function __construct(){
    require_once 'includes/DbConnect.php';

      $db=new DbConnect();

      $this->con=$db->connect();
      $this->heading='';
      $this->tablec='';
    }
    function searchFunction($pid,$fname,$mname,$lname){
      if(empty($pid)){
          if($fname==''){
        if($mname==''){
          if($lname=='')
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` ";
          else
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE lname='".$lname."'";
        }
        else if($lname=='')
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE mname='".$mname."'";
          else
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE mname='".$mname."' AND lname='".$lname."'";
          }
          else if($mname=='')
            if($lname=='')
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE fname='".$fname."'";
          else
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE fname='".$fname."' AND lname='".$lname."'";
          elseif($lname=='')
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE fname='".$fname."' AND mname='".$mname."'";
          else
            $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE fname='".$fname."' AND mname='".$mname."' AND lname='".$lname."'";
      }
      else{
              $sql="SELECT pid,fname,mname,lname,gender,Opid FROM `participant` WHERE pid='".$pid."'";
      }
      $sql=$sql." ORDER BY pid";
      $result=mysqli_query($this->con,$sql);
      $this->heading = $this->heading.'<tr><td><b>PID</td><td><b>First Name</td><td><b>Middle Name</td><td><b>Last Name</td><td><b>Gender</td><td><b>Operator</td></tr>';
              while ($value=mysqli_fetch_object($result)) {
                $this->tablec=$this->tablec.'<tr>'.
                                            '<td>'.$value->pid.'</td>'.
                                            '<td>'.$value->fname.'</td>'.
                                            '<td>'.$value->mname.'</td>'.
                                            '<td>'.$value->lname.'</td>'.
                                            '<td>'.$value->gender.'</td>'.
                                            '<td>'.$value->Opid.'</td>'.'</tr>';
              }
    }
  }
    $searchIns=new search();
  if($_SERVER['REQUEST_METHOD']=='POST'){
  $searchIns->searchFunction($_POST['pid'],$_POST['fname'],$_POST['mname'],$_POST['lname']);
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
      tr,table,td{
        border: 1px solid;
        background: #fff;
        padding: 3px;
        border-radius: 10px;
        text-align: center;
        width: 900px;
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
	<div class="col-md-1"></div>
			<div class="col-md-10" align="center">
				<div class="w3-container">
					<div class="w3-card-4">
					<br><br>
					<div class="w3-container">
					<form class="form-inline" action="search.php" method="POST">
          <div class="form-group has-feedback">
          <input type="text" name="pid" class="form-control" placeholder="Registration ID" style="width:210px">
          </div>
					<div class="form-group has-feedback">
					<input type="text" name="fname" class="form-control" placeholder="First name" style="width:210px">
					</div>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="mname" placeholder="Middle name" style="width:210px">
					</div>
					<div class="form-group has-feedback">
					<input type="text" class="form-control" name="lname" placeholder="Last name" style="width:210px">
					</div>
					<button class="btn btn-default" type="submit" style="width:50px"><span class="glyphicon glyphicon-search"></span></button>
					</form>
          <br><br>
          <table>
            <?php echo $searchIns->heading;
                  echo $searchIns->tablec; 
            ?>
          </table>
          <br>
					</div>
				</div>
			</div>
	</div>
</div>

</body>
</html>