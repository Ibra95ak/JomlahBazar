<?php
session_start();
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
$response['users']='';
$response['info']=array();
$response['addresses']=array();
$response['reachouts']=array();
$response['company']=array();
$response['devices']=array();
$response['credit_cards']=array();
$response['paypals']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['userId'])) $userId=$_GET['userId'];
else $userId=0;
if(isset($_GET['userIds'])) $userIds=explode(",",$_GET['userIds']);
if(isset($_GET['status'])) $status=$_GET['status'];
if ($action=='get') {
  if($userId!=0){
    /*get user by Id*/
    $user = $db->Admin_getUserById($userId);
    if($user){
      $response['err']=0;
      array_push($response['info'],$user);
    }else {
      $response['info']=Null;
    }
    /*get user addresses*/
    $addresses = $dba->Admin_getUserAddresses($userId);
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
      $reachout = $dbr->Admin_getUserReachouts($user['reachoutId']);
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
    $company = $db->Admin_getUserCompany($userId);
    if($company){
      $response['err']=0;
      array_push($response['company'],$company);
    }else {
      $response['company']=Null;
    }
    /*get user devices*/
    $devices = $db->Admin_getUserDevices($userId);
    if($devices){
      $response['err']=0;
      foreach ($devices as $device) {
        array_push($response['devices'],$device);
      }
    }else {
      $response['devices']=Null;
    }
    /*get user wallets*/
    $wallets = $db->Admin_getUserWallets($userId);
    if($wallets){
      foreach ($wallets as $wallet) {
        switch ($wallet['wallettypeId']) {
          case '1':
            /*get user credit cards*/
            $credit_cards = $db->Admin_getUserCreditCards($wallet['walletId']);
            if($credit_cards){
              $response['err']=0;
              foreach ($credit_cards as $credit_card) {
                array_push($response['credit_cards'],$credit_card);
              }
            }else {
              $response['credit_cards']=Null;
            }
            break;
          case '2':
            /*get user paypals*/
            $paypals = $db->Admin_getUserPaypals($wallet['walletId']);
            if($paypals){
              $response['err']=0;
              foreach ($paypals as $paypal) {
                array_push($response['paypals'],$paypal);
              }
            }else {
              $response['paypals']=Null;
            }
            break;

          default:
            // code...
            break;
        }
      }
    }
  }else{
    $query="SELECT * FROM users ";
    $query_count="SELECT COUNT( DISTINCT users.userId) as count FROM users ";
    $where = "";
    /*Parameters*/
    if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
    else $page=1;
    /*initialize limit clause for pagination*/
    $num_rec_per_page=24;/*records per page*/
    $start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
    $limit=" LIMIT $start_from, $num_rec_per_page";
    if (isset($_GET['generalSearch'])) {
      if ($where=="") $where = "WHERE fullname LIKE '%".$_GET['generalSearch']."%' OR email LIKE '%".$_GET['generalSearch']."%' OR otp LIKE '%".$_GET['generalSearch']."%' OR Nationality LIKE '%".$_GET['generalSearch']."%' ";
      else $where .= "AND fullname LIKE '%".$_GET['generalSearch']."%' OR email LIKE '%".$_GET['generalSearch']."%' OR otp LIKE '%".$_GET['generalSearch']."%' OR Nationality LIKE '%".$_GET['generalSearch']."%' ";
    }
    if (isset($_GET['kt_form_type'])) {
      switch ($_GET['kt_form_type']) {
        case '1':
          $searchby .= "is_buyer";
          break;
        case '2':
          $searchby .= "is_seller";
          break;

        default:
          $searchby .= "is_buyer";
          break;
      }
      if ($where=="") $where = "WHERE ".$searchby."=1 ";
      else $where .= "AND ".$searchby."=1 ";
    }
    if (isset($_GET['kt_form_login'])) {
      if ($where=="") $where = "WHERE login=".$_GET['kt_form_login']." ";
      else $where .= "AND login=".$_GET['kt_form_login']." ";
    }
    if (isset($_GET['kt_form_role'])) {
      if ($where=="") $where = "WHERE roleId=".$_GET['kt_form_role']." ";
      else $where .= "AND roleId=".$_GET['kt_form_role']." ";
    }
    /*construct query*/
    $sql=$query.$where.$limit;
    $csql=$query_count.$where;
    $users = $db->Admin_getallUsers($sql);
    $users_count = $db->getUserscount($csql)['count'];
    $pages=ceil($users_count/$num_rec_per_page);
    $ppages=ceil($pages/5);
    if(isset($_GET['pg'])) $pg=$_GET['pg'];
    else $pg=1;
    $start = ($pg - 1) * 5;
    $offset1 = ($page - 1) * $num_rec_per_page + 1;
    $offset2 = $page * $num_rec_per_page;
    if($offset2>$users_count) $offset2=$users_count;
     if($pg<=1) $pgp=1;
     else $pgp=$pg-1;
    if($pg>=$ppages) $pgn=$ppages;
    else $pgn=$pg+1;
    if($page+1>0 && $page+1<=$pages) $next = $page+1;
    else $next = $pages;
    if($page-1>0 && $page-1<=$pages) $prev = $page-1;
    else $prev = 1;
    if($users){
      $response['users'] .= '<table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Nationality</th>
              <th>Buyer</th>
              <th>Seller</th>
              <th>Role</th>
              <th>Status</th>
              <th>Active</th>
            </tr>
          </thead>
          <tbody>';
        foreach($users as $user){
            $user_img = $user['profile_pic'];
            $profile = '';
            if ($user_img) {
							$profile = '<div class="kt-user-card-v2">
								<div class="kt-user-card-v2__pic">
									<img src="'.DIR_ROOT.$user_img.'" alt="photo">
								</div>
								<div class="kt-user-card-v2__details">
									<span class="kt-user-card-v2__name">'.$user['fullname'].'</span>\
								</div>
							</div>';
						}else {
              $profile = '<div class="kt-user-card-v2">
								<div class="kt-user-card-v2__pic">
									<div class="kt-badge kt-badge--xl kt-badge--warning">'.substr($user['fullname'],0,2).'</div>
								</div>
								<div class="kt-user-card-v2__details">
									<span class="kt-user-card-v2__name">'.$user['fullname'].'</span>
								</div>
							</div>';
            }
            switch ($user['is_buyer']) {
              case '1':
                $title = "Buyer";
                $class = "warning";
                break;
              case '2':
                $title = "NA";
                $class = "dark";
                break;

              default:
                $title = "Buyer";
                $class = "warning";
                break;
            }
            $is_buyer = '<span class="kt-badge kt-badge--'.$class.' kt-badge--inline kt-badge--pill">'.$title.'</span>';
            switch ($user['is_seller']) {
              case '1':
                $title = "Seller";
                $class = "turquoise";
                break;
              case '2':
                $title = "NA";
                $class = "dark";
                break;

              default:
                $title = "Seller";
                $class = "turquoise";
                break;
            }
            $is_seller = '<span class="kt-badge kt-badge--'.$class.' kt-badge--inline kt-badge--pill">'.$title.'</span>';
            switch ($user['roleId']) {
              case '1':
                $title = "Manufacturer";
                $class = "brand";
                break;
              case '2':
                $title = "Distributer";
                $class = "brand";
                break;
              case '3':
                $title = "Wholeseller";
                $class = "brand";
                break;
              case '4':
                $title = "Supermarket";
                $class = "brand";
                break;

              default:
                $title = "Wholeseller";
                $class = "brand";
                break;
            }
            $role = '<span class="kt-badge kt-badge--'.$class.' kt-badge--inline kt-badge--pill">'.$title.'</span>';
            switch ($user['login']) {
              case '1':
                $title = "Online";
                $state = "success";
                break;
              case '2':
                $title = "Offline";
                $state = "dark";
                break;

              default:
                $title = "Offline";
                $state = "dark";
                break;
            }
            $login = '<span class="kt-badge kt-badge--'.$state.' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-'.$state.'">'.$title.'</span>';
            switch ($user['active']) {
              case '1':
                $state = "success";
                break;
              case '2':
                $state = "danger";
                break;
              default:
                $state = "danger";
                break;
            }
            $active = '<span class="kt-badge kt-badge--'.$state.' kt-badge--sm"></span>';
            $response['users'] .='
            <tr>
            <td>'.$user['userId'].'</td>
            <td>'.$profile.'</td>
            <td>'.$user['email'].'</td>
            <td>'.$user['otp'].'</td>
            <td>'.$user['Nationality'].'</td>
            <td>'.$is_buyer.'</td>
            <td>'.$is_seller.'</td>
            <td>'.$role.'</td>
            <td>'.$login.'</td>
            <td>'.$active.'</td>
            </tr>
            ';
        }
        $response['users'] .='</tbody>
        <tfoot>
          <tr>
            <td colspan="10">
              <div class="kt-portlet kt-mb-5">
                <div class="kt-portlet__body kt-padding-2">
                  <!--begin: Pagination-->
                  <div class="kt-pagination kt-pagination--dark kt-m5" style="margin-bottom: 13px !important;">
                    <div class="kt-pagination__toolbar">
                    </div>
                    <ul class="kt-pagination__links">
                      <li class="kt-pagination__link--first">
                        <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-dark"></i></a>
                        <li class="kt-pagination__link--next">
                          <a href="javascript:void(0)" onclick="page('.$prev.')"><i class="fa fa-angle-left kt-font-dark"></i></a>
                        </li>
                      </li>';
                      $count=0;
                      for($i=$start+1;$i<=$pages;$i++){
                        $count++;
                        if($count<=5){
                          if($page==$i) $response['users'] .= '<li class="kt-pagination__link--active"><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
                          else $response['users'] .='<li><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
                        }
                        else $response['users'] .= '';
                      }
                       $response['users'] .= '<li class="kt-pagination__link--prev">
                         <a href="javascript:void(0)" onclick="page('.$next.')"><i class="fa fa-angle-right kt-font-dark"></i></a>
                       </li>
                      <li class="kt-pagination__link--last">
                        <a href="javascript:void(0)" onclick="page('.$pages.')"><i class="fa fa-angle-double-right kt-font-dark"></i></a>
                      </li>
                      <li class="transparent-bg"><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">
                        Displaying '.$offset1.' - '.$offset2.' of '.$users_count.' records
                      </span></li>
                    </ul>
                  </div>
                  <!--end: Pagination-->
                </div>
              </div>
            </td>
          </tr>
        </tfoot>
        </table>';
    }
    echo $response['users'];
  }

}
if ($action=='update-list-status') {
  if($userIds!=Null){
    foreach ($userIds as $userId) {
      $db->Admin_updateStatus($userId,$status);
    }
    $response['err']=0;
  }else {
    $response['err']=1;
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
if ($action=='delete-list') {
  if($userIds!=Null){
    foreach ($userIds as $userId) {
      $db->DeleteUserById($userId);
    }
    $response['err']=0;
  }else {
    $response['err']=1;
  }
}
/*edit user info*/
if ($action=='post-account') {
  $userId=$_POST['userId'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $otp=$_POST['otp'];
  if(isset($_POST['nationality'])) $nationality=$_POST['nationality'];
  else $nationality=Null;
  if(isset($_POST['encrypted_password'])) $encrypted_password=$_POST['encrypted_password'];
  else $encrypted_password=Null;
  if(isset($_POST['salt'])) $salt=$_POST['salt'];
  else $salt=Null;
  if(isset($_POST['activation_code'])) $activation_code=$_POST['activation_code'];
  else $activation_code=Null;
  if(isset($_POST['activation_salt'])) $activation_salt=$_POST['activation_salt'];
  else $activation_salt=Null;
  $active=$_POST['active'];
  if(isset($_FILES["profile_pic"]["name"])) $profile_pic='assets/media/users/'.$_FILES["profile_pic"]["name"];
  else $profile_pic=$_POST['profile_pic'];
  $target_dir = "../../../assets/media/users/";
  $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
  $file=substr($target_file, 6);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
      $response['err']=0;
      $response['media']=$file;
  } else {
      $response['err']=1;
  }
  if(isset($_POST['roleId'])) $roleId=$_POST['roleId'];
  else $roleId=Null;
  $is_buyer=$_POST['is_buyer'];
  $is_seller=$_POST['is_seller'];
  $login=$_POST['login'];
  if(isset($_POST['googlesub'])) $googlesub=$_POST['googlesub'];
  else $googlesub=Null;
  if(isset($_POST['linkedinidentifier'])) $linkedinidentifier=$_POST['linkedinidentifier'];
  else $linkedinidentifier=Null;
  if(isset($_POST['authyId'])) $authyId=$_POST['authyId'];
  else $authyId=Null;
  $jbidentifier=$_POST['jbidentifier'];
  $user = $db->Admin_EditUser($userId, $fullname, $email, $otp, $nationality, $encrypted_password, $salt, $activation_code, $activation_salt, $active, $profile_pic, $roleId, $is_buyer, $is_seller, $login, $googlesub, $linkedinidentifier, $authyId, $jbidentifier);
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
  $reachout = $dbr->editReachout($reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom);
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
  if(isset($_POST['default_address'])) $default=1;
  else $default=2;
  if($addressId!=0) $address = $dba->EditUserAddress($addressId,$userId,$ipaddress, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude);
  else $address = $dba->AddUserAddress($userId, $ipaddress, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $language, $default);
  if($address) $response['err']=0;
  else $response['err']=1;
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
?>
