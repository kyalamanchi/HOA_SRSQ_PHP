<header class="header header-right undefined">
	
	<div class="container-fluid">
					
		<!-- Logos-->
		<div class="inner-header">

			<a class='inner-brand' href=''><h3 style='color: green;'><?php echo $_SESSION['hoa_community_code']; ?></h3></a>

		</div>
		
		<!-- Navigation-->
		<div class="inner-navigation collapse">
						
			<div class="inner-navigation-inline">
				
				<div class="inner-nav">
						
					<ul>

						<li><a href='boardDashboard.php'><span><i class='fa fa-home'></i> Home</span></a></li>

						<li class="menu-item-has-children menu-item-has-mega-menu"><a href="#"><span><i class='fa fa-bars'></i> Menu</span></a>

							<div class="mega-menu">

								<ul class="sub-menu mega-menu-row">

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-users'></i> Board</a>
										
										<ul class="sub-menu">
														
											<li><a>Charges</a></li>
											<li><a href="processPayment.php">Process Payments</a></li>
											<li><a>Set Reminders</a></li>
												
										</ul>

									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-institution'></i> Community</a>
										
										<ul class="sub-menu">
														
											<li><a>Disclosures</a></li>
											<li><a href="mailingList.php">Mailing List</a></li>
										
										</ul>

									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-street-view'></i> Users</a>
										
										<ul class="sub-menu">
														
											<li><a>Balances</a></li>
											<li href="hoaHomeInfo.php"><a>HOA &amp; Home Info</a></li>
											<li><a>User Dashboard</a></li>
										
										</ul>
										
									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-wrench'></i> Vendors</a>
										
										<ul class="sub-menu">

											<li><a>Vendor Dashboard</a></li>
										
										</ul>

									</li>
								
								</ul>

							</div>

						</li>

						<li><a style='color: green;' href='residentDashboard.php'><span><i class='fa fa-dashboard'></i> Resident Dashboard</span></a></li>

						<li><a href="logout.php" style="color: orange;"><span><i class='fa fa-sign-out'></i> Log Out</span></a></li>

					</ul>		
				
				</div>
			
			</div>

		</div>
		
		<!-- Mobile menu-->
		<div class="nav-toggle"><a href="#" data-toggle="collapse" data-target=".inner-navigation"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a></div>
	
	</div>

</header>