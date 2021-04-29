<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['id'];
	$intake = $_POST['intake'];
	$module = $_POST['module'];
	$lecturer = $_POST['lecturer'];
	
	$sql="UPDATE intake_module SET intake_module_id='$id', intake_id='$intake', module_id='$module', lec_id='$lecturer' WHERE intake_module_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='adminintakedetails.php?id=$intake';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>