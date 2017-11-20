$(document).ready(function(){

	$('#edit_email_div').hide();
	$('#email_continue').show();

});

$('#email_back').click(function(){

	window.location = "persons.php";

});

$('#email_radio_yes').change(function() {

	if (document.getElementById('email_radio_yes').checked) {

		$('#email_continue').show();

	}

});

$('#email_radio_no').change(function() {

	if (document.getElementById('email_radio_no').checked) {

		$('#email_div').hide();
		$('#edit_email_div').show();

	}

});

$('#edit_email_back').click(function(){

	$('#email_div').show();
	$('#edit_email_div').hide();
	$('#email_continue').show();
	$('#email_radio_no').prop('checked', false);
	$('#email_radio_yes').prop('checked', true);

});

$('#email_continue').click(function(){

	window.location = "notifications.php";

});