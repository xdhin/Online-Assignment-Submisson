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
	<title>Intakes | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		/* The Modal (background) */
		.modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  padding-top: 100px; /* Location of the box */
		  left: 0;
		  top: 0;
		  width: 100%; /* Full width */
		  height: 100%; /* Full height */
		  overflow: auto; /* Enable scroll if needed */
		  background-color: rgb(0,0,0); /* Fallback color */
		  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
		  background-color: #fefefe;
		  margin: auto;
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%;
		}

		/* The Close Button */
		.close {
		  color: #aaaaaa;
		  float: right;
		  font-size: 28px;
		  font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: #000;
		  text-decoration: none;
		  cursor: pointer;
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
				<h1><a href="adminintakes.php" class="logo">APU<span>Online Assignment Submission</span></a></h1>
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
								$lecname = $row['lec_name'];
								$lecid = $row['lec_id'];
								echo "<li><a>Lecturer: $lecname </a></li>";
							}
						}
						
					?>
					<li>
						<a href="lecturerdashboard.php"><span class="fa fa-dashboard mr-3"></span> Dashboard</a>
					</li>
					<li class="active">
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
			<center><h2 class="mb-4"><?php echo $id?></h2></center>
			<center><p><b>Intake Code: </b><?php echo $id;?> <br>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT intake_id, intake_name, intake_date
						FROM intake
						WHERE intake_id= '$id'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo '<b>Intake Name: </b>'.$row['intake_name'].'<br>';
						echo '<b>Intake Date: </b>'.$row['intake_date'].'</p></center>';
					}
				}
			?>
			<h5 id="module">Module Taken</h5>
			<table class="table table-sm table-sm">
				<tr>
					<th width="15%">Module ID</th>
					<th width="45%">Module Name</th>
					<th width="10%">Lecturer</th>
					<th width="5%"><center>Edit</center></th>
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
							$lecid = $row['lec_id'];
							$lecname = $row['lec_name'];
							echo '<tr>';
							echo '<td>'.$row['module_id'].'</td>';
							echo '<td>'.$row['module_name'].'</td>';
							echo "<td><a href='lecturerlecturerdetails.php?id=$lecid'>$lecname</a></td>";
							echo "<td><center><a href='lecturereditmoduleinintake.php?id=".$row['intake_module_id']."'><span class='fa fa-pencil'></span></a></center></td>";
							echo "<td><center><a href='lecturerdeletemoduleinintake.php?id=".$row['intake_module_id']."'><span class='fa fa-trash'></span></a></center></td>";
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
				echo "<button class='btn bg-light'><a href='lectureraddintakemodule.php?id=$id'>Add Module To This Intake</a></button>";
			?>
			<br><br><br>
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

		</div>
	</div>
	
	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>