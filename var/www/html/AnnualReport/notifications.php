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

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='HOA Alchemy User Features'>
		<meta name='author' content='Geeth'>

		<title><?php echo $community_code; ?> - Annual Report</title>

		<!-- Web Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Hind:400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora:400i" rel="stylesheet">
		<!-- Bootstrap core CSS-->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Icon Fonts-->
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/linea-arrows.css" rel="stylesheet">
		<link href="assets/css/linea-icons.css" rel="stylesheet">
		<!-- Plugins-->
		<link href="assets/css/owl.carousel.css" rel="stylesheet">
		<link href="assets/css/flexslider.css" rel="stylesheet">
		<link href="assets/css/magnific-popup.css" rel="stylesheet">
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<!-- Template core CSS-->
		<link href="assets/css/template.min.css" rel="stylesheet">
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

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-left'>

						<a><h5 style='color: green;'><?php echo $community_name; ?></h5></a>

					</div>

					<!-- Navigation-->
					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>
				
							<div class='inner-nav'>
						
								<ul>

									<li><a style="color: green;"><span>Hello <?php echo $username; ?></span></a></li>

									<li><a style="color: orange;" href='logout.php'><span><i class='fa fa-sign-out'></i> Log Out</span></a></li>

								</ul>

							</div>

						</div>

					</div>

                    <!-- Mobile menu-->
                    <div class='nav-toggle'>
                        
                        <a href='#' data-toggle='collapse' data-target='.inner-navigation'>
                            
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>

                        </a>

                    </div>
				
				</div>

			</header>

			<div class='wrapper'>

                <!-- Page Header -->
                <section class='module-page-title'>
                                    
                    <div class='container'>
                                            
                        <div class='row-page-title'>
                                            
                            <div class='page-title-captions'>
                                                
                                <ol class="breadcrumb">
                                        
                                    <li class="breadcrumb-item">User Details</li>
                                    <li class="breadcrumb-item">Home Details</li>
                                    <li class="breadcrumb-item">Persons</li>
                                    <li class='breadcrumb-item'>Primary Email</li>
                                    <li class='breadcrumb-item'><strong style='color: black;'>SMS Notifications</strong></li>
                                    <li class="breadcrumb-item">Agreements</li>
                                    <li class='breadcrumb-item'>Documents</li>
                                    <li class='breadcrumb-item'>CCR Inspection Notices</li>
                                    <li class="breadcrumb-item">Payments</li>
                                    <li class="breadcrumb-item">HOA Fact Sheet</li>
                                    <li class="breadcrumb-item">Disclosures</li>

                                </ol>
                                            
                            </div>
                                        
                        </div>
                                        
                    </div>
                                
                </section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

                        <div id='notifications_div'>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>SMS Notifications</h3></center>

                                </div>

                            </div>

                            <br>

                            <div class='row container-fluid'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table class='table table-striped' style="color: black;">

                                        <thead>
                                            
                                            <th>Person Name</th>
                                            <th>Event</th>
                                            <th>Phone Notification</th>
                                            <th>Email Notification</th>
                                            <th>Create Date</th>

                                        </thead>

                                        <tbody>
                                            
                                            <?php

                                                $result = pg_query("SELECT * FROM community_comms WHERE hoa_id=$hoa_id");

                                                while ($row = pg_fetch_assoc($result)) 
                                                {

                                                    $person_id = $row['person_id'];
                                                    $event_type_id = $row['event_type_id'];
                                                    $create_date = $row['create_date'];
                                                    $phone = $row['phone'];
                                                    $email = $row['email'];

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE id=$person_id"));
                                                    $pname = $row1['fname'];
                                                    $pname .= " ";
                                                    $pname .= $row1['lname'];
                                                    $is_active = $row1['is_active'];

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM event_type WHERE event_type_id=$event_type_id"));
                                                    $event_type_name = $row1['event_type_name'];
                                                    $event_header = $row1['header'];

                                                    if($phone == 't')
                                                        $phone = 'Enabled';
                                                    else
                                                        $phone = 'Disabled';

                                                    if($email == 't')
                                                        $email = 'Enabled';
                                                    else
                                                        $email = 'Disabled';

                                                    if($create_date != '')
                                                        $create_date = date('m-d-Y', strtotime($create_date));

                                                    if($is_active == 't')
                                                        echo "<tr><td>$pname</td><td>$event_header - $event_type_name</td><td>$phone</td><td>$email</td><td>$create_date</td></tr>";

                                                }

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row container'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <form method='POST' action='updateCommunityComms.php' style='color: black;'>

                                        <?php

                                            $i = 0;
                                            $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' ORDER BY fname");

                                            $total_persons = pg_num_rows($result);

                                            echo "<input type='hidden' name='total_persons' id='total_persons' value='$total_persons'>";

                                            while($row = pg_fetch_assoc($result))
                                            {

                                                $i++;

                                                $cc_person_id = $row['id'];
                                                $cc_person_firstname = $row['fname'];
                                                $cc_person_lastname = $row['lname'];

                                                echo "<input type='hidden' name='".$i."_person_id' id='".$i."_person_id' value='".$cc_person_id."'>";

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Person Name</strong> : $cc_person_firstname $cc_person_lastname

                                                    </div>

                                                </div>

                                                ";

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Board Meeting</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=1");

                                                $bm = pg_num_rows($res1);

                                                if($bm != 0)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_1' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_2' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_3' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='None'";

                                                            if($cc_email == 'f' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > None

                                                        </div>

                                                    </div>

                                                    ";

                                                }
                                                else
                                                {

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Phone'> SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Email'> Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Payment Received</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=4");

                                                $bm = pg_num_rows($res1);

                                                if($bm)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='None'";

                                                            if($cc_email == 'f' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > None

                                                        </div>

                                                    </div>

                                                    ";

                                                }
                                                else
                                                {

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Phone'> SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Email'> Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Landscape Maintenance / Repair</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=9");

                                                $bm = pg_num_rows($res1);

                                                if($bm)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='None'";

                                                            if($cc_email == 'f' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > None

                                                        </div>

                                                    </div>

                                                    ";

                                                }
                                                else
                                                {

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Phone'> SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Email'> Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Late Payment Posted</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=14");

                                                $bm = pg_num_rows($res1);

                                                if($bm)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='None'";

                                                            if($cc_email == 'f' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > None

                                                        </div>

                                                    </div>

                                                    ";

                                                }
                                                else
                                                {

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Phone'> SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Email'> Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Inspection Notices</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=16");

                                                $bm = pg_num_rows($res1);

                                                if($bm)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='None'";

                                                            if($cc_email == 'f' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > None

                                                        </div>

                                                    </div>

                                                    ";

                                                }
                                                else
                                                {

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Phone'> SMS

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Email'> Email

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_inspection_notices' id='".$i."_inspection_notices' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "<br><br>";

                                            }

                                        ?>

                                        <div class='row'>

                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                <center>

                                                    <button class='btn btn-xs btn-info' type='submit'><i class='fa fa-save'></i> Save</button>

                                                </center>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <hr class='small'>

                                    <div class='row'>
                                        
                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                            <button class='btn btn-warning btn-xs' type='button' id='notifications_back' name='notifications_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='notifications_continue' id='notifications_continue'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <br>

                        </div>

					</div>

				</section>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/notifications.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Datatable -->
        <script src='//code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

        <script>
        
            $(function () {
                
                $("#inspectionNoticesTable").DataTable({ "pageLength": 500, "order": [[0, 'desc']] });

            });

        </script>

	</body>

</html>