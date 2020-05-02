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
     $orderId=$get_supplier['orderId'];
     $discount_type=$get_supplier['discount_type'];
     $categoryId=$get_supplier['categoryId'];
     $subplanId=$get_supplier['subplanId'];
     $storeId=$get_supplier['storeId'];
     $registered_supId=$get_supplier['registered_supId'];
     $blockId=$get_supplier['blockId'];
    }else{
        $orderId='';
        $discount_type='';
        $categoryId='';
        $subplanId='';
        $storeId='';
        $registered_supId='';
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
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>orderId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="orderId" id="orderId"
                            value="<?php if(isset($orderId)) echo $orderId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your orderId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>discount_type:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="discount_type" id="discount_type"
                            value="<?php if(isset($discount_type)) echo $discount_type;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your discount_type</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>categoryId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="categoryId" id="categoryId"
                            value="<?php if(isset($categoryId)) echo $categoryId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your categoryId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>subplanId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="subplanId" id="subplanId"
                            value="<?php if(isset($subplanId)) echo $subplanId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your subplanId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>storeId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="storeId" id="storeId"
                            value="<?php if(isset($storeId)) echo $storeId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your storeId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>registered_supId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="registered_supId" id="registered_supId"
                            value="<?php if(isset($registered_supId)) echo $registered_supId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your registered_supId</span>
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
var supplierID = url.searchParams.get("supplierID");
// var div_edit = document.getElementById("edits");
// if (supplier > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var orderId = $("#orderId").val();
    var discount_type = $("#discount_type").val();
    var categoryId = $("#categoryId").val();
    var subplanId = $("#subplanId").val();
    var storeId = $("#storeId").val();
    var registered_supId = $("#registered_supId").val();
    var blockId = $("#blockId").val();
    form.validate({
        rules: {
            orderId: {
                required: true
            },
            discount_type: {
                required: true
            },
            categoryId: {
                required: true
            },
            subplanId: {
                required: true
            },
            storeId: {
                required: true
            },
            registered_supId: {
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
        dataType: "json",
        data: {
            supplierId: supplierId,
            orderId: orderId,
            discount_type: discount_type,
            categoryId: categoryId,
            subplanId: subplanId,
            storeId: storeId,
            registered_supId: registered_supId,
            blockId: blockId,
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