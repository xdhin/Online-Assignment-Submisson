<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$id = $_GET['id'];
$sql="DELETE FROM student WHERE std_id='$id'";
$result=mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn)<=0){
	echo "<script>alert('Unable to delete data!')</script>;";
	echo "<script>window.location.href='javascript:history.go(-1)';</script>";
}

echo "<script>alert('Data deleted!');</script>";
echo "<script>window.location.href='adminsearchstudent.php';</script>"; 
?>