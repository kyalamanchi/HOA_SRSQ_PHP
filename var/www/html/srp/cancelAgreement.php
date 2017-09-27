<!DOCTYPE html>

<html>

  <head>

  </head>

  <body>
    
    <?php

      session_start();

      pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      $id = $_GET['id'];

      $res = pg_query("UPDATE community_sign_agreements SET board_cancel_requested='f' WHERE id=$id")

      $data = '{ "value": "CANCEL", "comment": "", "notifySigner": true }';
      $url = 'https://api.na1.echosign.com:443/api/rest/v5/agreements/'.$id.'/status';
      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                 
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                
      
      if($_SESSION['hoa_community_id'] == 2)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Access-Token: 3AAABLblqZhBbuoGJoQZXIMhISUIAnh7R_qmzGgn_COsBf1G0kXyDFiaXxE-oM8ZMaL1LPybdYz1U2gYXszLLzpLuenZ3Ojfm'));
      else if($_SESSION['hoa_community_id'] == 1)
          curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Access-Token: 3AAABLblqZhBWF9BYTpVk2qiLdux9HoMp6296MnQhdvuw5sR-wRF84ZkKs3rUG6GDbSI8MVYE2-Kgabac7qiVa1FqAytq957r'));

      $result = curl_exec($ch);

      $result = json_decode($result,true);
      
      if (!(strpos($result['result'], 'CANCELLED'))) {
        echo "Agreement Cancelled.";
      }
      else {
        echo "Failed to cancel....";
        echo $result['result'];
        echo "<br>";
      }

    ?>

    <script>setTimeout(function(){window.location.href='https://hoaboardtime.com/srp/pendingAgreements.php'},1000);</script>

  </body>

</html>