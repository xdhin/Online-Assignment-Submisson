<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['lecturername'];
$password = $_POST['lecturerpw'];
$email = $_POST['lectureremail'];
$date = $_POST['dateofbirth'];
$phone = $_POST['lecturerphone'];
$sql = "INSERT INTO lecturer (lec_name, lec_password, lec_email, lec_dob, lec_phone_no) VALUES ('$name', '$password', '$email', '$date', '$phone')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='adminlecturers.php';</script>";
} else {
	echo "<script>alert('Record not created, please try again!');</script>";
	die ("<script>window.location.href='adminlecturers.php';</script>");
}

$conn->close();
?>