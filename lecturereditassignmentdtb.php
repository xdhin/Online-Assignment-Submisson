<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	$id = $_GET['id'];
	$asgname = $_POST['asgname'];
	$asgques = $_POST['asgques'];
	$asgdes = $_POST['asgdes'];
	$asgduedate = $_POST['asgduedate'];
	$asgtotmark = $_POST['asgtotmark'];
	
	$sql="UPDATE assignment SET asg_name='$asgname', asg_question='$asgques', asg_description='$asgdes', asg_end_date_time='$asgduedate', asg_total_marks='$asgtotmark' WHERE asg_id = '$id'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='lecturerassignmentdetails.php?id=$id';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='javascript:history.go(-1)';</script>");
	}

?>