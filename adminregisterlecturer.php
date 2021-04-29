<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Lecturer Registration | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		input[type=password], select, textarea {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
		}
		
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
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Menu</span>
				</button>
			</div>
			<div class="p-4">
				<h1><a href="adminintakes.php" class="logo">APU<span>Online Assignment Submission</span></a></h1>
				<ul class="list-unstyled components mb-5">
					<?php
						$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

						if (mysqli_connect_error()){
							die ('Connection ERROR');
						}  
						$sql = 'SELECT * FROM admin WHERE admin_email = "'.$_SESSION['login'].'"';
						$result = mysqli_query($conn, $sql);
						if(mysqli_affected_rows($conn)>0) {
							for($i = 0; $i < mysqli_num_rows($result); $i++){
								$row = mysqli_fetch_assoc($result);
								echo '<li><a>Admin: '.$row['admin_name'].'</a></li>';
							}
						}
						
					?>
					<li>
						<a href="adminintakes.php"><span class="fa fa-folder-o mr-3"></span> Intakes</a>
					</li>
					<li>
						<a href="adminmodules.php"><span class="fa fa-book mr-3"></span> Modules</a>
					</li>
					<li class="active">
						<a href="adminlecturers.php"><span class="fa fa-briefcase mr-3"></span> Lecturers</a>
					</li>
					<li>
						<a href="adminprofile.php"><span class="fa fa-user-circle mr-3"></span> Profile</a>
					</li>
					<li>
						<a href="adminlogout.php"><span class="fa fa-sign-out mr-3"></span> Logout</a>
					</li>
				</ul>

				<div class="footer">
					<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | APIIT Education Group.</p>
				</div>
			</div>
		</nav>

		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2 class="mb-4">Lecturer</h2></center>
			<p>Key in the lecturer information to register the lecturer.</p>
			<div class="container">
				<form method="POST" action="adminregisterlecturerdtb.php">
					<label for="lecturerid">Lecturer ID</label>
					<input type="text" id="lecturerid" name="lecturerid" placeholder="Enter the Lecturer ID" >

					<label for="lecturername">Lecturer Name</label>
					<input type="text" id="lecturername" name="lecturername" placeholder="Enter the Lecturer Name" required>

					<label for="lecturerpw">Lecturer Password (Temporary)</label>
					<input type="password" id="lecturerpw" name="lecturerpw" placeholder="Enter the password for lecturer" required>
					
					<label for="lectureremail">Lecturer Email</label>
					<input type="text" id="lectureremail" name="lectureremail" placeholder="Enter the Lecturer Email" required>
					
					<label for="dateofbirth">Lecturer's Date of Birth</label>
					<input type="date" id="dateofbirth" name="dateofbirth" placeholder="Enter the Lecturer's DOB" required>
					
					<label for="lecturerphone">Lecturer Phone No</label>
					<input type="text" id="lecturerphone" name="lecturerphone" placeholder="Enter the Lecturer Phone Number" required>
					
					<center><input type="submit" name="upload" value="Submit"><br><br>
					<h6><a href="adminlecturers.php">Back to Previous Page</a></h6></center></center>
				</form>
			</div>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>