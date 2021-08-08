<?php
session_start();
require_once 'Models/config.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1) {
	header('location: Views/dashboard.php');
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Restaurent Management System</title>
</head>
<body bgcolor="#00ffff">
	<center>
		<h1>Restaurent Management System</h1>
		<hr>
	</center>
	
	
	<form action="Controller/login_admin.php" method="post">
		<center>
		<table border="1" width="90%">
			<tr>
				<td bgcolor="dimgray">
					<h2 align="center">Login Panel</h2>
				</td>
			</tr>
			<tr height="380px">
				<td align="center">
					<center><b><?php if(isset($_SESSION['error']) && !empty($_SESSION['error']))echo $_SESSION['error']."<br>"; ?></b></center>			
					<table width="50%" cellpadding="7">
						<tr>
							<th align="left">
								User Name
							</th>
							<td>
								<input type="text" size="50" name="username" value="<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username'];?>">
							</td>
						</tr>
						<tr>
							<th align="left">
								Password
							</th>
							<td>
								<input type="password" size="50" name="password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password'];?>">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label><input type="checkbox" name="save" <?php if (isset($_COOKIE['save'])) echo "checked";?> > Remember Me</label><br>
								<hr>
						    <center>
						    	<input type="submit" name="login" value="Login">
						    </center>
							</td>
						</tr>
					</table>							  
				</td>
			</tr>
			<tr>
				<td height="65px" bgcolor="dimgray">
					<center>Copyright &copy; Rimi</center>
				</td>
			</tr>
		</table>
		</center>
	</form>
</body>
</html>