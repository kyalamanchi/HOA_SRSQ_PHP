<!DOCTYPE html>
<html>
<head>
	<title>Adobe Sign</title>
	<link rel="stylesheet" href="jquery.dataTables.css"/>
	<script src="jquery.js"></script>
	<script src="jquery.dataTables.js"></script>
</head>
<body>

<h1>Adobe Sign</h1>
<section>
<hr>
<br>
<br>
<br>
<div class="container">
<div class = "container">
<div>
<center><h1>Community : SRSQ</h1></center>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>HOA ID</th>
            <th>HOME ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th>HOA ID</th>
            <th>HOME ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            
        </tr>
    </tfoot>
 
    <tbody>
        <?php
        	$dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
        	if ( $dbconn3 ) {
        		$query = "select hoa_id,home_id,firstname,lastname,email from hoaid where community_id=2";
        		$result = pg_query($dbconn3,$query);
        		while ($row = pg_fetch_row($result)) {
        			echo "<tr>";
        			echo '<td><a href="adobeTesting2.php?id='.$row[0].'">';
        			echo $row[0];
        			echo '</a></td>';
        			echo "<td>";
        			echo $row[1];
        			echo "</td>";
        			echo "<td>";
        			echo $row[2];
        			echo "</td>";
        			echo "<td>";
        			echo $row[3];
        			echo "</td>";
        			echo "<td>";
        			if ( $row[4] ){
        				echo $row[4];
        			}
        			else {
        				echo "No email found";
        			}

        			echo "</td>";
        			echo "</tr>";
        		}
        	}
        	else 
        	{
        		echo "Failed to connect to database";
        	}
        ?>
    </tbody>
</table>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
     
    // Apply the filter
    $("#example tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    } );
} );
</script>
</section>
</body>
</html>