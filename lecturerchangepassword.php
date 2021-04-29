<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'onlineassignmentsubmission');

if (mysqli_connect_error()){
	die ('Connection ERROR');
}
$id = $_GET['id'];
if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT * FROM lecturer WHERE lec_id='$id'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["lec_password"]) {
        mysqli_query($conn, "UPDATE lecturer set lec_password='" . $_POST["newPassword"] . "' WHERE lec_id='$id'");
        echo "<script>alert('Password Changed!');</script>";
		echo "<script>window.location.href='lecturerprofile.php';</script>";
    } else
        $message = "Current Password is not correct!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="images/favicon.png" />
	<title>Change Password | APU Online Assignment Submission System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<script>
		function validatePassword() {
		var currentPassword,newPassword,confirmPassword,output = true;

		currentPassword = document.frmChange.currentPassword;
		newPassword = document.frmChange.newPassword;
		confirmPassword = document.frmChange.confirmPassword;

		if(!currentPassword.value) {
			currentPassword.focus();
			document.getElementById("currentPassword").innerHTML = "This column is required.";
			output = false;
		}
		else if(!newPassword.value) {
			newPassword.focus();
			document.getElementById("newPassword").innerHTML = "This column is required.";
			output = false;
		}
		else if(!confirmPassword.value) {
			confirmPassword.focus();
			document.getElementById("confirmPassword").innerHTML = "This column is required.";
			output = false;
		}
		if(newPassword.value != confirmPassword.value) {
			newPassword.value="";
			confirmPassword.value="";
			newPassword.focus();
			document.getElementById("confirmPassword").innerHTML = "New Passwords are not same..";
			output = false;
		} 	
		return output;
		}
</script>
<body>
	<?php
		session_start();
		if(!isset($_SESSION['login'])){
			echo '<script>alert ("You are not logged in. Please login to enter the main page.")</script>';
			echo '<script>window.location.href="studentlogin.html"</script>';
		}
	?>
	<div class="wrapper d-flex align-items-stretch">
		<div id="content" class="p-4 p-md-5 pt-5">
			<center><h2 class="mb-4">Change Password</h2></center>
			<center><form name="frmChange" method="post" action="lecturerchangepassword.php?id=<?php echo $id;?>" onSubmit="return validatePassword()">
        <div style="width: 500px;">
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
            <table border="0" cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="password" name="currentPassword" class="txtField" />
						<span id="currentPassword" class="required"></span>
					</td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPassword" class="txtField" />
						<span id="newPassword" class="required"></span>
					</td>
                </tr>
				<tr>
					<td><label>Confirm Password</label></td>
					<td><input type="password" name="confirmPassword" class="txtField" />
						<span id="confirmPassword" class="required"></span>
					</td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="submit" name="submit" value="Submit" class="btnSubmit"></center></td>
                </tr>
            </table>
        </div>
    </form></center>
		</div>
	</div>
	
	
	<script src="js/mainjquery.min.js"></script>
	<script src="js/mainpopper.js"></script>
	<script src="js/mainbootstrap.min.js"></script>
	<script src="js/main2.js"></script>
</body>
</html>