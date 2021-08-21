<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../' . DIR_MOD . 'Ser_Users.php';/*call carts class*/
require_once '../../'.DIR_MOD.'Ser_Addresses.php';
require_once '../../' . DIR_MOD . 'Ser_Orders.php';/*call carts class*/
$curl = curl_init();
$dbu = new Ser_Users();
$dba = new Ser_Addresses();
$dbo = new Ser_Orders();
$action = $_GET['action'];
/*Get login Token*/
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apix.stag.asyadexpress.com/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "username": "Clarence_orendain",
    "password": "Pomechain@asy20"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$res_json = json_decode($response);
$token = $res_json->data->token;/*Authintication token*/
if ($action=="printlabel") {
  $curllbl = curl_init();
  $awb = $_POST['awb'];
  $labelurl = "https://apix.stag.asyadexpress.com/v2/orders/".$awb."/awb";
curl_setopt_array($curllbl, array(
  CURLOPT_URL => $labelurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token.''
  ),
));
$responselbl = curl_exec($curllbl);
curl_close($curllbl);
$res_jsonlbl = json_decode($responselbl);
$awb = $res_jsonlbl->data->awb->labelx4;
echo $awb;
}else {
  $orderId = $_GET['orderId'];
  /*get order details*/
  $order_info = $dbo->GetOrderById($orderId);
  /*get sender details*/
  $sender_info = $dbu->getUserById($order_info['sellerId']);
  /*get sender company*/
  $sender_company = $dbu->getUserCompany($sender_info['usercompanyId']);
  /*get sender address*/
  $sender_defaultaddress = $dba->getDefaultAddressByUserId($order_info['sellerId']);
  $sender_company=$sender_company['companyname'];
  $sender_address1=$sender_defaultaddress['address1'];
  $sender_address2=$sender_defaultaddress['address2'];
  $sender_city=$sender_defaultaddress['city'];
  $sender_postalcode=$sender_defaultaddress['postalcode'];
  $country_info = $dba->getCountryByISO($sender_defaultaddress['country']);
  $sender_country=$country_info['name'];
  $sender_latitude=$sender_defaultaddress['latitude'];
  $sender_longitude=$sender_defaultaddress['longitude'];
  $sender_fullname=$sender_defaultaddress['fullname'];
  $sender_email=$sender_defaultaddress['email'];
  $sender_otp=$sender_defaultaddress['otp'];
  /*get receiver details*/
  $receiver_info = $dbu->getUserById($order_info['userId']);
  /*get receiver address*/
  $receiver_defaultaddress = $dba->getAddressById($order_info['addressId']);
  $receiver_address1=$receiver_defaultaddress['address1'];
  $receiver_address2=$receiver_defaultaddress['address2'];
  $receiver_country="Oman";
  $receiver_area=$receiver_defaultaddress['state'];
  $area_info = $dba->getAreaInfo($receiver_area);
  $receiver_city=$area_info['city'];
  $receiver_postalcode=$area_info['zipcode'];
  $receiver_country="Oman";
  $receiver_latitude=$receiver_defaultaddress['latitude'];
  $receiver_longitude=$receiver_defaultaddress['longitude'];
  $receiver_fullname=$receiver_info['fullname'];
  $receiver_email=$receiver_info['email'];
  $receiver_otp=$receiver_info['otp'];

  $ClientOrderRef = $order_info['ordernumber']."-".$order_info['orderId'];
  /*get payment details*/
  $order_payment = $dbo->GetPaymentByOrderId($orderId);
  if ($order_payment['payment_type']==1) {
  	$PaymentType = "COD";
  	$CODAmount=$order_info['total_price'];
  }else {
  	$PaymentType = "PREPAID";
  	$CODAmount=0;
  }
  $shipment_fees = $order_payment['shipmentfees'];
  $TotalShipmentValue = 1;
  $quantity=$order_info['total_quantity'];
  $weight=$order_info['total_weight'];
  $totalprice=$order_info['total_price'];

  /*Create Shipment*/
  $curlORD = curl_init();

  curl_setopt_array($curlORD, array(
    CURLOPT_URL => 'https://apix.stag.asyadexpress.com/v2/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "ClientOrderRef": "'.$ClientOrderRef.'",
    "Description": "NA",
    "HandlingTypee": "Others",
    "ShippingCost": '.$shipment_fees.',
    "PaymentType": "'.$PaymentType.'",
    "CODAmount": '.$CODAmount.',
    "ShipmentProduct": "EXPRESS",
    "ShipmentService": "ALL_DAY",
    "OrderType": "DROPOFF",
    "PickupType": "",
    "PickupDate": "",
    "TotalShipmentValue": '.$TotalShipmentValue.',
    "JourneyOptions": {
      "AdditionalInfo": 0,
      "NOReturn": true,
      "Extra": {}
    },
    "Consignee": {
      "Name": "'.$receiver_fullname.'",
      "MobileNo": "+'.$receiver_otp.'",
      "PhoneNo": "",
      "Email": "'.$receiver_email.'",
      "What3Words": "",
      "NationalId": "",
      "ReferenceNo": "",
      "CompanyName": "NA",
      "AddressLine1": "'.$receiver_address1.'",
      "AddressLine2": "'.$receiver_address2.'",
      "Area": "'.$receiver_area.'",
      "Country": "'.$receiver_country.'",
      "City": "'.$receiver_city.'",
      "Region": "NA",
      "ZipCode": "NA",
      "Latitude": "'.$receiver_latitude.'",
      "Longitude": "'.$receiver_longitude.'",
      "Instruction": "",
      "Vattaxcode": "",
      "Eorinumber": ""
    },
    "Shipper": {
      "ReturnAsSame": true,
      "CompanyName": "'.$sender_company.'",
      "ContactName": "'.$sender_fullname.'",
      "AddressLine1": "'.$sender_address1.'",
      "AddressLine2": "'.$sender_address2.'",
      "Area": "",
      "City": "'.$sender_city.'",
      "Region": "",
      "Country": "'.$sender_country.'",
      "ZipCode": "'.$sender_postalcode.'",
      "Latitude": "'.$sender_latitude.'",
      "Longitude": "'.$sender_longitude.'",
      "MobileNo": "'.$sender_otp.'",
      "TelephoneNo": "",
      "Email": "'.$sender_email.'",
      "ReferenceOrderNo": "123",
      "NationalId": "",
      "What3Words": "",
      "Vattaxcode": "",
      "Eorinumber": ""
    },
    "Return": {
      "CompanyName": "'.$sender_company.'",
      "ContactName": "'.$sender_company.'",
      "AddressLine1": "'.$sender_address1.'",
      "AddressLine2": "'.$sender_address1.'",
      "Area": "",
      "City": "'.$sender_city.'",
      "Region": "",
      "Country": "'.$sender_country.'",
      "ZipCode": "'.$sender_postalcode.'",
      "Latitude": '.$sender_latitude.',
      "Longitude": '.$sender_longitude.',
      "MobileNo": "'.$sender_otp.'",
      "TelephoneNo": "",
      "Email": "'.$sender_email.'",
      "NationalId": "",
      "What3Words": "",
      "Vattaxcode": "",
      "Eorinumber": ""
    },
    "PackageDetails": [
      {
        "Weight": '.$weight.',
        "Width": 1,
        "Length": 1,
        "Height": 1
      }
    ],
    "ShipmentPerformaInvoice": [
      {
        "HSCode": "8539.10.0040",
        "ProductDescription": "string",
        "ItemQuantity": '.$quantity.',
        "ProductDeclaredValue": '.$totalprice.',
        "itemRef": null,
        "ShipmentTypeCode": "Parcel",
        "PackageTypeCode": "POUCH"
      }
    ]
  }',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$token.'',
      'Content-Type: application/json'
    ),
  ));

  $responseORD = curl_exec($curlORD);

  curl_close($curlORD);
  $res_jsonORD = json_decode($responseORD);

  $awb = $res_jsonORD->data->order_awb_number;/*Authintication token*/

  $dbo->addexpressshipment($orderId, 1, 2, $shipment_fees, $awb, $awb);
}
?>
