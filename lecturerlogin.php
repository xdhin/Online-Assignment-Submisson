<?php
session_start();
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$sql = 'SELECT * FROM lecturer WHERE BINARY lec_email = "'.$_POST['lectureremail'].'" AND BINARY lec_password = "'.$_POST['lecturerpassword'].'"';

$loginfo = mysqli_query($conn, $sql);

if( mysqli_num_rows($loginfo)==1){
	$row = mysqli_fetch_assoc($loginfo);
	$_SESSION['login'] = $row['lec_email'];
	echo '<script>alert("Login SUCCESSFUL!")</script>';
	echo '<script>window.location.href = "lecturerdashboard.php";</script>';
}
else {
	echo '<script> alert("The Email and Password is incorrect. Please type again.")</script>';
	echo '<script>window.location.href = "lecturerlogin.html";</script>';
}

?>