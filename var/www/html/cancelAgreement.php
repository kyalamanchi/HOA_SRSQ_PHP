<!DOCTYPE html>

<html>

  <head>
  	
    <title>Pool Rules</title>

  </head>

  <body>
    
    <?php

      $data = '{ "value": "CANCEL", "comment": "", "notifySigner": true }';
      $url = 'https://api.na1.echosign.com:443/api/rest/v5/agreements/'.$_GET['id'].'/status';
      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                 
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
          'Content-Type: application/json', 
          'Access-Token: 3AAABLblqZhBbuoGJoQZXIMhISUIAnh7R_qmzGgn_COsBf1G0kXyDFiaXxE-oM8ZMaL1LPybdYz1U2gYXszLLzpLuenZ3Ojfm'));

      $result = curl_exec($ch);

      $result = json_decode($result,true);
      
      if (!(strpos($result['result'], 'CANCELLED'))) {
        echo "Agreement Cancelled Successfully";
      }
      else {
        echo "Failed to cancel....";
        echo $result['result'];
        echo "<br>";
      }

    ?>

  </body>

</html>