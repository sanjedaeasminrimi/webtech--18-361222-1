<?php
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

session_start();
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) ||  $_SESSION['logged_in']!=1 || $_SESSION['userType']!='admin'){
	header('location:../index.php');
	exit();
}

if (isset($_POST['addAdmin'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];

	if (empty($name) || empty($email) || empty($username) || empty($password)) {
		$_SESSION['message'] = "<div class='brownAlert'>Field can not be empty!</div><br>";
		header('location:../Views/admins.php');
	}else if (emailExists($conn, $email)) {
		$_SESSION['message'] = "<div class='brownAlert'>Email already exists!</div><br>";
		header('location:../Views/admins.php');
	}else if (usernameExists($conn, $username)) {
		$_SESSION['message'] = "<div class='brownAlert'>This username already exists! Try another one</div><br>";
		header('location:../Views/admins.php');
	} else{
		if (addAdmin($conn, $_POST)) {
			$_SESSION['message'] = "<div class='greenAlert'>New admin successfully Added!</div><br>";
		}else{
			$_SESSION['message'] = "<div class='brownAlert'>Opps! Error occured with database during insertion!</div><br>";
			
		}
		header('location:../Views/admins.php');
	}
}