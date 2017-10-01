<?php

	session_start();

	$community_id = $_SESSION['hoa_community_id'];
	
	if(isset($_POST['submit']))
	{
		echo $_POST['hoa_id_select'];
	}
	else
	{
		echo "No";

		echo "

		<form method='POST'>

			<select id='hoa_id_select' name='hoa_id_select' required>

				<option value='' selected disabled>Select User</option>";

				$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_until>='$today'");

											while($row = pg_fetch_assoc($result))
											{

												$hoa_id = $row['hoa_id'];
												$name = $row['firstname'];
												$name .= " ";
												$name .= $row['lastname'];

												echo "<option value='$hoa_id'>$name</option>";

											}

			echo "

			</select>

			<button type='submit' name='submit' id='submit'>Submit</button>

		</form>

		";
	}

	echo $_POST['payment_hoa_id'];

?>