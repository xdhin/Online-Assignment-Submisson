<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment WHERE asg_id =$id";
	$result = mysqli_query($conn, $sql);	

	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$intakemodule = $row['intake_module_id'];
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Add Assignment | APU Online Assignment Submission System</title>
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
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
		}
		input[type=datetime-local], select, textarea {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
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
				}
			}
		?>
		
		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2>Add Submission</h2>
			<p>Fill up the form below.</p></center>
			<div class="container">
				<form method="POST" action="studentsubmitassignmentdtb.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
					<label for="subname">Submission Name</label>
					<input type="text" id="subname" name="subname" placeholder="Enter the Submission Name" required>
					
					<label for="subfile">Submission File</label><br>
					<input type="file" id="subfile" name="subfile" placeholder="Upload the File you want to submit." required><br><br>
					
					<center><input type="submit" name="upload" value="Submit"><br><br>
					<h6><a href="studentassignmentdetails.php?id=<?php echo $id; ?>">Back to Previous Page</a></h6></center>
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
