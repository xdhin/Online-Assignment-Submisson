<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM intake_module WHERE intake_module_id =$id";
	$result = mysqli_query($conn, $sql);	

?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";
$target = "uploads/".basename($_FILES['asgfile']['name']);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$asgname = $_POST['asgname'];
$asgques = $_POST['asgquestion'];
$asgdes = $_POST['asgdes'];
$asgfile = $_FILES['asgfile']['name'];
    $asgfile_loc = $_FILES['asgfile']['tmp_name'];
$asgfile_size = $_FILES['asgfile']['size'];
$asgfile_type = $_FILES['asgfile']['type'];
$folder="uploads/";
$asgmark = $_POST['asgtotmark'];
$asgdue = $_POST['asgdate'];

$sql = "INSERT INTO assignment (asg_name, asg_question, asg_description, asg_file, asg_file_size, asg_file_type, asg_total_marks, asg_end_date_time, intake_module_id) VALUES ('$asgname', '$asgques', '$asgdes', '$asgfile', '$asgfile_size', '$asgfile_type', '$asgmark', '$asgdue', '$id')";
mysqli_query($conn, $sql);
	
if (move_uploaded_file($_FILES['asgfile']['tmp_name'], $target)){
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='lecturerassignments.php?id=$id';</script>";
} else {
	echo "<script>alert('Record exist!');</script>";
	die ("<script>window.location.href='lecturerassignments.php?id=$id';</script>");
}

?>