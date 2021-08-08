<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1)) {
	header('location:../index.php');
	exit();
}
$response = array('success'=>false);
if (isset($_POST['foodName'])) {
	$foodName = trim($_POST['foodName']);
	$menuData = fetchFoodMenuByName($conn, $foodName);
	if (count($menuData)==0) {
		$response['Data'] = 'No data found..';
		$response['have'] = false; 
		$response['success'] = true; 
		echo json_encode($response);
	}else{
		$response['Data']=$menuData;
		$response['success']=true;
		$response['have'] = true; 
		echo json_encode($response);
	}
}