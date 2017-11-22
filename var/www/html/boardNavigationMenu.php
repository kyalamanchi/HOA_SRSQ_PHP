<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<aside class="main-sidebar">
        
  <section class="sidebar">
          
    <ul class="sidebar-menu">
            
      <?php 

        if($community_id == 2)
          echo "<li class='header text-center'><img src='srsq_logo.JPG'></li>"; 

      ?>
            
      <li class="header text-center"> Quick Links </li>

      <li class="treeview">
              
        <a href='https://hoaboardtime.com/boardDashboard.php'>
                
          <i class="fa fa-dashboard"></i> <span>Board</span>

        </a>

      </li>

      <li class="treeview">
              
        <a href='https://hoaboardtime.com/financeDashboard.php'>
                
          <i class="fa fa-dollar"></i> <span>Finance</span>

        </a>

      </li>

      <li class="treeview">
              
        <a href='https://hoaboardtime.com/reservesDashboard.php'>
                
          <i class="fa fa-support"></i> <span>Reserves</span>

        </a>

      </li>

      <li class="treeview">
              
        <a>
                
          <i class="fa fa-envelope"></i> <span>Comms</span>

        </a>

      </li>

      <li class="header text-center"> Other Links </li>

      <li class="treeview">
              
        <a href="#">

          <i class="fa fa-users"></i> <span>Board</span>

          <span class="pull-right-container">
                        
            <i class="fa fa-angle-left pull-right"></i>

          </span>

        </a>

        <ul class="treeview-menu">
                
          <li>

            <a href='https://hoaboardtime.com/boardSetReminder.php'>

              <span>Create Reminder</span>

            </a>

          </li>

          <li>

            <a href='https://hoaboardtime.com/boardProcessPayment.php'>

              <span>Process Payments</span>
                  
            </a>

          </li>

          <li>

            <a href="https://hoaboardtime.com/boardViewReminders.php">

              <span>View Reminders</span>

            </a>

          </li>

        </ul>

      </li>

      <li class="treeview">
              
        <a href="#">

          <i class="fa fa-institution"></i> <span>Community</span>

          <span class="pull-right-container">
                        
            <i class="fa fa-angle-left pull-right"></i>

          </span>

        </a>

        <ul class="treeview-menu">
                
          <li>

            <a href="https://hoaboardtime.com/boardCommunityDisclosures.php">

              <span>Disclosures</span>

            </a>

          </li>

          <li>

            <a href="https://hoaboardtime.com/boardMailingList.php">

              <span>Mailing List</span>

            </a>

          </li>

        </ul>

      </li>

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

        <a href="https://hoaboardtime.com/boardCustomerBalance.php">

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

      <!-- Vendor -->
      <li class='treeview'>

        <a href="https://hoaboardtime.com/boardVendorDashboard.php">

          <i class="fa fa-wrench text-red"></i> <span>Vendor Dashboard</span>

        </a>

      </li>

    </ul>

  </section>

</aside>