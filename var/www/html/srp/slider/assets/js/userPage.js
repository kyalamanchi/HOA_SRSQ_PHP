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
	$('#agreements_div').hide();
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

	if (document.getElementById('email_radio_no').checked) {

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

$('#edit_email_back').click(function(){

	$('#email_div').show();
	$('#edit_email_div').hide();
	$('#email_radio_no').prop('checked', false);

});

$('#person_edit_save').click(function(){

	var person_id = $(this).val(),
	person_firstname = $('#edit_person_firstname_'+person_id).val(),
	person_lastname = $('#edit_person_lastname_'+person_id).val(),
	person_email = $('#edit_person_email_'+person_id).val(),
	person_cell_no = $('#edit_person_cell_no_'+person_id).val(),
	person_role = $('#edit_person_role_'+person_id).val(),
	person_relationship = $('#edit_person_relationship_'+person_id).val();

	data = {personId:person_id, personFirstname:person_firstname, personLastname:person_lastname, personEmail:person_email, personCellNo:person_cell_no, personRole: person_role, personRelationship: person_relationship};

	console.log(data);
	
	$.ajax({

		url: url,
		type: method,
		data: data,
		success: function(response){

			//if(response == "Some error occured. Please try again.")
				alert(response);
			//else
			//{
				//alert("Saved!");

				//$('#user_cell_no').text(response);
				//$('#user_information_radio_no').prop('checked', false);
				//$('#edit_user_details_div').hide();
				//$('#user_details_div').show();

			//}

		}

	});

});

$('form.ajax4').on('submit', function(){
	
	var obj = $(this),
	url = obj.attr('action'),
	method = obj.attr('method'),
	//id = obj.attr('id'),
	data = {};

	obj.find('[name]').each(function(index, value){

		var input = $(this),
		index = input.attr('name'),
		value = input.val();

		alert(input);

		data[index] = value;

	});

	var person_id = ('#edit_person_id').val();

	//alert(id);
	alert(person_id);

	$.ajax({

		url: url,
		type: method,
		data: data,
		success: function(response){

			//if(response == "Some error occured. Please try again.")
				alert(response);
			//else
			//{
				//alert("Saved!");

				//$('#user_cell_no').text(response);
				//$('#user_information_radio_no').prop('checked', false);
				//$('#edit_user_details_div').hide();
				//$('#user_details_div').show();

			//}

		}

	});

	return false;
	
});

$('#email_continue').click(function(){

	$('#email_div').hide();
	$('#agreements_div').show();

});

$('#agreements_back').click(function(){

	$('#agreements_div').hide();
	$('#email_div').show();

});

$('#agreements_continue').click(function(){

	$('#agreements_div').hide();
	$('#hoa_fact_sheet_div').show();

});

$('#hoa_fact_sheet_back').click(function(){

	$('#agreements_div').show();
	$('#hoa_fact_sheet_div').hide();

});

$('#hoa_fact_sheet_continue').click(function(){

	$('#disclosure1_div').show();
	$('#hoa_fact_sheet_div').hide();

});

$('#disclosure1_back').click(function(){

	$('#disclosure1_div').hide();
	$('#hoa_fact_sheet_div').show();

});

$('#disclosure1_continue').click(function(){

	$('#disclosure2_div').show();
	$('#disclosure1_div').hide();

});

$('#disclosure2_back').click(function(){

	$('#disclosure2_div').hide();
	$('#disclosure1_div').show();

});

$('#disclosure2_continue').click(function(){

	$('#disclosure3_div').show();
	$('#disclosure2_div').hide();

});

$('#disclosure3_back').click(function(){

	$('#disclosure3_div').hide();
	$('#disclosure2_div').show();

});

$('#disclosure3_continue').click(function(){

	$('#disclosure4_div').show();
	$('#disclosure3_div').hide();

});

$('#disclosure4_back').click(function(){

	$('#disclosure4_div').hide();
	$('#disclosure3_div').show();

});

$('#disclosure4_continue').click(function(){

	$('#disclosure5_div').show();
	$('#disclosure4_div').hide();

});

$('#disclosure5_back').click(function(){

	$('#disclosure5_div').hide();
	$('#disclosure4_div').show();

});

$('#disclosure5_continue').click(function(){

	$('#disclosure6_div').show();
	$('#disclosure5_div').hide();

});

$('#disclosure6_back').click(function(){

	$('#disclosure6_div').hide();
	$('#disclosure5_div').show();

});

$('#disclosure6_continue').click(function(){

	$('#disclosure7_div').show();
	$('#disclosure6_div').hide();

});

$('#disclosure7_back').click(function(){

	$('#disclosure7_div').hide();
	$('#disclosure6_div').show();

});

$('#disclosure7_continue').click(function(){

	$('#disclosure8_div').show();
	$('#disclosure7_div').hide();

});

$('#disclosure8_back').click(function(){

	$('#disclosure8_div').hide();
	$('#disclosure7_div').show();

});