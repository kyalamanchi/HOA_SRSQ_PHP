$(document).ready(function(){

	$('#documents_div').hide();
	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').hide();
	$('#documents_header').hide();
	$('#hoa_fact_sheet_header').hide();
	$('#disclosures_header').hide();

});

$('#agreements_continue').click(function(){

	$('#agreements_div').hide();
	$('#documents_div').show();
	$('#documents_header').show();
	$('#agreements_header').hide();

});

$('#agreements_back').click(function(){

	window.location = 'userPage4.php';

});

$('#documents_continue').click(function(){

	$('#documents_div').hide();
	$('#hoa_fact_sheet_div').show();
	$('#hoa_fact_sheet_div').show();
	$('#agreements_header').hide();

});

$('#documents_back').click(function(){

	$('#agreements_div').show();
	$('#documents_div').hide();
	$('#documents_header').hide();
	$('#agreements_header').show();

});

$('#hoa_fact_sheet_continue').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').show();
	$('#hoa_fact_sheet_header').hide();
	$('#disclosures_header').show();

});

$('#hoa_fact_sheet_back').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#documents_div').show();
	$('#hoa_fact_sheet_header').hide();
	$('#documents_header').show();

});

$('#disclosures_finish').click(function(){

	window.location = 'logout.php';

});

$('#disclosures_back').click(function(){

	$('#hoa_fact_sheet_div').show();
	$('#disclosures_div').hide();
	$('#hoa_fact_sheet_header').show();
	$('#disclosures_header').hide();

});