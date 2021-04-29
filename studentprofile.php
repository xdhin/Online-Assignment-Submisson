<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Profile | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		p {
			color: #646464;
		}
		input[type=text], select, textarea {
			width: 94%;
			padding: 6.5px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
		}
		input[type=submit] {
			background-color: #3C60F9;
			color: white;
			padding: 6.5px 10px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #485EBC;
			color: white;
			padding: 6.5px 10px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			padding: 8px 25px;
			padding-top: 18px;
			background-color: #EDEDED;
		}
		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}
		
	</style>
</head>

<body>
	<?php
		session_start();
		if(!isset($_SESSION['login'])){
			echo '<script>alert ("You are not logged in. Please login to enter the main page.")</script>';
			echo '<script>window.location.href="studentlogin.html"</script>';
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
				<h1><a href="studentdashboard.php" class="logo">APU<span>Online Assignment Submission</span></a></h1>
				<ul class="list-unstyled components mb-5">
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
								$stdname=$row['std_name'];
								$stdintake=$row['intake_id'];
								echo "<li><a>TP Number: $stdid<br>";
								echo "Student Name: $stdname</a></li>";
							}
						}
						
					?>
					<li>
						<a href="studentdashboard.php"><span class="fa fa-dashboard mr-3"></span> Dashboard</a>
					</li>
					<li class="active">
						<a href="studentprofile.php"><span class="fa fa-folder-o mr-3"></span> Profile</a>
					</li>
					<li>
						<a href="studentassignments.php"><span class="fa fa-book mr-3"></span> Assignments</a>
					</li>
					<li>
						<a href="studentlogout.php"><span class="fa fa-sign-out mr-3"></span> Logout</a>
					</li>
				</ul>

				<div class="footer">
					<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | APIIT Education Group.</p>
				</div>
			</div>
		</nav>

		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2 class="mb-4">Profile</h2></center>
			<p>This is the profile of yours.</p>

			<table class="table table-sm table-sm">
				<tr>
					<th width="15%">Student ID</th>
					<th width="30%">Student Name</th>
					<th width="25%">Email</th>
					<th width="15%">Date of Birth</th>
					<th width="15%">Phone Number</th>
				</tr>
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
							echo '<tr>';
							echo '<td>'.$row['std_id'].'</td>';
							echo '<td>'.$row['std_name'].'</td>';
							echo '<td>'.$row['std_email'].'</td>';
							echo '<td>'.$row['std_dob'].'</td>';
							echo '<td>'.$row['std_phone_no'].'</td>';
							echo '</tr>';
						}
					}
				?>
			</table>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}

				$sql = 'SELECT * FROM student WHERE std_id = "'.$_SESSION['login'].'"';
				$results = mysqli_query($conn, $sql);

				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($results); $i++){
						$row = mysqli_fetch_assoc($results);
						echo '<button class="btn bg-light"> <a href="studentchangepassword.php?id='.$row['std_id'].'">Change Password</a></button>';
					
					}
				}
			?>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>