<?php  
require_once 'model.php';


if (isset($_POST['AddProduct'])) {
	$data['name'] = $_POST['name'];
	$data['buyingprice'] = $_POST['buyingprice'];
	$data['sellingprice'] = $_POST['sellingprice'];

  if (addproduct($data)) {
  	echo 'Successfully added!!';
  }
} else {
	echo 'You are not allowed to access this page.';
}

?>