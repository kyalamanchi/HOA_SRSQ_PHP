$('#set_password').keypress(function(){

	data = $('#set_password').val();

	//alert(data);

	$.ajax({
					
		url: 'getBcrypt.php',
		method: 'post',
		data: {set_password:data},
		success: function(response){

			alert(response);
						
			$('#bcrypt_div').text("This is your encrypted password : "+response);
				
		}

	});

});