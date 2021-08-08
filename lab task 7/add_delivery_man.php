<?php
session_start();
require_once '../Models/config.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Delivery Man</title>

</head>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Add Delivery Man
				</h1>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php include_once 'includes/topbar.php'; ?>
			</td>
		</tr>
		<tr height="360px">
			<td width="25%">
				<?php include_once 'includes/sidebar.php'; ?>
			</td>
			<td align="center" bgcolor="cadetblue">
				<div id="message"></div>
				<?php if(isset($_SESSION['message']) && !empty($_SESSION['message']))echo $_SESSION['message']."<br>"; unset($_SESSION['message']); ?>
				<table width="100%" cellpadding="6">

				<form action="../Controller/addDeliveryMan.php" method="post" onsubmit="return admins()">
					<tr>
						<td width="10%">
							User Name
						</td>
						<td>
							<input type="text" name="username" size="50">
						</td>
						<td>
							Password
						</td>
						<td>
							<input type="text" name="password" size="50">
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" size="50">
						</td>
						<td>
							E-mail
						</td>
						<td>
							<input type="text" name="email" size="50">
						</td>
					</tr>
					<tr>
						<td colspan="4" align="right"><hr>
							<input type="submit" name="addDeliveryMan" value="Add Delivery Man">
						</td>
					</tr>
				</form>
				</table>
				<br>
				
			</td>
		</tr>
		<tr>
			<td height="65px" bgcolor="dimgray" colspan="3">
				<center>Copyright &copy; Rimi</center>
			</td>
		</tr>
	</table>
<script type="text/javascript">
	function admins() {
		var username = document.getElementsByName('username')[0].value.trim();
		var password = document.getElementsByName('password')[0].value.trim();
		var name = document.getElementsByName('name')[0].value.trim();
		
		var email = document.getElementsByName('email')[0].value.trim();

		if (username.length==0 || password.length==0 || name.length==0 || email.length==0) {
			document.getElementById('message').innerHTML = "<div class='brownAlert'>*Required field is empty! Here every field is required!</div>";
			return false;
		}else if (!emailBreakdown(email)) {
			document.getElementById('message').innerHTML = "<div class='brownAlert'>*Invalid email format!</div>";
			return false;
		}else{
			return true;
		}
	}
</script>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>