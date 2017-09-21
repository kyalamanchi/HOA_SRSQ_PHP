<?php

	session_start();

	$user_id = $_SESSION['hoa_user_id'];

	$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

?>

<header class='header header-center undefined'>

	<div class='container-fluid'>

		<div class='inner-header'>
						
			<a class='inner-brand'><h3 style='color: green;'><?php echo $_SESSION['hoa_community_code']; ?></h3></a>

		</div>

		<div class='inner-navigation collapse'>

			<div class='inner-navigation-inline'>

				<div class='inner-nav'>

					<ul>

						<li><a href='residentDashboard.php'>Home</a></li>
						<li><a class='smoothscroll' href='#pay_online'>Quick Pay</a></li>
						<?php

							if($board != 0)
								echo "<li><a style='color: green;' href='boardDashboard.php'>Board Dashboard</a></li>";

						?>

					</ul>

				</div>

			</div>

		</div>

		<div class="extra-nav">
						
			<ul>
				
				<li><a href="https://hoaboardtime.com/srp/logout.php" style="color: orange;"><span>Log Out</span></a></li>
						
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