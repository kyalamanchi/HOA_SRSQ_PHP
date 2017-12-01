<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$mode = $_SESSION['hoa_mode'];
			$today = date('Y-m-d');

			if($mode == 2)
			{	

				$hoa_id = $_SESSION['hoa_hoa_id'];
				$home_id = $_SESSION['hoa_home_id'];

			}

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; if($mode == 1) echo " | Board Dashboard"; else if($mode == 2) echo " | Resident Dashboard"; ?></title>

		<!-- Web Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Poppins:500,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Hind:400,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Lora:400i' rel='stylesheet'>
		<!-- Bootstrap core CSS-->
		<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<!-- Icon Fonts-->
		<link href='assets/css/font-awesome.min.css' rel='stylesheet'>
		<link href='assets/css/linea-arrows.css' rel='stylesheet'>
		<link href='assets/css/linea-icons.css' rel='stylesheet'>
		<!-- Plugins-->
		<link href='assets/css/magnific-popup.css' rel='stylesheet'>
		<link href='assets/css/vertical.min.css' rel='stylesheet'>
		<link href='assets/css/pace-theme-minimal.css' rel='stylesheet'>
		<link href='assets/css/animate.css' rel='stylesheet'>
		<!-- Template core CSS-->
		<link href='assets/css/template.min.css' rel='stylesheet'>
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

		<script type="text/javascript">
			
			$(document).ready(function() {
   
   				var table = $('#example').DataTable( {
        
        			scrollY:        "600px",
        			scrollX:        true,
        			scrollCollapse: true,
        			paging:         false,
        			"order": [[ 1, "desc" ]],
        			fixedColumns:   {
            				leftColumns: 1,
            				rightColumns: 4
        				
        			}

    			} );

			});

		</script>

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else if($mode == 2) include "residentHeader.php"; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Budget Vs Actual</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped' style="color: black;">
										
								<thead>
            <tr>
                <th rowspan="2"></th>
                <th colspan="4">January</th>
                <th colspan="4">February</th>
                <th colspan="4">March</th>
                <th colspan="4">April</th>
                <th colspan="4">May</th>
                <th colspan="4">June</th>
                <th colspan="4">July</th>
                <th colspan="4">August</th>
                <th colspan="4">September</th>
                <th colspan="4">October</th>
                <th colspan="4">November</th>
                <th colspan="4">December</th>
                <th colspan="4">Total</th>
            </tr>
            <tr>
                <th >ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th>ACTUAL</th>
                <th>BUDGET</th>
                <th>OVER BUDGET</th>
                <th>% OF BUDGET</th>
                <th class="total">YTD ACTUAL</th>
                <th class="total">YTD BUDGET</th>
                <th class="total">YTD OVER BUDGET</th>
                <th class="total">YTD % OF BUDGET</th>

            </tr>
        </thead>

								<tbody>
											
									<?php
   date_default_timezone_set('America/Los_Angeles');
   setlocale(LC_MONETARY, 'en_US');
   
   $query = "SELECT * FROM community_accounts WHERE COMMUNITY_ID = 2";
   $queryResult = pg_query($query);

   $accountTypes = array();

   while ($row = pg_fetch_assoc($queryResult)) {
       $accountTypes[$row['qb_id']] = $row['category'];
   }


   $query  = "select * from qb_monthly_actuals where year = ".date('Y');
   $queryResult = pg_query($query);
   $dbData  = array();

   while ($row = pg_fetch_assoc($queryResult)) {
      $dbData[$row['qb_vendor_id'].$row['month'].$row['year']] = $row['amount'];
   }
   $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509983625",oauth_nonce="c14fWRf8XyQ",oauth_version="1.0",oauth_signature="lWDlUObdtq5u8GvxpRz07Or0d9c%3D"'));
   curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from Budget");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   $result = curl_exec($ch);
   $result = json_decode($result);
   $result = ($result->QueryResponse->Budget[0]);
   $val = 0;
   $prevVal = 0 ;
   $valString = "";
   $totalBudget = 0;
   $totalActuals = 0;
   $fbName = "";
   foreach ($result->BudgetDetail as $budget) {
    if ($accountTypes[$budget->AccountRef->value]  == 2)
        $color = "red";
    else if ( $accountTypes[$budget->AccountRef->value] == 3)
        $color = "green";
    else 
        $color = "black";
      if ( $val == 0  ){
        $prevVal =  $budget->AccountRef->value;
         $month = date('m',strtotime($budget->BudgetDate)) ;
         $month  = ltrim($month, '0');
         $year = date('Y');
         $bName = $budget->AccountRef->name;
         $fbName = $bName;
         $actual = $dbData[$budget->AccountRef->value.$month.$year];
         $budget = $budget->Amount;

         $totalActuals = $actual;
         $totalBudget = $budget;

        $overBudget = $actual-$budget;
         if($budget != 0 ){
         $budgetPercentage = ($actual/$budget)*100;
         }
         else {
            $budgetPercentage = "";
         }
         $valString .= "<tr>";

         $valString .= "<td style=\"color: $color;\">";
         $valString .= $bName;
         $valString .= "</td>";

         $valString .= "<td>";
            $valString .= money_format('%#10n',  $actual);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $budget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $overBudget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= round((float)$budgetPercentage,2) . '%';
         $valString .= "</td>";

      }
      else {
         if ( $prevVal ==  $budget->AccountRef->value ){
         $month = date('m',strtotime($budget->BudgetDate)) ;
         $month  = ltrim($month, '0');
         $year = date('Y');
         $bName = $budget->AccountRef->name;
         $actual = $dbData[$budget->AccountRef->value.$month.$year];
         $budget = $budget->Amount;
         $totalBudget = $totalBudget + $budget;
         $totalActuals = $totalActuals + $actual;
         $overBudget = $actual-$budget;
         if($budget != 0 ){
         $budgetPercentage = ($actual/$budget)*100;
         }
         else {
            $budgetPercentage = "";
         }
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $actual);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $budget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $overBudget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= round((float)$budgetPercentage,2) . '%';
         $valString .= "</td>";
         $fbName = $bName;
         }
         else {
         $prevVal = $budget->AccountRef->value;
         $month = date('m',strtotime($budget->BudgetDate)) ;
         $month  = ltrim($month, '0');
         $year = date('Y');
         $bName = $budget->AccountRef->name;
         $actual = $dbData[$budget->AccountRef->value.$month.$year];
         $budget = $budget->Amount;
       
         $overBudget = $actual-$budget;
         if($budget != 0 ){
         $budgetPercentage = ($actual/$budget)*100;
         }
         else {
            $budgetPercentage = "";
         }

         $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalActuals);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalBudget);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalActuals-$totalBudget);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .=  round((float)(($totalActuals/$totalBudget)*100),2) . '%'; 
         $valString .= "</td>";
         $valString .= "</tr>";
           $totalBudget = $budget;
         $totalActuals = $actual;
         $valString .= "<tr>";
         $valString .= "<td  style=\"color: $color;\">";
         $valString .= $bName;
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $actual);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $budget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= money_format('%#10n',  $overBudget);
         $valString .= "</td>";
         $valString .= "<td>";
            $valString .= round((float)$budgetPercentage,2) . '%';
         $valString .= "</td>";

         }
         }
            $val = $val + 1;
      }
      $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalActuals);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalBudget);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .= money_format('%#10n',$totalActuals-$totalBudget);
         $valString .= "</td>";
         $valString .= "<td class=\"total\">";
            $valString .=  round((float)(($totalActuals/$totalBudget)*100),2) . '%'; 
         $valString .= "</td>";
      $valString .= "</tr>";
      print_r($valString);

?>

								</tbody>
										
							</table>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "paging": false, "pageLength": 500, "info": false });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>