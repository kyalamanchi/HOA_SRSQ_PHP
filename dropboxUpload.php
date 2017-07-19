<?php

  $path = 'residentDashboard.php';
  $fp = fopen($path, 'rb');
  $size = filesize($path);

  $cheaders = array('Authorization: Bearer QwUjEm5GAkAAAAAAAAAADocHK4CgCJoBl2A8-fe9Fs42E06qkDqJA2S9YPwGbZyF',
                    'Content-Type: application/octet-stream',
                    'Dropbox-API-Arg: {"path":"/'.$path.'", "mode":"add"}');

  $ch = curl_init('https://content.dropboxapi.com/2/files/upload');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
  curl_setopt($ch, CURLOPT_PUT, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_INFILE, $fp);
  curl_setopt($ch, CURLOPT_INFILESIZE, $size);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);

  echo $response;
  curl_close($ch);
  fclose($fp);

  #Key : dz9ohpqbhptmb9n
  #Secret : rmihz90xgng7q1n

?>