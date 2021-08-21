<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\CryptoKey\CryptoKeyPurpose;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Cloud\Kms\V1\KeyRing;

$client = new GuzzleHttp\Client();

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

if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
    $roleId = $usr->roleId;
    switch ($_SESSION['Login_as']) {
  		case 1:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  		case 2:
  			include('../' . DIR_CON . "header_supplier.php");
  			break;

  		default:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  	}
} else {
    header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
/*Call Users class*/
require_once '../../' . DIR_MOD . 'Ser_Wallets.php';
/*Create Users instance*/
$db = new Ser_Wallets();
$res_wallets = $client->request('GET', DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=get&userId='.$userId);/*fetch all categories*/
$wallets = json_decode($res_wallets->getBody());
$res_wallettypes = $client->request('GET', DIR_JSON.'Read.php?jsonname=wallettypes.json');/*fetch all categories*/
$wallettypes=json_decode($res_wallettypes->getBody());
// $cipher = "aes-256-cbc";
// $key = "H@McQeThWmZq4t7w!z%C*F-JaNdRgUjX";
if(isset($_GET['walletId'])){
  $walletId=$_GET['walletId'];
  $res_wallet = $client->request('GET', DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=get-wallet-info&walletId='.$walletId);/*fetch all categories*/
  $wallet = json_decode($res_wallet->getBody());
  switch ($wallet->wallettype) {
    case '1':
      $wallettypeId = $wallet->wallettype;
      $display_cc = "inline";
      $display_pp = "none";
      $display_ba = "none";
      $creditcardId = $wallet->creditcardId;
       // if (in_array($cipher, openssl_get_cipher_methods()))
       // {
       //     $ivlen = openssl_cipher_iv_length($cipher);
       //     $iv = "ThWmZq4t6w9z4C&F";
       //     $card_number = openssl_decrypt($wallet->card_number, $cipher, $key, $options=0, $iv);
       // }
       $response = $clientKMS->decrypt($keyName, base64_decode($wallet->card_number));

       $card_number = $response->getPlaintext();
       $card_type = $wallet->card_type;
       $card_holdername = $wallet->card_holdername;
       $card_name = $wallet->card_name;
       $card_expirymonth = $wallet->card_expirymonth;
       $card_expiryyear = $wallet->card_expiryyear;
       //$bankname = $wallet->bankname;
       $paypalId = NULL;
       $email = NULL;
       $bankaccountId = NULL;
       $account_number = NULL;
       $account_name = NULL;
       $bank_name = NULL;
       $iban = NULL;
       $swift_code = NULL;
       $currency = NULL;
      break;
    case '2':
      $wallettypeId = $wallet->wallettype;
      $display_cc = "none";
      $display_pp = "inline";
      $display_ba = "none";
      $paypalId = $wallet->paypalId;
      $email = $wallet->email;
      $creditcardId = NULL;
      $card_type = NULL;
      $card_number = NULL;
      $card_holdername = NULL;
      $card_name = NULL;
      $card_expirymonth = NULL;
      $card_expiryyear = NULL;
      $bankname = NULL;
      $bankaccountId = NULL;
      $account_number = NULL;
      $account_name = NULL;
      $bank_name = NULL;
      $iban = NULL;
      $swift_code = NULL;
      $currency = NULL;
      break;
    case '3':
      $wallettypeId = $wallet->wallettype;
      $display_cc = "none";
      $display_pp = "none";
      $display_ba = "inline";
      $bankaccountId = $wallet->bankaccountId;
      $account_number = $wallet->account_number;
      $account_name = $wallet->account_name;
      $bank_name = $wallet->bank_name;
      $iban = $wallet->iban;
      $swift_code = $wallet->swift_code;
      $currency = $wallet->currency;
      $creditcardId = NULL;
      $card_type = NULL;
      $card_number = NULL;
      $card_holdername = NULL;
      $card_name = NULL;
      $card_expirymonth = NULL;
      $card_expiryyear = NULL;
      $bankname = NULL;
      $paypalId = NULL;
      $email = NULL;
      break;

    default:
      $wallettypeId = 0;
      $display_cc = "inline";
      $display_pp = "none";
      $display_ba = "none";
      $creditcardId = NULL;
      $card_number = NULL;
      $card_holdername = NULL;
      $card_name = NULL;
      $card_expiry = NULL;
      $paypalId = NULL;
      $email = NULL;
      $bankaccountId = NULL;
      $nick_name = NULL;
      $bank_name = NULL;
      $iban = NULL;
      $account_number = NULL;
      break;
  }
}else{
  $walletId = NULL;
  $wallettypeId = 0;
  $display_cc = "inline";
  $display_pp = "none";
  $display_ba = "none";
  $creditcardId = NULL;
  $card_type = NULL;
  $card_number = NULL;
  $card_holdername = NULL;
  $card_name = NULL;
  $card_expiry = NULL;
  $paypalId = NULL;
  $email = NULL;
  $bankaccountId = NULL;
  $nick_name = NULL;
  $bank_name = NULL;
  $iban = NULL;
  $account_number = NULL;
}
?>

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->
    <div class="row safari-row-flex">
        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            My Wallets
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <table class="table table-light table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Wallet type</th>
                                    <th>Account</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($wallets) {
                                    foreach ($wallets->wallets as $wallet) {
                                        switch ($wallet->wallettypeId) {
                                            case '1':
                                                $creditcard = $db->GetCreditcardByWalletId($wallet->walletId);
                                                // if (in_array($cipher, openssl_get_cipher_methods()))
                                                // {
                                                //     $ivlen = openssl_cipher_iv_length($cipher);
                                                //     $iv = "ThWmZq4t6w9z4C&F";
                                                //     $dec_card_number = openssl_decrypt($creditcard['card_number'], $cipher, $key, $options=0, $iv);
                                                // }
                                                $response = $clientKMS->decrypt($keyName, base64_decode($creditcard['card_number']));
                                                $dec_card_number = $response->getPlaintext();
                                                $cardnumber = substr($dec_card_number,0,4)."********".substr($dec_card_number,-4);
                                                $account = $cardnumber;
                                                break;
                                            case '2':
                                                $paypal = $db->GetPaypalByWalletId($wallet->walletId);
                                                $account = $paypal['email'];
                                                break;
                                            case '3':
                                                $bank = $db->GetBankByWalletId($wallet->walletId);
                                                $account = $bank['account_number'];
                                                break;
                                            default:
                                                $account = "NA";
                                                break;
                                        }
                                        echo '<tr>';
                                        echo '<td>' . $wallet->walletId . '</td>';
                                        echo '<td>' . $wallet->wallettype . '</td>';
                                        echo '<td>' . $account . '</td>';
                                        echo '<td><div class="btn-group" role="group" aria-label="First group">
		<button type="button" class="btn btn-warning" onclick="editwallet(' . $wallet->walletId . ')"><i class="la la-edit"></i></button>
		</div></td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
          <div class="kt-portlet ">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Create New Wallet
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">

											<!--begin::Accordion-->
											<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
												<div class="card">
													<div class="card-header" id="headingOne6">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
															<i class="la la-credit-card"></i> Credit/Debit Card
														</div>
													</div>
													<div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
														<div class="card-body">
                              <form class="kt-form" id="jbformcc">
                                <input type="hidden" name="creditcardId" id="creditcardId" class="form-control" value="<?php echo $creditcardId;?>">
                                <input type="hidden" name="ccwalletId" id="ccwalletId" class="form-control" value="<?php echo $walletId;?>">
                                <div class="form-group">
                                  <select class="form-control" id="temp_payment_option" name="temp_payment_option">
                                    <option value="1" <?php if($card_type==1) echo "selected";else echo "";?>>Credit Card.</option>
                                    <option value="2"<?php if($card_type==2) echo "selected";else echo "";?>>Debit Card.</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <select class="form-control" id="temp_card_name" name="temp_card_name">
                                    <option value="Visa" <?php if($card_name=="Visa") echo "selected";else echo "";?>>Visa</option>
                                    <option value="MasterCard" <?php if($card_name=="MasterCard") echo "selected";else echo "";?>>MasterCard</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="text" name="temp_card_holdername" id="temp_card_holdername" class="form-control" placeholder="Card Holder Name" value="<?php echo $card_holdername;?>">
                                </div>
                                <div class="form-group">
                                  <input type="number" name="temp_card_number" id="temp_card_number" class="form-control" placeholder="Card Number" value="<?php //echo $card_number;?>">
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <input type="number" name="temp_expiry_month" id="temp_expiry_month" class="form-control" placeholder="Exp. Month" min="1" max="12" value="<?php echo $card_expirymonth;?>">
                                    </div>
                                    <div class="col-md-6">
                                      <input type="number" name="temp_expiry_year" id="temp_expiry_year" class="form-control" placeholder="Exp. Year" max="3000" value="<?php echo $card_expiryyear;?>">
                                    </div>
                                  </div>
                                </div>
                                <!-- <div class="form-group">
                                  <input type="text" name="temp_issuing_bank" id="temp_issuing_bank" class="form-control" placeholder="Issuing bank name" value="<?php //echo $bankname;?>">
                                </div> -->
                                  <div class="kt-form__actions">
                                      <button id="btn_submitcc" name="btn_submitcc" type="submit" class="btn btn-primary">Save My Wallet</button>
                                      <button type="button" class="btn btn-secondary" onclick="javascript:location.replace(window.location.pathname)">Cancel</button>
                                  </div>
                              </form>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="card-header" id="headingTwo6">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false" aria-controls="collapseTwo6">
															<i class="la la-paypal"></i> Paypal
														</div>
													</div>
													<div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo6" data-parent="#accordionExample6">
														<div class="card-body">
                              <form class="kt-form" id="jbformpp">
                                <input type="hidden" name="paypalId" id="paypalId" class="form-control" value="<?php echo $paypalId;?>">
                                <input type="hidden" name="ppwalletId" id="ppwalletId" class="form-control" value="<?php echo $walletId;?>">
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Email</label>
                                      <input type="email" name="paypal_email" id="paypal_email" class="form-control" placeholder="Enter paypal email" value="<?php echo $email;?>">
                                  </div>
                                  <div class="kt-form__actions">
                                      <button id="btn_submitpp" name="btn_submitpp" type="submit" class="btn btn-primary">Save My Wallet</button>
                                      <button type="button" class="btn btn-secondary" onclick="javascript:location.replace(window.location.pathname)">Cancel</button>
                                  </div>
                              </form>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="card-header" id="headingThree6">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
															<i class="la la-bank"></i> Bank account
														</div>
													</div>
													<div id="collapseThree6" class="collapse" aria-labelledby="headingThree6" data-parent="#accordionExample6">
														<div class="card-body">
                              <form class="kt-form" id="jbformba">
                                <input type="hidden" name="bankaccountId" id="bankaccountId" class="form-control" value="<?php echo $bankaccountId;?>">
                                <input type="hidden" name="bawalletId" id="bawalletId" class="form-control" value="<?php echo $walletId;?>">
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Enter Account Name" value="<?php echo $account_name;?>">
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number" value="<?php echo $account_number;?>">
                                </div>
                                <div class="form-group" id="credit-card-number">
                                    <label>IBAN Number</label>
                                    <input type="text" name="iban" id="iban" class="form-control" placeholder="Enter IBAN Number" value="<?php echo $iban;?>">
                                </div>
                                <div class="form-group" id="credit-card-number">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name" value="<?php echo $bank_name;?>">
                                </div>
                                <div class="form-group" id="credit-card-number">
                                    <label>Swift Code</label>
                                    <input type="text" name="swift_code" id="swift_code" class="form-control" placeholder="Enter Swift Code" value="<?php echo $swift_code;?>">
                                </div>
                                <div class="form-group" id="credit-card-number">
                                    <label>Currency</label>
                                    <input type="text" name="currency" id="currency" class="form-control" placeholder="Enter Currency" value="<?php echo $currency;?>">
                                </div>
                                <div class="kt-form__actions">
                                    <button id="btn_submitba" name="btn_submitba" type="submit" class="btn btn-primary">Save My Wallet</button>
                                    <button type="button" class="btn btn-secondary" onclick="javascript:location.replace(window.location.pathname)">Cancel</button>
                                </div>
                              </form>
														</div>
													</div>
												</div>
											</div>

											<!--end::Accordion-->
										</div>
									</div>
        </div>

    </div>
    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
$(document).ready(function(){
  switch (<?php echo $wallettypeId;?>) {
    case 1:
      $('#collapseOne6').collapse('show');
      break;
    case 2:
      $('#collapseTwo6').collapse('show');
      break;
    case 3:
      $('#collapseThree6').collapse('show');
      break;
    default:
    $('#collapseOne6').collapse('show');
  }
  var d = new Date();
  var n = d.getFullYear();
  var expyear = document.getElementById("temp_expiry_year");
  expyear.setAttribute("min", n);
});

$('#btn_submitcc').click(function(e) {
  e.preventDefault();
  var btn = $(this);
  var form = $(this).closest('form');
  var formdata1 = new FormData($('#jbformcc')[0]);
  form.validate({
      rules: {
          temp_card_number: {
              required: true
          },
          temp_card_name: {
              required: true
          },
          temp_expiry_month: {
              required: true
          },
          temp_expiry_year: {
              required: true
          }
      }
  });

  if (!form.valid()) {
      return;
  }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    var ccnb = document.getElementById('temp_card_number').value;
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_WLT+"CON_Wallets.php?action=post-cc&userId=<?php echo $userId?>",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        switch (data['err']) {
          case 0:
            //similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              // Simulate an HTTP redirect:
               window.location.reload();
            }, 2000);
            break;
          case 1:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              showErrorMsg(form, 'danger',
                'Please try again.');
            }, 2000);
            break;
          default:
        }
      }
    });
});
$('#btn_submitpp').click(function(e) {
  e.preventDefault();
  var btn = $(this);
  var form = $(this).closest('form');
  var formdata1 = new FormData($('#jbformpp')[0]);
  form.validate({
      rules: {
          paypal_email: {
              required: true
          }
      }
  });

  if (!form.valid()) {
      return;
  }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_WLT+"CON_Wallets.php?action=post-pp&userId=<?php echo $userId?>",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        switch (data['err']) {
          case 0:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              // Simulate an HTTP redirect:
               window.location.reload();
            }, 2000);
            break;
          case 1:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              showErrorMsg(form, 'danger',
                'Please try again.');
            }, 2000);
            break;
          default:
        }
      }
    });
});
$('#btn_submitba').click(function(e) {
  e.preventDefault();
  var btn = $(this);
  var form = $(this).closest('form');
  var formdata1 = new FormData($('#jbformba')[0]);
  form.validate({
      rules: {
          account_number: {
              required: true
          },
          account_name: {
              required: true
          },
          bank_name: {
              required: true
          },
          iban: {
              required: true
          },
          swift_code: {
              required: true
          },
          currency: {
              required: true
          }
      }
  });

  if (!form.valid()) {
      return;
  }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_WLT+"CON_Wallets.php?action=post-ba&userId=<?php echo $userId?>",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        switch (data['err']) {
          case 0:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              // Simulate an HTTP redirect:
               window.location.reload();
            }, 2000);
            break;
          case 1:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              showErrorMsg(form, 'danger',
                'Please try again.');
            }, 2000);
            break;
          default:
        }
      }
    });
});
function editwallet(walletId) {
  location.href = DIR_VIEW+DIR_USR+"form_userwallets.php?walletId="+walletId;
}
</script>
