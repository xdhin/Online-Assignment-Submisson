<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['lec_id'];
	$email = $_POST['lec_email'];
	$name = $_POST['lec_name'];
	$password = $_POST['lec_password'];
	$dob = $_POST['lec_dob'];
	$phoneno = $_POST['lec_phone_no'];
	
	$sql="UPDATE lecturer SET lec_email='$email', lec_name='$name', lec_password='$password', lec_phone_no='$phoneno', lec_dob='$dob' WHERE lec_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='adminlecturerdetails.php?id=$id';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>