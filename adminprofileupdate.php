<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['admin_id'];
	$name = $_POST['admin_name'];
	$email = $_POST['admin_email'];
	$password = $_POST['admin_password'];
	$phone = $_POST['admin_phone_no'];
	
	$sql="UPDATE admin SET admin_name = '$name', admin_email = '$email', admin_password = '$password', admin_phone_no = '$phone' WHERE admin_id = $id";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='adminprofile.php?id=$id';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='admineditprofile.php?id=$id';</script>");
	}

?>