<?php
	
	require 'app/start.php';

	$accessToken = 'QwUjEm5GAkAAAAAAAAAADocHK4CgCJoBl2A8-fe9Fs42E06qkDqJA2S9YPwGbZyF';

	$client = new Dropbox\Client($accessToken, $appName, 'UTF-8');



	$path = '/SRSQ_HOA/Documents/VendorInvoices/SRSQ_USPS_VendorInvoices_2017_April_001245_Invoice_Approved.pdf';

	$desc = 'SRSQ_Associationvoting.com_VendorInvoices_2017_April_041517_Invoice_Approved';

	echo "<a href='getPreview.php?path=$path&desc=$desc'>File</a>";