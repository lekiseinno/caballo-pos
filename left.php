<?php if(!isset($_SESSION['emp_code'])){header("location:login.php");} ?>
<aside class="aside-left">
	<div class="aside-inner-left">
		<ul class="list-group list-group-flush list-left">
			
			<!--
			<li class="list-group-item obj-menu text-center">
				<span class="name-login">
					<strong>Login</strong>
				</span>
			</li>
			-->
			<a class="btn-left" href="index.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-home"></i>
					</div>
					<!--
					<div class="text-center">
						Index
					</div>
					-->
				</li>
			</a>
			<a class="btn-left" href="checkout_list.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-shopping-cart"></i>
					</div>
					<div class="text-center">
						Checkout
					</div>
				</li>
			</a>
			<a class="btn-left" href="order_list.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-list-ol"></i>
					</div>
					<div class="text-center">
						Order
					</div>
				</li>
			</a>
			<a class="btn-left" href="order_tmp_list.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-heart"></i>
					</div>
					<div class="text-center">
						Sale
					</div>
				</li>
			</a>
			<a class="btn-left" href="quotation.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-list-ol"></i>
					</div>
					<div class="text-center">
						Quotation
					</div>
				</li>
			</a>
			<a class="btn-left" href="order_hold_list.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-shopping-bag"></i>
					</div>
					<div class="text-center">
						On hold
					</div>
				</li>
			</a>
			<a class="btn-left" href="customer.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-user-circle"></i>
					</div>
					<div class="text-center">
						Customer
					</div>
				</li>
			</a>
			<a class="btn-left" href="employee.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-users"></i>
					</div>
					<div class="text-center">
						Employee
					</div>
				</li>
			</a>
			<a class="btn-left" href="inventory-import.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-cloud-download-alt"></i>
					</div>
					<div class="text-center">
						Import
					</div>
				</li>
			</a>
			<a class="btn-left" href="inventory.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="far fa-object-group"></i>
					</div>
					<div class="text-center">
						Inventory
					</div>
				</li>
			</a>
			<!--
			<a class="btn-left" href="#">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-sync-alt"></i>
					</div>
					<div class="text-center">
						Sync
					</div>
				</li>
			</a>
			-->
			<a class="btn-left" href="process/logout.php">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-sign-out-alt"></i>
					</div>
					<div class="text-center">
						Logout
					</div>
				</li>
			</a>
			<!--
			<a class="btn-left" href="#">
				<li class="list-group-item obj-menu">
					<div class="text-center">
						<i class="fas fa-cog"></i>
					</div>
					<div class="text-center">
						Conf
					</div>
				</li>
			</a>
			-->
		</ul>
	</div>
</aside>

