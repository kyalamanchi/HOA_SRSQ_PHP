$('#set_password').on('change', function(){

	$.ajax({
					
		url: 'getBcrypt.php',
		type: 'post',
		success: function(response){
						
			$('#bcrypt').text("This is your encrypted password : "+response);
				
		}

	});

});