<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	switch ($_SESSION['Login_as']) {
		case 1:
			include("../".DIR_CON."header_buyer.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_seller_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;

		default:
			include("../".DIR_CON."header_buyer.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$user = json_decode($res_user->getBody());
if ($user->reachout) {
    $reachoutId = $user->reachout[0]->reachoutId;
    $phone = $user->reachout[0]->phone;
    $whatsapp = $user->reachout[0]->whatsapp;
    $telegram = $user->reachout[0]->telegram;
    $messenger = $user->reachout[0]->messenger;
    $linkedin = $user->reachout[0]->linkedin;
    $sms = $user->reachout[0]->sms;
} else {
    $reachoutId = '';
    $phone = '';
    $whatsapp = '';
    $telegram = '';
    $messenger = '';
    $linkedin = '';
    $sms = '';
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
  <div class="row">
    <div class="col-md-6">
      <div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Social Accounts
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form" id="jbform">
											<div class="kt-portlet__body">
												<div class="kt-section kt-section--first kt-m0">
                          <input type="hidden" class="form-control" name="reachoutId" id="reachoutId" value="<?php echo $reachoutId?>">
                          <div class="row">
                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="socicon-viber"></i></span></div>
                                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" aria-describedby="basic-addon1" value="<?php echo $phone?>">
                                </div>
                                </div>
                              </div>

                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="socicon-whatsapp"></i></span></div>
                                  <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Whatsapp" aria-describedby="basic-addon1" value="<?php echo $whatsapp?>">
                                </div>
                              </div>
                          </div>
                          </div>
                          <div class="row">

                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="socicon-telegram"></i></span></div>
                                  <input type="text" class="form-control" name="telegram" id="telegram" placeholder="Telegram" aria-describedby="basic-addon1" value="<?php echo $telegram?>">
                                </div>
                              </div>
                            </div>

                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-facebook-messenger"></i></span></div>
                                  <input type="text" class="form-control" name="messenger" id="messenger" placeholder="Messenger" aria-describedby="basic-addon1" value="<?php echo $messenger?>">
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="row">

                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="socicon-linkedin"></i></span></div>
                                  <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="linkedin" aria-describedby="basic-addon1" value="<?php echo $linkedin?>">
                                </div>
                              </div>
                            </div>

                            <div class="col-xl-6">
                              <div class="form-group ">
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sms"></i></span></div>
                                  <input type="text" class="form-control" name="sms" id="sms" placeholder="SMS" aria-describedby="basic-addon1" value="<?php echo $sms?>">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-warning" id="btn_submit">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
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
<script>

$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_USR+"CON_seller_profile.php?action=post-socials",
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
                        //Simulate an HTTP redirect:
                        window.location.replace(
                            DIR_VIEW+DIR_BRND+"dt_brands.php"
                        );
                    }, 2000);
                    break;
                case 1:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        showErrorMsg(form, 'danger',
                            'Incorrect username or password. Please try again.');
                    }, 2000);
                    break;
                case 2:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        showErrorMsg(form, 'danger',
                            'Missing required parameters. Please try again.');
                    }, 2000);
                    break;
                default:
            }
        }
    });
});
</script>
