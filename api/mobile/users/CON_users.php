<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
require_once '../../../'.DIR_MOD.'Ser_Reachouts.php';
require_once '../../../'.DIR_MOD.'Ser_Wallets.php';
/*Create Users instance*/
$db = new Ser_Users();
$dba = new Ser_Addresses();
$dbr = new Ser_Reachouts();
$dbw = new Ser_Wallets();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['insertId']=-1;
$response['users']=array();
$response['info']=array();
$response['addresses']=array();
$response['reachouts']=array();
$response['company']=array();
$response['devices']=array();
$response['credit_cards']=array();
$response['paypals']=array();
$response['is_seller']=-1;
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['userId'])) $userId=$_GET['userId'];
if(isset($_GET['userIds'])) $userIds=explode(",",$_GET['userIds']);
if(isset($_GET['status'])) $status=$_GET['status'];
if ($action=='get') {
  if($userId!=0){
    /*get user by Id*/
    $user = $db->getUserById($userId);
    if($user){
      $response['err']=0;
      array_push($response['info'],$user);
    }else {
      $response['info']=Null;
    }
    /*get user addresses*/
    $addresses = $dba->getAllAddressesByUserId($userId);
    if($addresses){
      $response['err']=0;
      foreach ($addresses as $address) {
        array_push($response['addresses'],$address);
      }
    }else {
      $response['addresses']=Null;
    }
    /*get user reachouts*/
    if ($user['reachoutId']!=0) {
      $reachout = $dbr->GetReachoutById($user['reachoutId']);
      if($reachout){
        $response['err']=0;
        array_push($response['reachouts'],$reachout);
      }else {
        $response['reachouts']=Null;
      }
    }else {
      $response['reachouts']=Null;
    }
    /*get user company*/
    $company = $db->getUserCompany($userId);
    if($company){
      $response['err']=0;
      array_push($response['company'],$company);
    }else {
      $response['company']=Null;
    }
    /*get user cards*/
    $credit_cards = $db->getUserCreditCards($userId);
    if($credit_cards){
      $response['err']=0;
      foreach ($credit_cards as $credit_card) {
        array_push($response['credit_cards'],$credit_card);
      }
    }else {
      $response['credit_cards']=Null;
    }
  }else{
    /*get all users*/
    $users = $db->getallUsers();
    if($users){
        foreach($users as $user){
            array_push($response['users'],$user);
        }
    }
    $fp = fopen('../json/users.json', 'w');
    fwrite($fp, json_encode($response['users']));
    fclose($fp);
  }

}
if ($action=='delete') {
  /*delete user*/
  $user = $db->DeleteUserById($userId);
  if ($user) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
}
/*edit user info*/
if ($action=='post-account') {
  $userId=$_POST['userId'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $otp=$_POST['otp'];
  // if(isset($_POST['nationality'])) $nationality=$_POST['nationality'];
  // else $nationality=Null;
  // if(isset($_POST['encrypted_password'])) $encrypted_password=$_POST['encrypted_password'];
  // else $encrypted_password=Null;
  // if(isset($_POST['salt'])) $salt=$_POST['salt'];
  // else $salt=Null;
  // if(isset($_POST['activation_code'])) $activation_code=$_POST['activation_code'];
  // else $activation_code=Null;
  // if(isset($_POST['activation_salt'])) $activation_salt=$_POST['activation_salt'];
  // else $activation_salt=Null;
  // $active=$_POST['active'];
  // if(isset($_FILES["profile_pic"]["name"])) $profile_pic='assets/media/users/'.$_FILES["profile_pic"]["name"];
  // else $profile_pic=$_POST['profile_pic'];
  // $target_dir = "../../../assets/media/users/";
  // $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
  // $file=substr($target_file, 6);
  // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
  //     $response['err']=0;
  //     $response['media']=$file;
  // } else {
  //     $response['err']=1;
  // }
  // if(isset($_POST['roleId'])) $roleId=$_POST['roleId'];
  // else $roleId=Null;
  // $is_buyer=$_POST['is_buyer'];
  // $is_seller=$_POST['is_seller'];
  // $login=$_POST['login'];
  // if(isset($_POST['googlesub'])) $googlesub=$_POST['googlesub'];
  // else $googlesub=Null;
  // if(isset($_POST['linkedinidentifier'])) $linkedinidentifier=$_POST['linkedinidentifier'];
  // else $linkedinidentifier=Null;
  // if(isset($_POST['authyId'])) $authyId=$_POST['authyId'];
  // else $authyId=Null;
  // $jbidentifier=$_POST['jbidentifier'];
  $user = $db->EditUser($userId,$fullname, $email, $otp);
  if($user) $response['err']=0;
  else $response['err']=1;
}
/*edit user reachout*/
if ($action=='post-socials') {
  $reachoutId=$_POST['reachoutId'];
  $phone=$_POST['phone'];
  $whatsapp=$_POST['whatsapp'];
  $telegram=$_POST['telegram'];
  $messenger=$_POST['messenger'];
  $linkedin=$_POST['linkedin'];
  $sms=$_POST['sms'];
  $facebook=$_POST['facebook'];
  $instagram=$_POST['instagram'];
  $teams=$_POST['teams'];
  $zoom=$_POST['zoom'];
  $userId = $_POST['userId'];
  if ($reachoutId!=0) {
    echo "edit";
    $reachout = $dbr->editReachout($reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom);
  }else {
    echo "add";
    $reachout = $dbr->addReachout($phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom);
    $reachoutId = $reachout['insertId'];
    echo "reachoutId".$reachoutId;
    $users = $db->UpdateReachoutId($userId,$reachoutId);
  }
  if($reachout) $response['err']=0;
  else $response['err']=1;
}
/*edit user license*/
if ($action=='post-license') {
  $userId=$_POST['userId'];
  $license= "assets/media/licenses/" . $_POST["path_license"];
  $vat= "assets/media/licenses/" . $_POST["path_vat"];
  if($vat== "assets/media/licenses/") $vat=Null;
  $registry = $db->DeleteUserlicense($userId);
  $registry = $db->AddUserlicense($userId,$license,$vat);
  if($registry) $response['err']=0;
  else $response['err']=1;
}
/*edit user store*/
if ($action=='post-store') {
  $userId=$_POST['userId'];
  $license= "assets/media/licenses/" . $_POST["path_license"];
  $vat= "assets/media/licenses/" . $_POST["path_vat"];
  if($vat== "assets/media/licenses/") $vat=Null;
  $registry = $db->DeleteUserlicense($userId);
  $registry = $db->AddUserlicense($userId,$license,$vat);
  if($registry) $response['err']=0;
  else $response['err']=1;
}
/*edit user address*/
if ($action=='post-address') {
  $userId=$_POST['userId'];
  $addressId=$_POST['addressId'];
  $addresstitle=$_POST['addresstitle'];
  $address_type=$_POST['address_type'];
  $ipaddress=$_POST['ipaddress'];
  $address1=$_POST['address1'];
  $address2=$_POST['address2'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $postalcode=$_POST['postalcode'];
  $country=$_POST['country'];
  $latitude=round($_POST['latitude'],7);
  $longitude=round($_POST['longitude'],7);
  $language=$_POST['language'];
  $default_address=$_POST['default'];
  if($default_address==0) $default=2;
  else $default=1;
  if ($default==1) {
    $resetaddress = $dba->ResetUserAddresses($userId);
  }
  if($addressId!=0) $address = $dba->EditUserAddress($addressId, $userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $default);
  else $address = $dba->AddUserAddress($userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $language, $default);
  if($address) $response['err']=0;
  else $response['err']=1;
  echo json_encode($response);
}
/*edit user credit card*/
if ($action=='post-card') {
  $walletId=$_POST['walletId'];
  $creditcardId=$_POST['creditcardId'];
  $card_name=$_POST['card_name'];
  $card_number=$_POST['card_number'];
  $card_expiry=$_POST['card_expiry'];
  $card = $dbw->EditCreditcard($creditcardId,$walletId,$card_number,$card_name,$card_expiry);
  if($card) $response['err']=0;
  else $response['err']=1;
}
/*edit user paypal*/
if ($action=='post-paypal') {
  $walletId=$_POST['walletId'];
  $paypalId=$_POST['paypalId'];
  $paypal_email=$_POST['paypal_email'];
  $paypal = $dbw->EditPaypal($paypalId,$walletId,$paypal_email);
  if($paypal) $response['err']=0;
  else $response['err']=1;
}
if ($action=="reg-seller") {
  $userId=$_GET['userId'];
  /*set user as seller by Id*/
  $user = $db->SetSupplier($userId);
  if ($user) $response['err'] = 0;
  else $response['err'] = 1;
}
if ($action=='check-seller') {
  /*get userId*/
  $users = $db->getUserById($userId);
  $response['err']=0;
  if ($users['is_seller']==1) {
    $response['is_seller']=1;
  }else {
    $response['is_seller']=2;
  }
}
echo json_encode($response);
?>
