<?php 
//Get creditcard class
require_once 'libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
$err=-1;

if(isset($_GET['creditcardId'])) $creditcardId=$_GET['creditcardId'];
else $creditcardId=0;

if($creditcardId>0){
    //Edit creditcard
    $get_creditcard=$db->GetCreditcardById($creditcardId);
    if($get_creditcard){
     $card_number=$get_creditcard['card_number'];
     $card_expMO=$get_creditcard['card_expMO'];
     $card_expYR=$get_creditcard['card_expYR'];
    }else{
        $card_number='';
        $card_expMO='';
        $card_expYR='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            Edit Creditcard
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>creditcardId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="creditcardId" id="creditcardId" value="<?php if(isset($creditcardId)) echo $creditcardId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>walletId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="walletId" id="walletId" value="<?php if(isset($creditcardId)) echo $creditcardId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>card_number:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="card_number" id="card_number"
                            value="<?php if(isset($card_number)) echo $card_number;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your card_number</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>card_expMO:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="card_expMO" id="card_expMO"
                            value="<?php if(isset($card_expMO)) echo $card_expMO;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your card_expMO</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>card_expYR:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="card_expYR" id="card_expYR"
                            value="<?php if(isset($card_expYR)) echo $card_expYR;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your card_expYR</span>
                </div>
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
            card_number: {
                required: true
            },
            card_expMO: {
                required: true
            },
            card_expYR: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_creditcard.php",
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
                        window.location.replace("http://localhost/JomlahBazar/AdminPanel/por_creditcard.php");
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