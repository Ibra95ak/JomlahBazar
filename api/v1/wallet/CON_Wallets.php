<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\CryptoKey\CryptoKeyPurpose;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Cloud\Kms\V1\KeyRing;
/*Call wallets class*/
require_once '../../../' . DIR_MOD . 'Ser_Wallets.php';
$db = new Ser_Wallets();
$response = array();
$response['err'] = -1;
$response['wallets'] = array();
$response['wallettypes'] = array();

$action = $_GET['action'];

$clientKMS = new KeyManagementServiceClient();

$projectId = 'third-nature-273904';
$location = 'global';

// Create a keyring
$keyRingId = 'test-jd-enc';
$locationName = $clientKMS::locationName($projectId, $location);
$keyRingName = $clientKMS::keyRingName($projectId, $location, $keyRingId);
try {
    $keyRing = $clientKMS->getKeyRing($keyRingName);
} catch (ApiException $e) {
    if ($e->getStatus() === 'NOT_FOUND') {
        $keyRing = new KeyRing();
        $keyRing->setName($keyRingName);
        $clientKMS->createKeyRing($locationName, $keyRingId, $keyRing);
    }
}

// Create a cryptokey
$keyId = 'test-fb-enc';
$keyName = $clientKMS::cryptoKeyName($projectId, $location, $keyRingId, $keyId);
try {
    $cryptoKey = $clientKMS->getCryptoKey($keyName);
} catch (ApiException $e) {
    if ($e->getStatus() === 'NOT_FOUND') {
        $cryptoKey = new CryptoKey();
        $cryptoKey->setPurpose(CryptoKeyPurpose::ENCRYPT_DECRYPT);
        $cryptoKey = $clientKMS->createCryptoKey($keyRingName, $keyId, $cryptoKey);
    }
}

if (isset($_GET['walletId'])) $walletId = $_GET['walletId'];
else {
  $walletId = 0;
}
if (isset($_GET['userId'])) $userId = $_GET['userId'];
else {
  $userId = 0;
}
if (isset($_GET['creditcardId'])) $creditcardId = $_GET['creditcardId'];
else {
  $creditcardId = 0;
}
if (isset($_GET['paypalId'])) $paypalId = $_GET['paypalId'];
else {
  $paypalId = 0;
}
if ($action == 'get-payment-fees') {
  $get_fees = $db->GetPaymentFees();
  echo json_encode($get_fees);
}
if ($action == 'get_creditcard') {
  $get_creditcard = $db->GetCreditcardById($creditcardId);
  echo json_encode($get_creditcard);
}
if ($action == 'get') {
  if($walletId!=0){
    $get_wallet = $db->GetWalletById($walletId);
    echo json_encode($get_wallet);
  }elseif ($creditcardId!=0) {
    $get_creditcard = $db->GetCreditcardById($creditcardId);
    echo json_encode($get_creditcard);
  }elseif ($paypalId!=0) {
    $get_paypalId = $db->GetPaypalById($paypalId);
    echo json_encode($get_paypalId);
  }else{
    //get all leads details
    $getUser_wallets = $db->GetWalletByUserId($userId);
    if ($getUser_wallets) {
      foreach ($getUser_wallets as $wallet) {
        array_push($response['wallets'], $wallet);
      }
      echo json_encode($response);
    }
  }
}
if ($action == 'get-wallet-info') {
  $get_wallet = $db->GetWalletById($walletId);
  switch ($get_wallet['wallettypeId']) {
    case '1':
      $get_wallet_info = $db->GetCreditcardByWalletId($walletId);
      $get_wallet_info ['wallettype'] = 1;
      break;
    case '2':
      $get_wallet_info = $db->GetPaypalByWalletId($walletId);
      $get_wallet_info ['wallettype'] = 2;
      break;
    case '3':
      $get_wallet_info = $db->GetBankByWalletId($walletId);
      $get_wallet_info ['wallettype'] = 3;
      break;
    default:
      $get_wallet_info = NULL;
      break;
  }
  echo json_encode($get_wallet_info);
}
if($action == 'post-cc'){
  // $cipher = "aes-256-cbc";
  // $key = "H@McQeThWmZq4t7w!z%C*F-JaNdRgUjX";
  $creditcardId = $_POST['creditcardId'];
  $walletId = $_POST['ccwalletId'];
  $card_type = $_POST['temp_payment_option'];
  $cardholdername = $_POST['temp_card_holdername'];
  $cardnumber = $_POST['temp_card_number'];
  // if (in_array($cipher, openssl_get_cipher_methods()))
  // {
  //     $ivlen = openssl_cipher_iv_length($cipher);
  //     $iv = "ThWmZq4t6w9z4C&F";
  //     $enc_cardnumber = openssl_encrypt($cardnumber, $cipher, $key, $options=0, $iv);
  // }
  $enc = $clientKMS->encrypt($keyName, $cardnumber);
  $enc_cardnumber = base64_encode($enc->getCiphertext());
  $cardname = $_POST['temp_card_name'];
  $cardexpirymonth = $_POST['temp_expiry_month'];
  $cardexpiryyear = $_POST['temp_expiry_year'];
  if ($creditcardId) {
    $card = $db->EditCreditcard($creditcardId,$walletId,$card_type,$cardholdername,$enc_cardnumber,$cardname,$cardexpirymonth,$cardexpiryyear);
    if ($card) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }else {
    $wallet = $db->addWallet($userId, 1);
    $card = $db->Addcreditcard($wallet['last_inserted'],$card_type, $cardholdername, $enc_cardnumber, $cardname, $cardexpirymonth,$cardexpiryyear);
    if ($card) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }
  echo json_encode($response);
}
if($action == 'post-pp'){
  $paypalId = $_POST['paypalId'];
  $walletId = $_POST['ppwalletId'];
  $paypalemail = $_POST['paypal_email'];
  if ($paypalId) {
    $card = $db->EditPaypal($paypalId,$walletId,$paypalemail);
    if ($card) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }else {
    $wallet = $db->addWallet($userId,2);
    $card = $db->AddPaypal($wallet['last_inserted'], $paypalemail);
    if ($card) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }
  echo json_encode($response);
}
if($action == 'post-ba'){
  $bankaccountId = $_POST['bankaccountId'];
  $walletId = $_POST['bawalletId'];
  $account_number = $_POST['account_number'];
  $account_name = $_POST['account_name'];
  $bank_name = $_POST['bank_name'];
  $iban = $_POST['iban'];
  $swift_code = $_POST['swift_code'];
  $currency = $_POST['currency'];
  if ($bankaccountId) {
    $bank = $db->EditBankAccount($bankaccountId, $walletId, $account_number, $account_name, $bank_name, $iban, $swift_code, $currency);
    if ($bank) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }else {
    $wallet = $db->addWallet($userId,3);
    $bank = $db->$bank = $db->AddBankAccount($wallet['last_inserted'], $account_number, $account_name, $bank_name, $iban, $swift_code, $currency);
    if ($bank) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
  }
  echo json_encode($response);
}
if ($action == 'delete') {
  $get_wallet = $db->GetWalletById($walletId);
  switch ($get_wallet['wallettypeId']) {
    case '1':
      $delete = $db->DeleteCreditCardByWalletId($walletId);
      break;
    case '2':
      $delete = $db->DeletePaypalByWalletId($walletId);
      break;
    case '3':
      $delete = $db->DeleteBankAccountByWalletId($walletId);
      break;
    default:
      $delete = NULL;
      break;
  }
  $wallet = $db->DeleteWalletById($walletId);
  header("Location:".DIR_VIEW.DIR_USR.'form_userwallets.php');
}
if ($action == 'delete-admin') {
  $get_wallet = $db->GetWalletById($walletId);
  echo "string".$get_wallet['wallettypeId'];
  switch ($get_wallet['wallettypeId']) {
    case '1':
      $delete = $db->DeleteCreditCardByWalletId($walletId);
      break;
    case '2':
      $delete = $db->DeletePaypalByWalletId($walletId);
      break;
    case '3':
      $delete = $db->DeleteBankAccountByWalletId($walletId);
      break;
    default:
      $delete = NULL;
      break;
  }
  //$wallet = $db->DeleteWalletById($walletId);
  $response['err'] = 0;
}
