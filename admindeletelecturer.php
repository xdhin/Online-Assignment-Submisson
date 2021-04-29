<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$id = $_GET['id'];
$sql="DELETE FROM lecturer WHERE lec_id='$id'";
$result=mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn)<=0){
	echo "<script>alert('Unable to delete the lecturer! ')</script>;";
	echo "<script>window.location.href='javascript:history.go(-1)';</script>";
}else{
	echo "<script>alert('Data deleted!');</script>";
	echo "<script>window.location.href='adminlecturers.php';</script>"; 
}
?>