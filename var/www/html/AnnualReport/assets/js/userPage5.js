$(document).ready(function(){

	$('#documents_div').hide();
	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').hide();

});

$('#agreements_continue').click(function(){

	$('#agreements_div').hide();
	$('#documents_div').show();

});

$('#agreements_back').click(function(){

	window.location = 'userPage4.php';

});

$('#documents_continue').click(function(){

	$('#documents_div').hide();
	$('hoa_fact_sheet_div').show();
});

$('#documents_back').click(function(){

	$('#agreements_div').show();
	$('#documents_div').hide();

});

$('#hoa_fact_sheet_continue').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').show();

});

$('#hoa_fact_sheet_back').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#documents_div').show();

});

$('#disclosures_finish').click(function(){

	window.location = 'logout.php';

});

$('#disclosures_back').click(function(){

	$('#hoa_fact_sheet_div').show();
	$('#disclosures_div').hide();

});