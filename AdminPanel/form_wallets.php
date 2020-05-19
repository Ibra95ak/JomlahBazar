<?php
//Get Wallet class
require_once 'libraries/Ser_Wallets.php';
require_once 'libraries/Ser_Wallettypes.php';
$db = new Ser_Wallets();
$db1 = new Ser_Wallettypes();
$err=-1;

if(isset($_GET['walletId'])) $walletId=$_GET['walletId'];
else $walletId=0;

if($walletId>0){
    //Edit wallet
    $get_wallet=$db->GetWalletById($walletId);
    if($get_wallet){
        $wallettypeId=$get_wallet['wallettypeId'];
        $active=$get_wallet['active'];
    }else{
        $wallettypeId='';
        $active='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Edit Wallet
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>walletId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="walletId" id="walletId"
                            value="<?php if(isset($walletId)) echo $walletId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                <label for="exampleSelectd">Select Wallet Type</label>
            <select class="form-control" id="wallettypeId" name="wallettypeId">
                <option value="">Choose Wallet Type</option>
                <?php
                //Get all wallets
                $get_wallettypes=$db1->GetwalletTypes();
                if($get_wallettypes){
                    foreach($get_wallettypes as $type){
                        if($wallettypeId==$type['wallettypeId']) echo "<option value='".$type['wallettypeId']."' selected>".$type['wallettype']."</option>";
                        else echo "<option value='".$type['wallettypeId']."'>".$type['wallettype']."</option>";
                    }
                }
                ?>
            </select>
                </div>
            </div>
            <div class="form-group" id="edits">
                <label>Status</label>
                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                    <input name="active" id="active" type="checkbox" <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
                    <span></span>
                </label>
                <span class="form-text text-muted">Some help text goes here</span>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        <button type="reset" class="btn btn-primary" id="btn_submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
            walletId: {
                required: true
            },
            wallettypeId: {
                required: true
            },
        }
    });

    if (!form.valid()) {
        return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_wallet.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
        success: function(data) {
            switch (data) {
                case 0:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        // Simulate an HTTP redirect:
                        window.location.replace(
                            "localhost/JomlahBazar/AdminPanel/por_wallets.php"
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
</body>
<!-- end::Body -->

</html>