$(document).ready(function(){

	$('#edit_home_details_div').hide();
	$('#home_details_continue').hide();

});

$('#home_details_back').click(function(){

	window.location = 'userPage1.php';

});

$('#home_edit_back').click(function(){

	$('#home_details_div').show();
	$('#edit_home_details_div').hide();
	$('#home_details_continue').show();
	$('#home_information_radio_no').prop('checked', false);
	$('#home_information_radio_yes').prop('checked', false);

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

	if (document.getElementById('home_information_radio_yes').checked) {

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
				$('#home_information_radio_yes').prop('checked', true);
				$('#home_details_continue').show();
				$('#edit_home_details_div').hide();
				$('#home_details_div').show();

			}

		}

	});

	return false;
	
});

$('#home_details_continue').click(function(){

	window.location = 'userPage3.php';

});