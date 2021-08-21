<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
require_once '../../' . DIR_MOD . 'Ser_Orderdetails.php';/*call carts class*/
require_once '../../' . DIR_MOD . 'Ser_Orders.php';/*call carts class*/
require_once '../../' . DIR_MOD . 'Ser_Users.php';/*call carts class*/
require_once '../../'.DIR_MOD.'Ser_Addresses.php';
require_once '../../' . DIR_MOD . 'Ser_Products.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$client = new GuzzleHttp\Client();
$db = new Ser_Orderdetails();
$dbo = new Ser_Orders();
$dbu = new Ser_Users();
$dba = new Ser_Addresses();
$dbp = new Ser_Products();
$orderId = $_GET['orderId'];
$today = date("d-M-Y",strtotime(' +1 day'));
/*get order details*/
$order_info = $dbo->GetOrderById($orderId);
/*get sender details*/
$sender_info = $dbu->getUserById($order_info['sellerId']);
/*get sender company*/
$sender_company = $dbu->getUserCompany($sender_info['usercompanyId']);
/*get sender address*/
$sender_defaultaddress = $dba->getDefaultAddressByUserId($order_info['sellerId']);
/*sender api data*/
$SenderContactName=$sender_info['fullname'];
$SenderCompanyName=$sender_company['companyname'];
$SenderAddress=$sender_defaultaddress['address1'];
$res_cities = $client->request('GET', 'https://osb.epg.gov.ae/ebs/genericapi/lookups/rest/GetEmiratesDetails');
$cities = json_decode($res_cities->getBody());
foreach ($cities->GetEmiratesDetailsResult->EmirateBO as $city) {
	if(strtolower($city->EmirateName)==strtolower($sender_defaultaddress['city'])) $SenderCity=$city->EmirateID;
}
$SenderContactMobile=$sender_info['otp'];
$SenderContactPhone=$sender_info['otp'];
$SenderEmail=$sender_info['email'];
$SenderZipCode=00000;
$SenderState=$sender_defaultaddress['state'];
$res_countries = $client->request('GET', 'https://osb.epg.gov.ae/ebs/genericapi/lookups/rest/GetCountries');
$countries = json_decode($res_countries->getBody());
foreach ($countries->CountriesResponse->Countries->Country as $country) {
	if(strtolower($country->CountryCode)==strtolower($sender_defaultaddress['country'])) $SenderCountry=$country->CountryId;
}
/*get receiver details*/
$receiver_info = $dbu->getUserById($order_info['userId']);
/*get receiver address*/
$receiver_defaultaddress = $dba->getAddressById($order_info['addressId']);
/*receiver api data*/
$ReceiverContactName=$receiver_info['fullname'];
$ReceiverCompanyName="null";
$ReceiverAddress=$receiver_defaultaddress['address1'];
foreach ($cities->GetEmiratesDetailsResult->EmirateBO as $city) {
	if(strtolower($city->EmirateName)==strtolower($receiver_defaultaddress['city'])) $ReceiverCity=$city->EmirateID;
}
$ReceiverContactMobile=$receiver_info['otp'];
$ReceiverContactPhone=$receiver_info['otp'];
$ReceiverEmail=$receiver_info['email'];
$ReceiverZipCode=00000;
$ReceiverState=$receiver_defaultaddress['state'];
foreach ($countries->CountriesResponse->Countries->Country as $country) {
	if(strtolower($country->CountryCode)==strtolower($receiver_defaultaddress['country'])) $ReceiverCountry=$country->CountryId;
}
/*get payment details*/
$order_payment = $dbo->GetPaymentByOrderId($orderId);
if ($order_payment['payment_type']==1) {
	$PaymentType="Cash";
	$CODAmount=$order_payment['total_price'];
}else {
	$PaymentType="Credit";
	$CODAmount=0;
}
$Pieces=$order_info['total_quantity'];
$Weight=$order_info['total_weight'];
$Length=10;
$Width=10;
$Height=10;
$Latitude=$receiver_defaultaddress['latitude'];
$Longitude=$receiver_defaultaddress['longitude'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://osb.epg.gov.ae/ebs/genericapi/booking/rest/CreateBooking',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
		"BookingRequest": {
	    "SenderContactName": "'.$SenderContactName.'",
	    "SenderCompanyName": "'.$SenderCompanyName.'",
	    "SenderAddress": "'.$SenderAddress.'",
	    "SenderCity": '.$SenderCity.',
	    "SenderContactMobile": "'.$SenderContactMobile.'",
	    "SenderContactPhone": "'.$SenderContactPhone.'",
	    "SenderEmail": "'.$SenderEmail.'",
	    "SenderZipCode": "'.$SenderZipCode.'",
	    "SenderState": "'.$SenderState.'",
	    "SenderCountry": '.$SenderCountry.',
	    "ReceiverContactName": "'.$ReceiverContactName.'",
	    "ReceiverCompanyName": '.$ReceiverCompanyName.',
	    "ReceiverAddress": "'.$ReceiverAddress.'",
	    "ReceiverCity": '.$ReceiverCity.',
	    "ReceiverContactMobile": "'.$ReceiverContactMobile.'",
	    "ReceiverContactPhone": "'.$ReceiverContactPhone.'",
	    "ReceiverEmail": "'.$ReceiverEmail.'",
	    "ReceiverZipCode": "'.$ReceiverZipCode.'",
	    "ReceiverState": "'.$ReceiverState.'",
	    "ReceiverCountry": '.$ReceiverCountry.',
	    "ReferenceNo": "Ref - 012",
	    "ReferenceNo1": null,
	    "ReferenceNo2": null,
	    "ReferenceNo3": null,
	    "ContentTypeCode": "NonDocument",
	    "NatureType": 11,
	    "Service": "Domestic",
	    "ShipmentType": "Express",
	    "DeleiveryType": "Door to Door",
	    "Registered": "No",
	    "PaymentType": "'.$PaymentType.'",
	    "CODAmount": "'.$CODAmount.'",
	    "CODCurrency": "AED",
	    "CommodityDescription": "NA",
	    "Pieces": '.$Pieces.',
	    "Weight": '.$Weight.',
	    "WeightUnit": "KiloGrams",
	    "Length": '.$Length.',
	    "Width": '.$Width.',
	    "Height": '.$Height.',
	    "DimensionUnit": "Centimetre",
	    "ItemValue": "'.$CODAmount.'",
	    "ValueCurrency": "AED",
	    "ProductCode": null,
	    "DeliveryInstructionsID": null,
	    "RequestSource": null,
	    "SendMailToSender": "Yes",
	    "SendMailToReceiver": "Yes",
	    "PreferredPickupDate": "'.$today.'",
	    "PreferredPickupTimeFrom": "10:00",
	    "PreferredPickupTimeTo": "16:00",
	    "Is_Return_Service": "No",
	    "PrintType": "LabelOnly",
	    "Latitude": "'.$Latitude.'",
	    "Longitude": "'.$Longitude.'",
	    "TransactionSource": null,
	    "AWBType":"EAWB",
	    "RequestType": "Booking",
	    "Remarks": null,
	    "SpecialNotes": null,
	    "SenderRegionId":null,
	    "ReceiverRegionId":null
	  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'AccountNo: C577133',
    'Password: C577133'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$res_shipment = json_decode($response);
# Define the Base64 string of the PDF file
$b64 = $res_shipment->BookingResponse->AWBLabel;
# Decode the Base64 string, making sure that it contains only valid characters
$bin = base64_decode($b64, true);
# Perform a basic validation to make sure that the result is a valid PDF file
# Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
# Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
if (strpos($bin, '%PDF') !== 0) {
  throw new Exception('Missing the PDF file signature');
}
# Write the PDF contents to a local file
$file_name = "awb-".$order_info['sellerId']."-".$order_info['userId']."-".$orderId."-".substr(md5(microtime()),rand(0,26),5).'.pdf';
file_put_contents('awbpdf/'.$file_name, $bin);
$awbnumber = $res_shipment->BookingResponse->AWBNumber;
$dbo->updateAWBpdf($orderId,$file_name,$awbnumber);
// $product = $dbp->GetproductById($order_info['productId']);
// $notification_email=$receiver_info['email'];
// $notification_fullname=urlencode($receiver_info['fullname']);
// $summary_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Order Summary:</td></tr><tr><td>Order #: </td><td>'.$order_info['ordernumber'].'</td></tr><tr><td>Order Date: </td><td>'.$order_info['order_date'].'</td></tr><tr><td>Date Shipped:</td><td>'.date("F d, Y").'</td></tr><tr><td>Amount Charged:</td><td>AED '.$order_info['totalprice'].'</td></tr></table>';
// $item_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Items included in this shipment:</td></tr><tr><td>Item/SKU </td><td>Quantity</td></tr><tr><td>'.$product['name'].'</td><td>'.$order_info['quantity'].'</td></tr></table>';
// $ship_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Here are your tracking numbers for the items shipped:</td></tr><tr><td>Carrier </td><td>Tracking Number</td></tr><tr><td>Jomlahbazar Delivery</td><td>'.$awbnumber.'</td></tr></table>';
// if ($notification_email) {
// 	/* Send Email buyer*/
// 	$mail = new PHPMailer(true);
// 	try {
// 			//Server settings
// 			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
// 			$mail->isSMTP();                                            // Send using SMTP
// 			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
// 			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
// 			$mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
// 			$mail->Password   = 'Notify@pomechain20';                               // SMTP password
// 			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
// 			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//
// 			//Recipients
// 			$mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
// 			$mail->addAddress($notification_email, $notification_fullname);     // Add a recipient
//
// 			// Content
// 			$mail->isHTML(true);                                  // Set email format to HTML
// 			$mail->Subject = 'Your order is ready for shipment';
// 			$msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order Shipped</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear '.$receiver_info['fullname'].',</p><p>This is to confirm that your order has now been shipped.</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$summary_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$item_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$ship_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
// 			$mail->Body    = $msg;
// 			$mail->send();
// 			$response['err']=0;
// 	} catch (Exception $e) {
// 			$response['err']=1;
// 	}
// 	/* Send Email */
// }
echo $file_name;
 ?>
