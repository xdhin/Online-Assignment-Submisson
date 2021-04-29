<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM module WHERE module_id =$id";
	$result = mysqli_query($conn, $sql);	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title><?php echo $id;?> | APU Online Assignment Submission System</title>
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
					<li class="active">
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
			<center><h2 class="mb-4"><?php echo $id;?></h2></center>

			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT m.module_id, m.module_name, m.module_leader, l.lec_id, l.lec_name
						FROM module as m
						INNER JOIN lecturer AS l 
						ON m.module_leader = l.lec_id
						WHERE m.module_id = '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo '<center><p><b>Module ID: </b>'.$row['module_id'].'<br>';
						echo '<b>Module Name: </b>'.$row['module_name'].'</br>';
						echo '<b>Module Leader: </b><a href="adminlecturerdetails.php?id='.$row['lec_id'].'">'.$row['lec_name'].'</a></p></center>';
						echo '</tr>';
					}
				}
			?>
			<br><br>
			<h5>Intakes</h5>
				<table class="table table-sm table-sm">
					<tr>
						<th width="15%">Intake ID</th>
						<th width="40%">Intake Name</th>
						<th width="20%">Intake Leader (Incharged by)</th>
					</tr>
					<?php
						$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

						if (mysqli_connect_error()){
							die ('Connection ERROR');
						}      
						
						$sql = "SELECT n.intake_module_id, n.intake_id, n.module_id, n.lec_id, i.intake_id, i.intake_name, l.lec_id, l.lec_name
								FROM intake_module AS n 
								INNER JOIN intake AS i
								ON n.intake_id = i.intake_id
								INNER JOIN lecturer AS l
								ON n.lec_id = l.lec_id
								WHERE module_id = '$id'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_affected_rows($conn)>0) {
							for($i = 0; $i < mysqli_num_rows($result); $i++){
								$row = mysqli_fetch_assoc($result);
								echo '<tr>';
								echo '<td><a href="adminintakedetails.php?id='.$row['intake_id'].'">'.$row['intake_id'].'</a></td>';
								echo '<td>'.$row['intake_name'].'</td>';
								echo '<td><a href="adminlecturerdetails.php?id='.$row['lec_id'].'">'.$row['lec_name'].'</a></td>';
								echo '</tr>';
							}
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