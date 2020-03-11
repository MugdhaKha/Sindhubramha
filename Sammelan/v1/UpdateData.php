<?php

	class updateData{

		private $con;

		function __construct(){
			require_once '../includes/DbConnect.php';

			$db=new DbConnect();

			$this->con=$db->connect();
		}


		function enterParticipant($fname,$mname,$lname,$village,$taluka,$district,$opid){

			$stmt=$this->con->prepare("INSERT INTO `participant` (`pid`, `fname`, `mname`, `lname`, `village`, `taluka`, `district`, `regtime`, `Opid`) VALUES (NULL,?,?,?,?,?,?, CURRENT_TIMESTAMP, ?)");

			$stmt->bind_param("ssssssi",$fname,$mname,$lname,$village,$taluka,$district,$opid);

			if($stmt->execute()){

				echo "Successfully updated";
				exit;
			}else{

				echo $this->con->error;
				echo "Enter Participant Failed";
				exit;
			}
		}
	}

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$ua=new updateData();
		$ua->enterParticipant($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['village'],$_POST['taluka'],$_POST['district'],$_POST['opid']);
	}