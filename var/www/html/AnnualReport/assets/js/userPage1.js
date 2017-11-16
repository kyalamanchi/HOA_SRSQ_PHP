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
	$('#edit_email_div').hide();
	$('#notifications_div').hide();
	$('#agreements_div').hide();
	$('#documents_div').hide();
	$('#hoa_fact_sheet_div').hide();
	$('#disclosure1_div').hide();
	$('#disclosure2_div').hide();
	$('#disclosure3_div').hide();
	$('#disclosure4_div').hide();
	$('#disclosure5_div').hide();
	$('#disclosure6_div').hide();
	$('#disclosure7_div').hide();
	$('#disclosure8_div').hide();

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

				$('#user_information_radio_no').prop('checked', false);
				$('#user_details_continue').hide();
				$('#edit_user_details_div').hide();

				$.ajax({
					
					url: 'resetCellNo.php',
					type: 'post',
					success: function(response){
						
						$('#user_cell_no').text(response);
						$('#edit_cell_no').val(response);
				
					}

				});

				$.ajax({
					
					url: 'resetEmail.php',
					type: 'post',
					success: function(response){
						
						$('#user_email').text(response);
						$('#edit_email').val(response);
				
					}

				});

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

	$.ajax({
					
		url: 'resetCellNo.php',
		type: 'post',
		success: function(response){
						
			$('#edit_cell_no').val(response);
				
		}

	});

	$.ajax({
					
		url: 'resetEmail.php',
		type: 'post',
		success: function(response){
						
			$('#edit_email').val(response);
				
		}

	});

});