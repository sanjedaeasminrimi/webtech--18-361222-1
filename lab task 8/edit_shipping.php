<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}
if (!isset($_GET['orderId']) || empty($_GET['orderId'])) {
	header('location: orders.php');
	exit();
}
$orderData = fetchOrders($conn, $_GET['orderId']);
if (empty($orderData)) {
	header('location: orders.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Details</title>
</head>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Shipping Details
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
				<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?>
				<form action="../Controller/editShipping.php" method="post" onsubmit="return shipping();">
				<table width="100%" border="1" cellpadding="5" id="mainTable">
					<tr>
						<th>Order date</th>
						<td><?=$orderData['order_date']?></td>
					</tr>
					<tr>
						<th>Customer Name</th>
						<td><?=$orderData['customer_name']?></td>
					</tr>
					<tr>
						<th>Shipping Address</th>
						<td><?=$orderData['shipping_address']?></td>
					</tr>
					<tr>
						<th>Menu</th>
						<td><?=fetchMenuNameById($conn, $orderData['menu_id'])?></td>
					</tr>
					<tr>
						<th>Quantity</th>
						<td><?=$orderData['quantity']?></td>
					</tr>
					<tr>
						<th>Total Price</th>
						<td><?=(fetchMenuPriceById($conn, $orderData['menu_id'])*$orderData['quantity'])?> Tk.</td>
					</tr>
					<tr>
						<td colspan="2">Update Shipping Address</td>
					</tr>
				
					<tr>
				
						<td>
							<textarea name="shipping_address" cols="50" rows="3"><?=$orderData['shipping_address']?></textarea>
						</td>
						<td>
							<input type="hidden" name="orderId" value="<?=$orderData['id']?>">
							<input type="submit" name="updateShipping" value="Update Shipping">
						</td>
				
					</tr>
				
				</table>
				</form>
			</td>
		</tr>
		<tr>
			<td height="65px" bgcolor="dimgray" colspan="3">
				<center>Copyright &copy; Rimi</center>
			</td>
		</tr>
	</table>

	<script type="text/javascript">
	function shipping() {
		var shipping_address = document.getElementsByName('shipping_address')[0].value.trim();
		//var photo = document.getElementsByName('photo')[0].files;

		if (shipping_address.length==0 ) {
			document.getElementById('message').innerHTML = "<div class='brownAlert'>*Shipping address field is required!</div>";
			return false;
		}else{
			return true;
		}
	}
</script>
</body>
</html>