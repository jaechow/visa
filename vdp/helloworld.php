<?php

//UTC Timestamp
$time = time();
//VDP Application API Key
$apikey='';
//VDP Shared Secret Hash
$secret='';
//The pre-hash token needs "apikey=" before the actual API Key
$query_string = "apikey=" .$apikey;
//The pre-hash token needs the resource path without the leading "/"
$resource = "helloworld";
//The complete request URL
$url="https://sandbox.api.visa.com/vdp/".$resource."?".$query_string;
//The pre-hash token
$token = $time.$resource.$query_string;
//Hash for x-pay-token
$hashtoken = "xv2:".$time.":".hash_hmac('sha256',$token,$secret);
//Debugging: output the fully-built x-pay-token and request URL
#echo "<strong>X-PAY-TOKEN:</strong><br>".$hashtoken. "<br><br>";
#echo "<strong>URL:</strong><br>".$url. "<br><br>";
//The HTTP header
$header[] = 'X-PAY-TOKEN: '.$hashtoken;
$header[] = 'Accept: application/json';
$header[] = 'Content-Type: application/json';
$header[] = 'Host: sandbox.api.visa.com';
//Debugging: output the HTTP header
#var_dump($header);
//Post request (Get method by default)         
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//Execute the current cURL session
$response = curl_exec($ch);
//Debugging: output HTTP response, 200 is successful
if(!$response) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
echo "<strong>HTTP Status:</strong> <br>".curl_getinfo($ch, CURLINFO_HTTP_CODE). "<br><br>";
//Close cURL resource
curl_close($ch);
//Debugging: output cURL session response

echo "<strong>Response:</strong><br>";
$json = json_decode($response);
$json = json_encode($json, 128);
printf("<pre>%s</pre>", $json);

exit();
?>
