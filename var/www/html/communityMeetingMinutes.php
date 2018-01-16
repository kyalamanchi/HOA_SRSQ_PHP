<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    
    <?php

      if(@!$_SESSION['hoa_username'])
        header("Location: https://hoaboardtime.com/logout.php");

      $community_id = $_SESSION['hoa_community_id'];
      $user_id = $_SESSION['hoa_user_id'];
      $mode = $_SESSION['hoa_mode'];

      include 'includes/dbconn.php';

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

          $today = date('Y-m-d');

        ?>
        
        <section class="content-header">

          <h1><strong>Minutes</strong></h1>

          <ol class="breadcrumb">
            
            <?php if($mode == 1) echo "<li><i class='fa fa-institution'></i> Community</li>"; ?>

            <li>Minutes</li>
          
          </ol>

        </section>

        <section class="content">
          
          <div class="row container-fluid">

            <ul class="timeline">

              <?php

                $result = pg_query("SELECT year_of_upload FROM document_management WHERE community_id=$community_id GROUP BY year_of_upload ORDER BY year_of_upload DESC");

                while($row = pg_fetch_assoc($result))
                {
                
                $year_of_upload = $row['year_of_upload'];
                
                echo "<li class='time-label'>
                  
                  <span class='bg-red'>".$year_of_upload."</span>

                </li> 

                <li>
          
                  <div class='timeline-item'>

                    <div class='timeline-body container-fluid'>";
                  
                      if($community_id == 2)
                        $result1 = pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND year_of_upload=$year_of_upload AND url LIKE '/SRSQ_HOA/Documents/Minutes/SRSQ_Minutes_".$year_of_upload."_%'");

                      while($row1 = pg_fetch_assoc($result1))
                      {

                        $desc = $row1['description'];
                        $document_url = $row1['url'];

                        echo "<div class='row container-fluid'><a href='https://hoaboardtime.com/getDocumentPreviewTest.php?t=-2&path=$document_url&desc=$desc' target='_blank'>$desc</a></div>";

                      }

                    echo "</div>
                    
                  </div>
                  
                </li>";

                }

              ?>

            </ul>

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
        $("#example1").DataTable({ "pageLength": 50, "order": [[0,"desc"]] });
      });
    </script>

  </body>

</html>