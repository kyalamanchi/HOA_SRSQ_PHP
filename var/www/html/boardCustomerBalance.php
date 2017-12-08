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
          header("Location: logout.php");

        $community_id = $_SESSION['hoa_community_id'];
        $user_id=$_SESSION['hoa_user_id'];

        $result = pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id AND community_id=$community_id");
        $num_row = pg_num_rows($result);

        if($num_row == 0)
          header("Location: residentDashboard.php");

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
    <script type="text/javascript">
        function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 100px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}
      function emailStatement(hoaid){
          showPleaseWait();
            var request = new XMLHttpRequest();
  request.open("POST","https://hoaboardtime.com/getEmails.php",true);
  request.send(hoaid.id);
  request.onreadystatechange = function (){
      if (request.readyState == XMLHttpRequest.DONE) {
        hidePleaseWait();
            if ( request.responseText == "Failed to connect to database"){
                alert("Failed to connect to database.Please try again");
                return;
            }
            else if (request.responseText == "An error occured" ){
              alert(request.responseText);
              return;
            }
            var json = JSON.parse(request.responseText);
            var str = "";
            var count = 0;
            for ( var i = 0 ;i<json.length;i++){
               str = str.concat(json[i].email);
               str = str.concat(" ");
               count = count + 1;
            }
            if ( count > 1){
            showEmails(str,hoaid.id);
            }
            else {
              mailStatement2(hoaid.id,str);
            }
        }
      }
      }
      function sendSouthData(hoaid){
        showPleaseWait();
        jsonObj = [];
        item = {};
        item["hoaid"] = hoaid.id;
        jsonObj.push(item);
        lol =  JSON.stringify(jsonObj);
        var request= new XMLHttpRequest();
        request.open("POST", "https://hoaboardtime.com/sendViaSouthData.php", true);
        request.setRequestHeader("Content-type", "application/json");
        request.send(lol);
        request.onreadystatechange = function () {
          if (request.readyState == XMLHttpRequest.DONE) {
              hidePleaseWait();
              alert(request.responseText);
          }
          }
      }
      function showEmails(email,hoaid){
        $("#pleaseWaitDialog2").find('.modal-header').html('<h3>Edit Email</h3>');
        $("#pleaseWaitDialog2").find('.modal-body').html('\
        <label for="example-text-input">Emails</label>\
        <div>\
        <input class="form-control" type="text" value="'+email+'" id="emails">\
        </div>\
        ');
        $("#pleaseWaitDialog2").find('.modal-footer').html('<button type="button" id="'+hoaid+'" class="btn btn-success btn-lg" onclick="mailStatement(this);">Mail Statement</button>\
          <button type="button" class="btn btn-danger btn-lg" onclick="closeModal();">Close</button>');
        $("#pleaseWaitDialog2").modal("show");
      }
      function closeModal(){
         $("#pleaseWaitDialog2").modal("hide");
      }

      function mailStatement(button){
        closeModal();
        hidePleaseWait();
        showPleaseWait();
          var emails = document.getElementById("emails").value;
           jsonObj = [];
          item = {};
          item["hoaid"] = button.id;
    item["email"] = emails;
    jsonObj.push(item);
    lol =  JSON.stringify(jsonObj);
    var request= new XMLHttpRequest();
    request.open("POST", "https://hoaboardtime.com/sendViaMandrillEmails.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(lol);
    showPleaseWait();
    request.onreadystatechange = function () {
          if (request.readyState == XMLHttpRequest.DONE) {
              hidePleaseWait();
              alert(request.responseText);
          }
          }
      }
      function mailStatement2(hoaid,email){
        closeModal();
        hidePleaseWait();
        showPleaseWait();
        jsonObj = [];
        item = {};
        item["hoaid"] = hoaid;
  item["email"] = email;
  jsonObj.push(item);
  lol =  JSON.stringify(jsonObj);
  var request= new XMLHttpRequest();
  request.open("POST", "https://hoaboardtime.com/sendViaMandrillEmails.php", true);
  request.setRequestHeader("Content-type", "application/json");
  request.send(lol);
  showPleaseWait();
  request.onreadystatechange = function () {
        if (request.readyState == XMLHttpRequest.DONE) {
            hidePleaseWait();
            alert(request.responseText);
        }
        }
}
    </script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

        <header class="main-header">
        
          <a class="logo">
          
              <span class="logo-mini"><?php echo $_SESSION['hoa_community_code']; ?></span>
          
              <span class="logo-lg"><?php echo $_SESSION['hoa_community_name']; ?></span>

          </a>
        
          <nav class="navbar navbar-static-top">
          
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                
                <span class="sr-only">Toggle navigation</span>

              </a>

              <div class="navbar-custom-menu">
              
                <ul class="nav navbar-nav">

                  <li class="dropdown user user-menu">
                
                    <a href="https://hoaboardtime.com/residentDashboard.php">Resident Dashboard</a>

                  </li>

                  <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                        <i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $_SESSION['hoa_username']; ?></span>

                    </a>

                    <ul class="dropdown-menu">
                    
                        <li class="user-header">
                      
                          <i class="fa fa-user fa-5x"></i>

                          <p>
                        
                              <?php echo $_SESSION['hoa_username']; ?>

                              <br>

                              <small><?php echo $_SESSION['hoa_address']; ?></small>

                              <a href="https://hoaboardtime.com/logout.php" class="btn btn-warning">Log Out</a>

                            <br>

                          </p>

                        </li>

                    </ul>

                  </li>

                </ul>

              </div>

          </nav>

        </header>
      
        <aside class="main-sidebar">
        
          <section class="sidebar">
          
              <ul class="sidebar-menu">
            
                <?php if($community_id == 2)
                echo "<li class='header text-center'>

                  <img src='srsq_logo.JPG'>

                </li>"; ?>

                <li class="header text-center"> Quick Links </li>

                <li class="treeview">
              
                  <a href='https://hoaboardtime.com/boardDashboard.php'>
                
                    <i class="fa fa-dashboard"></i> <span>Board Dashboard</span>

                  </a>

                </li>
            
                <li class="treeview">
              
                  <a href="#">

                    <i class="glyphicon glyphicon-hdd"></i> <span>Document Management</span>

                    <span class="pull-right-container">
                        
                      <i class="fa fa-angle-left pull-right"></i>

                    </span>

                  </a>

                  <ul class="treeview-menu">
                
                    <li><a><i class="fa fa-male text-green"></i> Member Documents</a></li>
                    <li><a><i class="fa fa-wrench text-red"></i> Vendor Documents</a></li>

                  </ul>

                </li>
             
                <li class="treeview">

                  <a href='https://hoaboardtime.com/boardProcessPayment.php'>

                    <i class='fa fa-dollar'></i> <span>Process Payments</span>
              
                  </a>

                </li>
            
                <li class="treeview">
              
                  <a href='https://hoaboardtime.com/boardSetReminder.php'>

                    <i class='fa fa-bell'></i> <span>Create Reminder</span>

                  </a>

                </li>

                <li class="header text-center"> Other Links </li>

                <!-- Board -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCharges.php">

                    <i class="fa fa-users text-blue"></i> <span>Late Fee / Write Off </span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityDisclosures.php">

                    <i class="fa fa-users text-blue"></i> <span>Community Disclosures</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a>

                    <i class="fa fa-users text-blue"></i> <span>Digital Board Room</span>

                  </a>

                </li>

                <li class='treeview'>
                  
                  <a href="https://hoaboardtime.com/boardPreviousMonthsPayments.php">

                    <i class="fa fa-users text-blue"></i> <span>Previous Months Payments</span>

                  </a>

                </li>

                <li class="treeview">
                  
                  <a href="https://hoaboardtime.com/boardSurveyDetails.php">

                    <i class="fa fa-users text-blue"></i> <span>Survey Details</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityExpenditureSummary.php">

                    <i class="fa fa-users text-blue"></i> <span>YTD Expenses</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityDeposits.php">

                    <i class="fa fa-users text-blue"></i> <span>YTD Income</span>

                  </a>

                </li>

                <!-- Member -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardMailingList.php">

                    <i class="fa fa-street-view text-green"></i> <span>Community Mailing List</span>

                  </a>

                </li>
                      
                <li class='active treeview'>

                  <a>

                    <i class="fa fa-street-view text-green"></i> <span>Customer Balance</span>

                  </a>

                </li>
                
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardHOAHomeInfo.php">

                    <i class="fa fa-street-view text-green"></i> <span>HOA &amp; Home Info</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardUserDashboard.php">

                    <i class="fa fa-street-view text-green"></i> <span>User Dashbord</span>

                  </a>

                </li>
                
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardViewReminders.php">

                    <i class="fa fa-street-view text-green"></i> <span>View Reminders</span>

                  </a>

                </li>

                <!-- Vendor -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardVendorDashboard.php">

                    <i class="fa fa-wrench text-red"></i> <span>Vendor Dashboard</span>

                  </a>

                </li>

              </ul>

          </section>

        </aside>

      <div class="content-wrapper">

        <?php

          $year = date("Y");
          $month = date("m");
          $end_date = date("t");

          $today = date("Y-m-d");

        ?>
        
        <section class="content-header">

          <h1><strong>Customer Balance</strong></h1>

        </section>

        <section class="content">

          <div class="row">

            <center>
              
              <form method='POST' action='https://hoaboardtime.com/boardCustomerBalance.php'>
                  
                <?php

                  if(isset($_POST['submit']))
                  {    
                                    
                    switch($_POST['having'])
                    {
                                        
                      case 1 :
                        echo "Show customers having balance <input type='radio' name='having' checked id='having' value='1' required> Greater than <input type='radio' name='having' id='having' value='2'> Equal to <input type='radio' name='having' id='having' value='3'> Less than <b>$</b> <input type='number' name='value' size=2 id='value' step='0.01' value='".$_POST['value']."' required><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Customers'>";
                      break; 

                      case 2 :
                        echo "Show customers having balance <input type='radio' name='having' id='having' value='1' required> Greater than <input type='radio' name='having' id='having' checked value='2'> Equal to <input type='radio' name='having' id='having' value='3'> Less than <b>$</b> <input type='number' name='value' size=2 id='value' step='0.01' value='".$_POST['value']."' required><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Customers'>";
                      break;

                      case 3 :
                        echo "Show customers having balance <input type='radio' name='having' id='having' value='1' required> Greater than <input type='radio' name='having' id='having' value='2'> Equal to <input type='radio' name='having' id='having' checked value='3'> Less than <b>$</b> <input type='number' name='value' size=2 id='value' step='0.01' value='".$_POST['value']."' required><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Customers'>";
                      break;

                    }

                  }
                  else
                    echo "Show customers having balance <input type='radio' name='having' id='having' value='1' checked required> Greater than <input type='radio' name='having' id='having' value='2'> Equal to <input type='radio' name='having' id='having' value='3'> Less than $ <input type='number' size=2 name='value' id='value' step='0.01' value='0.00' required><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Customers'>";

                ?>

              </form>

            </center>

          </div>

          <br><br>
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">
                
                <div class="box-body table-responsive">
                  
                  <?php
                    
                    if(isset($_POST['submit']))
                    {
                                
                      $having = $_POST['having'];
                      $value = $_POST['value'];

                      if($having == 1)
                      {
                        
                        $result = pg_query("SELECT cc.hoa_id, cc.home_id FROM current_charges cc GROUP BY cc.home_id, cc.hoa_id HAVING (sum(cc.amount)-(SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND home_id=cc.home_id AND hoa_id=cc.hoa_id))>".$value." ORDER BY cc.home_id"); 

                      }
                      else if ($having == 2) 
                      {
                        
                        $result = pg_query("SELECT cc.hoa_id, cc.home_id FROM current_charges cc GROUP BY cc.home_id, cc.hoa_id HAVING (sum(cc.amount)-(SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND community_id=$community_id AND home_id=cc.home_id AND hoa_id=cc.hoa_id))=".$value." ORDER BY cc.home_id"); 

                      }
                      else
                      {
                        
                        $result = pg_query("SELECT cc.hoa_id, cc.home_id FROM current_charges cc GROUP BY cc.home_id, cc.hoa_id HAVING (sum(cc.amount)-(SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND community_id=$community_id AND home_id=cc.home_id AND hoa_id=cc.hoa_id))<".$value." ORDER BY cc.home_id"); 

                      }

                      echo "<br><center>Total Number of records fetched : ".pg_num_rows($result)."</center><br>";

                      echo "<table class='table table-striped table-bordered' id='example1' width=100%>";

                     echo "<thead><th></th><th>Name<br>Living In</th><th>Contact Details</th><th>Total Charges<br>Total Payments</th><th>Total Balance</th><th></th><th></th></thead><tbody>";

                      while ($row = pg_fetch_assoc($result)) 
                      {
                        
                        $hoa_id = $row['hoa_id'];
                        $home_id = $row['home_id'];

                        $result1 = pg_query("SELECT firstname, community_id, lastname, email, cell_no FROM hoaid WHERE hoa_id=".$hoa_id);
                        $row1 = pg_fetch_assoc($result1);

                        $community_id = $row1['community_id'];
                        $name = $row1['firstname'];
                        $name .= " ";
                        $name .= $row1['lastname'];
                        $email = $row1['email'];
                        $phone = $row1['cell_no'];

                        $result1 = pg_query("SELECT address1 FROM homeid WHERE community_id=$community_id AND home_id=$home_id");
                        $row1 = pg_fetch_assoc($result1);

                        $address = $row1['address1'];

                        $result1 = pg_query("SELECT sum(amount) FROM current_charges WHERE community_id=$community_id AND home_id=$home_id AND hoa_id=$hoa_id");
                        $row1 = pg_fetch_assoc($result1);

                        $charges = $row1['sum'];

                        $result1 = pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND community_id=$community_id AND home_id=$home_id AND hoa_id=$hoa_id");
                        $row1 = pg_fetch_assoc($result1);

                        $payments = $row1['sum'];

                        if($payments == "")
                          $payments = 0.0;

                        $balance = $charges - $payments;

                        $result1 = pg_query("SELECT * FROM reminders WHERE home_id=$home_id AND is_active='t'");
                        $numrow1 = pg_num_rows($result1);
                        if($numrow1 != 0 )
                        {  

                          $row1 = pg_fetch_assoc($result1);
                          $rid = $row1['id'];
                          $o_date = $row1['open_date'];
                          $d_date = $row1['due_date'];
                          $reminder_type_id = $row1['reminder_type_id'];
                          $comment = $row1['comments'];

                          echo "

                          <div class='modal fade hmodal-success' id='editReminder_$rid' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                                      
                              <div class='modal-content'>
                                          
                                <div class='modal-header'>
                                                                  
                                  <h4 class='modal-title'>Edit Reminder - <strong>".$name."</strong></h4>

                                </div>

                                <div class='modal-body'>
                                                                  
                                  <div class='container-fluid'>

                                    <form class='row' method='post' action='https://hoaboardtime.com/boardEditReminder.php'>

                                      <div class='row container-fluid'>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                          <label>Open Date</label>
                                          <input class='form-control' type='date' name='edit_reminder_open_date' id='edit_reminder_open_date' value='$o_date' readonly>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                          <label>Due Date</label>
                                          <input class='form-control' type='date' name='edit_reminder_due_date' id='edit_reminder_due_date' value='$d_date' required>

                                        </div>

                                      </div>

                                      <br>

                                      <div class='row container-fluid'>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                          <label>Reminder Type</label>
                                          <select class='form-control' type='date' name='edit_reminder_type' id='edit_reminder_type' required>

                                            <option value='' selected disabled>Select Reminder Type</option>";

                                            $ree = pg_query("SELECT * FROM reminder_type ORDER BY reminder_type");

                                            while($roo = pg_fetch_assoc($ree))
                                            {

                                              $r_id = $roo['id'];
                                              $r_type = $roo['reminder_type'];

                                              echo "<option ";

                                              if($r_id == $reminder_type_id)
                                                echo " selected ";

                                              echo "value='$r_id'>$r_type</option>";
                                            }

                                          echo "</select>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                          <label>Vendor Assigned</label>
                                          <select class='form-control' type='date' name='edit_vendor' id='edit_vendor'>

                                            <option value='' selected>NONE</option>";

                                            $ree = pg_query("SELECT * FROM vendor_master WHERE community_id=$community_id");

                                            while($roo = pg_fetch_assoc($ree))
                                            {

                                              $vendor_id = $roo['vendor_id'];
                                              $vendor_name = $roo['vendor_name'];

                                              echo "<option value='$vendor_id'>$vendor_name</option>";
                                            }

                                          echo "</select>

                                          <input type='hidden' name='reminder_id' id='reminder_id' value='$rid'>

                                        </div>

                                      </div>

                                      <br>

                                      <div class='row container-fluid'>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                          <label>Comment</label>
                                          <textarea id='edit_comment' name='edit_comment' class='form-control' required>$comment</textarea>

                                        </div>

                                      </div>

                                      <br>

                                      <div class='row container-fluid text-center'>
                                              
                                        <button type='submit' name='submit' id='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Update</button>
                                        <button type='button' class='btn btn-warning btn-xs' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>

                                      </div>

                                    </form>
                                                                  
                                  </div>

                                </div>

                              </div>
                                    
                            </div>

                          </div>

                          ";

                          $reminder = "<center><a data-toggle='modal' data-target='#editReminder_$rid'><i class='fa fa-bell text-green'></i></a></center>";
                        }
                        else
                          $reminder = "<center><a title='Set Reminder' href='https://hoaboardtime.com/boardSetReminder2.php?name=$name&living_in=$address&hoa_id=$hoa_id&home_id=$home_id&email=$email'><i class='fa fa-bell'></i></a></center>";

                        echo "<tr><td>$reminder</td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name ($hoa_id)</a><br>$address ($home_id)</td><td>$email<br>$phone</td><td>$ $charges<br>$ $payments</td><td>$ $balance</td><td><form method='POST' action='print_invoice.php'><a target='_blank' href='viewBillingStatement.php?hoa_id=$hoa_id'><i class='fa fa-print'></i> Invoice</a></td><td><button type=\"button\" class=\"btn btn-default\" id=$hoa_id onclick=\"emailStatement(this);\">Email Statement</button>
                        <button type=\"button\" id=$hoa_id class=\"btn btn-default\" onclick=\"sendSouthData(this);\">Send Via SouthData</button></td></tr>";


                      }

                      echo"</tbody><tfoot><th></th><th>Name<br>Living In</th><th>Contact Details</th><th>Total Charges<br>Total Payments</th><th>Total Balance</th><th></th><th></th></tfoot><table>";

                    }
                    else
                    {
                                
                      $having = 1;
                      $value = 0;

                      $result = pg_query("SELECT cc.hoa_id, cc.home_id FROM current_charges cc GROUP BY cc.home_id, cc.hoa_id HAVING (sum(cc.amount)-(SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND home_id=cc.home_id AND hoa_id=cc.hoa_id))>".$value." ORDER BY cc.home_id");

                      echo "<br><center>Total Number of records fetched : ".pg_num_rows($result)."</center><br>";

                      echo "<table class='table table-striped table-bordered' id='example1' width=100%>";

                      echo "<thead><th></th><th>Name<br>Living In</th><th>Contact Details</th><th>Total Charges<br>Total Payments</th><th>Total Balance</th><th></th><th></th></thead><tbody>";

                      while ($row = pg_fetch_assoc($result)) 
                      {
                        
                        $hoa_id = $row['hoa_id'];
                        $home_id = $row['home_id'];

                        $result1 = pg_query("SELECT firstname, community_id, lastname, email, cell_no FROM hoaid WHERE hoa_id=".$hoa_id);
                        $row1 = pg_fetch_assoc($result1);

                        $community_id = $row1['community_id'];
                        $name = $row1['firstname'];
                        $name .= " ";
                        $name .= $row1['lastname'];
                        $email = $row1['email'];
                        $phone = $row1['cell_no'];

                        $result1 = pg_query("SELECT address1 FROM homeid WHERE community_id=$community_id AND home_id=$home_id");
                        $row1 = pg_fetch_assoc($result1);

                        $address = $row1['address1'];

                        $result1 = pg_query("SELECT sum(amount) FROM current_charges WHERE community_id=$community_id AND home_id=$home_id AND hoa_id=$hoa_id");
                        $row1 = pg_fetch_assoc($result1);

                        $charges = $row1['sum'];

                        $result1 = pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND community_id=$community_id AND home_id=$home_id AND hoa_id=$hoa_id");
                        $row1 = pg_fetch_assoc($result1);

                        $payments = $row1['sum'];

                        if($payments == "")
                                      $payments = 0.0;

                        $balance = $charges - $payments;

                        $result1 = pg_query("SELECT * FROM reminders WHERE home_id=$home_id AND hoa_id=$hoa_id");
                        $numrow1 = pg_num_rows($result1);

                        $row1 = pg_fetch_assoc($result1);

                        $o_date = $row1['open_date'];
                        $d_date = $row1['due_date'];

                        if($numrow1 != 0 && $today>=$d_date)
                        {
                          $reminder = "<center><a data-toggle='modal' data-target='#editReminder_$rid'><i class='fa fa-bell text-green'></i></a></center>";
                        }
                        else
                          $reminder = "<center><a title='Set Reminder' href='https://hoaboardtime.com/boardSetReminder2.php?name=$name&living_in=$address&hoa_id=$hoa_id&home_id=$home_id&email=$email'><i class='fa fa-bell'></i></a></center>";

                        if($email != '')
                        {
                                    
                          $arr = array();
                          $arr = explode('@', $email);
                          $email = $arr[0];
                          $i = strlen($email);

                          for($j = 3; $j < $i; $j++)
                            $email[$j] = '*';

                          $email = $email.'@'.$arr[1];

                        }

                        echo "<tr><td>$reminder</td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name ($hoa_id)</a><br>$address ($home_id)</td><td>$email<br>$phone</td><td>$ $charges<br>$ $payments</td><td>$ $balance</td><td><form method='POST' action='print_invoice.php'><a target='_blank' href='viewBillingStatement.php?hoa_id=$hoa_id'><i class='fa fa-print'></i> Invoice</a></td><td><button type=\"button\" class=\"btn btn-default\" id=$hoa_id onclick=\"emailStatement(this);\">Email Statement</button>
                        <button type=\"button\" id=$hoa_id class=\"btn btn-default\" onclick=\"sendSouthData(this);\">Send Via SouthData</button></td></tr>";


                      }

                      echo"</tbody><tfoot><th></th><th>Name<br>Living In</th><th>Contact Details</th><th>Total Charges<br>Total Payments</th><th>Total Balance</th><th></th><th></th></tfoot><table>";

                    }
                  
                  ?>

                </div>

              </div>

            </section>

          </div>

        </section>

      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs"></div>
        
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_blank' href="<?php echo $_SESSION['hoa_community_website_url']; ?>"><?php echo $_SESSION['hoa_community_name']; ?></a>.</strong> All rights reserved.

      </footer>

      <div class="control-sidebar-bg"></div>

    </div>

    <div class="modal" id="pleaseWaitDialog2" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
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
        $("#example1").DataTable({ "pageLength": 50, "order": [[1, "asc"]] });
      });
    </script>

  </body>

</html>