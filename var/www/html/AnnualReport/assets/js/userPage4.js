$('#notifications_back').click(function(){

	window.location = 'userPage3.php';

});

$('#notifications_continue').click(function(){

	window.location = 'userPage5.php';

});

$('form.ajax7').on('submit', function(){
	
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

			alert(response);

		}

	});

	//window.location = 'userPage4.php';

	return false;
	
});