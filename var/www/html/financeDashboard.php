<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    
    <?php

      pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      if(@!$_SESSION['hoa_username'])
      	header("Location: https://hoaboardtime.com/logout.php");

      $community_id = $_SESSION['hoa_community_id'];
      $user_id=$_SESSION['hoa_user_id'];

      if($_SESSION['hoa_mode'] == 2)
        header("Location: https://hoaboardtime.com/residentDashboard.php");

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $_SESSION['hoa_community_name']; ?></title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="dist/js/googleanalytics.js"></script>

    <script type="text/javascript">
      var dimensionValue1 = "${userDetails.user.memberInfo.hoaId.hoaId}";
      var dimensionValue2 = "${communityInfo.communityCode}";
      if(<?php echo $community_id; ?> == 1)
        ga('create', 'UA-102881886-3', 'auto');
      else if(<?php echo $community_id; ?> == 2)
        ga('create', 'UA-102881886-2', 'auto');
      ga('set', 'dimension1', dimensionValue1);
      ga('set', 'dimension2', dimensionValue2);
      ga('send', 'pageview');
    </script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <?php

      if($community_id == 1)
      { 
                      
        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/77?minorversion=8');      
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="jzXGHD9VKI6fxwrXaWg90HQgFuI%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
        $result = curl_exec($ch);
        $json_decode = json_decode($result,TRUE);
        $srp_primarySavings = $json_decode['Account'];
        $srp_current_balance = $srp_primarySavings['CurrentBalance'];
                            
        curl_close($ch);

        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/74?minorversion=8');      
                            
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1508539532",oauth_nonce="2nX9kd69aNw",oauth_version="1.0",oauth_signature="5ZScoTRHF28D3YT0kHO27%2Br8Hvo%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
        $result2 = curl_exec($ch);
        $json_decode2 = json_decode($result2,TRUE);
        $srp = $json_decode2['Account'];
        $srp_savings_balance = $srp['CurrentBalance'];

      }
      else if($community_id == 2)
      {
                      
        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/33?minorversion=8');      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506682054",oauth_nonce="skPZikoZJCt",oauth_version="1.0",oauth_signature="aEBIdXcJdXSWiLp5k9gxlVuvsbs%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        $json_decode = json_decode($result,TRUE);
        $srp_primarySavings = $json_decode['Account'];
        $srp_primary_Savings_CurrentBalance = $srp_primarySavings['CurrentBalance'];

        curl_close($ch);

        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/32?minorversion=8');      
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="5IDpz%2F%2FItyjMYbh4Ke3JoBx3YGY%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result2 = curl_exec($ch);
        $json_decode2 = json_decode($result2,TRUE);
        $srp = $json_decode2['Account'];
        $srp_savings = $srp['CurrentBalance'];

        curl_close($ch);

        $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/31?minorversion=8');
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506681985",oauth_nonce="H7DXVHb2Qdp",oauth_version="1.0",oauth_signature="HDWt%2BfIz3NrAhJE9fO9G%2FI8Q%2Fcg%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result3 = curl_exec($ch);
        $json_decode3 = json_decode($result3,TRUE);
        $srsq_third_Account = $json_decode3['Account'];
        $srsq_third_Account_Balance = $srsq_third_Account['CurrentBalance'];
            
      }

    ?>
    
    <div class="wrapper">

      <?php include 'boardHeader.php'; ?>
      
      <?php include 'boardNavigationMenu.php'; ?>

      <?php include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">
        
        <section class="content-header">

          <h1><strong>Finance Dashboard</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

          <ol class="breadcrumb">
            
            <li><i class="fa fa-dollar"></i> Finance Dashboard</li>
          
          </ol>

        </section>

        <br>

        <section class="content">

          <div class="row container-fluid">

            <section style="background-color: white;">

              <br><br>

              <div class="row container-fluid">

                <?php

                  if($community_id == 1)
                  {

                    echo "

                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

                      <div class='row container-fluid text-left'>

                        <div class='row container-fluid'>

                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                            <a href='https://hoaboardtime.com/communityIncome.php'>

                              <h1 class='text-info'><strong>$ ".round($srp_savings_balance, 0)."</strong></h1>

                            </a>

                          </div>

                        </div>

                        <div class='row container-fluid text-center'>

                          <h5><strong>Savings</strong></h5>

                        </div>

                      </div>

                    </div>

                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

                      <div class='row container-fluid text-left'>

                        <div class='row container-fluid'>

                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                            <a href='https://hoaboardtime.com/communityIncome.php'>

                              <h1 class='text-info'><strong>$ ".round($srp_current_balance, 0)."</strong></h1>

                            </a>

                          </div>

                        </div>

                        <div class='row container-fluid text-center'>

                          <h5><strong>Checkings</strong></h5>

                        </div>

                      </div>

                    </div>

                    ";

                  }
                  else if($community_id == 2)
                  {

                    echo "

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12'>

                      <div class='row container-fluid text-left'>

                        <div class='row container-fluid'>

                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                            <a href='https://hoaboardtime.com/communityIncome.php'>

                              <h1 class='text-info'><strong>$ ".round($srp_primary_Savings_CurrentBalance, 0)."</strong></h1>

                            </a>

                          </div>

                        </div>

                        <div class='row container-fluid text-center'>

                          <h5><strong>Checkings</strong></h5>

                        </div>

                      </div>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12'>

                      <div class='row container-fluid text-left'>

                        <div class='row container-fluid'>

                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                            <a href='https://hoaboardtime.com/communityIncome.php'>

                              <h1 class='text-info'><strong>$ ".round($srp_savings, 0)."</strong></h1>

                            </a>

                          </div>

                        </div>

                        <div class='row container-fluid text-center'>

                          <h5><strong>Savings</strong></h5>

                        </div>

                      </div>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12'>

                      <div class='row container-fluid text-left'>

                        <div class='row container-fluid'>

                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                            <a href='https://hoaboardtime.com/communityIncome.php'>

                              <h1 class='text-info'><strong>$ ".round($srsq_third_Account_Balance, 0)."</strong></h1>

                            </a>

                          </div>

                        </div>

                        <div class='row container-fluid text-center'>

                          <h5><strong>Investments</strong></h5>

                        </div>

                      </div>

                    </div>

                    ";

                  }

                ?>

              </div>

              <br><br>

              <div class="row container-fluid">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/trailBalanceReport.php'>

                          <img src='trail_balance.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Trail Balance Report</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/chartOfAccounts.php'>

                          <img src='chart_of_accounts.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Chart Of Accounts</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/expenditureByVendor.php'>

                          <img src='expenditures_by_vendors.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Expenditure By Vendor</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/generalLedger.php'>

                          <img src='general_ledger.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>General Ledger</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/purchaseSummary.php'>

                          <img src='purchase_summary.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Purchase Summary</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/communityIncome.php'>

                          <img src='community_income.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Community Income</strong></h5>

                    </div>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="row container-fluid text-left">

                    <div class="row container-fluid">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                        <a href='https://hoaboardtime.com/communityExpenditure.php'>

                          <img src='community_expenditure.png'>

                        </a>

                      </div>

                    </div>

                    <div class="row container-fluid text-center">

                      <h5><strong>Community Expenditure</strong></h5>

                    </div>

                  </div>

                </div>

              </div>

              <br><br>

            </section>

          </div>

        </section>

        <br>

        <section class="content">

          <div class="row container-fluid">

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
            
            ?>

            <section style="background-color: white;">

              <br>
            
              <div class="row container-fluid">
                
                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">

                  <div class='row text-center container-fluid'>

                    <h4><strong>Income vs Expenditure</strong></h4>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>

                    <canvas id="myChart3"></canvas>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>
                    
                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6' style="border-right: 1px solid #f4f4f4">
                    
                      <a href="https://hoaboardtime.com/boardCommunityDeposits.php" title='Click to view community deposits'><h5>INCOME : <b>$ <?php echo round($income, 0); ?></b></h5></a>

                    </div>

                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                    
                      <a href='https://hoaboardtime.com/boardCommunityExpenditureSummary.php' title='Click to view expenditure summary'><h5>EXPENDITURE : <b>$ <?php echo round($expenditure, 0); ?></b></h5></a>

                    </div>

                  </div>

                </div>

                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                  <div class='row text-center container-fluid'>

                    <h4><strong>Top 3 Spendings</strong></h4>

                  </div>

                  <br>

                  <div class='row text-center container-fluid' >

                    <canvas id="myChart4"></canvas>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>
                    
                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">
                    
                      <h5>5420 Repair &amp; Maintainance : <b style="color: black;">$ <?php echo round($repair, 0); ?></b></h5>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">
                    
                      <h5>6410 Office/General Administrative Expenses : <b style="color: black;">$ <?php echo round($officegeneral, 0); ?></b></h5>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                    
                      <h5>Others : <b style="color: black;">$ <?php echo round($expenditure - ($officegeneral+$repair), 0); ?></b></h5>

                    </div>

                  </div>

                </div>
              
              </div>

              <br>

              <?php

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
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="dF10iisxl3QVmuZhGLd4pIA9GAQ%3D"'));
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

              <br>

            </section>

          </div>

          <script>
            
            var ctx = document.getElementById("myChart3");
            ctx.width  = 2;
            ctx.height = 1;
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: [
                      "INCOME ($)",
                      "EXPENDITURE ($)"
                  ],
                  datasets: [
                      {
                          data: [<?php echo round($income, 0); ?>, <?php echo round($expenditure, 0); ?>],
                          backgroundColor: [
                              "green",
                              "orange"
                          ]
                      }]
              },
                options: {
                        legend:{
                          position:'right'
                        },
                        cutoutPercentage:70,
                        animation:{
                            animateScale:true
                        }
                    }
            });

            $(document).ready( 
                function () {
                    var ctx = document.getElementById("myChart3").getContext("2d");
                    var myNewChart = new Chart(ctx).Pie(data);

                    $("#myChart3").click( 
                        function(evt){
                            var activePoints = myNewChart.getSegmentsAtEvent(evt);
                            var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                            alert(url);
                        }
                    );                  
                }
            );

          </script>

          <script>
            
            var ctx = document.getElementById("myChart4");
            ctx.width  = 2;
            ctx.height = 1;
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: [
                      "5420 Repair & Maintainance ($)",
                      "6410 Office/General Administrative Expenses ($)",
                      "Others ($)"
                  ],
                  datasets: [
                      {
                          data: [<?php echo round($repair, 0); ?>, <?php echo round($officegeneral, 0); ?>, <?php echo round($expenditure - ($officegeneral+$repair), 0); ?>],
                          backgroundColor: [
                              "rgba(75, 192, 192, 99)",
                              "rgba(143, 102, 144, 99)",
                              "rgba(153, 102, 255, 99)"
                          ]
                      }]
              },
                options: {
                        legend:{
                          position:'right'
                        },
                        cutoutPercentage:70,
                        animation:{
                            animateScale:true
                        }
                    }
            });

          </script>

        </section>

      </div>

      <?php include "footer.php"; ?>

      <div class="control-sidebar-bg"></div>

    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>

</html>
