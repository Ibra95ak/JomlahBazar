<?php
//Get cart class
require_once 'libraries/Ser_Carts.php';
$db = new Ser_Carts();
$err=-1;

if(isset($_GET['cartId'])) $cartId=$_GET['cartId'];
else $cartId=0;

if($cartId>0){
    //Edit cart
    $get_cart=$db->GetCartById($cartId);
    if($get_cart){
     $userId=$get_cart['userId'];
     $productId=$get_cart['productId'];
     $created_date=$get_cart['created_date'];
     $updated_date=$get_cart['updated_date'];
     $active=$get_cart['active'];
    }else{
        $userId='';
        $productId='';
        $created_date='';
        $updated_date='';
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
                cart
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>cartId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-cart"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="cartId" id="cartId"
                            value="<?php if(isset($cartId)) echo $cartId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your cartId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>userId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="userId" id="userId"
                            value="<?php if(isset($userId)) echo $userId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your userId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>productId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="productId" id="productId"
                            value="<?php if(isset($productId)) echo $productId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your productId</span>
                </div>
            </div>       
        <div class="form-group" id="edits">
            <label>Status</label>
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="active" id="active" type="checkbox" value="1"
                    <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
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
            userId: {
                required: true
            },
            productId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_cart.php",
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
                            "localhost/JomlahBazar/AdminPanel/por_Carts.php"
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