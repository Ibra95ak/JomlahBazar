<?php
$trackingId = $_GET['trackingId'];
$url = 'https://osbtest.epg.gov.ae/ebs/epg.pos.trackandtrace.rest/GetTrackDetails?track_id='.$trackingId;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic b3NiLnVzZXI6RVBHQDEyMzQ1'
  ),
));
$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
