<?php
require_once 'vendor/autoload.php';
// Get $id_token via HTTPS POST.
$id_token=$_GET['idtoken'];
$CLIENT_ID='301552150059-pu3l9ca3mon5qhjreksj12nflqtd41ie.apps.googleusercontent.com';
$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($id_token);
if ($payload) {
  $userid = $payload['sub'];
  // If request specified a G Suite domain:
  //$domain = $payload['hd'];
  print_r($payload);
} else {
  // Invalid ID token
}

?>
