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

<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $community_code; ?> - Annual Report</title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <style type="text/css">
      
      .collapsing {
  
          position: relative;
          height: 0;
          overflow: hidden;
          -webkit-transform: translateZ(0);
          -webkit-transition: height 0.35s ease 1s linear;
          -moz-transition: height 0.35s ease 1s linear;
          -o-transition: height 0.35s ease 1s linear;
          -ms-transition: height 0.35s ease 1s linear;
          transition: height 0.35s ease 1s linear;
          -webkit-transition: height 0.35s ease;
          transition: height 0.35s ease;
      }

      table .collapse.in {
    
          display:table-row;
    
      }

        .notbold{
    
          font-weight:normal
      }​

    </style>

    <script type="text/javascript">

      $(document).ready(function() {

          var table = $('#example').DataTable( {
        
              "ordering": false,
              "paging": false,
              "scrollY":        "600px",
              "scrollCollapse": true

          } );
      } );

      </script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

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

    <div class="content-wrapper">
        
        <section class="content-header">

          <h1><strong>General Ledger</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Date</th>
                        <th>Transaction Type</th>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Memo / Description</th>
                        <th>Split</th>
                        <th>Amount</th>
                        <th>Balance</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                        setlocale(LC_MONETARY, 'en_US');
                        error_reporting(E_ERROR | E_PARSE);
                        ini_set('display_errors', 1);
                          
                        if($community_id == 2)
                        {

                          $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/GeneralLedger?date_macro=This%20Fiscal%20Year');
              
                          curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509663029",oauth_nonce="VobfNZi3JwU",oauth_version="1.0",oauth_signature="4XCX1HNmLhF1DFp08eLyDXlwomI%3D"'));
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          $result = curl_exec($ch);
                          $result = json_decode($result);
                          $idNum = 1;
              
                          foreach ($result->Rows->Row as $generalLedger) 
                          {

                            $idVal = "row".$idNum;

                            if ( isset($generalLedger->Header->ColData[0]->value) )
                            {

                              $printVal = '<tr class="clickable" data-toggle="collapse" id="'.$idVal.'" data-target=".'.$idVal.'">'.'<td><i class="fa fa-plus"></i> '.$generalLedger->Header->ColData[0]->value.'</td>'.'<td>'.$generalLedger->Header->ColData[1]->value.'</td>'.'<td>'.$generalLedger->Header->ColData[2]->value.'</td>'.'<td>'.$generalLedger->Header->ColData[3]->value.'</td>'.'<td>'.$generalLedger->Header->ColData[4]->value.'</td>'.'<td>'.$generalLedger->Header->ColData[5]->value.'</td>'.'<td>'.money_format('%#10n',$generalLedger->Header->ColData[6]->value).'</td>'.'<td>'.money_format('%#10n',$generalLedger->Header->ColData[7]->value).'</td>'.'</tr>';

                              echo $printVal;

                              foreach ($generalLedger->Rows->Row as $childTrans) 
                              {

                                if ( isset($childTrans->ColData[0]->value) )
                                {

                                  echo '<tr class="collapse '.$idVal.'"><td>'.$childTrans->ColData[0]->value.'</td><td>'.$childTrans->ColData[1]->value.'</td><td>'.$childTrans->ColData[2]->value.'</td><td>'.$childTrans->ColData[3]->value.'</td><td>'.$childTrans->ColData[4]->value.'</td><td>'.$childTrans->ColData[5]->value.'</td><td>'.money_format('%#10n',$childTrans->ColData[6]->value).'</td><td>'.money_format('%#10n',  $childTrans->ColData[7]->value).'</td></tr>';
                               
                                }
                         
                              }

                              if ( isset($generalLedger->Summary->ColData[0]->value)  )
                              {

                                echo '<tr class="collapse '.$idVal.'"><td><b>'.$generalLedger->Summary->ColData[0]->value.'</b></td><td><b>'.$generalLedger->Summary->ColData[1]->value.'</b></td><td><b>'.$generalLedger->Summary->ColData[2]->value.'</b></td><td><b>'.$generalLedger->Summary->ColData[3]->value.'</b></td><td><b>'.$generalLedger->Summary->ColData[4]->value.'</b></td><td><b>'.$generalLedger->Summary->ColData[5]->value.'</b></td><td><b>'.money_format('%#10n',$generalLedger->Summary->ColData[6]->value).'</b></td><td><b>'.money_format('%#10n',  $generalLedger->Summary->ColData[7]->value).'</b></td></tr>';

                              }

                            }
                            else if ( isset($generalLedger->Summary->ColData[0]->value) )
                            {

                              $printVal = '<b><tr class="clickable" data-toggle="collapse" id="'.$idVal.'" data-target=".'.$idVal.'">'.'<td><b>'.$generalLedger->Summary->ColData[0]->value.'</b></td>'.'<td><b>'.$generalLedger->Summary->ColData[1]->value.'</b></td>'.'<td><b>'.$generalLedger->Summary->ColData[2]->value.'</b></td>'.'<td><b>'.$generalLedger->Summary->ColData[3]->value.'</b></td>'.'<td><b>'.$generalLedger->Summary->ColData[4]->value.'</b></td>'.'<td><b>'.$generalLedger->Summary->ColData[5]->value.'</b></td>'.'<td><b>'.money_format('%#10n', $generalLedger->Summary->ColData[6]->value).'</b></td>'.'<td><b>'.money_format('%#10n',  $generalLedger->Summary->ColData[7]->value).'</b></td>'.'</tr></b>';
                                    
                              echo $printVal;

                            }
                                
                            $idNum = $idNum +  1;
                   
                          }

                        }

                      ?>
                    
                    </tbody>

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
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>

    <script>
      $(function () {
        $("#example1").DataTable({ "paging": false, "pageLength": 500, "info": false });
      });
    </script>

  </body>

</html>