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

							<?php

                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t'");

                                if(pg_num_rows($result))
                                {
                                    
                                    echo "

                                    <div class='row'>

        								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>";

        										$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND role_type_id=1 AND is_active='t' AND relationship_id=1"));

        										$primary_email = $row['email'];
                                                $pid = $row['id'];


        									echo "

                                            <div class='row'>

        										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

        											<center><h3 class='h3'>Is <u>$primary_email</u> your primary email?</h3></center>

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

                                    ";

                                }

                            ?>

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

                                                                                <form id='".$person_id."' method='POST' class='ajax6' action='removePerson.php'>

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

                            <div class='row'>

                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                        <h3>Select Primary Email</h3>

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