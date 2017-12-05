$('#person_back').click(function(){

	window.location = "homeid.php";

});

$('form.ajax4').on('submit', function(){

	var obj = $(this),
	person_id = obj.attr('id'),
	person_firstname = $('#edit_person_firstname_'+person_id).val(),
	person_lastname = $('#edit_person_lastname_'+person_id).val(),
	person_email = $('#edit_person_email_'+person_id).val(),
	person_cell_no = $('#edit_person_cell_no_'+person_id).val(),
	person_role = $('#edit_person_role_'+person_id).val(),
	person_relationship = $('#edit_person_relationship_'+person_id).val();

	data = {personId:person_id, personFirstname:person_firstname, personLastname:person_lastname, personEmail:person_email, personCellNo:person_cell_no, personRole: person_role, personRelationship: person_relationship};

	$.ajax({

		url: 'updatePerson.php',
		method: "POST",
		data: data,
		success:function(response){

			alert("Updated");

			window.location = 'persons.php';

		}

	});

	return false;
	
});

$('form.ajax5').on('submit', function(){
	
	var obj = $(this),
	url = obj.attr('action'),
	method = obj.attr('method'),
	data = {};

	var ro = '', re = '';

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

			if(response == 'Some error occured. Please try again.')
				alert(response);
			else
			{

				alert("Person added.");

				window.location = 'persons.php';

			}

		}

	});

	return false;
	
});

$('#person_continue').click(function(){

	window.location = "primaryEmail.php";

});