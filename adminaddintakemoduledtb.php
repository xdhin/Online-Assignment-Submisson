<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM intake WHERE intake_id =$id";
	$result = mysqli_query($conn, $sql);	

?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$module = $_POST['module'];
$lecturer = $_POST['lecturer'];
$sql = "INSERT INTO intake_module (intake_id, module_id, lec_id) VALUES ('$id', '$module', '$lecturer')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='adminintakedetails.php?id=$id';</script>";
} else {
	echo "<script>alert('Record not created, please try again!');</script>";
	die ("<script>window.location.href='adminintakedetails.php?id=$id';</script>");
}

$conn->close();
?>