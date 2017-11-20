<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];

	$today = date('Y-m-d');

	$total_persons = $_POST['total_persons'];

	for($i = 1; $i <= $total_persons; $i++)
	{

		$person_id = $_POST[$i.'_person_id'];
		$board_meeting = $_POST[$i.'_board_meeting'];
		$payment_received = $_POST[$i.'_payment_received'];
		$landscape_maintenance = $_POST[$i.'_landscape_maintenance'];
		$late_payment_posted = $_POST[$i.'_late_payment_posted'];
		$inspection_notices = $_POST[$i.'_inspection_notices'];

		$bm_phone = 'NULL';
		$bm_email = 'NULL';
		$pr_phone = 'NULL';
		$pr_email = 'NULL';
		$lm_phone = 'NULL';
		$lm_email = 'NULL';
		$lpp_phone = 'NULL';
		$lpp_email = 'NULL';
		$in_phone = 'NULL';
		$in_email = 'NULL';

		if($board_meeting == 'Phone')
		{

			$bm_phone = 't';
			$bm_email = 'f';

		}
		else if($board_meeting == 'Email')
		{

			$bm_phone = 'f';
			$bm_email = 't';

		}
		else if($board_meeting == 'Both')
		{

			$bm_phone = 't';
			$bm_email = 't';

		}
		else if($board_meeting == 'None')
		{

			$bm_phone = 'f';
			$bm_email = 'f';

		}

		if($payment_received == 'Phone')
		{

			$pr_phone = 't';
			$pr_email = 'f';

		}
		else if($payment_received == 'Email')
		{

			$pr_phone = 'f';
			$pr_email = 't';

		}
		else if($payment_received == 'Both')
		{

			$pr_phone = 't';
			$pr_email = 't';

		}
		else if($payment_received == 'None')
		{

			$pr_phone = 'f';
			$pr_email = 'f';

		}

		if($landscape_maintenance == 'Phone')
		{

			$lm_phone = 't';
			$lm_email = 'f';

		}
		else if($landscape_maintenance == 'Email')
		{

			$lm_phone = 'f';
			$lm_email = 't';

		}
		else if($landscape_maintenance == 'Both')
		{

			$lm_phone = 't';
			$lm_email = 't';

		}
		else if($landscape_maintenance == 'None')
		{

			$lm_phone = 'f';
			$lm_email = 'f';

		}

		if($late_payment_posted == 'Phone')
		{

			$lpp_phone = 't';
			$lpp_email = 'f';

		}
		else if($late_payment_posted == 'Email')
		{

			$lpp_phone = 'f';
			$lpp_email = 't';

		}
		else if($late_payment_posted == 'Both')
		{

			$lpp_phone = 't';
			$lpp_email = 't';

		}
		else if($late_payment_posted == 'None')
		{

			$lpp_phone = 'f';
			$lpp_email = 'f';

		}




		if($inspection_notices == 'Phone')
		{

			$in_phone = 't';
			$in_email = 'f';

		}
		else if($inspection_notices == 'Email')
		{

			$in_phone = 'f';
			$in_email = 't';

		}
		else if($inspection_notices == 'Both')
		{

			$in_phone = 't';
			$in_email = 't';

		}
		else if($inspection_notices == 'None')
		{

			$in_phone = 'f';
			$in_email = 'f';

		}

		$result = pg_query("SELECT * FROM community_comms WHERE hoa_id=$hoa_id AND person_id=$person_id");

		if(!$result)
		{	

			echo "Some error occured. Please try again.";

		}

		if(pg_num_rows($result))
			$result = pg_query("DELETE FROM community_comms WHERE hoa_id=$hoa_id AND person_id=$person_id");

		$result = pg_query("INSERT INTO community_comms (community_id, hoa_id, person_id, event_type_id, create_date, created_by, phone, email, updated_on, updated_by) VALUES ($community_id, $hoa_id, $person_id, 1, '$today', $user_id, '$bm_phone', '$bm_email', '$today', $user_id)");

		$result = pg_query("INSERT INTO community_comms (community_id, hoa_id, person_id, event_type_id, create_date, created_by, phone, email, updated_on, updated_by) VALUES ($community_id, $hoa_id, $person_id, 4, '$today', $user_id, '$pr_phone', '$pr_email', '$today', $user_id)");

		$result = pg_query("INSERT INTO community_comms (community_id, hoa_id, person_id, event_type_id, create_date, created_by, phone, email, updated_on, updated_by) VALUES ($community_id, $hoa_id, $person_id, 9, '$today', $user_id, '$lm_phone', '$lm_email', '$today', $user_id)");

		$result = pg_query("INSERT INTO community_comms (community_id, hoa_id, person_id, event_type_id, create_date, created_by, phone, email, updated_on, updated_by) VALUES ($community_id, $hoa_id, $person_id, 14, '$today', $user_id, '$lpp_phone', '$lpp_email', '$today', $user_id)");

		$result = pg_query("INSERT INTO community_comms (community_id, hoa_id, person_id, event_type_id, create_date, created_by, phone, email, updated_on, updated_by) VALUES ($community_id, $hoa_id, $person_id, 16, '$today', $user_id, '$in_phone', '$in_email', '$today', $user_id)");

	}

	header("Location: userPage4.php");

?>