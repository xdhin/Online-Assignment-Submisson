<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$feedbackid = $_GET['id'];
	
	$sql = "SELECT * FROM feedback WHERE feedback_id ='$feedbackid'";
	$result = mysqli_query($conn, $sql);	

	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$id = $row['sub_id'];
		}
	}
?>

<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}
	$mark = $_POST['mark'];
	$ct = $_POST['ct'];
	
	$sql="UPDATE feedback SET feedback_mark='$mark', feedback_content='$ct' WHERE feedback_id = '$feedbackid'";
	
	mysqli_query($conn, $sql);
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Successfully to update data!');</script>";
		echo "<script>window.location.href='lecturerviewfeedback.php?id=$id';</script>";
	} else {
		echo "<script>alert('Cannot update data!');</script>";
		die ("<script>window.location.href='lecturerviewfeedback.php?id=$id';</script>");
	}

?>