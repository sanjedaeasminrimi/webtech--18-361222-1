<?php
session_start();
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) ||  ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

$userId = $_SESSION['userId'];
//For Profile data change
if (isset($_POST['changeProfile'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	if (empty($name) || empty($email)) {
		$_SESSION['message'] = "<div class='brownAlert'>Name and Email can not be empty!</div><br>";
	}else{

		if (editAdminData($conn, $_POST, $userId)) {
			$_SESSION['message'] = "<div class='greenAlert'>Profile data successfully changed!</div><br>";
			header("location:../Views/edit_profile.php");
		}else{
			$_SESSION['message'] = "<div class='brownAlert' >Opps! Error occured with database during update!</div><br>";
			header("location:../Views/edit_profile.php");
		}
	}
	
}

//For Password Change
if (isset($_POST['changePassword'])) {
	$currentPassword = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];
	$newPassword2 = $_POST['newPassword2'];


	$userData = viewAdmin($conn, $userId);

	if (empty($currentPassword) || empty($newPassword) || empty($newPassword2)) {
		$_SESSION['message'] = "<div class='brownAlert'>During password change field should not be empty!</div><br>";
	}else if ($newPassword != $newPassword2) {
		$_SESSION['message'] = "<div class='brownAlert'>New Password and Again New Password not matched!</div><br>";
	}else if ($currentPassword!=$userData['password']) {
		$_SESSION['message'] = "<div class='brownAlert'>Current Password was wrong</div><br>";
	}else{
		if (editAdminPassword($conn, $password, $userId)) {
			$_SESSION['message'] = "<div class='greenAlert' >Password successfully changed!</div><br>";
		}else{
			$_SESSION['message'] = "<div class='brownAlert' >Opps! Error occured with database during update!</div><br>";
		}
	}
	header("location:../Views/edit_profile.php");
}