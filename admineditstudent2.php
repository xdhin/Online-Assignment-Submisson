<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM student WHERE std_id =$id";
	$result = mysqli_query($conn, $sql);	

?>

<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}      
	
	$sql = "SELECT std_id, std_email, std_name, intake_id, std_dob, std_phone_no, std_password FROM student WHERE std_id= '$id'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$email = $row['std_email'];
			$name = $row['std_name'];
			$intake = $row['intake_id'];
			$dob = $row['std_dob'];
			$phone = $row['std_phone_no'];
			$password = $row['std_password'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Edit Student Information | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		input[type=date], select, textarea {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
		}
	</style>
</head>

<body>
	<?php
		session_start();
		if(!isset($_SESSION['login'])){
			echo '<script>alert ("You are not logged in. Please login to enter the main page.")</script>';
			echo '<script>window.location.href="adminlogin.html"</script>';
		}
	?>
	<div class="wrapper d-flex align-items-stretch">
		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2 class="mb-4">Student Information</h2></center>
			<center><p>Modify the selected student information here.</p></center>

			<form method="POST" action="admineditstudentupdate.php">
				
				<center><table>
					<tr>
						<th width="50px">Student ID:</th>
						<td width="300px">
							<input type="text" id="std_id" name="std_id" value="<?php echo $id;?>" readonly/>
						</td>
					</tr>
					<tr>
						<th width="50px">Student Email:</th>
						<td width="300px">
							<input type="text" id="std_email" name="std_email" value="<?php echo $email;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">Student Name:</th>
						<td width="300px">
							<input type="text" id="std_name" name="std_name" value="<?php echo $name;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">Intake:</th>
						<td width="300px">
							<?php
								$conn = new mysqli('localhost:3306', 'root', '', 'onlineassignmentsubmission') 
								or die ('Cannot connect to db');
								$result = $conn->query("SELECT intake_id, intake_name from intake");
									echo '<select id="std_intake" name="std_intake" >';
									echo "<option value='$intake'>$intake</option>";
									while ($row = $result->fetch_assoc()) {
										unset($intakeid, $intakename);
										$intakeid = $row['intake_id'];
										$intakename = $row['intake_name']; 
										echo '<option value="'.$intakeid.'">'.$intakeid.' '.$intakename.'</option>';
									}
									echo "</select>";
							?> 
						</td>
					</tr>
					<tr>
						<th width="50px">Password:</th>
						<td width="300px">
							<input type="password" name="std_password" value="<?php echo $password;?>" required="required"/>
						</td>
					</tr>

					<tr>
						<th width="50px">Phone Number:</th>
						<td width="300px">
							<input type="text" name="std_phone_no" value="<?php echo $phone;?>" required="required"/>
						</td>
					</tr>
					<tr>
						<th width="50px">Date of Birth:</th>
						<td width="300px">
							<input type="date" name="std_dob" value="<?php echo $dob;?>" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
								<input type="submit" value="Back to Previous Page" formaction="adminsearchstudent.php"/>
							</center>
						</td>
					</tr>
				</table></center>
			</form>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>