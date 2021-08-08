<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}

if (isset($_POST['editMenuData'])) {

	$food_name = $_POST['food_name'];
	$food_price = $_POST['food_price'];

	$menuId = $_POST['menuId'];

	$error = "";
	$dbError = "";
	if (empty($food_name) || empty($food_price)) {
		//exit();
		$_SESSION['message'] = "<div class='brownAlert'>Field can not be empty!</div><br>";
		header('location:../Views/edit_menu.php?menuId='.$menuId);
	}else{
		if (!is_numeric($food_price)) {
			$error .= "Menu price should be numeric value!<br>";
		}


		if (!empty($error)) {
			$_SESSION['message'] = "<div class='brownAlert'>".$error."</div>";
		}else{
			$sql1 = "UPDATE food_menu SET food_name='$food_name', food_price='$food_price' WHERE id='$menuId'";
			if (mysqli_query($conn, $sql1)) {
				
				$_SESSION['message'] = "<div class='greenAlert'>Successfully Updated!</div><br>";
			}else{
				$_SESSION['message'] = "<div class='brownAlert'>Menu data update failed!</div><br>";
			}
		}
		header('location:../Views/edit_menu.php?menuId='.$menuId);
	}
}


if (isset($_POST['editMenuPhoto'])) {
	$menuId = $_POST['menuId'];
	$food_name = $_POST['food_name'];

	$photo = $_FILES['photo'];
	$file_extension = pathinfo($photo["name"], PATHINFO_EXTENSION);
   	$allowed = array('png', 'jpg', 'jpeg');
	if (empty($photo['name'])) {
		$_SESSION['message'] = "<div class='brownAlert'>Photo can not be empty!</div><br>";
		//print_r($_POST);
		header('location:../Views/edit_menu.php?menuId='.$menuId);
	}else if (!in_array($file_extension, $allowed)) {
	 	$_SESSION['message'] = "<div class='brownAlert'>Image should be in JPG/PNG format!</div><br>";
	 	header('location:../Views/edit_menu.php?menuId='.$menuId);
	 }else{
		$existsPhotoPath = fetchMenuPhotoById($conn, $menuId);
		
		$unique_image_name = date('d-m-Y')."_".$food_name.".".$file_extension;
	 	$photoSource = $photo['tmp_name'];
		$photoPath = "Uploads/Images/FoodMenu/".$unique_image_name;
		//$_POST['photo'] = $photoPath;

		
		if(move_uploaded_file($photoSource, '../'.$photoPath)){
			if (isset($existsPhotoPath) && !empty($existsPhotoPath)) {
				unlink('../'.$existsPhotoPath);
			}

			if (mysqli_query($conn, "UPDATE food_menu SET photo='$photoPath'WHERE id='$menuId'")) {
				
				$_SESSION['message'] = "<div class='greenAlert'>Photo Successfully Updated!</div><br>";
			}else{
				$_SESSION['message'] = "<div class='brownAlert'>Menu photo update failed!</div><br>";
			}
		}
		header('location:../Views/edit_menu.php?menuId='.$menuId);

	}

}