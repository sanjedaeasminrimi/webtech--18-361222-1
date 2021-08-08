<?php if($_SESSION['userType']=='admin'){?>
				<ul id="sideBar">
					<li>
						<a href="add_manager.php">Add Manager</a>
					</li>
					<li>
						<a href="manager_list.php">Managers List</a>
					</li>
					<li>
						<a href="add_delivery_man.php">Add Delivery Man</a>
					</li>
					<li>
						<a href="delivery_man_list.php">Delivery Man List</a>
					</li>
					<li>
						<a href="add_menu.php">Add Food Menu</a>
					</li>
					<li>
						<a href="menu_list.php">Food Menu List</a>
					</li>
					<li>
						<a href="orders.php">Orders</a>
					</li>
					<li>
						<a href="delivery_list.php">Delivery List</a>
					</li>
				</ul>
			<?php } ?>