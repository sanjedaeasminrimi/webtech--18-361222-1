<?php
require_once '../Models/config.php';

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1) {
	header('location: ../Views/dashboard.php');
	exit();
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($username) || empty($password)) {
		$_SESSION['error'] = "<font color='red'>Required field is empty</font><br>";
	}else{
		$query=mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' AND password='$password'");

		 if(mysqli_num_rows($query)>=1)
		   {
		   		$user= mysqli_fetch_assoc($query);

			    $_SESSION['userId'] = $user['id'];
			    $_SESSION['name'] = $user['name'];
				
				$_SESSION['userType'] = "admin";
				$_SESSION['logged_in'] = 1;

				if (isset($_POST['save'])) {
					setcookie('username', $username, time() + (86400 * 30), "/");
					setcookie('password', $password, time() + (86400 * 30), "/");
				}else{
					unset($_COOKIE['username']);
					unset($_COOKIE['password']);
				}
				//exit(print_r($_SESSION));
				header('location:../Views/dashboard.php');
		   }else{
		   		$_SESSION['error'] = '<font color="red">Admin with this username and password doesn\'t exists!</font><br>';
		   		header('location:../index.php');
		   }
			
			
		
	}
}