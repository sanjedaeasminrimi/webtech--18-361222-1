<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1)) {
	header('location:../index.php');
	exit();
}

$userId = $_SESSION['userId'];

$userData = viewAdmin($conn,$userId);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pofile</title>
</head>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Profile
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
				<table width="60%" border="1" cellpadding="6">
					<tr>
						<td>
							User Name
						</td>
						<td>
							<?=$userData['username']?>
						</td>
					</tr>
					<tr>
						<td>
							Name
						</td>
						<td>
							<?=$userData['name']?>
						</td>
					</tr>
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<?=$userData['email']?>
						</td>
					</tr>
					
					<tr>
						<td colspan="2" align="right" height="30">
							<a href="edit_profile.php">Edit Profile</a>
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

</body>
</html>