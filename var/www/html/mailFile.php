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
    
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>


    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/alt/AdminLTE-select2.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


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
    </style>
<script type="text/javascript">
  

  function getAddress(){
      $("modal-warning").modal("show");
      $("#memberAddress").find('option').remove();
      $("#memberAddress").selectpicker('refresh');
      var selectedMember = $('#memberID').find("option:selected").text();
      if ( selectedMember ){
        var memberId = $('#memberID').val();
        json = [];

        item = {};
        item["member_id"] = memberId;
        json.push(item);
        data = JSON.stringify(json);
        var request= new XMLHttpRequest();
        request.open("POST", "https://hoaboardtime.com/getAddress.php", true);
        request.setRequestHeader("Content-type", "application/json");
        request.send(data);
        request.onreadystatechange = function () {
          if (request.readyState == XMLHttpRequest.DONE) {
              alert(request.responseText);

        }
        }
      } 
      else {
        swal("Please select a member","","error");
      }
  }

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

          <h1><strong>Send To Member</strong></h1>

        </section>
        <br>
        <section class="content" id="content">
                 

                <div class="row-fluid">
                    <label>Select Member</label>
                    <br>
                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="memberID" onchange="getAddress();">
                      <option></option>
                      <?php

                        $query = "SELECT * FROM HOMEID WHERE COMMUNITY_ID =".$_SESSION['hoa_community_id'];
                        $queryResult = pg_query($query);
                        $homeIDS = array();

                        while ($row = pg_fetch_assoc($queryResult)) {
                          $homeIDS[$row['home_id']] = $row['address1'];
                        }

                        $query = "SELECT * FROM HOAID WHERE COMMUNITY_ID =".$_SESSION['hoa_community_id'];
                        $queryResult = pg_query($query);

                        $hoaIDS = array();
                        $hoaHomeIDS = array();
                        while ($row = pg_fetch_assoc($queryResult)) {
                          $hoaIDS[$row['hoa_id']] = $row['firstname'].' '.$row['lastname'];
                          $hoaHomeIDS[$row['hoa_id']] = $row['home_id'];
                        }

                        foreach ($hoaIDS as $key => $value) {
                          echo '<option value="'.$key.'" data-subtext="'.$value.'('.$key.')'.'">'.$homeIDS[$hoaHomeIDS[$key]].'</option>';
                        }


                      ?>
                    </select>
                </div>

                <br>
                
                <div class="row-fluid">
                    <label>ADDRESS</label>
                    <br>
                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="memberAddress" onchange="changeOptions();">
                    </select>
                </div>

                <div style="clear: both;"></div>
                <br>
                <br>
                <div>
                    <label>Select File</label>
                </div>
                <br>
                <br>

          </section>

</div>
      </div>

      <?php include 'footer.php'; ?>

      <div class="control-sidebar-bg"></div>

    </div>
            <div class="modal modal-warning fade" id="modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  </body>

</html>