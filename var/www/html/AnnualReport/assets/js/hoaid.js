$(document).ready(function(){

	//$('#page_title1').show();
	//$('#page_title2').hide();
	//$('#page_title3').hide();
	$('#edit_user_details_div').hide();
	$('#user_details_continue').hide();

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
				$('#user_information_radio_yes').prop('checked', true);
				$('#user_details_continue').show();
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

	window.location = 'homeid.php';

});

$('#user_edit_back').click(function(){

	$('#user_details_div').show();
	$('#edit_user_details_div').hide();
	$('#user_information_radio_no').prop('checked', false);
	$('#user_information_radio_yes').prop('checked', true);
	$('#user_details_continue').show();

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