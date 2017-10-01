<?php

	if(isset($_POST['submit']))
	{
		echo "Yes";
	}
	else
	{
		echo "No";

		echo "

		<form method='POST'>

			<button type='submit' name='submit' id='submit'>Submit</button>

		</form>

		";
	}

	echo $_POST['payment_hoa_id'];

?>