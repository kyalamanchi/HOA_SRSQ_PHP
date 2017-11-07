$(document).ready(function(){

	$('#page_title1').show();
	$('#page_title2').hide();
	$('#page_title3').hide();
	$('#edit_user_details_div').hide();
	$('#home_details_div').hide();
	$('#user_details_continue').hide();
	$('#edit_home_details_div').hide();


});

$('#user_information_radio_yes').change(function() {

	if (document.getElementById('user_information_radio_yes').checked) {

		$('#user_details_continue').show();

	}

});

$('#user_information_radio_no').change(function() {

	if (document.getElementById('user_information_radio_no').checked) {

		$('#user_details_continue').hide();
		$('#user_details_div').hide();
		$('#edit_user_details_div').show();

	}

});

$('form.ajax1').on('submit', function(){
	
	var obj = $(this),
	url = obj.attr('action'),
	method = obj.attr('method'),
	data = {};

	obj.find('[name]').each(function(index, value){

		var input = $(this),
		index = input.attr('name'),
		value = input.val();

		data[index] = value;

	});

	$.ajax({

		url: url,
		type: method,
		data: data,
		success: function(response){

			if(response == "Some error occured. Please try again.")
				alert(response);
			else
			{
				alert("Saved!");

				$('#user_cell_no').text(response);
				$('#user_information_radio_no').prop('checked', false);
				$('#edit_user_details_div').hide();
				$('#user_details_div').show();

			}

		}

	});

	return false;
	
});

$('#home_details_back').click(function(){

	$('#page_title1').show();
	$('#page_title2').hide();
	$('#page_title3').hide();
	$('#home_details_div').hide();
	$('#edit_user_details_div').hide();
	$('#user_details_continue').hide();
	$('#user_information_radio_yes').prop('checked', false);
	$('#user_details_div').show();

});

$('#home_information_radio_yes').change(function() {

	if (document.getElementById('user_information_radio_yes').checked) {

		$('#home_details_continue').show();

	}

});

$('#home_information_radio_no').change(function() {

	if (document.getElementById('home_information_radio_no').checked) {

		$('#home_details_continue').hide();
		$('#home_details_div').hide();
		$('#edit_home_details_div').show();

	}

});



















$('#home_details_div').ready(function(){

	if (document.getElementById('edit_living_status_f').checked) {

  		$('#mailing_address_div').show();

	}
	else {
		
		$('#mailing_address_div').hide();

	}

});

$('#user_details_continue').click(function(){

	$('#page_title1').hide();
	$('#page_title2').show();
	$('#page_title3').hide();
	$('#home_details_div').show();
	$('#user_details_div').hide();

});

$('form.ajax2').on('submit', function(){
	
	var obj = $(this),
	url = obj.attr('action'),
	method = obj.attr('method'),
	data = {};

	obj.find('[name]').each(function(index, value){

		var input = $(this),
		index = input.attr('name'),
		value = input.val();

		data[index] = value;

	});

	$.ajax({

		url: url,
		type: method,
		data: data,
		success: function(response){
			if(response != 'correct')
				alert(response);
			else
			{

				window.location.href = 'login.php';

			}
		}

	});

	return false;
	
});