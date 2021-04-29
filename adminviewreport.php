<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT i.intake_module_id, i.intake_id, i.module_id, i.lec_id, m.module_id, m.module_name, l.lec_id, l.lec_name
			FROM intake_module AS i
			INNER JOIN module AS m
			ON i.module_id = m.module_id
			INNER JOIN lecturer AS l
			ON l.lec_id = i.lec_id
			WHERE intake_module_id =$id";
	$result = mysqli_query($conn, $sql);	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$intakeid = $row['intake_id'];
			$moduleid = $row['module_id'];
			$modulename = $row['module_name'];
			$lec = $row['lec_name'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title><?php echo $intakeid; ?> | APU Online Assignment Submission System</title>
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
			<h2 class="mb-4"><?php echo $intakeid;?></h2>
			<p><b>Intake Code: </b><?php echo $intakeid;?> <br>
			<b>Module Code: </b><?php echo $moduleid;?> <br>
			<b>Module Name: </b><?php echo $modulename;?> <br>
			<b>Lecturer: </b><?php echo $lec;?> <br></p>
			<table>
				
					<?php
						$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

						if (mysqli_connect_error()){
							die ('Connection ERROR');
						}      
						
						$sql = "SELECT *
								FROM assignment
								WHERE intake_module_id= '$id'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_affected_rows($conn)>0) {
							for($i = 0; $i < mysqli_num_rows($result); $i++){
								$row = mysqli_fetch_assoc($result);
								$asgid = $row['asg_id'];
								$asg_name = $row['asg_name'];
								echo "<td><button class='btn bg-light'><a href='adminviewsubmissionireport.php?id=$asgid'>$asg_name</a></b></td>";
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