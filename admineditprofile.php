<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}

$id = $_GET['id'];
$sql = "SELECT * FROM admin WHERE admin_id =$id";
$result = mysqli_query($conn, $sql);
if($row = mysqli_fetch_array($result)){
	$name=$row['admin_name'];
	$email=$row['admin_email'];
	$password=$row['admin_password'];
	$phone=$row['admin_phone_no'];
}
else{
	echo "<script>alert('No data from database! Technical error!');</script>";
	die("<script>window.location.href='adminprofile.php'</script>");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Edit Profile | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
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
			<center><h2 class="mb-4">Profile</h2></center>
			<center><p>Modify your personal information here. You can only modify your name, your password or your phone number.</p></center>

			<form method="post" action="adminprofileupdate.php">
				<center><table>
					<tr>
						<th width="50px">ID:</th>
						<td width="300px">
							<input type="text" name="admin_id" value="<?php echo $id;?>" readonly/>
						</td>
					</tr>
					<tr>
						<th width="50px">Email:</th>
						<td width="300px">
							<input type="text" name="admin_email" value="<?php echo $email;?>" readonly/>
						</td>
					</tr>
					<tr>
						<th width="50px">Name:</th>
						<td width="300px">
							<input type="text" name="admin_name" value="<?php echo $name;?>" required="required"/>
						</td>
					</tr>
					<tr>
						<th width="50px">Password:</th>
						<td width="300px">
							<input type="password" name="admin_password" value="<?php echo $password;?>" required="required"/>
						</td>
					</tr>
					<tr>
						<th width="50px">Phone:</th>
						<td width="300px">
							<input type="text" name="admin_phone_no" value="<?php echo $phone;?>" required="required"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
								<input type="submit"value="Back to Previous Page" formaction="adminprofile.php"/>
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