<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$email = $_SESSION['hoa_alchemy_email'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$today = date('Y-m-d');

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $community_code; ?> - Annual Report</title>

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

	</head>

	<body>

		<style type="text/css">
			
			body {
  				background: #ecf0f1;
			}

			.loader {
  				width: 50px;
  				height: 30px;
  				position: absolute;
  				left: 50%;
  				top: 50%;
  				transform: translate(-50%, -50%);
			}
			.loader:after {
  				position: absolute;
  				content: "Loading";
  				bottom: -40px;
  				left: -2px;
  				text-transform: uppercase;
  				font-family: "Arial";
  				font-weight: bold;
  				font-size: 12px;
			}

			.loader > .line {
  				background-color: #333;
  				width: 6px;
  				height: 100%;
  				text-align: center;
  				display: inline-block;
  
  				animation: stretch 1.2s infinite ease-in-out;
			}

			.line.one {
			  	background-color: #2ecc71; 
			}

			.line.two {
			  	animation-delay:  -1.1s;
			  	background-color:#3498db;
			}
			.line.three {
			  	animation-delay:  -1.0s;
			  	background-color:#9b59b6;
			}
			.line.four {
			  	animation-delay:  -0.9s;
			   	background-color: #e67e22;
			}
			.line.five {
			  	animation-delay:  -0.8s;
			  	background-color: #e74c3c;
			}

			@keyframes stretch {
			  	0%, 40%, 100% { transform: scaleY(0.4); }
			  	20% {transform: scaleY(1.0);}
			}

		</style>

		<div class="loader">
  			
  			<div class="line one"></div>
  			<div class="line two"></div>
  			<div class="line three"></div>
  			<div class="line four"></div>
  			<div class="line five"></div>
		
		</div>

		<div class='layout'>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<br><h1 class="h5">Trail Balance Report - Till <?php echo date('F d,Y'); ?></h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<?php
        
              					$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLoss?minorversion=8');
              
              					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
              					curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="z5lf3IXAgwz5xXVG11yFEYKkvqw%3D"'));
              					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

              					$profitandloss = curl_exec($ch);
              					$jsonprofitandloss = json_decode($profitandloss,TRUE);
              					$data = $jsonprofitandloss['Rows']['Row'];

              					foreach ($data as $key ) {

                					foreach ($key['Summary'] as $Summary) {
                  
                  						$count = 0;
                  
                  						foreach ($Summary as $summary) {
    
                    						if ($summary['value'] == 'Total Revenue') {
                      
                      							$count = 1;
                      							continue;

                    						}
                    						if ( $count == 1 ) {
                      
                      							$income = $summary['value'];
                      							continue;

                    						} 

                    						if ( $summary['value'] == 'Total Expenditures') {
                      
                      							$count = 2;
                      							continue;

                    						}

                    						if ( $count == 2) {
                      
                      							$expenditure = $summary['value'];
                      							continue;

                    						}

                    						if ( $summary['value'] == 'Net Revenue') {
                      
                      							$count = 3;
                      							continue;

                    						}

                    						if ( $count == 3) {
                      
                      							$revenue = $summary['value'];
                      							continue;

                    						}

                    						if ( $summary['value'] == 'Total Office Supplies & Software'){
                      
                      							$count = 4;
                      							continue;

                    						}
                    						if( $count == 4) {
                      
                      							$officetotal = $summary['value'];
                      							continue;

                    						}

                  						}

                					}

                					foreach ($key['Rows'] as $allRows) {
                  
                  						foreach ($allRows as $individualRows) {
  
                    						foreach ($individualRows as $colData) {
      
                      							foreach ($colData as $keyColData) {
                        
                        							$count = 0;
         
                        							foreach ($keyColData as $keyColData2) {
           
                          								if ( $keyColData2['value'] == 'Total 6410 Office/General Administrative Expenses') {
                            
                            								$count = 1;
                            								continue;

                          								}
                          								else if ( $keyColData2['value'] == 'Total 5420 Repairs & Maintenance') {
                            
                            								$count = 2;
                            								continue;

                          								}

                          								if ( $count == 2 ){
                            
                            								$repair = $keyColData2['value'];
                            								$count = 0;
                            								continue;

                          								}

                          								if ( $count == 1) {
            
                            								$officegeneral = $keyColData2['value'];
                            								$count = 0;
                            								continue;
                          
                          								}
                        
                        							}
                      
                      							}  
      
                    						}
                  
                  						}

                					}
              
              					}

                				$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query?minorversion=8');
                
                				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                				curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="XuTqhe0Pc3l6ByJNHpbyp1P8W0k%3D"'));
                				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                				curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from CompanyInfo");
                
                				$companyInfo = curl_exec($ch);
                
                				curl_close($ch);
                
                				$companyInfo = json_decode($companyInfo,TRUE);
                				$companyInfo  = $companyInfo['QueryResponse'];
                				$companyInfo = $companyInfo['CompanyInfo'];
                
                				curl_close($ch);
              
                				$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLossDetail?minorversion=8');
                
                				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                				curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="nkBSFyHp1p022rshX1sc2twDKpA%3D"'));
                				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                
                				$result = curl_exec($ch);
                				$json_Decode = json_decode($result,TRUE);
                				$header = $json_Decode['Header'];
                				$startDate  = $header['StartPeriod'];
                				$endDate = $header['EndPeriod'];
                				$startDate = strtotime($startDate);
                				$endDate = strtotime($endDate);
                				$startDate = date('F jS ',$startDate);
                				$endDate = date('F jS, Y',$endDate);
                
                				curl_close($ch);

              				?>

              <?php

                  $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLoss?minorversion=8');
                  
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="z5lf3IXAgwz5xXVG11yFEYKkvqw%3D"'));
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  
                  $profitandloss = curl_exec($ch);
                  $jsonprofitandloss = json_decode($profitandloss,TRUE);
                  $profitandlossrows = $jsonprofitandloss['Rows']['Row'];
                  
                  foreach ($profitandlossrows as $profitandlosstest) {
                    
                    foreach ($profitandlosstest['Header'] as $keyprofitandloss) {
                      
                      foreach ($keyprofitandloss as $keyprofitandloss) {
                        
                        $keyprofitandloss = $keyprofitandloss['value'];
                        
                        if ( $keyprofitandloss == "Expenditures") {
                          
                          foreach ($profitandlosstest['Rows'] as $keyprofitandlosstester) {
                            
                            foreach ($keyprofitandlosstester as $helloworld) {
                              
                              $helloworld2 = $helloworld['Header'];
                              $count = 0;
                              
                              foreach ($helloworld2['ColData'] as $keycoldata) {
                                
                                $count = $count + 1;
                                if ( $count == 2 ){
                                  
                                }

                              }

                            }

                          }

                        }

                      }

                    }

                  }

                ?>

                <div class="col-xl-offset-1 col-lg-offset-1 col-md-offset-1 col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                  
                  <table class="table table-hover table-bordered container-fluid">
                    
                    <thead>
                        
                        <tr>
                            
                            <th></th>
                            <th>Total</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                      
                      <tr>
                        
                        <?php
                          
                          echo '<td>Revenue</td>';
                          echo '<td>';
                          echo '<b>';
                          echo '$ ';
                          
                          $allRows = $json_Decode['Rows'];
                          
                          foreach ($allRows['Row'] as $singleRow) {
                            
                            $insideRows = $singleRow['Rows'];
                            $insideRow = $insideRows['Row'];
                  
                            foreach($insideRow as $key ) {
                    
                              $summary = $key['Summary'];
                    
                              foreach ($summary['ColData'] as $colval) {
                                
                                $value = floatval($colval['value']);
                                
                                if($value && intval($value) != $value)
                                {
                                  echo $value;
                                  break 3;

                                }

                              }
                            
                            }

                          }
                          
                          echo '</b>';

                        ?>

                      </tr>

                      <tr>

                        <td>
                          
                          <h5>4010 Assessments<span style="float:right;">$ <?php  echo $value; ?></span></h5>
                          
                          <ul>
                            
                            <hr>
                            <h4>Total Revenue<span style="float:right;">$ <?php  echo $value; ?></span></h4>
                        
                          </ul>
                        
                        </td>

                      </tr>
                      
                      <tr>
                      
                        <td>Gross Profit </td>
                        <td><b>$ <?php echo $value; ?></b></td>

                      </tr>

                      <tr>
                        
                        <td colspan="5"><ul><li>No data found.</li></ul></td>
                      
                      </tr>

                      <tr>
                        
                        <td>Expenditures</td>
                        
                        <?php

                          $cell = 0;

                          echo '<td>';
                          echo '<b>';
                          echo '$ ';

                          $allRows = $json_Decode['Rows'];
                          
                          foreach ($allRows['Row'] as $singleRow) {
                            
                            $insideRows = $singleRow['Rows'];
                            $insideRow = $insideRows['Row'];
                  
                            foreach($insideRow as $key ) {
                              
                              $summary = $key['Summary'];
                    
                              foreach ($summary['ColData'] as $colval) {
                      
                                foreach ($colval as $keycol) {
                                  
                                  if ( $keycol == "Total for Expenditures") {
                        
                                    $cell = 1;

                                  }

                                  if ( $cell == 1 ){
                                    
                                    $fval  = floatval($keycol);
                                    
                                    if($fval && intval($fval) != $fval)
                                    {
                                      echo $fval;
                                      $cell = 0;
                                      break 3;

                                    }

                                  }

                                }

                              }

                            }

                          }

                          echo '</b>';
                        
                        ?>

                      </tr>

                      <tr>

                        <td>
                          
                          <ul>
                  
                            <?php 
                  
                              foreach ($keyprofitandlosstester as $helloworld) {
                  
                                $helloworld2 = $helloworld['Header'];
                                $count = 0;
                  
                                foreach ($helloworld2['ColData'] as $keycoldata) {
                    
                                  $count = $count + 1;
                                  
                                  if ( $count == 1){

                                    $firstvalue = $keycoldata['value'];
                                  
                                  }
                                  
                                  if ( $count == 2 ){
                                    
                                    echo '<h5>'.$firstvalue.'<span style="float:right;">$ '.$keycoldata['value'].'</span></h5>';
                                    echo "<hr>";
                    
                                  }
                                
                                }
                              
                              }

                              echo '<h4>Total Expenditure<span style="float:right;">$ '.$fval.'</span></h4>';

                            ?>

                          </ul>

                        </td>

                      </tr>

                      <tr>

                        <td>Net Operating Revenue</td>
                        <td><b>$ 
                          <?php
                            
                            foreach ($allRows['Row'] as $singleRow) {
                              
                              $summary = $singleRow['Summary'];
                              $ColData  = $summary['ColData'];
                    
                              foreach ($ColData as $key) {
                      
                                $value   = $key['value'];
                      
                                if($value && intval($value) != $value)
                                {
                            
                                  echo $value;
                                  break 2;

                                }
                    
                              }
                            }
                          ?>
                          
                        </b></td>

                      </tr>

                      <tr>

                        <td colspan="5">
                
                          <ul><li>No data found.</li></ul>

                        </td>

                      </tr>

                      <tr>

                        <td>Net Revenue</td>
                        <td><b>$ <?php echo $value; ?></b></td>

                      </tr>
                    
                    </tbody>

                  </table>

                </div>

						</div>

					</div>

				</section>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
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