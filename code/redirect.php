<?php
session_start();
if (!empty($_SESSION["access_token"] )) {

 $USERNAME=$_SESSION["USERNAME"];
 $PASSWORD=$_SESSION["PASSWORD"];
 $ch = curl_init( "http://34.107.15.66:32027/oauth2/token" );
 $payload = 'grant_type=password&username='.$USERNAME.'&password='.$PASSWORD.'';
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic MzFiMGZlZmMtODAxOS00YTY2LTljZGMtNDMwM2RmODU5YWY4OjVjZTAwYmM4LTc0YjYtNDVlYi1hMWQzLTljN2E4MjNmN2Y2Mw==" ,
 "Content-Type: application/x-www-form-urlencoded"));
 curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
 # Return response instead of printing.
 curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
 # Send request.
 $result = curl_exec($ch);
 curl_close($ch);
 $array = array();
 $payload=json_decode($result,true);
   foreach($payload as $x => $x_value) {


       if (is_string ( $x_value)==true){
        $array[$x] = $x_value;

      }

      else{

         if(is_string($x_value)==true){
           foreach($x_value as $y => $y_value){
               if($y=="value")
               $array[$x] = $y_value;
          }
         }

      }
   }
   foreach($array as $y => $y_value){
       if($y=="access_token"){
         $access_token=$y_value;
       }
       if($y=="refresh_token"){
         $refresh_token=$y_value;
       }
   }

  $app=$_SERVER['REQUEST_URI'];
  $arr = explode("/", $app, 3);
  $app=$arr[2];
  file_put_contents('php://stderr', print_r($fapp, TRUE));

  $ch = curl_init( "http://34.107.15.66:1881/$app" );
  #Testing
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Auth-token: thisismagickeyfornodered"));

  # Send request.
  $result = curl_exec($ch);
  curl_close($ch);
  echo str_replace("USERNAME",$USERNAME,$result);

}else{
    //echo "you must login first ";
    header("Location: index.php");
  }
