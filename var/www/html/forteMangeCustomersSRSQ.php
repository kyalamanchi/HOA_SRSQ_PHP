<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forte Mange Customers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}
</script>
</head>
<body>
<div class="container">
  <h2>Forte Mange Customers</h2>
  <button onclick="showPleaseWait();"></button>
</div>
<div class="container"> 
        <table id="example" class="table table-striped" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                       <center>
                                       <th>Customer ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th></th>
                                       </center>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                  <td>
                                    1
                                  </td>
                                </tr>
</tbody>
</table>
<script type="text/javascript">
        $(document).ready(function() {
              $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'My button',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            }
            ]
            } ); 
            var table = $('#example').DataTable({
            dom: 'l<"toolbar">frtip',
            initComplete: function(){
            $('.datatable').dataTable({
                "sPaginationType": "bs_four_button"
            }); 
            $('.datatable').each(function(){
                var datatable = $(this);
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.addClass('form-control input-sm');
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.addClass('form-control input-sm');
            });
</script>
</div>
</body>
</html>