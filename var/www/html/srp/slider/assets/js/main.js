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
			if(response != 'sent')
				alert(response);
			else
			{

				$('#confirm_phone_head').hide();
				$('#tab-1').hide();
				$('#tab-2').show();
				$('#verify_user_head').show();
				return false;
			}
		}

	});

	return false;
	
});