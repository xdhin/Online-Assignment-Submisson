<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['modulecode'];
$name = $_POST['modulename'];
$lec = $_POST['lecturer'];

$sql = "INSERT INTO module (module_id, module_name, module_leader) VALUES ('$id', '$name', '$lec')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='adminmodules.php';</script>";
} else {
	echo "<script>alert('Record not created, please try again!');</script>";
	die ("<script>window.location.href='adminaddmodules.php';</script>");
}

$conn->close();
?>