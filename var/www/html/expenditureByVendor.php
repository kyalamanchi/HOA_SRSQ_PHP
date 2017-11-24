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
      $user_id = $_SESSION['hoa_user_id'];
      $mode = $_SESSION['hoa_mode'];

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $_SESSION['hoa_community_name']; ?></title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <?php if($mode == 1) include "boardHeader.php"; ?>
      
      <?php if($mode == 1) include 'boardNavigationMenu.php'; ?>

      <?php include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">

        <?php

          $year = date("Y");
          $month = date("m");
          $end_date = date("t");

          $result = pg_query("SELECT * FROM community_invoices WHERE community_id=$community_id AND reserve_expense='t'");

        ?>
        
        <section class="content-header">

          <h1><strong>Vendor Expenditure Summary</strong></h1>

          <ol class="breadcrumb">
            
            <li><a href='financeDashboard.php'><i class="fa fa-dollar"></i> Finance Dashboard</a></li>
            <li>Expenditure By Vendor</li>
          
          </ol>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Vendor</th>
                        <th>Total</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                    $finalAmount = "NULL";

                    if($community_id == 1)
                    {

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/reports/VendorExpenses?minorversion=8');
                          // curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
                          curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="doJ2s3%2F2B6LEarru2JKFfy9%2B8V0%3D"'));
                          // curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                          $result = curl_exec($ch);
                          $result  = json_decode($result);
        
                          $vendorsArray = array();

                            foreach ($result->Rows->Row as $ColumnData) 
                            {
                              
                              $values = array();
                              $id = -10;
                              $vendors = array();
                              $amounts = array();
            
                              foreach ($ColumnData as $row) 
                              {
                                  
                                  $name = "";
                                  $id = "";
                                  $amount = "";
                                  
                                  if ( $row->ColData )
                                  {
                                      
                                      $finalAmount = $row->ColData[1]->value;
                                      setlocale(LC_MONETARY, 'en_US');
                                      $finalAmount = money_format('%#10n', $finalAmount);

                                  }
                                  else 
                                  {
                   
                                      $vendorsArray[$row[0]->value] = $row[1]->value;
                                      setlocale(LC_MONETARY, 'en_US');
                                      $vendorsArray[$row[0]->value] = money_format('%#10n', $row[1]->value);

                                  }

                              }
                          
                          }

                          foreach ($vendorsArray as $key => $value) 
                            {
                                
                              if ( $key && $value )
                                echo "<tr><td>".$key."</td><td>".$value."</td></tr>";

                          }

                        }
                    else if($community_id == 2)
                    {

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/VendorExpenses?minorversion=8');
                          // curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
                          curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="0pBXJJqrgWzGbU51XadGu%2FuKtyc%3D"'));
                          // curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                          $result = curl_exec($ch);
                          $result  = json_decode($result);
        
                          $vendorsArray = array();

                            foreach ($result->Rows->Row as $ColumnData) 
                            {
                              
                              $values = array();
                              $id = -10;
                              $vendors = array();
                              $amounts = array();
            
                              foreach ($ColumnData as $row) 
                              {
                                  
                                  $name = "";
                                  $id = "";
                                  $amount = "";
                                  
                                  if ( $row->ColData )
                                  {
                                      
                                      $finalAmount = $row->ColData[1]->value;
                                      setlocale(LC_MONETARY, 'en_US');
                                      $finalAmount = money_format('%#10n', $finalAmount);

                                  }
                                  else 
                                  {
                   
                                      $vendorsArray[$row[0]->value] = $row[1]->value;
                                      setlocale(LC_MONETARY, 'en_US');
                                      $vendorsArray[$row[0]->value] = money_format('%#10n', $row[1]->value);

                                  }

                              }
                          
                          }

                          foreach ($vendorsArray as $key => $value) 
                          {
                                
                            if ( $key && $value )
                              echo "<tr><td>".$key."</td><td>".$value."</td></tr>";

                          }

                        }

                      ?>
                    
                    </tbody>

                    <tfoot>
                  
                      <th>Total</th>
                      <th><?php if($finalAmount != 'NULL') echo $finalAmount; ?></th>

                    </tfoot>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </section>

      </div>

      <?php include 'footer.php'; ?>

      <div class="control-sidebar-bg"></div>

    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable({ "pageLength": 50 });
      });
    </script>

  </body>

</html>