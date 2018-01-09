$(document).ready(function(){

	$('#page_title1').show();
	$('#page_title2').hide();
	$('#verify_user_div').hide();

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
			if(response != 'sent')
				alert(response);
			else
			{

				$('#page_title1').hide();
				$('#page_title2').show();
				$('#confirm_phone_div').hide();
				$('#tab-1').hide();
				$('#tab-2').show();
				$('#verify_user_div').show();
				return false;
			}
		}

	});

	return false;
	
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