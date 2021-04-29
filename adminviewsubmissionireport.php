<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment WHERE asg_id=$id";
	$result = mysqli_query($conn, $sql);	
	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$asg = $row['asg_name'];
			$intakemodule = $row['intake_module_id'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title><?php echo $asg; ?> | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		.alnright { text-align: right; }
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
		<div id="content" class="p-4 p-md-5 pt-5">
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}

				$id = $_GET['id'];
				$sql = "SELECT n.intake_module_id, n.intake_id, n.module_id, n.lec_id, i.intake_id, i.intake_name, m.module_id, m.module_name, l.lec_id, l.lec_name, a.asg_id, a.intake_module_id, a.asg_name
						FROM intake_module AS n
						INNER JOIN intake AS i
						ON n.intake_id = i.intake_id
						INNER JOIN module AS m
						ON n.module_id = m.module_id
						INNER JOIN lecturer AS l
						ON n.lec_id = l.lec_id
						INNER JOIN assignment AS a
						ON a.intake_module_id = n.intake_module_id
						WHERE asg_id=$id";
				$result = mysqli_query($conn, $sql);	
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						$intakeid=$row['intake_id'];
						$moduleid=$row['module_id'];
						$modulename=$row['module_name'];
						$lec=$row['lec_name'];
						$asgname=$row['asg_name'];
						echo "<h2 class='mb-4'>$intakeid</h2>";
						echo "<p><b>Intake Code: </b>$intakeid<br>";
						echo "<b>Module Code: </b>$moduleid<br>";
						echo "<b>Module Name: </b>$modulename<br>";
						echo "<b>Lecturer: </b>$lec<br></p>";
						echo "<b>Assignment: </b>$asgname<br>";
					}
				}
			?>
			<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}

				$id = $_GET['id'];
				echo "<table class='table table-sm table-sm'>";
				echo "<tr>";
				echo "<th width='10%'>Student ID</th>";
				echo "<th width='30%'>Student Name</th>";
				echo "<th width='15%'>Submission Name</th>";
				echo "<th width='15%'>Submission Date</th>";
				echo "<th width='10%'>Submission Status</th>";
				echo "</tr>";
				$sql = "SELECT s.sub_id, s.sub_name, s.sub_date_time, s.sub_status, s.asg_id, s.std_id, d.std_id, d.std_name 
						FROM submission AS s
						INNER JOIN student AS d
						ON s.std_id = d.std_id
						WHERE asg_id=$id";
				$result = mysqli_query($conn, $sql);	
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo "<tr>";
						echo "<td>".$row['std_id']."</td>";
						echo "<td>".$row['std_name']."</td>";
						echo "<td>".$row['sub_name']."</td>";
						echo "<td>".$row['sub_date_time']."</td>";
						echo "<td>".$row['sub_status']."</td>";
						echo "</tr>";
					}
				}
			?>
			<tr>
				<th colspan="4" class='alnright'>Total Submission of the Assignment: </th>
				<?php
				$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

				if (mysqli_connect_error()){
					die ('Connection ERROR');
				}      
				
				$sql = "SELECT COUNT(sub_id) AS tot
						FROM submission
						WHERE asg_id=$id";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_affected_rows($conn)>0) {
					for($i = 0; $i < mysqli_num_rows($result); $i++){
						$row = mysqli_fetch_assoc($result);
						echo '<th>'.$row['tot'].'</th>';
					}
				}
				?>
				
			</tr>
		</div>
	</div>

	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>