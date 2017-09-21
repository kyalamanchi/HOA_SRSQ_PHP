<?php

	session_start();

	$row = pg_fetch_assoc(pg_query("SELECT * FROM community_info WHERE community_id=$_SESSION['hoa_community_id']"));

	$email = $row['email'];
	$remit_payment_address = $row['remit_payment_address'];
	$mailing_addr_city = $row['mailing_addr_city'];
	$mailing_addr_state = $row['mailing_addr_state'];
	$mailing_addr_zip = $row['mailing_addr_zip'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_addr_city"));
	$mailing_addr_city = $row['city_name'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_addr_state"));
	$mailing_addr_state = $row['state_code'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_addr_zip"));
	$mailing_addr_zip = $row['zip_code'];

?>

<footer class='footer'>

	<div class='container'>

		<div class='row'>

			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
								
				<aside class='widget widget_tag_cloud'>

					<div class='textwidget text-center'>
										
						<p><h3><?php echo $_SESSION['hoa_community_name']; ?></h3></p>
						<?php echo $remit_payment_address; ?>, <?php echo $mailing_addr_city; ?>, <?php echo $mailing_addr_state; ?> <?php echo $mailing_addr_zip; ?><br />
						E-mail: <a href='<?php echo $email; ?>'><?php echo $email; ?></a> <br/>

					</div>

				</aside>

			</div>

		</div>

	</div>

	<div class='footer-copyright'>

		<div class='container'>

			<div class='row'>

				<div class='col-md-12'>

					<div class='text-center'>

						<span class='copyright'>© <?php echo date('Y')." ".$_SESSION['hoa_community_name']; ?>, All Rights Reserved.</span>

					</div>

				</div>

			</div>

		</div>

	</div>

</footer>