<?php 
//Get productId class
require_once 'libraries/Ser_Products.php';
$db = new Ser_Products();
$err=-1;

if(isset($_GET['productId'])) $productId=$_GET['productId'];
else $productId=0;

if($productId>0){
    //Edit productId
    $get_productId=$db->GetProductById($productId);
    if($get_productId){
     $supplierId=$get_productId['supplierId'];
     $productdetailId=$get_productId['productdetailId'];
     $inventoryId=$get_productId['inventoryId'];
     $name=$get_productId['name'];
     $quantity=$get_productId['quantity'];
     $min_order=$get_productId['min_order'];
     $unitprice=$get_productId['unitprice'];
     $discount=$get_productId['discount'];
     $ranking=$get_productId['ranking'];
     $brandId=$get_productId['brandId'];
     $blockId=$get_productId['blockId'];
     $active=$get_productId['active'];
    }else{
        $supplierId='';
        $productdetailId='';
        $inventoryId='';
        $name='';
        $quantity='';
        $min_order='';
        $unitprice='';
        $discount='';
        $ranking='';
        $brandId='';
        $blockId='';
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
            Edit Product
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>productId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="productId" id="productId"
                            value="<?php if(isset($productId)) echo $productId;else echo '';?>">
                    </div>
                </div>
            </div>
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>supplierId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="supplierId" id="supplierId"
                            value="<?php if(isset($supplierId)) echo $supplierId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your supplierId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>productdetailId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="productdetailId" id="productdetailId"
                            value="<?php if(isset($productdetailId)) echo $productdetailId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your productdetailId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>inventoryId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="inventoryId" id="inventoryId"
                            value="<?php if(isset($inventoryId)) echo $inventoryId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your inventoryId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="name" id="name"
                            value="<?php if(isset($name)) echo $name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your name</span>
                </div>
                </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>quantity:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="quantity" id="quantity"
                            value="<?php if(isset($quantity)) echo $quantity;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your quantity</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>min_order:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="min_order" id="min_order"
                            value="<?php if(isset($min_order)) echo $min_order;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your min_order</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>unitprice:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="unitprice" id="unitprice"
                            value="<?php if(isset($unitprice)) echo $unitprice;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your unitprice</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>discount:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="discount" id="discount"
                            value="<?php if(isset($discount)) echo $discount;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your discount</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>ranking:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="ranking" id="ranking"
                            value="<?php if(isset($ranking)) echo $ranking;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your ranking</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>brandId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="brandId" id="brandId"
                            value="<?php if(isset($brandId)) echo $brandId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your brandId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>blockId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="blockId" id="blockId"
                            value="<?php if(isset($blockId)) echo $blockId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your blockId</span>
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
var productId = url.searchParams.get("productId");
// var div_edit = document.getElementById("edits");
// if (product > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var supplierId = $("#supplierId").val();
    var productdetailId = $("#productdetailId").val();
    var inventoryId = $("#inventoryId").val();
    var name = $("#name").val();
    var quantity = $("#quantity").val();
    var min_order = $("#min_order").val();
    var unitprice = $("#unitprice").val();
    var discount = $("#discount").val();
    var ranking = $("#ranking").val();
    var brandId = $("#brandId").val();
    var blockId = $("#blockId").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            supplierId: {
                required: true
            },
            productdetailId: {
                required: true
            },
            inventoryId: {
                required: true
            },
            name: {
                required: true
            },
            quantity: {
                required: true
            },
            min_order: {
                required: true
            },
            unitprice: {
                required: true
            },
            discount: {
                required: true
            },
            ranking: {
                required: true
            },
            brandId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_product.php",
        dataType: "json",
        data: {
            productId: productId,
            supplierId: supplierId,
            productdetailId: productdetailId,
            inventoryId: inventoryId,
            name: name,
            quantity: quantity,
            min_order: min_order,
            unitprice: unitprice,
            discount: discount,
            ranking: ranking,
            brandId: brandId,
            blockId: blockId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_products.php"
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