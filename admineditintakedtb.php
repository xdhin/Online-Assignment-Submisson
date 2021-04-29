<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['intake'];
	$intakename = $_POST['intakename'];
	$intakedate = $_POST['intakedate'];
	$lecturer = $_POST['lecturer'];
	
	$sql="UPDATE intake SET intake_name='$intakename', intake_date='$intakedate', intake_incharge='$lecturer' WHERE intake_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='adminintakes.php';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>