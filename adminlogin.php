<?php
session_start();
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$sql = 'SELECT * FROM admin WHERE BINARY admin_email = "'.$_POST['adminemail'].'" AND BINARY admin_password = "'.$_POST['password'].'"';

$loginfo = mysqli_query($conn, $sql);

if( mysqli_num_rows($loginfo)==1){
	$row = mysqli_fetch_assoc($loginfo);
	$_SESSION['login'] = $row['admin_email'];
	echo '<script>alert("Login SUCCESSFUL!")</script>';
	echo '<script>window.location.href = "adminintakes.php";</script>';
}
else {
	echo '<script> alert("The Email and Password is incorrect. Please type again.")</script>';
	echo '<script>window.location.href = "adminlogin.html";</script>';
}

?>