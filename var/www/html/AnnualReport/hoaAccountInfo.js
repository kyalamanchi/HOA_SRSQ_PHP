$('#set_password').change(function(){

	$.ajax({
					
		url: 'getBcrypt.php',
		type: 'post',
		success: function(response){

			alert(response);
						
			$('#bcrypt_div').text("This is your encrypted password : "+response);
				
		}

	});

});