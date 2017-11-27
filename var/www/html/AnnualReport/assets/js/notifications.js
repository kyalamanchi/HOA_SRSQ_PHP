$('form').change(function(){

	$('#notifications_continue').hide();

});

$('#notifications_back').click(function(){

	window.location = 'primaryEmail.php';

});

$('#notifications_continue').click(function(){

	window.location = 'agreements.php';

});