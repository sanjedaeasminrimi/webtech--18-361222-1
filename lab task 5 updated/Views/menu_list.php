<?php
session_start();
require_once '../Models/config.php';
require_once '../Models/modelFunction.php';

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['userType']) || ($_SESSION['logged_in']!=1) || ($_SESSION['userType']!='admin')) {
	header('location:../index.php');
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Food Menu List</title>
</head>
<body bgcolor="aqua">
	<table border="1" width="100%" cellpadding="10">
		<tr>
			<td align="center" colspan="2" bgcolor="dimgray">
				<h1>
					Food Menu List
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
				<table width="100%">
					<tr>
						<td align="right">
							<input type="text" name="search" placeholder="Search.." onkeyup="fetchFoodByName(this.value)" >
						</td>
					</tr>
				</table><br>
				<div id="dataTable">
					
				</div>
				<table width="100%" border="1" cellpadding="5" id="mainTable">
					<tr>
						<th width="1%">Sl. No</th>
						<th width="9%">Image</th>
						<th width="50%">Food Name</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
			<?php
			$foodDatas = fetchFoodMenu($conn);
			// print_r(fetchTeachers($conn));
			// exit();
			$i=0;
			if (count($foodDatas)==0) {
				echo "<tr><td colspan='9' align='center'>No food menu found...</td></tr>";
			}
			foreach ($foodDatas as $foodData) {
			?>
					<tr>
						<td><?=++$i?></td>
						<td><img width="100px" src="../<?=$foodData['photo']?>"></td>
						<td><?=$foodData['food_name']?></td>
						<td><?=$foodData['food_price']?> Tk.</td>
						<td>[<a href="edit_menu.php?menuId=<?=$foodData['id']?>">Edit</a>] [<a href="../Controller/delete_menu.php?menuId=<?=$foodData['id']?>">Delete</a>]</td>
					</tr>
					<?php } ?>
				</table>
			</td>
		</tr>
		<tr>
			<td height="65px" bgcolor="dimgray" colspan="3">
				<center>Copyright &copy; Rimi</center>
			</td>
		</tr>
	</table>
<script type="text/javascript">
	function fetchFoodByName(foodName) {
		if (foodName.trim().length!=0) {
			xhttp = new XMLHttpRequest();
			xhttp.open("POST", "../Controller/fetchDataUsingAjax.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("foodName="+foodName);

			xhttp.onreadystatechange = function() {
		      if(this.readyState == 4 && this.status == 200){
		      	//alert(email);
		      	var jsonData = JSON.parse(this.responseText);
		      	//console.log(jsonData.Data);
		      	
		      	if (jsonData.success==true) {
		      		var dataTable = tableHeader();
		      		if (jsonData.have==true) {
		      			var x=0;
		      			for(i in jsonData.Data){
		      				//alert(jsonData.Data[i].username);
			      			dataTable += "<tr><td>"+(++x)+"</td>"+
			      						"<td><img width='100px' src='../"+jsonData.Data[i].photo+"'></td>"+
			      						"<td>"+jsonData.Data[i].food_name+"</td>"+
			      						"<td>"+jsonData.Data[i].food_price+" Tk.</td>"+
			      						'<td>[<a href="edit_menu.php?menuId='+jsonData.Data[i].id+'">Edit</a>] [<a href="../Controller/delete_menu.php?menuId='+jsonData.Data[i].id+'">Delete</a>]</td></tr></table>';

			      		}

		      		}else{
		      			dataTable +="<tr><td colspan='5'>"+jsonData.Data+"</td></tr></table>";
		      		}
		      		document.getElementById('mainTable').style = "display:none;";
		      		document.getElementById('dataTable').innerHTML = dataTable;
		      		document.getElementById('dataTable').style = "display:block;";
					
		      	}else{
		      		alert('Wrong....');
		      	}
					//returnFunc(jsonData.success);
				}
		    }
		}else{
			document.getElementById('dataTable').style = "display:block;";
			document.getElementById('ajaxData').style = "display:none;";
			document.getElementById('mainTable').style = "display:block;";
		}
		
	}


	function tableHeader() {
		var head = "<table width='100%' border='1' cellpadding='5' id='ajaxData'>"+
		      		"<tr>"+
						"<th width='1%'>Sl. No</th>"+
						"<th width='9%'>Image</th>"+
						"<th width='50%'>Food Name</th>"+
						"<th>Price</th>"+
						"<th>Action</th>"+
					"</tr>";
		return head;
	}
</script>
</body>
</html>