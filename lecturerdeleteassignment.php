<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}      
	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment
			WHERE asg_id= '$id'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$intakemodule=$row['intake_module_id'];
		}
	}
?>
<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$id = $_GET['id'];

$sql="DELETE FROM assignment WHERE asg_id='$id'";
$result=mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn)<=0){
	echo "<script>alert('Unable to delete intake!')</script>;";
	echo "<script>window.location.href='javascript:history.go(-1)';</script>";
}else{
	echo "<script>alert('Data deleted!');</script>";
	echo "<script>window.location.href='lecturerassignments.php?id=$intakemodule';</script>"; 
}
?>