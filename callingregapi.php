<?php
session_start();

require __DIR__.'/classes/Database.php';

$name=$_POST['name'];
$email=$_POST['email'];
$password= $_POST['password'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl."/register.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\t\"name\":\"$name\",\n\t\"email\":\"$email\",\n\t\"password\":\"$password\"\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$response = json_decode($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	if(isset($response->userId))	{
	  $_SESSION['userId'] = $response->userId;
	  $_SESSION['userName'] = $response->userName;
	}
  echo $response->message;
}