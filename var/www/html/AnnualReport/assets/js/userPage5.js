$(document).ready(function(){

	$('#documents_div').hide();
	$('#payments_div').hide();
	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').hide();
	$('#documents_header').hide();
	$('#payments_header').hide();
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
	$('#payments_div').show();
	$('#payments_header').show();
	$('#documents_header').hide();

});

$('#documents_back').click(function(){

	$('#agreements_div').show();
	$('#documents_div').hide();
	$('#documents_header').hide();
	$('#agreements_header').show();

});

$('#payments_continue').click(function(){

	$('#payments_div').hide();
	$('#hoa_fact_sheet_div').show();
	$('#hoa_fact_sheet_header').show();
	$('#payments_header').hide();

});

$('#payments_back').click(function(){

	$('#payments_div').show();
	$('#documents_div').show();
	$('#documents_header').show();
	$('#payments_header').hide();

});

$('#hoa_fact_sheet_continue').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#disclosures_div').show();
	$('#hoa_fact_sheet_header').hide();
	$('#disclosures_header').show();

});

$('#hoa_fact_sheet_back').click(function(){

	$('#hoa_fact_sheet_div').hide();
	$('#payments_div').show();
	$('#hoa_fact_sheet_header').hide();
	$('#payments_header').show();

});

$('#disclosures_continue').click(function(){

	window.location = 'hoaAccountInfo.php';

});

$('#disclosures_back').click(function(){

	$('#hoa_fact_sheet_div').show();
	$('#disclosures_div').hide();
	$('#hoa_fact_sheet_header').show();
	$('#disclosures_header').hide();

});