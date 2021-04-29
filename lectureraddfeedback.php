<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM submission WHERE sub_id =$id";
	$result = mysqli_query($conn, $sql);	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Give Feedback and Grading | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		h1, h2, h3, h4, h5, h6{
			text-align: left;
		}
		
		input[type=submit] {
			width: 50%;
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
						echo "<center><h2>$studentid / $student</h2></center>";
					}
				}
			?>
			<p>
				<b>Assignment: </b><?php echo $assignment;?><br>
				<b>Intake: </b><?php echo $intake;?><br>
			</p>
			<hr><br>
			<form method="POST" action="lectureraddfeedbackdtb.php?id=<?php echo $id;?>">
				<center><table width="100%">
					<tr>
						<th width="15%">Submission Mark:</th>
						<td width="85%">
							<input type="text" id="marking" name="marking" >
						</td>
					</tr>
					<tr>
						<th width="15%">Feedback:</th>
						<td width="85%">
							<textarea name="feedback" cols="60" rows="4" id="feedback" ></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
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
