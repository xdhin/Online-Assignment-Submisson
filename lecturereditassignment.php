<?php
	$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

	if (mysqli_connect_error()){
		die ('Connection ERROR');
	}

	$id = $_GET['id'];
	$sql = "SELECT * FROM assignment WHERE asg_id ='$id'";
	$result = mysqli_query($conn, $sql);	

	if(mysqli_affected_rows($conn)>0) {
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$asgname = $row['asg_name'];
			$asgques = $row['asg_question'];
			$asgdes = $row['asg_description'];
			$asgfile = $row['asg_file'];
			$asgduedate = $row['asg_end_date_time'];
			$asgtotmark = $row['asg_total_marks'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Edit Assignment | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		input[type=datetime-local], select, textarea {
			width: 100%;
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
		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2 class="mb-4">Assignment Modification</h2></center>
			<center><p>Modify the assignment information here.</p></center>

			<form method="POST" action="lecturereditassignmentdtb.php?id=<?php echo $id;?>">
				
				<center><table>
					<tr>
						<th width="50px">Assignment Name:</th>
						<td width="300px">
							<input type="text" id="asgname" name="asgname" value="<?php echo $asgname;?>" required>
						</td>
					</tr>
					<tr>
						<th width="50px">Assignment Question:</th>
						<td width="300px">
							<textarea name="asgques" cols="60" rows="4" id="asgques" required></textarea>
						</td>
					</tr>
					<tr>
						<th width="50px">Assignment Description:</th>
						<td width="300px">
							<textarea name="asgdes" cols="50" rows="4" id="asgdes"  ></textarea>
						</td>
					</tr>
					<tr>
						<th width="50px">Total Mark:</th>
						<td width="300px">
							<input type="text" id="asgtotmark" name="asgtotmark" value="<?php echo $asgtotmark;?>"  required>
						</td>
					</tr>
					<tr>
						<th width="50px">Due Date:</th>
						<td width="300px">
							<input type="text" id="asgduedate" name="asgduedate" value="<?php echo $asgduedate;?>" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<center>
								<input type="submit" value="Update"/>&nbsp;&nbsp;
								<input type="submit" value="Back to Previous Page" formaction="lecturerassignmentdetails.php?id=<?php echo $id ?>"/>
							</center>
						</td>
					</tr>
				</table></center>
			</form>
		</div>
	</div>
	
	<script>
		document.getElementById("asgques").defaultValue = "<?php echo $asgques;?>";
		document.getElementById("asgdes").defaultValue = "<?php echo $asgdes;?>";
		document.getElementById("asgduedate").defaultValue = "<?php echo $asgduedate;?>";
	</script>
	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>