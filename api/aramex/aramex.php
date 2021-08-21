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
$sender_country=$sender_defaultaddress['country'];
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
$receiver_city=$receiver_defaultaddress['city'];
$receiver_postalcode=$receiver_defaultaddress['postalcode'];
$receiver_country=$receiver_defaultaddress['country'];
$receiver_latitude=$receiver_defaultaddress['latitude'];
$receiver_longitude=$receiver_defaultaddress['longitude'];
$receiver_fullname=$receiver_info['fullname'];
$receiver_email=$receiver_info['email'];
$receiver_otp=$receiver_info['otp'];
/*pickup date*/
$current = strtotime("today")."000";
$tomorrow = strtotime("tomorrow +10hours")."000";
$aftertomorrow = strtotime("tomorrow +1day +10hours")."000";
$closingtime = strtotime("tomorrow +14hours")."000";
$isweekend = date('w', strtotime("tomorrow +10hours"));
if ($isweekend==6 || $isweekend==0) {
	$tomorrow = strtotime("next Monday +10hours")."000";
	$aftertomorrow = strtotime("next Monday +1day +10hours")."000";
	$closingtime = strtotime("next Monday +14hours")."000";
}
/*get payment details*/
$order_payment = $dbo->GetPaymentByOrderId($orderId);
if ($order_payment['payment_type']==1) {
	$services = "CODS";
	$CODAmount=$order_payment['total_price'];
}else {
	$services = "";
	$CODAmount="null";
}
$quantity=$order_info['total_quantity'];
$weight=$order_info['total_weight'];
if ($receiver_country == $sender_country) {
	$ProductGroup = "DOM"; //Domestic
	$ProductType = "OND";
}else {
	$ProductGroup = "EXP"; //Express
	$ProductType = "EPX";
}
if ($services == "CODS") {
	/*sender api data*/
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "Shipments": [
	        {
	            "Reference1": null,
	            "Reference2": null,
	            "Reference3": null,
	            "Shipper": {
	                "Reference1": null,
	                "Reference2": null,
	                "AccountNumber": "60515443",
	                "PartyAddress": {
	                    "Line1": "'.$sender_address1.'",
	                    "Line2": "'.$sender_address2.'",
	                    "Line3": "",
	                    "City": "'.$sender_city.'",
	                    "StateOrProvinceCode": "",
	                    "PostCode": "'.$sender_postalcode.'",
	                    "CountryCode": "'.$sender_country.'",
	                    "Longitude": '.$sender_longitude.',
	                    "Latitude": '.$sender_latitude.',
	                    "BuildingNumber": null,
	                    "BuildingName": null,
	                    "Floor": null,
	                    "Apartment": null,
	                    "POBox": null,
	                    "Description": null
	                },
	                "Contact": {
	                    "Department": null,
	                    "PersonName": "'.$sender_fullname.'",
	                    "Title": null,
	                    "CompanyName": "'.$sender_company.'",
	                    "PhoneNumber1": "'.$sender_otp.'",
	                    "PhoneNumber1Ext": null,
	                    "PhoneNumber2": null,
	                    "PhoneNumber2Ext": null,
	                    "FaxNumber": null,
	                    "CellPhone": "'.$sender_otp.'",
	                    "EmailAddress": "'.$sender_email.'",
	                    "Type": null
	                }
	            },
	            "Consignee": {
	                "Reference1": null,
	                "Reference2": null,
	                "AccountNumber": null,
	                "PartyAddress": {
	                    "Line1": "'.$receiver_address1.'",
	                    "Line2": "'.$receiver_address2.'",
	                    "Line3": "",
	                    "City": "'.$receiver_city.'",
	                    "StateOrProvinceCode": "",
	                    "PostCode": "'.$receiver_postalcode.'",
	                    "CountryCode": "'.$receiver_country.'",
	                    "Longitude": '.$receiver_longitude.',
	                    "Latitude": '.$receiver_latitude.',
	                    "BuildingNumber": null,
	                    "BuildingName": null,
	                    "Floor": null,
	                    "Apartment": null,
	                    "POBox": null,
	                    "Description": null
	                },
	                "Contact": {
	                    "Department": "null",
	                    "PersonName": "'.$receiver_fullname.'",
	                    "Title": null,
	                    "CompanyName": "NA",
	                    "PhoneNumber1": "'.$receiver_otp.'",
	                    "PhoneNumber1Ext": null,
	                    "PhoneNumber2": null,
	                    "PhoneNumber2Ext": null,
	                    "FaxNumber": null,
	                    "CellPhone": "'.$receiver_otp.'",
	                    "EmailAddress": "'.$receiver_email.'",
	                    "Type": null
	                }
	            },
	            "ThirdParty": null,
	            "ShippingDateTime": "/Date('.$current.')/",
	        	"DueDate": "/Date('.$tomorrow.')/",
	            "Comments": null,
	            "PickupLocation": null,
	            "OperationsInstructions": null,
	            "AccountingInstrcutions": null,
	            "Details": {
	                "Dimensions": null,
	                "ActualWeight": {
	                    "Unit": "KG",
	                    "Value": '.$weight.'
	                },
	                "ChargeableWeight": null,
	                "DescriptionOfGoods": "NA",
	                "GoodsOriginCountry": "'.$sender_country.'",
	                "NumberOfPieces": '.$quantity.',
	                "ProductGroup": "'.$ProductGroup.'",
	                "ProductType": "'.$ProductType.'",
	                "PaymentType": "P",
	                "PaymentOptions": null,
	                "CustomsValueAmount":null,
									"CashOnDeliveryAmount": {
			               "CurrencyCode": "AED",
			               "Value": "'.$CODAmount.'"
			            },
	                "InsuranceAmount": null,
	                "CashAdditionalAmount": null,
	                "CashAdditionalAmountDescription": null,
	                "CollectAmount": null,
	                "Services": "'.$services.'",
	                "Items": null,
	                "DeliveryInstructions": null
	            },
	            "Attachments": null,
	            "ForeignHAWB": null,
	            "TransportType": 0,
	            "PickupGUID": null,
	            "Number": null,
	            "ScheduledDelivery": null
	        }
	    ],
	    "LabelInfo": {
	        "ReportID": 9729,
	        "ReportType": "URL"
	    },
	    "ClientInfo": {
	        "Source": 24,
	        "AccountCountryCode": "AE",
	        "AccountEntity": "DXB",
	        "AccountPin": "116216",
	        "AccountNumber": "60515443",
			"UserName": "clarence.orendain@pomechain.com",
			"Password": "Pomechain@ara20",
	        "Version": "v1"
	    },
	    "Transaction": {
	        "Reference1": "001",
	        "Reference2": "",
	        "Reference3": "",
	        "Reference4": "",
	        "Reference5": ""
	    }
	}
	',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Accept: application/json'
	  ),
	));

}else {
	/*sender api data*/
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "Shipments": [
	        {
	            "Reference1": null,
	            "Reference2": null,
	            "Reference3": null,
	            "Shipper": {
	                "Reference1": null,
	                "Reference2": null,
	                "AccountNumber": "45796",
	                "PartyAddress": {
	                    "Line1": "'.$sender_address1.'",
	                    "Line2": "'.$sender_address2.'",
	                    "Line3": "",
	                    "City": "'.$sender_city.'",
	                    "StateOrProvinceCode": "",
	                    "PostCode": "'.$sender_postalcode.'",
	                    "CountryCode": "'.$sender_country.'",
	                    "Longitude": '.$sender_longitude.',
	                    "Latitude": '.$sender_latitude.',
	                    "BuildingNumber": null,
	                    "BuildingName": null,
	                    "Floor": null,
	                    "Apartment": null,
	                    "POBox": null,
	                    "Description": null
	                },
	                "Contact": {
	                    "Department": null,
	                    "PersonName": "'.$sender_fullname.'",
	                    "Title": null,
	                    "CompanyName": "'.$sender_company.'",
	                    "PhoneNumber1": "'.$sender_otp.'",
	                    "PhoneNumber1Ext": null,
	                    "PhoneNumber2": null,
	                    "PhoneNumber2Ext": null,
	                    "FaxNumber": null,
	                    "CellPhone": "'.$sender_otp.'",
	                    "EmailAddress": "'.$sender_email.'",
	                    "Type": null
	                }
	            },
	            "Consignee": {
	                "Reference1": null,
	                "Reference2": null,
	                "AccountNumber": null,
	                "PartyAddress": {
	                    "Line1": "'.$receiver_address1.'",
	                    "Line2": "'.$receiver_address2.'",
	                    "Line3": "",
	                    "City": "'.$receiver_city.'",
	                    "StateOrProvinceCode": "",
	                    "PostCode": "'.$receiver_postalcode.'",
	                    "CountryCode": "'.$receiver_country.'",
	                    "Longitude": '.$receiver_longitude.',
	                    "Latitude": '.$receiver_latitude.',
	                    "BuildingNumber": null,
	                    "BuildingName": null,
	                    "Floor": null,
	                    "Apartment": null,
	                    "POBox": null,
	                    "Description": null
	                },
	                "Contact": {
	                    "Department": "null",
	                    "PersonName": "'.$receiver_fullname.'",
	                    "Title": null,
	                    "CompanyName": "NA",
	                    "PhoneNumber1": "'.$receiver_otp.'",
	                    "PhoneNumber1Ext": null,
	                    "PhoneNumber2": null,
	                    "PhoneNumber2Ext": null,
	                    "FaxNumber": null,
	                    "CellPhone": "'.$receiver_otp.'",
	                    "EmailAddress": "'.$receiver_email.'",
	                    "Type": null
	                }
	            },
	            "ThirdParty": null,
	            "ShippingDateTime": "/Date('.$current.')/",
	        	"DueDate": "/Date('.$tomorrow.')/",
	            "Comments": null,
	            "PickupLocation": null,
	            "OperationsInstructions": null,
	            "AccountingInstrcutions": null,
	            "Details": {
	                "Dimensions": null,
	                "ActualWeight": {
	                    "Unit": "KG",
	                    "Value": '.$weight.'
	                },
	                "ChargeableWeight": null,
	                "DescriptionOfGoods": "NA",
	                "GoodsOriginCountry": "'.$sender_country.'",
	                "NumberOfPieces": '.$quantity.',
	                "ProductGroup": "'.$ProductGroup.'",
	                "ProductType": "'.$ProductType.'",
	                "PaymentType": "P",
	                "PaymentOptions": null,
	                "CustomsValueAmount":null,
									"CashOnDeliveryAmount": null,
	                "InsuranceAmount": null,
	                "CashAdditionalAmount": null,
	                "CashAdditionalAmountDescription": null,
	                "CollectAmount": null,
	                "Services": "'.$services.'",
	                "Items": null,
	                "DeliveryInstructions": null
	            },
	            "Attachments": null,
	            "ForeignHAWB": null,
	            "TransportType": 0,
	            "PickupGUID": null,
	            "Number": null,
	            "ScheduledDelivery": null
	        }
	    ],
	    "LabelInfo": {
	        "ReportID": 9729,
	        "ReportType": "URL"
	    },
			"ClientInfo": {
	        "Source": 24,
	        "AccountCountryCode": "AE",
	        "AccountEntity": "DXB",
	        "AccountPin": "116216",
	        "AccountNumber": "60515443",
			"UserName": "clarence.orendain@pomechain.com",
			"Password": "Pomechain@ara20",
	        "Version": "v1"
	    }
	    "Transaction": {
	        "Reference1": "001",
	        "Reference2": "",
	        "Reference3": "",
	        "Reference4": "",
	        "Reference5": ""
	    }
	}
	',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Accept: application/json'
	  ),
	));

}

$response = curl_exec($curl);
$res_shipment = json_decode($response);
$file_name = $res_shipment->Shipments[0]->ShipmentLabel->LabelURL;
$awbnumber = $res_shipment->Shipments[0]->ID;
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreatePickup',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"ClientInfo": {
		"Source": 24,
		"AccountCountryCode": "AE",
		"AccountEntity": "DXB",
		"AccountPin": "116216",
		"AccountNumber": "60515443",
		"UserName": "clarence.orendain@pomechain.com",
		"Password": "Pomechain@ara20",
		"Version": "v1"
	},
	"LabelInfo": {
		"ReportID": 9201,
		"ReportType": "URL"
	},
	"Pickup": {
		"PickupAddress": {
			"Line1": "'.$sender_address1.'",
			"Line2": "'.$sender_address2.'",
			"Line3": "",
			"City": "'.$sender_city.'",
			"StateOrProvinceCode": "",
			"PostCode": "'.$sender_postalcode.'",
			"CountryCode": "'.$sender_country.'",
			"Longitude": '.$sender_longitude.',
			"Latitude": '.$sender_latitude.',
			"BuildingNumber": null,
			"BuildingName": null,
			"Floor": null,
			"Apartme nt": null,
			"POBox": null,
			"Description": null
		},
		"PickupContact": {
			"Department": null,
			"PersonName": "'.$sender_fullname.'",
			"Title": null,
			"CompanyName": "'.$sender_company.'",
			"PhoneNumber1": "'.$sender_otp.'",
			"PhoneNumber1Ext": null,
			"PhoneNumber2": null,
			"PhoneNumber2Ext": null,
			"FaxNumber": null,
			"CellPhone": "'.$sender_otp.'",
			"EmailAddress": "'.$sender_email.'",
			"Type": null
		},
		"PickupLocation": "Reception",
		"PickupDate": "/Date('.$tomorrow.')/",
		"ReadyTime": "/Date('.$tomorrow.')/",
		"LastPickupTime": "/Date('.$aftertomorrow.')/",
		"ClosingTime": "/Date('.$closingtime.')/",
		"Comments": "",
		"Reference1": "001",
		"Reference2": "",
		"Vehicle": "Car",
		"Shipments": null,
		"PickupItems": [{
			"ProductGroup": "'.$ProductGroup.'",
			"ProductType": "'.$ProductType.'",
			"NumberOfShipments": 1,
			"PackageType": "Box",
			"Payment": "P",
			"ShipmentWeight": {
				"Unit": "KG",
				"Value": '.$weight.'
			},
			"ShipmentVolume": null,
			"NumberOfPieces": '.$quantity.',
			"CashAmount": null,
			"ExtraCharges": null,
			"ShipmentDimensions": {
				"Length": 0,
				"Width": 0,
				"Height": 0,
				"Unit": ""
			},
			"Comments": ""
		}],
		"Status": "Ready",
		"ExistingShipments": null,
		"Branch": "",
		"RouteCode": ""
	},
	"Transaction": {
		"Reference1": "",
		"Reference2": "",
		"Reference3": "",
		"Reference4": "",
		"Reference5": ""
	}
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$dbo->updateAWBpdf($orderId,$file_name,$awbnumber);
echo $file_name;
?>
