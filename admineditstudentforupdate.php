<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['std_id'];
	$email = $_POST['std_email'];
	$name = $_POST['std_name'];
	$intake = $_POST['std_intake'];
	$password = $_POST['std_password'];
	$dob = $_POST['std_dob'];
	$phoneno = $_POST['std_phone_no'];
	
	$sql="UPDATE student SET std_email='$email', std_name='$name', intake_id='$intake', std_password='$password', std_phone_no='$phoneno', std_dob='$dob' WHERE std_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='javascript:history.go(-2)';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>