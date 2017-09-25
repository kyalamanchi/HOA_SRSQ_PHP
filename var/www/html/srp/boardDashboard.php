<!DOCTYPE html>
<html lang="en">
	<head>
		

		<?php

			session_start();

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$user_id = $_SESSION['hoa_user_id'];
			$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

			if($board == 0)
				header("Location: residentDashboard.php");

			if($_SESSION['hoa_mode'] == 2)
				$_SESSION['hoa_mode'] = 1;

			$community_id = $_SESSION['hoa_community_id'];
			$days90 = date('Y-m-d', strtotime("-90 days"));

			$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
			$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
			$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
			$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
			$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

		?>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Core - Template</title>
		<!-- Favicons-->
		<link rel="shortcut icon" href="assets/images/favicon.png">
		<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png">
		<!-- Web Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Hind:400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora:400i" rel="stylesheet">
		<!-- Bootstrap core CSS-->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Icon Fonts-->
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/linea-arrows.css" rel="stylesheet">
		<link href="assets/css/linea-icons.css" rel="stylesheet">
		<!-- Plugins-->
		<link href="assets/css/owl.carousel.css" rel="stylesheet">
		<link href="assets/css/flexslider.css" rel="stylesheet">
		<link href="assets/css/magnific-popup.css" rel="stylesheet">
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<!-- Template core CSS-->
		<link href="assets/css/template.min.css" rel="stylesheet">
	</head>
	<body>

		<!-- Layout-->
		<div class="layout">

			<!-- Header-->
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
														
											<li><a href="index-2.html">Charges</a></li>
											<li><a href="index.html">Process Payment</a></li>
											<li><a href="index-3.html">Set Reminders</a></li>
												
										</ul>

									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-institution'></i> Community</a>
										
										<ul class="sub-menu">
														
											<li><a href="index-18.html">Deposits</a></li>
											<li><a href="index-26.html">Disclosures</a></li>
											<li><a href="index-21.html">Mailing List</a></li>
										
										</ul>

									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-street-view'></i> Users</a>
										
										<ul class="sub-menu">
														
											<li><a href="index-9.html">Balances</a></li>
											<li><a href="index-7.html">HOA &amp; Home Info</a></li>
											<li><a href="index-8.html">User Dashboard</a></li>
										
										</ul>
										
									</li>

									<li class="menu-item-has-children mega-menu-col"><a href="#"><i class='fa fa-wrench'></i> Vendors</a>
										
										<ul class="sub-menu">

											<li><a href="index-13.html">Vendor Dashboard</a></li>
										
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

			<!-- Wrapper-->
			<div class="wrapper">

				<!-- Page Header-->
				<section class="module-page-title">
					<div class="container">
						<div class="row-page-title">
							<div class="page-title-captions">
								<h1 class="h5">Tabs</h1>
							</div>
							<div class="page-title-secondary">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Shortcodes</a></li>
									<li class="breadcrumb-item active">Tabs</li>
								</ol>
							</div>
						</div>
					</div>
				</section>
				<!-- Page Header end-->

				<!-- Tabs-->
				<section class="module module-divider-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div class="special-heading m-b-40">
									<h4>Standard</h4>
								</div>
								<!-- Tabs-->
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Tab One</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab">Tab Two</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab">Tab Three</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane in active" id="tab-1">
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
									</div>
									<div class="tab-pane" id="tab-2">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues.</p>
									</div>
									<div class="tab-pane" id="tab-3">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Tabs end-->

				<!-- Tabs-->
				<section class="module module-divider-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div class="special-heading m-b-40">
									<h4>Standard - Center</h4>
								</div>
								<!-- Tabs-->
								<ul class="nav nav-tabs justify-content-center">
									<li class="nav-item"><a class="nav-link active" href="#tab-7" data-toggle="tab">Tab One</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-8" data-toggle="tab">Tab Two</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-9" data-toggle="tab">Tab Three</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane in active" id="tab-7">
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
									</div>
									<div class="tab-pane" id="tab-8">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues.</p>
									</div>
									<div class="tab-pane" id="tab-9">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Tabs end-->

				<!-- Tabs-->
				<section class="module module-divider-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div class="special-heading m-b-40">
									<h4>Standard - Right</h4>
								</div>
								<!-- Tabs-->
								<ul class="nav nav-tabs justify-content-end">
									<li class="nav-item"><a class="nav-link active" href="#tab-10" data-toggle="tab">Tab One</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-11" data-toggle="tab">Tab Two</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-12" data-toggle="tab">Tab Three</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane in active" id="tab-10">
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
									</div>
									<div class="tab-pane" id="tab-11">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues.</p>
									</div>
									<div class="tab-pane" id="tab-12">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Tabs end-->

				<!-- Tabs-->
				<section class="module">
					<div class="container">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div class="special-heading m-b-40">
									<h4>Standard with Icons</h4>
								</div>
								<!-- Tabs-->
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active" href="#tab-4" data-toggle="tab"><i class="fa fa-anchor"></i> Tab One</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-5" data-toggle="tab"><i class="fa fa-area-chart"></i> Tab Two</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-6" data-toggle="tab"><i class="fa fa-support"></i> Tab Three</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane in active" id="tab-4">
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
									</div>
									<div class="tab-pane" id="tab-5">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues.</p>
									</div>
									<div class="tab-pane" id="tab-6">
										<p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew.</p>
										<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean shorts fixie consequat flexitarian four loko.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Tabs end-->

				<!-- Footer-->
				<footer class="footer">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-lg-3">
								<!-- Text widget-->
								<aside class="widget widget_text">
									<div class="textwidget">
										<p><img src="assets/images/logo-light.png" width="100" alt=""></p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat.</p>E-mail: <a href="mailto:support@core.com">support@core.com</a> <br/>
										Phone: 8 800 123 4567 <br/>
										Fax: 8 800 123 4567 <br/>
									</div>
								</aside>
							</div>
							<div class="col-md-6 col-lg-3">
								<!-- Recent entries widget-->
								<aside class="widget widget_recent_entries">
									<div class="widget-title">
										<h5>Recent Posts</h5>
									</div>
									<ul>
										<li><a href="#">Experience the sound of a modern and clean 360° Bluetooth Speaker.</a> <span class="post-date">May 8, 2016</span></li>
										<li><a href="#">Experience the sound of a modern and clean 360° Bluetooth Speaker.</a> <span class="post-date">April 7, 2016</span></li>
										<li><a href="#">Experience the sound of a modern and clean 360° Bluetooth Speaker.</a> <span class="post-date">April 7, 2016</span></li>
									</ul>
								</aside>
							</div>
							<div class="col-md-6 col-lg-3">
								<!-- Twitter widget-->
								<aside class="widget twitter-feed-widget">
									<div class="widget-title">
										<h5>Twitter Feed</h5>
									</div>
									<div class="twitter-feed" data-twitter="345170787868762112" data-number="2"></div>
								</aside>
							</div>
							<div class="col-md-6 col-lg-3">
								<!-- Tags widget-->
								<aside class="widget widget_tag_cloud">
									<div class="widget-title">
										<h5>Tags</h5>
									</div>
									<div class="tagcloud"><a href="#">Design</a><a href="#">Travel</a><a href="#">Startup</a><a href="#">Music</a><a href="#">Portfolio</a><a href="#">Responsive</a></div>
								</aside>
							</div>
						</div>
					</div>
					<div class="footer-copyright">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center"><span class="copyright">© 2017 Core, All Rights Reserved. Design with love by <a href="http://2the.me/">2the.me</a></span></div>
								</div>
							</div>
						</div>
					</div>
				</footer>
				<!-- Footer end-->

				<a class="scroll-top" href="#top"><i class="fa fa-angle-up"></i></a>
			</div>
			<!-- Wrapper end-->

		</div>
		<!-- Layout end-->

		<!-- Off canvas-->
		<div class="off-canvas-sidebar">
			<div class="off-canvas-sidebar-wrapper">
				<div class="off-canvas-header"><a class="close-offcanvas" href="#"><span class="arrows arrows-arrows-remove"></span></a></div>
				<div class="off-canvas-content">
					<!-- Text widget-->
					<aside class="widget widget_text">
						<div class="textwidget">
							<p class="text-center"><img src="assets/images/logo-light.png" width="100" alt=""></p>
						</div>
					</aside>
					<!-- Text widget-->
					<aside class="widget widget_text">
						<div class="textwidget">
							<p class="text-center"><img src="assets/images/offcanvas.jpg" alt=""></p>
						</div>
					</aside>
					<!-- Navmenu widget-->
					<aside class="widget widget_nav_menu">
						<ul class="menu">
							<li class="menu-item menu-item-has-children"><a href="#">Home</a></li>
							<li class="menu-item"><a href="#">About Us</a></li>
							<li class="menu-item"><a href="#">Services</a></li>
							<li class="menu-item"><a href="#">Portfolio</a></li>
							<li class="menu-item"><a href="#">Blog</a></li>
							<li class="menu-item"><a href="#">Shortcodes</a></li>
						</ul>
					</aside>
					<ul class="social-icons">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-vk"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Off canvas end-->

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<!-- Color Switcher (Remove these lines)-->
		<script src="assets/js/style-switcher.min.js"></script>
	</body>
</html>