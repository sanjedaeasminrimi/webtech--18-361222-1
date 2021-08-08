<?php
@session_start();
//require_once '../DB/config.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}

function addAdmin($conn, $data)
{
	$username = $data['username'];
	$password = $data['password'];
	$email = $data['email'];
	$name = $data['name'];
	$q1 = "INSERT INTO admins (username, password, email, name) VALUES ('$username','$password','$email','$name')";
	if (mysqli_query($conn, $q1)) {
		return true;
	}
	return false;
}

function editAdminData($conn, $data, $userId)
{
	$q1 = "update admins set name='".$data['name']."', email='".$data['email']."' where id='$userId'";
	if (mysqli_query($conn, $q1)){
		return true;
	}
	return false;
}

function editAdminPassword($conn, $password,$userId)
{
	$q1 = "update admins set password='$password' where id='$userId'";
	if (mysqli_query($conn, $q1)){
		return true;
	}
	return false;
}

function viewAdmin($conn, $userId)
{
	$query = mysqli_query($conn, "SELECT * FROM admins WHERE id='$userId'");
	return mysqli_fetch_assoc($query);
}


function managerEmailExists($conn, $email)
{
	$q1 = "SELECT email FROM managers WHERE email='$email'";
	$result = mysqli_query($conn, $q1);
	if (mysqli_num_rows($result)>0) {
		return true;
	}
	return false;
}

function managerUsernameExists($conn, $username)
{
	$q1 = "SELECT username FROM managers WHERE username='$username'";
	$result = mysqli_query($conn, $q1);
	if (mysqli_num_rows($result)>0) {
		return true;
	}
	return false;
}

function addManager($conn, $data)
{
	$username = $data['username'];
	$password = $data['password'];
	$email = $data['email'];
	$name = $data['name'];
	$q1 = "INSERT INTO managers (username, password, email, name) VALUES ('$username','$password','$email','$name')";
	if (mysqli_query($conn, $q1)) {
		return true;
	}
	return false;
}

function updatePassword($conn, $tableName, $password, $userId)
{
	$sql1 = "UPDATE $tableName SET password='$password' WHERE id='$userId'";
	if (mysqli_query($conn, $sql1)){
		return true;
	}
	return false;
}

function fetchManager($conn, $userId=null)
{
	if ($userId) {
		$query = mysqli_query($conn, "SELECT * FROM managers WHERE id='$userId'");
		return mysqli_fetch_assoc($query);
	}
	$q1 = "SELECT * FROM managers";
	$result = mysqli_query($conn, $q1);
	$datas = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$datas[] = $rows;
	}
	return $datas;
}

function addDeliveryMan($conn, $data)
{
	$username = $data['username'];
	$password = $data['password'];
	$email = $data['email'];
	$name = $data['name'];
	$q1 = "INSERT INTO delivery_man (username, password, email, name) VALUES ('$username','$password','$email','$name')";
	if (mysqli_query($conn, $q1)) {
		return true;
	}
	return false;
}

function fetchDeliveryMan($conn, $userId=null)
{
	if ($userId) {
		$query = mysqli_query($conn, "SELECT * FROM delivery_man WHERE id='$userId'");
		return mysqli_fetch_assoc($query);
	}
	$q1 = "SELECT * FROM delivery_man";
	$result = mysqli_query($conn, $q1);
	$datas = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$datas[] = $rows;
	}
	return $datas;
}


function emailExists($conn, $email)
{
	$q1 = "SELECT email FROM admins WHERE email='$email'";
	$result = mysqli_query($conn, $q1);
	if (mysqli_num_rows($result)>0) {
		return true;
	}
	return false;
}


function menuItemExists($conn, $food_name)
{
	$q1 = "SELECT food_name FROM food_menu WHERE food_name='$food_name'";
	$result = mysqli_query($conn, $q1);
	if (mysqli_num_rows($result)>0) {
		return true;
	}
	return false;
}

function addFoodMenu($conn, $data)
{

	$q1 = "INSERT INTO food_menu (food_name, food_price, photo) VALUES ('".$data['food_name']."','".$data['food_price']."','".$data['photo']."')";
	if (mysqli_query($conn, $q1)) {
		return true;
	}
	return false;
}

function fetchFoodMenu($conn, $menuId=null)
{
	if ($menuId) {
		$query = mysqli_query($conn, "SELECT * FROM food_menu WHERE id='$menuId'");
		return mysqli_fetch_assoc($query);
	}
	$q1 = "SELECT * FROM food_menu";
	$result = mysqli_query($conn, $q1);
	$datas = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$datas[] = $rows;
	}
	return $datas;
}

function fetchFoodMenuByName($conn, $menuName)
{
	$query = mysqli_query($conn, "SELECT * FROM food_menu WHERE food_name LIKE '%$menuName%'");
	$datas = array();
	$data = array();
	while ($rows = mysqli_fetch_assoc($query)) {
		$data['id'] = $rows['id'];
		$data['food_name'] = $rows['food_name'];
		$data['food_price'] = $rows['food_price'];
		$data['photo'] = $rows['photo'];
		$datas[]=$data;
	}
	return $datas;
}


 function fetchMenuPhotoById($conn, $menuId)
{
	$query = mysqli_query($conn, "SELECT photo FROM food_menu WHERE id='$menuId'");
	$menu = mysqli_fetch_assoc($query);
	return $menu['photo'];
}

function fetchMenuNameById($conn, $menuId)
{
	$query = mysqli_query($conn, "SELECT food_name FROM food_menu WHERE id='$menuId'");
	$menu = mysqli_fetch_assoc($query);
	return $menu['food_name'];
}

function fetchMenuPriceById($conn, $menuId)
{
	$query = mysqli_query($conn, "SELECT food_price FROM food_menu WHERE id='$menuId'");
	$menu = mysqli_fetch_assoc($query);
	return $menu['food_price'];
}


function fetchOrders($conn, $orderId=null)
{
	if ($orderId) {
		$query = mysqli_query($conn, "SELECT * FROM orders WHERE id='$orderId'");
		return mysqli_fetch_assoc($query);
	}
	$q1 = "SELECT * FROM orders";
	$result = mysqli_query($conn, $q1);
	$datas = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$datas[] = $rows;
	}
	return $datas;
}


function updateShippingAddress($conn, $data)
{
	$q1="UPDATE orders SET shipping_address='".$data['shipping_address']."' WHERE id='".$data['orderId']."'";
	if (mysqli_query($conn, $q1)) {
		return true;
	}
	return false;
}

function fetchDelivery($conn)
{
	$q1 = "SELECT * FROM delivery";
	$result = mysqli_query($conn, $q1);
	$datas = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$datas[] = $rows;
	}
	return $datas;
}