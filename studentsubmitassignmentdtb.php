<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment WHERE asg_id =$id";
	$result = mysqli_query($conn, $sql);	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$enddate = $row['asg_end_date_time'];
			date_default_timezone_set("Asia/Kuala_Lumpur");
			$curDateTime = date("Y-m-d H:i:s");
			
			$duedate = date("Y-m-d H:i:s", strtotime("$enddate"));
			if ( $curDateTime > $enddate ) {
				$status = 'Late Submission';
			}
			else {
				$status = 'On Time';
			}
		}
	}
	
?>
<?php
	session_start();
	if(!isset($_SESSION['login'])){
		echo '<script>alert ("You are not logged in. Please login to enter the main page.")</script>';
		echo '<script>window.location.href="lecturerlogin.html"</script>';
	}
?>
<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}  
	$sql = 'SELECT * FROM student WHERE std_id = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $sql);
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$stdid=$row['std_id'];
		}
	}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineassignmentsubmission";
$target = "uploads/".basename($_FILES['subfile']['name']);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$subname = $_POST['subname'];
$subfile = $_FILES['subfile']['name'];
$asgfile_loc = $_FILES['subfile']['tmp_name'];
$subfile_size = $_FILES['subfile']['size'];
$subfile_type = $_FILES['subfile']['type'];
$folder="uploads/";


$sql = "INSERT INTO submission (sub_name, sub_file, sub_file_size, sub_file_type, sub_status, asg_id, std_id) VALUES ('$subname', '$subfile', '$subfile_size', '$subfile_type', '$status', '$id', '$stdid')";
	mysqli_query($conn, $sql);
	
	if (move_uploaded_file($_FILES['subfile']['tmp_name'], $target)){
		echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='studentassignmentdetails.php?id=$id';</script>";
} else {
	echo "<script>alert('Record exist!');</script>";
	die ("<script>window.location.href='studentassignmentdetails.php?id=$id';</script>");
}

?>