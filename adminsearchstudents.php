<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Student List | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
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
					<li class="active">
						<a href="adminintakes.php"><span class="fa fa-folder-o mr-3"></span> Intakes</a>
					</li>
					<li>
						<a href="adminmodules.php"><span class="fa fa-book mr-3"></span> Modules</a>
					</li>
					<li>
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
			<center><h2 class="mb-4">Students List</h2></center>
			<form action="adminsearchstudents.php" method="POST">
				<input type="text" name="search_key" placeholder="Please enter the student name to find the student you want to find."/>
				<input type="submit" value="Search" /> 
			</form>
			<button class="btn bg-light"> <a href="adminregisterstudent.php">Student Registration</a></button><br><br>
			<p>This is the list of all students in APU.</p>
			<table class="table table-sm table-sm">
				<?php
					$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

					if (mysqli_connect_error()){
						die ('Connection ERROR');
					}

					$search_key = isset($_POST['search_key'])?
					$_POST['search_key']: '';

					if ($search_key == NULL) {
						echo "<script>alert('Please key in your search key first!');</script>";
						echo '<script>window.location.href = "adminsearchstudent.php";</script>';
					}
					else{
					}

					$sql="SELECT *
						  FROM student
						  WHERE std_name LIKE'%".
					$search_key. "%'";
					$result=mysqli_query($conn, $sql);

					if(mysqli_num_rows($result) <= 0) {
						echo "<script>alert('No Result!');</script>"; 
						echo "<script>window.location.href='javascript:history.go(-1)';</script>"; 
					}
					else{
					}

					echo '<tr>';
					echo '<th width="10%">Student ID</th>';
					echo '<th width="30%">Student Name</th>';
					echo '<th width="15%">Email</th>';
					echo '<th width="10%">Date of Birth</th>';
					echo '<th width="15%">Phone Number</th>';
					echo '<th width="10%">Intake</th>';
					echo "<th width='5%'><center>Edit</center></th>";
					echo "<th width='5%'><center>Delete</center></th>";
					echo '</tr>';

					while($row = mysqli_fetch_array($result)){
						echo '<tr>';
						echo '<td>'.$row['std_id'].'</td>';
						echo '<td>'.$row['std_name'].'</td>';
						echo '<td>'.$row['std_email'].'</td>';
						echo '<td>'.$row['std_dob'].'</td>';
						echo '<td>'.$row['std_phone_no'].'</td>';
						echo '<td><a href="adminintakedetails.php?id='.$row['intake_id'].'">'.$row['intake_id'].'</a></td>';
						echo "<td><center><a href='admineditstudent2.php?id=".$row['std_id']."'><span class='fa fa-pencil'></span></a></center></td>";
						echo "<td><center><a href='admindeletestudent.php?id=".$row['std_id']."'><span class='fa fa-trash'></span></a></center></td>";
						echo '</tr>';
					}
				?>
			</table>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>