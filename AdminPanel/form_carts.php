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
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>UserID:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="userId" id="userId"
                            value="<?php if(isset($userId)) echo $userId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your UserID</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>ProductID:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="productId" id="productId"
                            value="<?php if(isset($productId)) echo $productId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your ProductID</span>
                </div>
            </div>
            <div id="edits">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Created_Date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="created_date" id="created_date"
                            value="<?php if(isset($created_date)) echo $created_date;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">created_date</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Updated_Date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="updated_date" id="updated_date"
                            value="<?php if(isset($updated_date)) echo $updated_date;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">updated_date</span>
                </div>
            </div>
            </div>
            <div class="form-group">
                <label>Status</label>
                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                    <input id="active" type="checkbox" value="1"
                        <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
                    <span></span>
                </label>
                <span class="form-text text-muted">Some help text goes here</span>
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
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var cartId = url.searchParams.get("cartId");
var div_edit = document.getElementById("edits");
if (cartId > 0) div_edit.style.display = "inline";
else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var userId = $("#userId").val();
    var productId = $("#productId").val();
    var created_date = $("#created_date").val();
    var updated_date = $("#updated_date").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            userId: {
                required: true
            },
            productId: {
                required: true
            },
            created_date: {
                required: true
            },
            updated_date: {
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
        dataType: "json",
        data: {
            cartId: cartId,
            userId: userId,
            productId: productId,
            created_date: created_date,
            updated_date: updated_date,
            active: active
        },
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
                            "http://localhost/JomlahBazar/AdminPanel/por_carts.php"
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