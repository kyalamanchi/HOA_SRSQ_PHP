$(document).ready(function(){

	$('#board_dashboard_div').show();
	$('#finance_dashboard_div').hide();
	$('#communications_dashboard_div').hide();
	$('#reserves_dashboard_div').hide();

});

$('#board_dashboard_button').click(function(){

	$('#board_dashboard_div').show();
	$('#finance_dashboard_div').hide();
	$('#communications_dashboard_div').hide();
	$('#reserves_dashboard_div').hide();

});

$('#finance_dashboard_button').click(function(){

	$('#board_dashboard_div').hide();
	$('#finance_dashboard_div').show();
	$('#communications_dashboard_div').hide();
	$('#reserves_dashboard_div').hide();

});

$('#communications_dashboard_button').click(function(){

	$('#board_dashboard_div').hide();
	$('#finance_dashboard_div').hide();
	$('#communications_dashboard_div').show();
	$('#reserves_dashboard_div').hide();

});

$('#reserves_dashboard_button').click(function(){

	$('#board_dashboard_div').hide();
	$('#finance_dashboard_div').hide();
	$('#communications_dashboard_div').hide();
	$('#reserves_dashboard_div').show();

});