<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$id = $_GET['id'];
$sql="DELETE FROM intake WHERE intake_id='$id'";
$result=mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn)<=0){
	echo "<script>alert('Unable to delete intake! Students are registered to the intake.')</script>;";
	echo "<script>window.location.href='javascript:history.go(-1)';</script>";
}else{
	echo "<script>alert('Data deleted!');</script>";
	echo "<script>window.location.href='javascript:history.go(-1)';</script>"; 
}
?>