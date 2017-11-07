$(document).ready(function(){

	$('#page_title1').show();
	$('#page_title2').hide();
	$('#page_title3').hide();
	$('#home_details_div').hide();

	var living_status = $('#edit_living_status').val();

	if(living_status == 'f')
		$('#mailing_address_div').show();
	else
		$('#mailing_address_div').hide();

});

$('#edit_living_status').change(function(){

	var living_status = $('#edit_living_status').val();

	if(living_status == 'f')
		$('#mailing_address_div').show();
	else
		$('#mailing_address_div').hide();

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
				alert("Updated!");

				$('#user_cell_no').text(response);

			}

		}

	});

	return false;
	
});

$('#user_details_continue').click(function(){

	$('#page_title1').hide();
	$('#page_title2').show();
	$('#page_title3').hide();
	$('#home_details_div').show();
	$('#user_details_div').hide();

});

$('#home_details_back').click(function(){

	$('#page_title1').show();
	$('#page_title2').hide();
	$('#page_title3').hide();
	$('#home_details_div').hide();
	$('#user_details_div').show();

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