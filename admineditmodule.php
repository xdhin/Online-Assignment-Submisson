<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM module WHERE module_id ='$id'";
	$result = mysqli_query($conn, $sql);	

	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$modulename = $row['module_name'];
			$moduleleader = $row['module_leader'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Edit Module | APU Online Assignment Submission System</title>
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
			<center><h2 class="mb-4">Module Modification</h2></center>
			<center><p>Modify the module information here.</p></center>

			<form method="POST" action="admineditmoduledtb.php">
				
				<center><table>
					<tr>
						<th width="50px">Module ID:</th>
						<td width="300px">
							<input type="text" id="moduleid" name="moduleid" value="<?php echo $id;?>" readonly/>
						</td>
					</tr>
					<tr>
						<th width="50px">Module Name:</th>
						<td width="300px">
							<input type="text" id="modulename" name="modulename" value="<?php echo $modulename;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">Module Leader:</th>
						<td width="300px">
							<?php
								$conn = new mysqli('localhost:3306', 'root', '', 'onlineassignmentsubmission') 
								or die ('Cannot connect to db');
								$result = $conn->query("SELECT lec_id, lec_name from lecturer");
									echo '<select id="moduleleader" name="moduleleader" >';
									echo "<option value='$moduleleader'>$moduleleader</option>";
									while ($row = $result->fetch_assoc()) {
										unset($lecturerid, $lecturername);
										$lecturerid = $row['lec_id'];
										$lecturername = $row['lec_name']; 
										echo '<option value="'.$lecturerid.'">'.$lecturerid.' '.$lecturername.'</option>';
									}
									echo "</select>";
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
								<input type="submit" value="Back to Previous Page" formaction="adminmodules.php"/>
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