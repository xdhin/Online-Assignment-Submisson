<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['intakecode'];
$name = $_POST['intakename'];
$lec = $_POST['lecturer'];
$date = $_POST['intakedate'];
$sql = "INSERT INTO intake (intake_id, intake_name, intake_incharge, intake_date) VALUES ('$id', '$name', '$lec', '$date')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='adminintakes.php';</script>";
} else {
	echo "<script>alert('Record exist!');</script>";
	die ("<script>window.location.href='adminaddintake.php';</script>");
}

$conn->close();
?>