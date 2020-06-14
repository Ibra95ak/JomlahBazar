<?php 
//Get supplierId class
require_once 'libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
$err=-1;

if(isset($_GET['supplierId'])) $supplierId=$_GET['supplierId'];
else $supplierId=0;

if($supplierId>0){
    //Edit supplier
    $get_supplier=$db->GetSupplierById($supplierId);
    if($get_supplier){
     $aaaId=$get_supplier['aaaId'];
     $subscriptionplanId=$get_supplier['subscriptionplanId'];
     $discount_type=$get_supplier['discount_type'];
     $registeredsupplierId=$get_supplier['registeredsupplierId'];
     $blockId=$get_supplier['blockId'];
    }else{
        $aaaId='';
        $subscriptionplanId='';
        $discount_type='';
        $registeredsupplierId='';
        $blockId='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Manage Supplier
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>supplierId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="supplierId" id="supplierId" value="<?php if(isset($supplierId)) echo $supplierId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>aaaId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="aaaId" id="aaaId" value="<?php if(isset($aaaId)) echo $aaaId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your aaaId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>subscriptionplanId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="subscriptionplanId" id="subscriptionplanId" value="<?php if(isset($subscriptionplanId)) echo $subscriptionplanId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your subscriptionplanId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>discount_type:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="discount_type" id="discount_type" value="<?php if(isset($discount_type)) echo $discount_type;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your discount_type</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>registeredsupplierId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="registeredsupplierId" id="registeredsupplierId" value="<?php if(isset($registeredsupplierId)) echo $registeredsupplierId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your registeredsupplierId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>blockId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="blockId" id="blockId" value="<?php if(isset($blockId)) echo $blockId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your blockId</span>
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
                aaaId: {
                    required: true
                },
                subscriptionplanId: {
                    required: true
                },
                discount_type: {
                    required: true
                },
                registeredsupplierId: {
                    required: true
                },
                blockId: {
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
            url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_supplier.php",
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
                                "http://localhost/JomlahBazar/AdminPanel/por_suppliers.php"
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