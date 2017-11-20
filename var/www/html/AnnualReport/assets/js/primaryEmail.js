$('#email_back').click(function(){

	window.location = "persons.php";

});

$('form.ajax1').on('submit', function(){
	
	var obj = $(this),
	url = obj.attr('action'),
	method = obj.attr('method'),
	id = obj.attr('id');

	obj.find('[name]').each(function(index, value){

		var input = $(this),
		index = input.attr('name'),
		value = input.val();

		data[index] = value;

		alert(data[index]);

	});

	$.ajax({

		url: url,
		type: method,
		data: {person_id:id},
		success: function(response){

			if(response == 'null')
				alert("Select an email.");
			if(response == 'Some error occured. Please try again.')
				alert(response);
			else
				alert("Changed.");

		}

	});

	return false;
	
});

$('#email_continue').click(function(){

	window.location = "notifications.php";

});