<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    <script type="text/javascript">
        $(document).ready(function() {
  $(".js-example-basic-single").select2();
});
    </script>
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
    <link rel="stylesheet" href="dist/css/alt/AdminLTE-select2.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/select2.min.css" />

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/select2.min.js"></script>
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

          <h1><strong>Send To Member</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                 

                  <div class="row-fluid" style="float: left;">
                      <h5>Select Member</h5>
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Select2</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Minimal</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
            </div>
          </div>
        </div>
                  </div>

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
        $("#example1").DataTable({ "paging": false, "pageLength": 500, "info": false });
      });
    </script>

  </body>

</html>