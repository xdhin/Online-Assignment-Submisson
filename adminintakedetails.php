<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM intake WHERE intake_id =$id";
	$result = mysqli_query($conn, $sql);	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title><?php echo $id; ?> | APU Online Assignment Submission System</title>
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
			<center><h2 class="mb-4"><?php echo $id;?></h2></center>
			<center><p><b>Intake Code: </b><?php echo $id;?> <br>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT i.intake_id, i.intake_name, i.intake_incharge, l.lec_id, l.lec_name
						FROM intake AS i
						INNER JOIN lecturer AS l
						ON i.intake_incharge = l.lec_id
						WHERE i.intake_id= '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo '<b>Intake Name: </b>'.$row['intake_name'].'<br>';
						echo '<b>Incharged by: </b>'.$row['lec_name'].'</p></center>';
					}
				}
			?>
			
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT *
						FROM intake
						WHERE intake_id= '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo "<button class='btn bg-light'><a href='adminregisterstudentwithid.php?id=$id'>Register Student to This Intake</a></button>";
					}
				}
			?>
			
			<button class="btn bg-light"> <a href="#module">Module Taken</a></button>
			<br><br>
			<h5>Student List</h5>
			<table class="table table-sm table-sm">
				<tr>
					<th width="15%">Student ID</th>
					<th width="30%">Student Name</th>
					<th width="20%">Student Email</th>
					<th width="15%">Phone Number</th>
					<th width="10%">Student DOB</th>
				</tr>
				<?php
					$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

					if (mysqli_connect_error()){
						die ('Connection ERROR');
					}      
					
					$sql = "SELECT *
							FROM student
							WHERE intake_id= '$id'";
					$result = mysqli_query($conn, $sql);
					
					if(mysqli_affected_rows($conn)>0) {
						for($i = 0; $i < mysqli_num_rows($result); $i++){
							$row = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>'.$row['std_id'].'</td>';
							echo '<td>'.$row['std_name'].'</td>';
							echo '<td>'.$row['std_email'].'</td>';
							echo '<td>'.$row['std_phone_no'].'</td>';
							echo '<td>'.$row['std_dob'].'</td>';
							echo '</tr>';
						}
					}
				?>
			</table>
			<br><br>
			<h5 id="module">Module Taken</h5>
			<table class="table table-sm table-sm">
				<tr>
					<th width="15%">Module ID</th>
					<th width="30%">Module Name</th>
					<th width="25%">Lecturer</th>
					<th width="25%"><center>View Report of Submission</center></th>
					<th width="5%"><center>Delete</center></th>
				</tr>
				<?php
					$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

					if (mysqli_connect_error()){
						die ('Connection ERROR');
					}      
					
					$sql = "SELECT n.intake_module_id, n.intake_id, n.module_id, n.lec_id, m.module_id, m.module_name, l.lec_id, l.lec_name
							FROM intake_module AS n 
							INNER JOIN module AS m
							ON n.module_id = m.module_id
							INNER JOIN lecturer AS l
							ON n.lec_id = l.lec_id
							WHERE intake_id = '$id'";
					$result = mysqli_query($conn, $sql);
					
					if(mysqli_affected_rows($conn)>0) {
						for($i = 0; $i < mysqli_num_rows($result); $i++){
							$row = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>'.$row['module_id'].'</td>';
							echo '<td>'.$row['module_name'].'</td>';
							echo "<td><a href='admineditmoduleinintake.php?id=".$row['intake_module_id']."'>".$row['lec_name']."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='fa fa-pencil'></span></a></td></td>";
							echo "<td><center><a href='adminviewreport.php?id=".$row['intake_module_id']."'><span class='fa fa-file-text-o'></span></a></center></td>";
							echo "<td><center><a href='admindeletemoduleinintake.php?id=".$row['intake_module_id']."'><span class='fa fa-trash'></span></a></center></td>";
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
				echo "<button class='btn bg-light'><a href='adminaddintakemodule.php?id=$id'>Add Module To This Intake</a></button>";
			?>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>