<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM lecturer WHERE lec_id =$id";
	$result = mysqli_query($conn, $sql);	

	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$name = $row['lec_name'];
			$email = $row['lec_email'];
			$dob = $row['lec_dob'];
			$phone = $row['lec_phone_no'];
			$password = $row['lec_password'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Edit Lecturer Information | APU Online Assignment Submission System</title>
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
			<center><h2 class="mb-4">Lecturer Info Modification</h2></center>
			<center><p>Modify the selected lecturer information here.</p></center>

			<form method="POST" action="admineditlecturerdtb2.php">
				
				<center><table>
					<tr>
						<th width="50px">Lecturer ID:</th>
						<td width="300px">
							<input type="text" id="lec_id" name="lec_id" value="<?php echo $id;?>" readonly/>
						</td>
					</tr>
					<tr>
						<th width="50px">Lecturer Email:</th>
						<td width="300px">
							<input type="text" id="lec_email" name="lec_email" value="<?php echo $email;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">Lecturer Name:</th>
						<td width="300px">
							<input type="text" id="lec_name" name="lec_name" value="<?php echo $name;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">His/Her Password:</th>
						<td width="300px">
							<input type="password" name="lec_password" value="<?php echo $password;?>" required="required"/>
						</td>
					</tr>

					<tr>
						<th width="50px">Phone Number:</th>
						<td width="300px">
							<input type="text" name="lec_phone_no" value="<?php echo $phone;?>" required="required"/>
						</td>
					</tr>
					<tr>
						<th width="50px">Date of Birth:</th>
						<td width="300px">
							<input type="date" name="lec_dob" value="<?php echo $dob;?>" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
								<input type="submit" value="Back to Previous Page" formaction="adminlecturerdetails.php?id=<?php echo $id;?>"/>
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