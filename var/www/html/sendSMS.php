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

<!--     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" /> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!--       <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>   -->

    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />





    <style type="text/css">
      body{
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
#content{
  flex: 1;
  background-color: white;
}

  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
[hidden] {
  display: none !important;
}
.btn.outline {
  background: none;
  padding: 12px 22px;
}
    .notbold{
    font-weight:normal
}​
body {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100vw;
    height: 100vh;
}
input {
    padding: 1px;
    align-self: center;
    min-width: 80px;
    max-width: 500px;
}
input, label {
    display:block;
}

div{
    display:inline-block;
    position:relative;
}

button{
 position:absolute;
 bottom:10px;
 right:10px;
}

    </style>
<script type="text/javascript">
</script>
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

          <h1><strong>Send SMS</strong></h1>

        </section>
        <br>
        <section class="content" id="content">

        <div>
          <div class="row-fluid">
              <label>Event</label>
              <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="eventType" onchange="getFileDetails();">
                      <option data-hidden="true"></option>
                      <?php
                        $query = "SELECT * from event_type";
                        $queryResult = pg_query($query);
                        while ($row = pg_fetch_assoc($queryResult)) {
                            echo '<option id="'.$row['id'].'">';
                              echo $row['event_type_name'];
                            echo '</option>';
                        }
                      ?>
              </select>
        </div>
        <br>
        <div class="form-group" style="width: 25%">
                  <label for="comment">Message:</label>
                  <textarea class="form-control" rows="5" id="comment"></textarea>
                  <button>Name</button>
                  <button>Address</button>
        </div>
        </div>
     
        </section>

</div>
      </div>

      <?php include 'footer.php'; ?>

      <div class="control-sidebar-bg"></div>

    </div>
    <div class="modal" id="pleaseWaitDialog2" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>


    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>
<script>
$(document).ready(
     function changeState(){
    if ( document.getElementById('deliveryType').value != "" ){
      document.getElementById("saveButton2").disabled = false;
    }
    else {
      document.getElementById("saveButton2").disabled = true;
    }
  }

);
</script>

      <script type="text/javascript">
            $('.daterange').daterangepicker({
              showDropdowns: true
            });
            $("#legalDateUntil").daterangepicker({
              singleDatePicker: true,
              showDropdowns: true
            });
            $("#deliveryType").change(function(){
                if ( $(this).val() ){
                document.getElementById("saveButton2").disabled = false;
                }
            });
      </script>
  </body>

</html>