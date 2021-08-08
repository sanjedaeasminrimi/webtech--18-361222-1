<link rel="stylesheet" type="text/css" href="assets/css/style.css?click=<?=rand()?>">

<table width="100%">
	<tr>
		<td align="left">
			[ <a href="dashboard.php">Dashboard</a> ] | [ <a href="../Views/admins.php">See Another Admins</a> ]
		</td>
		<td align="right">
			Welcome, <a href="profile.php"><?=$_SESSION['name']?></a> [<?php if($_SESSION['userType']=='admin')echo"Admin";?>] | <a href="../Controller/logout.php">Logout</a>
		</td>
	</tr>
</table>
