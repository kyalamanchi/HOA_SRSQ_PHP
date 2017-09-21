<?php

	session_start();

	$user_id = $_SESSION['hoa_user_id';]

	$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

?>

<header class='header header-center undefined'>

	<div class='container-fluid'>

		<div class='inner-header'>
						
			<a class='inner-brand' href='index.html'><h5 style='color: green;'>Stoneridge Place<br>At Pleasanton HOA</h5></a>

		</div>

		<div class='inner-navigation collapse'>

			<div class='inner-navigation-inline'>

				<div class='inner-nav'>

					<ul>

						<li><a href='index.php'>Home</a></li>
						<li><a class='smoothscroll' href='#pay_online'>Pay Online</a></li>
						<li><a class='smoothscroll' href='#budget'>2017 Budget</a></li>
						<li><a class='smoothscroll' href='#r_p'>Rule &amp; Policies</a></li>
						<li><a class='smoothscroll' href='#contact'>Contact Us</a></li>
						<?php

							if($board)
								echo "<li><a style='color: green;' href='boardDashboard.php'>Board Dashboard</a></li>";

						?>

					</ul>

				</div>

			</div>

		</div>

		<div class="extra-nav">
						
			<ul>
				
				<li><a href="https://hoaboardtime.com/srp/logout.php"><span>Log Out</span></a></li>
						
			</ul>

		</div>

		<!-- Mobile menu-->
		<div class='nav-toggle'>
						
			<a href='#' data-toggle='collapse' data-target='.inner-navigation'>
							
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>

			</a>

		</div>

	</div>

</header>