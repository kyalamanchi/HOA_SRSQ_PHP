<?php
	
	session_start();

include 'includes/dbconn.php';
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

    function get_client_ip() {

        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;

    }

    $ip = get_client_ip();

    $today = date('Y-m-d G:i:s');

    $result = pg_fetch_assoc(pg_query("SELECT * FROM community_annual_report_pages WHERE community_id=$community_id"));
    $page = $result['persons'];

    if($page == 'f')
        header("Location: primaryEmail.php");

    $result = pg_query("UPDATE community_annual_report_visited SET persons_page_visited='t', last_visited_on='$today', last_visited_ip='$ip' WHERE hoa_id=$hoa_id AND home_id=$home_id");

    $visited_pages = pg_query("SELECT * FROM community_annual_report_visited WHERE hoa_id=$hoa_id AND home_id=$home_id");
    $visited_pages = pg_fetch_assoc($visited_pages);
    $hoaid_page_visited = $visited_pages['hoaid_page_visited'];
    $homeid_page_visited = $visited_pages['homeid_page_visited'];
    $persons_page_visited = $visited_pages['persons_page_visited'];
    $primary_email_page_visited = $visited_pages['primary_email_page_visited'];
    $notifications_page_visited = $visited_pages['notifications_page_visited'];
    $agreements_page_visited = $visited_pages['agreements_page_visited'];
    $documents_page_visited = $visited_pages['documents_page_visited'];
    $payments_page_visited = $visited_pages['payments_page_visited'];
    $hoa_fact_sheet_page_visited = $visited_pages['hoa_fact_sheet_page_visited'];
    $disclosures_page_visited = $visited_pages['disclosures_page_visited'];
    $contracts_page_visited = $visited_pages['contracts_page_visited'];
    $financial_summary_page_visited = $visited_pages['financial_summary_page_visited'];
    $volunteers_page_visited = $visited_pages['volunteers_page_visited'];
    $inspection_notices_page_visited = $visited_pages['inspection_notices_page_visited'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

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
                                        
                                    <li class="breadcrumb-item">

                                        <?php if($hoaid_page_visited == 't') echo "<a href='hoaid.php'>"; ?>
                                    
                                        User Details

                                        <?php if($hoaid_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($homeid_page_visited == 't') echo "<a href='homeid.php'>"; ?>
                                    
                                        Home Details

                                        <?php if($homeid_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($persons_page_visited == 't') echo "<a href='persons.php'>"; ?>
                                        
                                        <strong style='color: black;'>Persons</strong>

                                        <?php if($persons_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($primary_email_page_visited == 't') echo "<a href='primaryEmail.php'>"; ?>
                                    
                                        Primary Email

                                        <?php if($primary_email_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($notifications_page_visited == 't') echo "<a href='notifications.php'>"; ?>
                                    
                                        SMS Notifications

                                        <?php if($notifications_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($agreements_page_visited == 't') echo "<a href='agreements.php'>"; ?>
                                    
                                        Agreements

                                        <?php if($agreements_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($documents_page_visited == 't') echo "<a href='documents.php'>"; ?>
                                    
                                        Documents

                                        <?php if($documents_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($inspection_notices_page_visited == 't') echo "<a href='inspectionNotices.php'>"; ?>
                                    
                                        CCR Inspection Notices

                                        <?php if($inspection_notices_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($payments_page_visited == 't') echo "<a href='payments.php'>"; ?>
                                    
                                        Payments

                                        <?php if($payments_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($hoa_fact_sheet_page_visited == 't') echo "<a href='factSheet.php'>"; ?>
                                        
                                        HOA Fact Sheet

                                        <?php if($hoa_fact_sheet_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($contracts_page_visited == 't') echo "<a href='communityContracts.php'>"; ?>
                                        
                                        Contracts

                                        <?php if($contracts_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($financial_summary_page_visited == 't') echo "<a href='financialSummary.php'>"; ?>
                                        
                                        Financial Summary

                                        <?php if($financial_summary_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($disclosures_page_visited == 't') echo "<a href='disclosures.php'>"; ?>
                                    
                                        Disclosures

                                        <?php if($disclosures_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($volunteers_page_visited == 't') echo "<a href='volunteers.php'>"; ?>
                                        
                                        Volunteers

                                        <?php if($volunteers_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                </ol>
                                            
                            </div>
                                        
                        </div>
                                        
                    </div>
                                
                </section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='email_div'>

                            <div class='row'>

                                <div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3 class='h3'>Persons</h3></center>

                                </div>

                            </div>

                            <div class='row container-fluid'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table id='person_table' class='table table-striped' style='color: black;'>

                                        <thead>

                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Relationship</th>
                                            <th></th>
                                            <th></th>

                                        </thead>

                                        <tbody>

                                            <?php

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' ORDER BY fname");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $person_id = $row['id'];
                                                    $person_firstname = $row['fname'];
                                                    $person_lastname = $row['lname'];
                                                    $person_email = $row['email'];
                                                    $person_cell_no = $row['cell_no'];
                                                    $person_relationship = $row['relationship_id'];
                                                    $person_role = $row['role_type_id'];

                                                    $person_cell_no = base64_decode($person_cell_no);

                                                    $_SESSION['person_$person_id_firstname'] = $person_firstname;
                                                    $_SESSION['person_$person_id_lastname'] = $person_lastname;
                                                    $_SESSION['person_$person_id_email'] = $person_email;
                                                    $_SESSION['person_$person_id_cell_no'] = $person_cell_no;
                                                    $_SESSION['person_$person_id_relationship'] = $person_relationship;
                                                    $_SESSION['person_$person_id_role'] = $person_role;

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$person_relationship"));
                                                    $person_relationship = $row1['name'];

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$person_role"));
                                                    $person_role = $row1['name'];

                                                    echo "
                                            
                                                        <div class='modal fade' id='edit_".$person_id."'>

                                                            <div class='modal-dialog modal-lg'>

                                                                <div class='modal-content'>

                                                                    <div class='modal-header'>

                                                                        <h4 class='h4'>Edit - $person_firstname</h4>
                                                                        <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                                    </div>

                                                                    <div class='modal-body'>

                                                                        <div class='row'>

                                                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                <form id='$person_id' method='POST' class='ajax4' action='updatePerson.php'>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Firstname</strong></label>

                                                                                            <br>

                                                                                            <input type='hidden' name='edit_person_id' id='edit_person_id' value='".$person_id."'>

                                                                                            <input class='form-control' type='text' name='edit_person_firstname_".$person_id."' id='edit_person_firstname_".$person_id."' value='".$person_firstname."' required>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Lastname</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='text' name='edit_person_lastname_".$person_id."' id='edit_person_lastname_".$person_id."' value='".$person_lastname."' required>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Email</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='email' name='edit_person_email_".$person_id."' id='edit_person_email_".$person_id."' value='".$person_email."' required>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Phone</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='number' name='edit_person_cell_no_".$person_id."' id='edit_person_cell_no_".$person_id."' value='".$person_cell_no."' required>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Role</strong></label>

                                                                                            <br>

                                                                                            <select class='form-control' name='edit_person_role_".$person_id."' id='edit_person_role_".$person_id."' required>

                                                                                                <option value='' disabled selected>Select Role</option>

                                                                                                ";

                                                                                                $res = pg_query("SELECT * FROM role_type");

                                                                                                while($r = pg_fetch_assoc($res))
                                                                                                {

                                                                                                    $role_id = $r['role_type_id'];
                                                                                                    $role_name = $r['name'];

                                                                                                    echo "<option value='$role_id'";

                                                                                                    if($person_role == $role_name)
                                                                                                        echo " selected";

                                                                                                    echo ">$role_name</option>";

                                                                                                }

                                                                                                echo "

                                                                                            </select>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Relationship</strong></label>

                                                                                            <br>

                                                                                            <select class='form-control' name='edit_person_relationship_".$person_id."' id='edit_person_relationship_".$person_id."' required>

                                                                                                <option value='' disabled selected>Select Relationship</option>

                                                                                                ";

                                                                                                $res = pg_query("SELECT * FROM relationship");

                                                                                                while($r = pg_fetch_assoc($res))
                                                                                                {

                                                                                                    $relationship_id = $r['id'];
                                                                                                    $relationship_name = $r['name'];

                                                                                                    echo "<option value='$relationship_id'";

                                                                                                    if($person_relationship == $relationship_name)
                                                                                                        echo " selected";

                                                                                                    echo ">$relationship_name</option>";

                                                                                                }

                                                                                                echo "

                                                                                            </select>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row'>

                                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                                                                            <button type='submit' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Save</button>

                                                                                            <button type='button' data-dismiss='modal' class='btn btn-warning btn-xs closing'><i class='fa fa-close'></i> Close</button>

                                                                                        </div>

                                                                                    </div>

                                                                                </form>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    ";

                                                    echo "
                                            
                                                        <div class='modal fade' id='remove_".$person_id."'>

                                                            <div class='modal-dialog modal-lg'>

                                                                <div class='modal-content'>

                                                                    <div class='modal-header'>

                                                                        <h4 class='h4'>Remove - $person_firstname</h4>
                                                                        <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                                    </div>

                                                                    <div class='modal-body'>

                                                                        <div class='row'>

                                                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                <form id='".$person_id."' method='POST' class='ajax6' action='removePerson.php'>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                            <h3 class='h3'>Are you sure you want to remove $person_firstname?</h3>

                                                                                            <h5 class='h5'>Note : This action cannot be undone.</h5>

                                                                                            <input type='hidden' name='person_id' id='person_id' value='".$person_id."'>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row'>

                                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                                                                            <button type='submit' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Remove</button>

                                                                                            <button type='button' data-dismiss='modal' class='btn btn-warning btn-xs closing'><i class='fa fa-close'></i> Close</button>

                                                                                        </div>

                                                                                    </div>

                                                                                </form>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    ";

                                                    echo "

                                                    <tr>

                                                        <td name='person_".$person_id."_firstname' id='person_".$person_id."_firstname'>$person_firstname</td>
                                                        <td name='person_".$person_id."_email' id='person_".$person_id."_email'>$person_email</td>
                                                        <td name='person_".$person_id."_cell_no' id='person_".$person_id."_cell_no'>$person_cell_no</td>
                                                        <td name='person_".$person_id."_role' id='person_".$person_id."_role'>$person_role</td>
                                                        <td name='person_".$person_id."_relationship' id='person_".$person_id."_relationship'>$person_relationship</td>
                                                        <td><button class='btn btn-link' type='button' data-toggle='modal' data-target='#edit_$person_id'><i class='fa fa-edit'></i> Edit</button></td>
                                                        <td><button class='btn btn-link text-warning' type='button' data-toggle='modal' data-target='#remove_".$person_id."'><i class='fa fa-close'></i> Remove</button></td>

                                                    </tr>

                                                    ";

                                                }

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <div class='modal fade' id='add_person'>

                                        <div class='modal-dialog modal-lg'>

                                            <div class='modal-content'>

                                                <div class='modal-header'>

                                                    <h4 class='h4'>Add Person</h4>
                                                    <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                </div>

                                                <div class='modal-body'>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            <form method='POST' class='ajax5' action='addPerson.php'>

                                                                <div class='row container'>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Firstname</strong></label>

                                                                        <br>

                                                                        <input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

                                                                        <input type='hidden' name='home_id' id='home_id' value='<?php echo $home_id; ?>'>

                                                                        <input class='form-control' type='text' name='add_person_firstname' id='add_person_firstname' required>

                                                                    </div>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Lastname</strong></label>

                                                                        <br>

                                                                        <input class='form-control' type='text' name='add_person_lastname' id='add_person_lastname' required>

                                                                    </div>

                                                                </div>

                                                                <br>

                                                                <div class='row container'>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Email</strong></label>

                                                                        <br>

                                                                        <input class='form-control' type='email' name='add_person_email' id='add_person_email' required>

                                                                    </div>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Phone</strong></label>

                                                                            <br>

                                                                            <input class='form-control' type='number' name='add_person_cell_no' id='add_person_cell_no' required>

                                                                        </div>

                                                                    </div>

                                                                    <br>

                                                                    <div class='row container'>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Role</strong></label>

                                                                            <br>

                                                                            <select class='form-control' name='add_person_role' id='add_person_role' required>

                                                                                <option value='' disabled selected>Select Role</option>

                                                                                <?php

                                                                                    $res = pg_query("SELECT * FROM role_type");

                                                                                    while($r = pg_fetch_assoc($res))
                                                                                    {

                                                                                        $role_id = $r['role_type_id'];
                                                                                        $role_name = $r['name'];

                                                                                        echo "<option value='$role_id'>$role_name</option>";

                                                                                    }

                                                                                ?>

                                                                            </select>

                                                                        </div>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Relationship</strong></label>

                                                                            <br>

                                                                            <select class='form-control' name='add_person_relationship' id='add_person_relationship' required>

                                                                                <option value='' disabled selected>Select Relationship</option>

                                                                                <?php

                                                                                    $res = pg_query("SELECT * FROM relationship");

                                                                                    while($r = pg_fetch_assoc($res))
                                                                                    {

                                                                                        $relationship_id = $r['id'];
                                                                                        $relationship_name = $r['name'];

                                                                                        echo "<option value='$relationship_id'>$relationship_name</option>";

                                                                                    }

                                                                                ?>

                                                                            </select>

                                                                        </div>

                                                                    </div>

                                                                    <br>

                                                                    <div class='row'>

                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                                                            <button type='submit' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Save</button>

                                                                            <button type='button' data-dismiss='modal' class='btn btn-warning btn-xs closing'><i class='fa fa-close'></i> Close</button>

                                                                        </div>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <center>

                                        <button class='btn btn-info btn-xs' type='button' data-toggle='modal' data-target='#add_person'><i class='fa fa-plus'></i> Add Person</button>

                                    </center>

                                </div>

                            </div>

                            <br>

							<div class='row container-fluid'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button id='person_back' name='email_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button id='person_continue' name='email_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

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

		<script src='assets/js/persons.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>