<?php
//Get Wishlist class
require_once 'libraries/Ser_Wishlists.php';
require_once 'libraries/Ser_Buyers.php';
require_once 'libraries/Ser_Products.php';
$db = new Ser_Wishlists();
$db1 = new Ser_Buyers();
$db2 = new Ser_Products();
$err=-1;

if(isset($_GET['wishlistId'])) $wishlistId=$_GET['wishlistId'];
else $wishlistId=0;

if($wishlistId>0){
    //Edit wishlist
    $get_wishlist=$db->GetWishlistById($wishlistId);
    if($get_wishlist){
     $userId=$get_wishlist['userId'];
     $productId=$get_wishlist['productId'];
     $active=$get_wishlist['active'];
    }else{
        $userId='';
        $productId='';
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
                Edit Wishlist
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>wishlistId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="wishlistId" id="wishlistId"
                            value="<?php if(isset($wishlistId)) echo $wishlistId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                <label for="exampleSelectd">Select User</label>
            <select class="form-control" id="userId" name="userId">
                <?php
                //Get all categories
                $get_User=$db1->GetBuyers();
                if($get_User){
                    foreach($get_User as $cat){
                        echo "<option value='".$cat['userId']."'>".$cat['first_name']."</option>";
                    }
                }
                ?>
            </select>
                    <span class="form-text text-muted">Please enter your user</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                <label for="exampleSelectd">Select Product</label>
            <select class="form-control" id="productId" name="productId">
                <?php
                //Get all categories
                $get_product=$db2->GetProducts();
                if($get_product){
                    foreach($get_product as $cat){
                        echo "<option value='".$cat['productId']."'>".$cat['name']."</option>";
                    }
                }
                ?>
            </select>
                    <span class="form-text text-muted">Please enter your product</span>
                </div>
            </div>       
             <div class="form-group" id="edits">
            <label>Status</label>
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input id="active" type="checkbox" value="1"
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
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var wishlistId = url.searchParams.get("wishlistId");
// var div_edit = document.getElementById("edits");
// if (wishlistId > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var userId = $("#userId").val();
    var productId = $("#productId").val();
    var active = $("#active").val();
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_wishlist.php",
        dataType: "json",
        data: {
            wishlistId: wishlistId,
            userId: userId,
            productId: productId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_Wishlists.php"
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