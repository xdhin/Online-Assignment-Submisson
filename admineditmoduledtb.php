<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	
	$id = $_POST['moduleid'];
	$modulename = $_POST['modulename'];
	$moduleleader = $_POST['moduleleader'];
	
	$sql="UPDATE module SET module_name='$modulename', module_leader='$moduleleader' WHERE module_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='adminmodules.php';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>