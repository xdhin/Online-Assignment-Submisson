<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['studentid'];
$name = $_POST['studentname'];
$password = $_POST['studentpw'];
$email = $_POST['studentemail'];
$date = $_POST['intakedate'];
$phone = $_POST['studentphone'];
$intake = $_POST['intake'];
$sql = "INSERT INTO student (std_id, std_name, std_password, std_email, std_dob, std_phone_no, intake_id) VALUES ('$id', '$name', '$password', '$email', '$date', '$phone', '$intake')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='javascript:history.go(-2)';</script>";
} else {
	echo "<script>alert('Student ID is used, please try with another ID.');</script>";
	die ("<script>window.location.href='javascript:history.go(-1)';</script>");
}

$conn->close();
?>