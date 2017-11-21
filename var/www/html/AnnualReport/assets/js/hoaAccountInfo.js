$('#set_password').change(function(){

	data = $('#set_password').val();

	//alert(data);

	if(data)
	{
		$.ajax({
					
			url: 'getBcrypt.php',
			method: 'post',
			data: {set_password:data},
			success: function(response){

				$('#bcrypt_div').text("This is your encrypted password : "+response);
					
			}

		});

	}
	else
		$('#bcrypt_div').text(" ");

});