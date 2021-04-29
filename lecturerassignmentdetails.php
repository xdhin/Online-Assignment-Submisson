<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment WHERE asg_id =$id";
	$result = mysqli_query($conn, $sql);	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Assignment | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		p {
			color: #646464;
		}
		h1, h2, h3, h4, h5, h6{
			text-align: left;
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
			echo '<script>window.location.href="lecturerlogin.html"</script>';
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
				<h1><a href="lecturerdashboard.php" class="logo">APU<span>Online Assignment Submission</span></a></h1>
				<ul class="list-unstyled components mb-5">
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
								echo "<li><a>Lecturer: $lecname</a></li>";
							}
						}
						
					?>
					<li class="active">
						<a href="lecturerdashboard.php"><span class="fa fa-dashboard mr-3"></span> Dashboard</a>
					</li>
					<li>
						<a href="lecturerintakes.php"><span class="fa fa-folder-o mr-3"></span> Intakes</a>
					</li>
					<li>
						<a href="lecturermodules.php"><span class="fa fa-book mr-3"></span> Modules</a>
					</li>
					<li>
						<a href="lecturerprofile.php"><span class="fa fa-user mr-3"></span> Profile</a>
					</li>
					<li>
						<a href="lecturerlogout.php"><span class="fa fa-sign-out mr-3"></span> Logout</a>
					</li>
				</ul>

				<div class="footer">
					<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | APIIT Education Group.</p>
				</div>
			</div>
		</nav>

		<div id="content" class="p-4 p-md-5 pt-5">
			</a><a style="float:right;" href="lecturereditassignment.php?id=<?php echo $id?>"><b>Edit Assignment</b></a>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT a.asg_name, a.asg_question, a.asg_description, a.asg_file, a.asg_start_date_time, a.asg_end_date_time, a.intake_module_id, n.intake_module_id, n.intake_id, n.module_id, m.module_id, m.module_name
						FROM assignment AS a
						INNER JOIN intake_module AS n
						ON a.intake_module_id=n.intake_module_id
						INNER JOIN module AS m
						ON n.module_id=m.module_id
						WHERE a.asg_id= '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						$intake=$row['intake_id'];
						$moduleid=$row['module_id'];
						$modulename=$row['module_name'];
						$assignmentname=$row['asg_name'];
						echo "<center><h2>$assignmentname</h2></center>";
					}
				}
			?>
			<p>
				<b>Assignment of: </b><?php echo $modulename;?> / <?php echo $moduleid;?><br>
				<b>Intake: </b><?php echo $intake;?> <br>
			</p>
			<hr>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT a.asg_name, a.asg_question, a.asg_description, a.asg_file, a.asg_start_date_time, a.asg_end_date_time, a.asg_total_marks, a.intake_module_id, n.intake_module_id, n.intake_id, n.module_id, m.module_id, m.module_name
						FROM assignment AS a
						INNER JOIN intake_module AS n
						ON a.intake_module_id=n.intake_module_id
						INNER JOIN module AS m
						ON n.module_id=m.module_id
						WHERE a.asg_id= '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						$intake=$row['intake_id'];
						$moduleid=$row['module_id'];
						$modulename=$row['module_name'];
						$assignmentname=$row['asg_name'];
						$asgfile=$row['asg_file'];
						echo "<p>";
						echo "<b>Assignment Question:</b><br>".$row['asg_question']."";
						echo "<b></b><br></p>";
						echo "<p><b>Description:</b><br>".$row['asg_description']."";
						echo "<b></b><br></p>";
						echo "<p><b>Hand Out Date:</b><br>".$row['asg_start_date_time']."";
						echo "<b></b><br></p>";
						echo "<p><b>Hand In Date:</b><br>".$row['asg_end_date_time']."";
						echo "<b></b><br></p>";
						echo "<p><b>Total Marks:</b><br>".$row['asg_total_marks']."";
						echo "<b></b><br></p>";
						echo "<p><b>Assignment File:</b><br><a href='uploads/$asgfile' target='_blank'>View File</a>";
						echo "<b></b><br></p>";
						echo "</p>";
					}
				}
			?>
			<button class='btn bg-light'><a href="lecturersubmission.php?id=<?php echo $id?>">View Submission</a></button>
		</div>
		
	</div>
	
	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>
