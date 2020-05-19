<?php
//Get Registeredsupplier class
require_once 'libraries/Ser_Registeredsuppliers.php';
$db = new Ser_Registeredsuppliers();
$err=-1;

if(isset($_GET['registeredsupplierId'])) $registeredsupplierId=$_GET['registeredsupplierId'];
else $registeredsupplierId=0;

if($registeredsupplierId>0){
    //Edit registeredsupplier
    $get_registeredsupplier=$db->GetregisteredsupplierById($registeredsupplierId);
    if($get_registeredsupplier){
     $registered_name=$get_registeredsupplier['registered_name'];
     $creditcardId=$get_registeredsupplier['creditcardId'];
    }else{
        $registered_name='';
        $creditcardId='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Manage Registeredsupplier
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>registeredsupplierId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="registeredsupplierId" id="registeredsupplierId" value="<?php if(isset($registeredsupplierId)) echo $registeredsupplierId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>registered_name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="registered_name" id="registered_name" value="<?php if(isset($registered_name)) echo $registered_name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your registered_name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>creditcardId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="creditcardId" id="creditcardId" value="<?php if(isset($creditcardId)) echo $creditcardId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your creditcardId</span>
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
                registered_name: {
                    required: true
                },
                creditcardId: {
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
            url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_registeredsupplier.php",
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
                                "localhost/JomlahBazar/AdminPanel/por_registeredsuppliers.php"
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