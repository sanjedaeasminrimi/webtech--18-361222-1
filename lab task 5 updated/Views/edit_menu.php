<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}
if (!isset($_GET['menuId']) || empty($_GET['menuId'])) {
	header('location: menu_list.php');
	exit();
}
$menuData = fetchFoodMenu($conn, $_GET['menuId']);
if (empty($menuData)) {
	header('location: menu_list.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Menu</title>

</head>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Edit Menu
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
				<div id="message"></div>
				<?php if(isset($_SESSION['message']) && !empty($_SESSION['message']))echo $_SESSION['message']."<br>"; unset($_SESSION['message']); ?>
				<table width="100%" cellpadding="6">

				<form action="../Controller/editMenu.php" method="post" onsubmit="return foodMenu()">
					<tr>
						<td colspan="4">
							<img src="../<?=$menuData['photo']?>" width="300px">
						</td>
					</tr>
					<tr>
						<td width="10%">
							Food Name
						</td>
						<td>
							<input type="text" name="food_name" value="<?=$menuData['food_name']?>" size="50">
						</td>
						<td>
							Price
						</td>
						<td>
							<input type="text" name="food_price" value="<?=$menuData['food_price']?>" size="50">
						</td>
					</tr>
					<tr>
						<td colspan="4" align="right"><hr>
							<input type="hidden" name="menuId" value="<?=$menuData['id']?>">
							<input type="submit" name="editMenuData" value="Edit Menu Item">
						</td>
					</tr>
				</form>
				<form action="../Controller/editMenu.php" method="post" enctype="multipart/form-data">
					<tr>
						<td>
							Upload menu Image
						</td>
						<td>
							<input type="file" name="photo" accept="image/*">
						</td>
						<td colspan="2">
							<input type="hidden" name="food_name" value="<?=$menuData['food_name']?>">
							<input type="hidden" name="menuId" value="<?=$menuData['id']?>">
							<input type="submit" name="editMenuPhoto" value="Change Image">
						</td>
					</tr>
				</form>
				</table>
				<br>
				
			</td>
		</tr>
		<tr>
			<td height="65px" bgcolor="dimgray" colspan="3">
				<center>Copyright &copy; Rimi</center>
			</td>
		</tr>
	</table>
<script type="text/javascript">
	function foodMenu() {
		var food_name = document.getElementsByName('food_name')[0].value.trim();
		var food_price = document.getElementsByName('food_price')[0].value.trim();
		//var photo = document.getElementsByName('photo')[0].files;

		if (food_name.length==0 || food_price.length==0) {
			document.getElementById('message').innerHTML = "<div class='brownAlert'>*Required field is empty! Here every field is required!</div>";
			return false;
		}/*else if (photo.length==0) {
			document.getElementById('message').innerHTML = "<div class='brownAlert'>*Photo is required!</div>";
			return false;
		}*/else{
			return true;
		}
	}
</script>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>