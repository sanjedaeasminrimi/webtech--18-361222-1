<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}

if (isset($_POST['addMenu'])) {

	
	$food_name = $_POST['food_name'];
	$food_price = $_POST['food_price'];

	$photo = $_FILES['photo'];

	$error = "";
	$dbError = "";
	if (empty($food_name) || empty($food_price) || empty($photo['name'])) {
		//exit();
		$_SESSION['message'] = "<div class='brownAlert'>Field can not be empty!</div><br>";
		//print_r($photo);
		header('location:../Views/add_menu.php');
	}else {

		if (menuItemExists($conn, $food_name)) {
			$error .= "This menu already exits!<br>";
		}

		if (!is_numeric($food_price)) {
			$error .= "Invalid food price format! It should be numeric value<br>";
		}


		// Get image file extension
   		 $file_extension = pathinfo($photo["name"], PATHINFO_EXTENSION);
   		 $allowed = array('png', 'jpg', 'jpeg');
   		 if (!in_array($file_extension, $allowed)) {
   		 	$error .= "Image should be in JPG/PNG format!<br>";
   		 }

   		 if (!empty($error)) {
   		 	$_SESSION['message'] = "<div class='brownAlert'>".$error."</div>";
   		 }else{
   		 		$unique_image_name = date('d-m-Y')."_".$food_name.".".$file_extension;
   		 		$photoSource = $photo['tmp_name'];
				$photoPath = "Uploads/Images/FoodMenu/".$unique_image_name;
				$_POST['photo'] = $photoPath;

				if (addFoodMenu($conn, $_POST)) {
					move_uploaded_file($photoSource, '../'.$photoPath);
					$_SESSION['message'] = "<div class='greenAlert'>Menu item added successfully!</div><br>";
				}else{
					$_SESSION['message'] = "<div class='brownAlert'>Failed to add menu in database!</div><br>";
				}
   		 	
   		 }
   		 header('location:../Views/add_menu.php');
	}

}