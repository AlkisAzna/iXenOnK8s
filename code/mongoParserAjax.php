<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $request_body = file_get_contents('php://input');
  $ch=curl_init("http://10.124.0.12:1025");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-Auth-token: thisismagickeyforqueryingsensors",));
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $request_body );
  $result = curl_exec($ch);
  curl_close($ch);
  if($result=='Syntax error'){
    echo  $result;
  }else{
    
    $ch=curl_init("http://10.124.0.3:80/mongoModule.php");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $result );
    $result = curl_exec($ch);
    curl_close($ch);
    echo  $result;
    #file_put_contents('php://stdout', print_r($result, TRUE));


  }
  /////////////////////////////////////////////////////


}


?>
