<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) ||  $_SESSION['logged_in']!=1) {
	header('location:../index.php');
	exit();
}

$userId = $_SESSION['userId'];

$userData = viewAdmin($conn, $userId);

//$message = "";



?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
</head>
<style type="text/css">
</style>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Edit Profile
				</h1>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php include_once 'includes/topbar.php'; ?>
			</td>
		</tr>
		<tr height="450px">
			<td width="25%">
				<?php include_once 'includes/sidebar.php'; ?>
			</td>
			<td align="center" bgcolor="cadetblue">
				<div id="message"></div>
				<?php if(isset($_SESSION['message'])) echo $_SESSION['message'];
				unset($_SESSION['message']); ?>
				<table width="60%" border="1" cellpadding="6">
					<tr>
						<th align="center" colspan="2">
							Profile Change
						</th>
					</tr>
				<form action="../Controller/change_account.php" method="post" onsubmit="return editProfile()">
					<tr>
						<td width="25%">
							User Name
						</td>
						<td>
							<input type="text" size="50" disabled value="<?=$userData['username']?>">
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" size="50" value="<?=$userData['name']?>">
						</td>
					</tr>
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<input type="text" name="email" size="50" value="<?=$userData['email']?>">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="submit" name="changeProfile" value="Change Profile">
						</td>
					</tr>
				</form>
					<tr>
						<th colspan="2" align="center">
							Change Password
						</th>
					</tr>
					<tr>
						<td colspan="2">
							<form action="../Controller/change_account.php" method="post" onsubmit="return editPass()">
								<table width="100%" cellpadding="3">
									<tr>
										<td>
											Current Password
										</td>
										<td>
											<input type="password" name="currentPassword" size="50">
										</td>
									</tr>
									<tr>
										<td>
											New Password
										</td>
										<td>
											<input type="password" name="newPassword" size="50">
										</td>
									</tr>
									<tr>
										<td>
											Again New Password
										</td>
										<td>
											<input type="password" name="newPassword2" size="50">
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right">
											<input type="submit" name="changePassword" value="Change Password">
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right" height="30">
							<a href="profile.php">View Profile</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="65px" bgcolor="dimgray" colspan="3">
				<center>Copyright &copy; Rimi</center>
			</td>
		</tr>
	</table>
<script type="text/javascript">
	function editPass() {
		var currentPassword = document.getElementsByName('currentPassword')[0].value.trim();
		var newPassword = document.getElementsByName('newPassword')[0].value.trim();
		var newPassword2 = document.getElementsByName('newPassword2')[0].value.trim();
		if (currentPassword.length==0 || newPassword.length==0 || newPassword2.length==0) {
			document.getElementById('message').innerHTML = "<div class='brownAlert' style='top: -48px;'>*Required field is empty! Here every password field is required!</div>";
			return false;
		}else{
			return true;
		}
	}
	function editProfile() {
		var name = document.getElementsByName('name')[0].value.trim();
		var email = document.getElementsByName('email')[0].value.trim();
		if (name.length==0 || email.length==0 ) {
			document.getElementById('message').innerHTML = "<div class='brownAlert' style='top: -48px;'>*Required field is empty! Here every password field is required!</div>";
			return false;
		}else{
			return true;
		}
	}
</script>
</body>
</html>