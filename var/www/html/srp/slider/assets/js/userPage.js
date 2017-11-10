$(document).ready(function(){

	//$('#page_title1').show();
	//$('#page_title2').hide();
	//$('#page_title3').hide();
	$('#edit_user_details_div').hide();
	$('#home_details_div').hide();
	$('#user_details_continue').hide();
	$('#edit_home_details_div').hide();
	$('#home_details_continue').hide();
	$('#email_div').hide();
	$('#email_continue').hide();
	$('#agreements_div').hide();

	$('#edit_mailing_country').on('change', function(){

		var country = $(this).val();

		if(country) {

			$.ajax({

				type: 'POST',
				url: 'getState.php',
				data: 'country_id='+country,
				success:function(response) {

					$('#edit_mailing_state').html(response);

					$('#edit_mailing_district').html("<option selected disabled value=''>Select State First</option>");

					$('#edit_mailing_city').html("<option selected disabled value=''>Select District First</option>");

					$('#edit_mailing_zip').html("<option selected disabled value=''>Select City First</option>");

				}

			});

		}

	});

	$('#edit_mailing_state').on('change', function(){

		var state = $(this).val();

		if(state) {

			$.ajax({

				type: 'POST',
				url: 'getDistrict.php',
				data: 'state_id='+state,
				success:function(response) {

					$('#edit_mailing_district').html(response);

				}

			});

		}

	});

	$('#edit_mailing_district').on('change', function(){

		var district = $(this).val();

		if(district) {

			$.ajax({

				type: 'POST',
				url: 'getCity.php',
				data: 'district_id='+district,
				success:function(response) {

					$('#edit_mailing_city').html(response);

				}

			});

		}

	});

	$('#edit_mailing_city').on('change', function(){

		var city = $(this).val();

		if(city) {

			$.ajax({

				type: 'POST',
				url: 'getZip.php',
				data: 'city_id='+city,
				success:function(response) {

					$('#edit_mailing_zip').html(response);

				}

			});

		}

	});

});

$('#user_information_radio_yes').change(function() {

	if (document.getElementById('user_information_radio_yes').checked) {

		$('#user_details_continue').show();

	}

});

$('#user_information_radio_no').change(function() {

	if (document.getElementById('user_information_radio_no').checked) {

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
				$('#user_details_continue').hide();
				$('#edit_user_details_div').hide();
				$('#user_details_div').show();

			}

		}

	});

	return false;
	
});

$('#user_details_continue').click(function(){

	$('#home_details_div').show();
	$('#user_details_div').hide();

});

$('#user_edit_back').click(function(){

	$('#user_details_div').show();
	$('#edit_user_details_div').hide();
	$('#user_information_radio_no').prop('checked', false);
	$('#user_details_continue').hide();

	//$.ajax({

		//type: 'POST',
		//url: 'resetUserDetails.php',
		//success:function(response) {

			//$('#edit_cell_no').val(parseInt(response));

		//}

	//});

});

$('#home_details_back').click(function(){

	$('#home_details_div').hide();
	$('#user_details_div').show();

});

$('#home_edit_back').click(function(){

	$('#home_details_div').show();
	$('#edit_home_details_div').hide();
	$('#home_details_continue').hide();
	$('#home_information_radio_no').prop('checked', false);

	$.ajax({

		type: 'POST',
		url: 'resetAddress.php',
		success:function(response) {

			$('#edit_mailing_address').val(response);

		}

	});

	$.ajax({

		type: 'POST',
		url: 'resetCountry.php',
		success:function(response) {

			$('#edit_mailing_country').html(response);

		}

	});

	$.ajax({

		type: 'POST',
		url: 'resetState.php',
		success:function(response) {

			$('#edit_mailing_state').html(response);

		}

	});

	$.ajax({

		type: 'POST',
		url: 'resetDistrict.php',
		success:function(response) {

			$('#edit_mailing_district').html(response);

		}

	});

	$.ajax({

		type: 'POST',
		url: 'resetCity.php',
		success:function(response) {

			$('#edit_mailing_city').html(response);

		}

	});

	$.ajax({

		type: 'POST',
		url: 'resetZip.php',
		success:function(response) {

			$('#edit_mailing_zip').html(response);

		}

	});

});

$('#home_information_radio_yes').change(function() {

	if (document.getElementById('user_information_radio_yes').checked) {

		$('#home_details_continue').show();

	}

});

$('#home_information_radio_no').change(function() {

	if (document.getElementById('home_information_radio_no').checked) {

		$('#home_details_div').hide();
		$('#edit_home_details_div').show();

	}

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

			if(response == "Some error occured. Please try again.")
				alert(response);
			else
			{
				alert("Saved!");

				$('#user_mailing_address').text(response);
				$('#home_information_radio_no').prop('checked', false);
				$('#home_details_continue').hide();
				$('#edit_home_details_div').hide();
				$('#home_details_div').show();

			}

		}

	});

	return false;
	
});

$('#home_details_continue').click(function(){

	$('#email_div').show();
	$('#home_details_div').hide();

});

$('#email_back').click(function(){

	$('#home_details_div').show();
	$('#email_div').hide();

});

$('#email_radio_yes').change(function() {

	if (document.getElementById('user_information_radio_yes').checked) {

		$('#email_continue').show();

	}

});

$('#email_radio_no').change(function() {

	if (document.getElementById('home_information_radio_no').checked) {

		$('#email_div').hide();
		$('#edit_email_div').show();

	}

});

$('form.ajax3').on('submit', function(){
	
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

$('#email_continue').click(function(){

	$('#email_div').hide();
	$('#agreements_div').show();

});