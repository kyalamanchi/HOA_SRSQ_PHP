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

		<title><?php echo $community_code; ?> - User Page</title>

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

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-center'>

						<a class='inner-brand'><h3 style='color: green;'><?php echo $community_code; ?></h3></a>

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
				
				</div>

			</header>

            <!-- Page Header -->
            <section class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Email &amp; Persons</strong></li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='email_div'>

							<div class='row'>

								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND role_type_id=1 AND is_active='t' AND relationship_id=1"));

										$primary_email = $row['email'];
                                        $pid = $row['id'];

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center><h3 class='h3'>Is <u><?php echo $primary_email; ?></u> your primary email?</h3></center>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this is my primary email.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_no' value='no'> <strong style='color: black;'>No</strong>, this is not my primary email.

										</div>

									</div>

								</div>

							</div>

							<br>

                            <div class='row'>

                                <div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3 class='h3'>Persons</h3></center>

                                </div>

                            </div>

                            <div class='row container-fluid'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table id='person_table' class='table table-striped' style='color: black;'>

                                        <thead>

                                            <th>Firstname</th>
                                            <th>Lastname</th>
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

                                                                        <h4 class='h4'>Edit - $person_firstname $person_lastname</h4>
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

                                                                        <h4 class='h4'>Remove - $person_firstname $person_lastname</h4>
                                                                        <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                                    </div>

                                                                    <div class='modal-body'>

                                                                        <div class='row'>

                                                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                <form id='$person_id' method='POST' class='ajax4' action='removePerson.php'>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                            <h3 class='h3'>Are you sure you want to remove $person_firstname $person_lastname?</h3>

                                                                                            <h5 class='h5'>Note : This action cannot be undone.</h5>

                                                                                            <input type='hidden' name='person_id' id='person_id' value='".$person_id."'>

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

                                                    <tr>

                                                        <td name='person_".$person_id."_firstname' id='person_".$person_id."_firstname'>$person_firstname</td>
                                                        <td name='person_".$person_id."_lastname' id='person_".$person_id."_lastname'>$person_lastname</td>
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

											<button id='email_back' name='email_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button id='email_continue' name='email_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

                        <div id='edit_email_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Email &amp; Persons</strong></li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                        <h3>Edit Primary Email</h3>

                                    </div>

                                    <br><br>

                                    <form method='POST' action='updatePrimaryEmail.php' class='ajax3'>
                                                                                        
                                        <div class='row'>

                                            <div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

                                                <label><strong>Email</strong></label>

                                                <br>

                                                <input class='form-control' type='email' name='edit_primary_email' id='edit_primary_email' value='<?php echo $primary_email; ?>' required>

                                                <input type='hidden' name='pid' id='pid' value='<?php echo $pid; ?>'>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                            <center>

                                                <button class='btn btn-warning btn-xs' type='button' name='edit_email_back' id='edit_email_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-save'></i> Save</button>

                                            </center>

                                        </div>

                                    </form>

                                </div>

                            </div>

                            <br>

                        </div>

                        <div id='notifications_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'><strong style='color: black;'>SMS Notifications</strong></li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

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

                                    <form method='POST' style='color: black;'>

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

                                                echo "<input type='hidden' name='".$i."_person_id' id='".$i."_person_id' value='$cc_person_id'>";

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_1' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_2' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting_3' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Phone'> SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Email'> Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_board_meeting' id='".$i."_board_meeting' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Phone'> SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Email'> Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_payment_received' id='".$i."_payment_received' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Landscape Repair</strong> : 

                                                    </div>

                                                </div>

                                                ";

                                                $res1 = pg_query("SELECT * FROM community_comms WHERE person_id=$cc_person_id AND event_type_id=8");

                                                $bm = pg_num_rows($res1);

                                                if($bm)
                                                {

                                                    $row1 = pg_fetch_assoc($res1);

                                                    $cc_phone = $row1['phone'];
                                                    $cc_email = $row1['email'];

                                                    echo "

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='None'";

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Phone'> SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Email'> Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_repair' id='".$i."_landscape_repair' value='None' checked> None

                                                        </div>

                                                    </div>

                                                    ";

                                                }

                                                echo "

                                                <div class='row'>

                                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                        <strong>Landscape Maintenance</strong> : 

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Phone'> SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Email'> Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_landscape_maintenance' id='".$i."_landscape_maintenance' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Phone'";

                                                            if($cc_email == 'f' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Email'";

                                                            if($cc_email == 't' && $cc_phone == 'f')
                                                                echo " checked";

                                                            echo "

                                                            > Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Both'";

                                                            if($cc_email == 't' && $cc_phone == 't')
                                                                echo " checked";

                                                            echo "
                                                            
                                                            > Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

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

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Phone'> SMS Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Email'> Email Only

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='Both'> Both

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='".$i."_late_payment_posted' id='".$i."_late_payment_posted' value='None' checked> None

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

                            <br>

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

						<div id='agreements_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Agreements</strong></li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Pending Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

									<table id='pendingAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Sign Agreement</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
													$id = $row['id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>$agreement_name</a></td><td>$document_to</td><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>Click Here</a></td></tr>";
		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Signed Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<table id='signedAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Document Preview</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
			                          				$agreement_id = $row['agreement_id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$document_to</td><td><a target='_blank' href='esignPreview.php?id=$agreement_id'><i class='fa fa-file-pdf-o'></i></a></td></tr>";

		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button class='btn btn-warning btn-xs' type='button' id='agreements_back' name='agreements_back'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button class='btn btn-xs btn-success' name='agreements_continue' id='agreements_continue'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

                        <div id='documents_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Documents</strong></li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>Documents</h3></center>

                                </div>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table id='myDocuments' class='table table-striped' style='color: black;'>

                                        <thead>
                                            
                                            <th>Name</th>
                                            <th>Date of Upload</th>
                                            <th>Year</th>

                                        </thead>

                                        <tbody>

                                            <?php 

                                                $result = pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $document_id = $row['document_id'];
                                                    $year = $row['year_of_upload'];
                                                    $upload_date = $row['uploaded_date'];
                                                    $description = $row['description'];
                                                    $document_url = $row['url'];

                                                    if($upload_date != "")
                                                        $upload_date = date('m-d-Y', strtotime($upload_date));

                                                    $is_visible = pg_num_rows(pg_query("SELECT * FROM document_visibility WHERE document_id=$document_id AND (user_id=$user_id OR hoa_id=$hoa_id)"));

                                                    if($is_visible)
                                                        echo "<tr><td><a href='getDocumentPreview.php?path=$document_url&desc=$description&cid=$community_id&doc_id=$document_id' target='_blank'>$description</a></td><td><a href='getDocumentPreview.php?path=$document_url&desc=$description&cid=$community_id&doc_id=$document_id' target='_blank'>$upload_date</a></td><td>$year</td></tr>";

                                                }

                                            ?>
                                            
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <hr class='small'>

                                    <div class='row'>
                                        
                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                            <button class='btn btn-warning btn-xs' type='button' id='documents_back' name='documents_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='documents_continue' id='documents_continue'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <br>

                        </div>

						<div id='hoa_fact_sheet_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>HOA Fact Sheet</strong></li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3 class='h3'>HOA Fact Sheet</h3></center>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class="container">

									<div class="row">

										<div class="table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
											<!-- Tabs-->
											<ul class="nav nav-tabs">
										
												<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Board</a></li>
												<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab">Comms</a></li>
												<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">
										
												<div class="tab-pane in active" id="tab-1">
											
													<div class="special-heading m-b-40">
										
														<h4><i class="fa fa-dashboard"></i> Board Dashboard</h4>
									
													</div>
									
													<div class='container'>

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																<br><center><h3 class='h3'>PAYMENT INFORMATION</h3></center>

															</div>

														</div>
			
														<div class='row module-gray'>

															<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php echo round($amount_received, 0); ?>
																	
																	</div>

																	<div class='counter-title'>Amount Received (%)</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php echo round($members_paid, 0); ?>

																	</div>

																	<div class='counter-title'>Members Paid (%)</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			$ach = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); 

																			echo $ach;

																		?>
																	
																	</div>

																	<div class='counter-title'>ACH</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																		
																			$bill_pay = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); 

																			echo $bill_pay;

																		?>

																	</div>

																	<div class='counter-title'>Bill Pay</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			$check = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); 

																			echo $check;

																		?>

																	</div>

																	<div class='counter-title'>Check</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																			
																			echo ($total_homes - ( $ach + $bill_pay + $check ) ); 

																		?>

																	</div>

																	<div class='counter-title'>Others</div>

																</div>

															</div>

														</div>

														<br /><br />

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                         									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php 
	                                
	                                										$board_documents = pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='t'")); 

	                                										echo $board_documents;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Board Documents</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<?php 

	                                									$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='t'"));

	                                									if($pending_agreements == 0)
	                                  										echo "<div class='counter-number' >$pending_agreements</div>";
	                                									else
	                                  										echo "<div class='counter-number' style='color: orange;' >$pending_agreements</div>";

	                              									?>

	                            

	                            									<div class='counter-title'>Board Pending Agreements</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php

	                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='t'"));

	                                										echo $signed_agreements;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Board Signed Agreements</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

																		?>
																	
																	</div>

																	<div class='counter-title'>Community Deposits</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																	
																			echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'")); 

																		?>

																	</div>

																	<div class='counter-title'>Community Documents</div>

																</div>

															</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                              								<?php 

		                                								$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='f'"));

		                                								if($pending_agreements == 0)
		                                  									echo "<div class='counter-number'>$pending_agreements</div>";
		                                								else
		                                  									echo "<div class='counter-number' style='color: orange;'>$pending_agreements</div>";

		                              								?>

		                            								<div class='counter-title'>Community Pending Agreements</div>

		                          								</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php

	                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='f'"));

	                                										echo $signed_agreements;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Community Signed Agreements</div>

	                          									</div>

	                       									</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php

																			echo "$del_acc";

																		?>

																	</div>

																	<div class='counter-title'>Delinquent Accounts</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																			
																		$inspection_notices = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id"));

																		$closed = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND (inspection_status_id=2 OR inspection_status_id=6 OR inspection_status_id=9 OR inspection_status_id=13 OR inspection_status_id=14)"));

																		$inspection_notices = $inspection_notices - $closed;

																		if ($inspection_notices == 0) 
																			echo "<div class='counter-number'>".$inspection_notices."</div>";
																		else
																			echo "<div class='counter-number' style='color: orange;'>$inspection_notices</div>";

																	?>

																	<div class='counter-title'>Inspection Notices</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																	
																		$late_payments = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-16' AND process_date<='$year-$month-$last'"));

																		if ($late_payments == 0) 
																			echo "<div class='counter-number'>".$late_payments."</div>";
																		else
																			echo "<div class='counter-number' style='color: orange;'>$late_payments</div>";

																	?>

																	<div class='counter-title'>Late Payments</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																	
																		$parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1"));

																		if ($parking_tags > 0) 
																			echo "<div class='counter-number' style='color: green;'>$parking_tags</div>";
																		else
																			echo "<div class='counter-number'>".$parking_tags."</div>";

																	?>

																	<div class='counter-title'>Parking Tags</div>

																</div>

															</div>

														</div>

														<br /><br />

														<?php

															if($community_id == 1)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																					
																					".round($srp_savings_balance, 0)."
																						
																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_current_balance, 0)."

																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																	</div>

																";
															else if($community_id == 2)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																			<br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center>

																		</div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																			
																					".round($srp_primary_Savings_CurrentBalance, 0)."
																				
																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_savings, 0)."

																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srsq_third_Account_Balance, 0)."

																				</div>

																				<div class='counter-title'>Investments ($)</div>

																			</div>

																		</div>

																	</div>

																";

														?>

													</div>

												</div>

												<div class="tab-pane" id="tab-2">
												
													<div class="special-heading m-b-40">
											
														<h4><i class="fa fa-envelope"></i> Communications Dashboard</h4>
										
													</div>

													<div class='container'>

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php

																		$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));

																		if($email_homes > 0)
																			echo "<div class='counter-number' style='color: green;'>".$email_homes."</div>";
																		else
																			echo "<div class='counter-number'>".$email_homes."</div>";

																	?>

																	<div class='counter-title'>Email Signup</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																	
																		<?php

																			$campaigns = 0;

																			if($community_id == 1)
																			{

																				$ch = curl_init('https://us14.api.mailchimp.com/3.0/campaigns/');
																				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey eecf4b5c299f0cc2124463fb10a6da2d-us14'));

																			}
																			else if($community_id == 2)
																			{

																				$ch = curl_init('https://us12.api.mailchimp.com/3.0/campaigns/');
																				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey af5b50b9f714f9c2cb81b91281b84218-us12'));

																			}
												            				
												            				curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
												            				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
												            
												            				$result = curl_exec($ch);
												            				$json_decode = json_decode($result,TRUE);

												            				foreach ($json_decode['campaigns'] as $key ) 
												            					$campaigns++;

												            				echo $campaigns;

																		?>
																		
																	</div>

																	<div class='counter-title'>Community Notifications</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 

																		$statements_mailed = pg_num_rows(pg_query("SELECT * FROM community_statements_mailed WHERE community_id=$community_id"));

																		if($statements_mailed == 0)
																			echo "<div class='counter-number'>".$statements_mailed."</div>";
																		else
																			echo "<div class='counter-number' style='color: green;'>$statements_mailed</div>";

																	?>

																	<div class='counter-title'>Statements Mailed</div>

																</div>

															</div>

														</div>

													</div>

												</div>

												<div class="tab-pane" id="tab-3">
												
													<div class="special-heading m-b-40">
											
														<h4><i class="fa fa-support"></i> Reserves Dashboard</h4>
										
													</div>

													<div class='container'>

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>
		                              
		                              								<?php 

		                                								$assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id"));

		                                								if($assets != '')
		                                  									echo "<div class='counter-number' style='color: green;'>$assets</div>";
		                                								else
		                                  									echo "<div class='counter-number'>$assets</div>";

		                              								?>

		                            								<div class='counter-title'>Assets</div>

		                          								</div>

		                        							</div>

		                        							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                            								<?php 

		                              									$row = pg_fetch_assoc(pg_query("SELECT sum(invoice_amount) FROM community_invoices WHERE reserve_expense='t' AND community_id=$community_id"));

		                              									$repairs = $row['sum'];

		                              									$repairs = round($repairs, 0);
											
		                              									if($repairs > 0)
		                                									echo "<div class='counter-number' style='color: green;'>".$repairs."</div>";
		                              									else
		                                									echo "<div class='counter-number'>".$repairs."</div>";

		                            								?>

		                            								<div class='counter-title'>Completed Repairs ($)</div>

		                          								</div>

		                        							</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		<?php 

																			$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id"));

																			$reserves = $row['cur_bal_vs_ideal_bal'];

																			echo $reserves;

																		?>
																			
																	</div>

																	<div class='counter-title'>Reserves Funded (%)</div>

																</div>

															</div>

		                        							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                            								<?php 

		                              									$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND fisc_yr_end<='$year-12-31'"));

		                              									$recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];
		                              									$cur_bal_vs_ideal_bal = $row['cur_bal_vs_ideal_bal'];

		                              									$reserve_allocation = $recommended_monthly_allocation_units * $month;

		                              									$reserve_allocation = round($reserve_allocation, 0);

		                              									if($cur_bal_vs_ideal_bal >= 70)
		                                									echo "<div class='counter-number' style='color: green;'>".$reserve_allocation."</div>";
		                              									else
		                                									echo "<div class='counter-number' style='color: orange;'>".$reserve_allocation."</div>";

		                            								?>

		                            								<div class='counter-title'>YTD Allocation ($)</div>

		                          								</div>

		                       								</div>

														</div>

													</div>

												</div>

												<div class="tab-pane" id="tab-4">
											
													<div class="special-heading m-b-40">
												
														<h4><i class="fa fa-dollar"></i> Finance Dashboard</h4>
									
													</div>

													<div class='container'>

														<?php

															if($community_id == 1)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																					
																					".round($srp_savings_balance, 0)."
																						
																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_current_balance, 0)."

																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																	</div>

			                            							<br><br>

																";
															else if($community_id == 2)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																					
																					".round($srp_primary_Savings_CurrentBalance, 0)."
																						
																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_savings, 0)."

																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srsq_third_Account_Balance, 0)."

																				</div>

																				<div class='counter-title'>Investments ($)</div>

																			</div>

																		</div>

																	</div>

			                            							<br><br>

																";

														?>

	                      								<div class='row'>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<div class='counter-number'>
	                              
	                              										<?php 

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
	                                        												$finalAmount = $row->ColData[1]->value;

	                                    											}

	                                  											}

	                                  											echo round($finalAmount, 0);

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
	                                        												$finalAmount = $row->ColData[1]->value;

	                                    											}

	                                  											}

	                                 											echo round($finalAmount, 0);

	                                										}

	                              										?>
	                                
	                            									</div>

	                            									<div class='counter-title'>Expenditure By Vendors ($)</div>

	                          									</div>

	                        								</div>

	                      								</div>

	                      								<br><br>

													</div>

								                    <div class="special-heading m-b-40">
								                  
								                      	<h4><i class="fa fa-area-chart"></i> Yearly Report - <?php echo $year; ?></h4>
								            
								                    </div>

								                    <div class='container'>

								                      	<div class='row'>

									                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
									                          
									                          	<canvas id="myChart1"></canvas>

									                        </div>

									                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
									                          
									                         	<canvas id="myChart2"></canvas>

									                        </div>

								                      	</div>

								                    </div>

	                    							<br>

	                    							<div class='container'>

	                      								<div class='row'>

	                        								<div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
	                          
	                          									<canvas id="myChart3"></canvas>

	                        								</div>

	                     								</div>

	                    							</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='hoa_fact_sheet_back' name='hoa_fact_sheet_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='hoa_fact_sheet_continue' name='hoa_fact_sheet_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id='disclosure1_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Disclosures</strong></li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                    <?php

                                        $result = pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id");

                                        while($row = pg_fetch_assoc($result))
                                        {

                                            $notes = $row['notes'];
                                            $document_id = $row['document_id'];
                                            $changed_this_year = $row['changed_this_year'];
                                            $type_id = $row['type_id'];

                                            $row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=$type_id"));
                                            $disclosure_name = $row['name'];
                                            $desc = $row['desc'];
                                            $civilcode_section = $row['civilcode_section'];
                                            $legal_url = $row['legal_url'];

                                            $dname = $disclosure_name;

                                            if($civilcode_section != "")
                                                $disclosure_name = $disclosure_name." (".$civilcode_section.")";

                                            if($legal_url != '')
                                                $disclosure_name = "<a target='_blank' href='$legal_url'>$disclosure_name</a>";

                                            if($desc == "")
                                                $desc = " - ";

                                            if($notes == "")
                                                $notes = " - ";

                                            if($changed_this_year == 't') 
                                                $changed_this_year = "Yes"; 
                                            else if($changed_this_year == 'f') 
                                                $changed_this_year = "No"; 
                                            else 
                                                $changed_this_year = " - ";

                                            if($document_id == "")
                                                $document = " - ";
                                            else
                                                $document = "<a target='_blank' href='getDocumentPreview.php?cid=$community_id&path=$document_id&desc=$dname'><i class='fa fa-file-pdf-o'></i> Click Here</a>";

                                            echo "

                                            <div class='row'>

                                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                                    <div class='container module-gray' style='color: black;'>

                                                        <br>

                                                        <div class='row'>

                                                            <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                <strong>Disclosure Name :</strong> $disclosure_name

                                                            </div>

                                                        </div>

                                                        <br>";

                                                        if($changed_this_year != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Changed this year :</strong> $changed_this_year

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                        if($notes != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Board Comments </strong> $notes

                                                                </div>

                                                            </div>

                                                            <br>";

                                                        if($document != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Document :</strong> $document

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                    echo "

                                                    </div>

                                                    <br><br>

                                                </div>

                                            </div>

                                            ";

                                        }

                                    ?>

                                    <br>

                                    <div class='row'>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

                                            <hr class='small'>

                                            <div class='row'>
                                        
                                                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                                    <button id='disclosure1_back' name='disclosure1_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

                                                </div>

                                                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                                    <!--button id='disclosure1_continue' name='disclosure1_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

						<div id='disclosure8_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Disclosures</strong></li>

										</ol>

									</div>

								</div>

							</div>

							<br>

                            <div class='row'>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <center><h3 class='h3'>Community Communications</h3></center>

                                </div>

                            </div>

                            <br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='container module-gray' style="color: black;">

										<?php

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id AND type_id=15"));

											$notes = $row['notes'];
											$document_id = $row['document_id'];
											$changed_this_year = $row['changed_this_year'];

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=15"));
											$disclosure_name = $row['name'];
											$desc = $row['desc'];
											$civilcode_section = $row['civilcode_section'];
											$legal_url = $row['legal_url'];

											$dname = $disclosure_name;

											if($civilcode_section != "")
												$disclosure_name = $disclosure_name." (".$civilcode_section.")";

											if($legal_url != '')
												$disclosure_name = "<a target='_blank' href='$legal_url'>$disclosure_name</a>";

											if($desc == "")
												$desc = " - ";

											if($notes == "")
												$notes = " - ";

											if($changed_this_year == 't') 
												$changed_this_year = "Yes"; 
											else if($changed_this_year == 'f') 
												$changed_this_year = "No"; 
											else 
												$changed_this_year = " - ";

											if($document_id == "")
												$document = " - ";
											else
												$document = "<a target='_blank' href='getDocumentPreview.php?cid=$community_id&path=$document_id&desc=$dname'><i class='fa fa-file-pdf-o'></i> Click Here</a>";

										?>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Disclosure Name :</strong> <?php echo $disclosure_name; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Changed this year :</strong> <?php echo $changed_this_year; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Board Comments </strong> <?php echo $notes; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Document :</strong> <?php echo $document; ?>

											</div>

										</div>

										<br>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

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

													$row1 = pg_fetch_assoc(pg_query("SELECT * FROM event_type WHERE event_type_id=$event_type_id"));
													$event_type_name = $row1['event_type_name'];
													$event_header = $row1['header'];

													if($phone == 't')
														$phone = 'Sent';
													else
														$phone = 'Not Sent';

													if($email == 't')
														$email = 'Sent';
													else
														$email = 'Not Sent';

													if($create_date != '')
														$create_date = date('m-d-Y', strtotime($create_date));

													echo "<tr><td>$pname</td><td>$event_header - $event_type_name</td><td>$phone</td><td>$email</td><td>$create_date</td></tr>";

												}

											?>

										</tbody>

									</table>

								</div>

							</div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <form method='POST' >

                                        <div class='row'>

                                            <label><strong>Select notification type</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_email' value='Email'> <strong>Email Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_phone' value='Phone'> <strong>Phone Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_both' value='both' selected> <strong>Both Email &amp; Phone</strong>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <label><strong>Send notification to</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>
                                            
                                            <?php

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $person_name = $row['fname'];
                                                    $person_name .= " ";
                                                    $person_name .= $row['lname'];

                                                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'><input type='checkbox' name='notification_person' value='$person_name'> <strong>$person_name</strong></div>";

                                                }

                                            ?>

                                        </div>
                                        
                                    </form>

                                </div>

                            </div>

							<div class='row'>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='disclosure8_back' name='disclosure8_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<!--button id='disclosure8_continue' name='disclosure8_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button-->

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

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
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/userPage3.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>