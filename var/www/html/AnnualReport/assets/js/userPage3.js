$('#email_back').click(function(){

	window.location = "userPage2.php";

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
	$('#email_continue').show();
	$('#email_radio_no').prop('checked', false);
	$('#email_radio_yes').prop('checked', true);

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

	$.ajax({

		url: 'updatePerson.php',
		type: 'POST',
		data: data,
		success: function(response){

				if(response != person_id)
					alert(response);
				else
				{
					alert("Updated!");

					//$('#user_cell_no').text(response);
					//$('#user_information_radio_no').prop('checked', false);
					//$('#edit_user_details_div').hide();
					//$('#user_details_div').show();

				}

		}

	});

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

			alert("Updated");$('#edit_person_lastname_'+person_id).val(person_lastname);

			$('#person_'+person_id+'_lastname').html(person_lastname);

			$('#edit_person_firstname_'+person_id).val(person_firstname);
			$('#person_'+person_id+'_firstname').html(person_firstname);

			$('#edit_person_email_'+person_id).val(person_email);
			$('#person_'+person_id+'_email').html(person_email);

			$('#edit_person_cell_no_'+person_id).val(person_cell_no);
			$('#person_'+person_id+'_cell_no').html(person_cell_no);

			$('#edit_person_role_'+person_id).val(person_role);
			
			$.ajax({

				url: 'resetRole.php',
				method: 'POST',
				data: {roleId: person_role},
				success: function(response1){

					$('#person_'+person_id+'_role').html(response1);

				}

			});

			$('#edit_person_relationship_'+person_id).val(response1);

			$.ajax({

				url: 'resetRelationship.php',
				method: 'POST',
				data: {relationshipId: person_relationship},
				success: function(response1){

					$('#person_'+person_id+'_relationship').html(response1);

				}

			});

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

	alert('Adding Person. Please Wait.');

	$.ajax({

		url: 'resetRole.php',
		method: 'POST',
		data: {roleId: data['add_person_role']},
		success: function(response1){

			ro = response1;

		}

	});

	$.ajax({

		url: 'resetRelationship.php',
		method: 'POST',
		data: {relationshipId: data['add_person_relationship']},
		success: function(response1){

			re = response1;

		}

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

				$('#person_table').append('<tr><td name="person_'+response+'_firstname" id="person_'+response+'_firstname">'+data['add_person_firstname']+'</td><td name="person_'+response+'_lastname" id="person_'+response+'_lastname">'+data['add_person_lastname']+'</td><td name="person_'+response+'_email" id="person_'+response+'_email">'+data['add_person_email']+'</td><td name="person_'+response+'_cell_no" id="person_'+response+'_cell_no">'+data['add_person_cell_no']+'</td><td name="person_'+response+'_role" id="person_'+response+'_role">'+ro+'</td><td name="person_'+response+'_relationship" id="person_'+response+'_relationship">'+re+'</td><td></td><td></td></tr>');

			}

		}

	});

	return false;
	
});

$('#email_continue').click(function(){

	window.location = "userPage4.php";

});