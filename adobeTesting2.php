<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
<link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>

<title>Select Document</title>
</head>
<body>
<h1>Select document</h1>
<hr>
<div class="container">
<center><h3>HOA ID <?php echo $_GET['id']; ?></h3></center>
<?php
          $id = $_GET['id'];
          $dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
          if ( $dbconn3 ) {
            $query = "select hoa_id,home_id,firstname,lastname,email from hoaid where hoa_id=".$id;
            $result = pg_query($dbconn3,$query);
            while ($row = pg_fetch_row($result)) {
              // echo '<h3><p style="text-align:left;">Name :  '.$row[2].' '.$row[3].nl2br("\n").'<span style="float:right;">Email'.$row[4].'</span></p></h3>';
              echo '<h3><p style="text-align:left;">
    Name : '.$row[2].' '.$row[3].'
    <span style="float:right;">Email: '.$row[4].' </span>
    </p></h3>';
            }
          }
          else 
          {
            echo "Failed to connect to database";
          }
?>
<br>
<div class="dropdown" style="font-size: 18px">
    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
      <span id="selected">Select Document</span><span class="caret"></span></a>

  <ul class="dropdown-menu" id="someval">
    <li><a href="#">Email Consent Form</a></li>
    <li><a href="#">Pool Rules</a></li>
    <li><a href="#">Governing Docs</a></li>
    <li><a href="#">Collection Policy</a></li>
  </ul>
  <br>
  <br>
   
</div>

<script type="text/javascript">
var selectedtext = "";
 $('.dropdown-menu a').click(function(){
    $('#selected').text($(this).text());
   selectedtext = ($(this).text());
  });
function testfunction()
{
  if (selectedtext == ""){
    window.alert("Please select a  valid document");
  }
  else if (selectedtext == "Email Consent Form"){
  <?php $url = "http://52.52.199.120/srsqemailConsent.php?id=".$id; echo 'window.location="'.$url.'"'; ?>
}
else if ( selectedtext == "Pool Rules") {

}
else if ( selectedtext == "Governing Docs") {

}
else if ( selectedtext == "Collection Policy") {
  <?php $url = "http://52.52.199.120/srsqCollectionPolicy.php?id=".$id; echo 'window.location="'.$url.'"'; ?>
}


}

</script>
</div>
<div class="container">
  <button type="button"  class="btn btn-success" style="font-size: 18px;" onclick="testfunction();">Send for signature</button>
</div>
</body>
</html>