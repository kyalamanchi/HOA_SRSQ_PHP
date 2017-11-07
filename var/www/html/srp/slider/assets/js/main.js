$('form.ajax').on('submit', function(){
	
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

			if (response == 'Please enter the OTP texted to your number to verify your identity.') 
			{
				alert(response);
			}
			else
			{
				console.log(response);
			}

		}

	});

	return false;
});