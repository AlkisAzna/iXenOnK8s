<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $request_body = file_get_contents('php://input');
  $phpobj=json_decode($request_body,true);
  $service_path=$phpobj['service_path'];
  $ch=curl_init("http://10.4.12.80:1027/v2/entities"); #orion-proxy
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Fiware-Service:tourguide',"X-Auth-token: thismagickeyfororion","Fiware-ServicePath:/applications/$service_path"));

  $result = curl_exec($ch);
  curl_close($ch);
  $payload=json_decode($result,true);

  echo  $result;

}


?>
