<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM submission WHERE sub_id =$id";
	$result = mysqli_query($conn, $sql);	

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
	$sql = 'SELECT * FROM lecturer WHERE lec_email = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $sql);
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$lecid=$row['lec_id'];
			$lecname=$row['lec_name'];
		}
	}
	
?>
<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}      
	
	$sql = "SELECT s.sub_id, s.sub_name, s.sub_file, s.sub_date_time, s.sub_status, s.asg_id, s.std_id, d.std_id, d.std_name, d.intake_id, a.asg_id, a.asg_name
			FROM submission AS s
			INNER JOIN student AS d
			ON s.std_id = d.std_id
			INNER JOIN assignment AS a
			ON s.asg_id = a.asg_id
			WHERE s.sub_id= '$id'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$submission=$row['sub_name'];
			$subfile=$row['sub_file'];
			$subdate=$row['sub_date_time'];
			$substatus=$row['sub_status'];
			$studentid=$row['std_id'];
			$student=$row['std_name'];
			$aid=$row['asg_id'];
			$assignment=$row['asg_name'];
			$intake=$row['intake_id'];
		}
	}
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

$feedback = $_POST['feedback'];
$mark = $_POST['marking'];
$sql = "INSERT INTO feedback (feedback_content, feedback_mark, sub_id, lec_id) VALUES ('$feedback', '$mark', '$id', '$lecid')";

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('New record created SUCCESSFULLY!');</script>";
	echo "<script>window.location.href='lecturersubmission.php?id=$aid';</script>";
} else {
	echo "<script>alert('Feedback was given. Please view the feedback you have created.');</script>";
	die ("<script>window.location.href='lecturersubmission.php?id=$aid';</script>");
}

$conn->close();
?>