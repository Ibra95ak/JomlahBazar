<?php 
//Get order class
require_once 'libraries/Ser_Orders.php';
$db = new Ser_Orders();
$err=-1;

if(isset($_GET['orderId'])) $orderId=$_GET['orderId'];
else $orderId=0;

if($orderId>0){
    //Edit order
    $get_order=$db->GetOrderById($orderId);
    if($get_order){
$userId=$get_orderdetailId['userId'];
$productId=$get_orderdetailId['productId'];
$supplierId=$get_orderdetailId['supplierId'];
$ordernumber=$get_orderdetailId['ordernumber'];
$puchaseId=$get_orderdetailId['puchaseId'];
$order_date=$get_orderdetailId['order_date'];
$statusId=$get_orderdetailId['statusId'];
$blockId=$get_orderdetailId['blockId'];
$active=$get_orderdetailId['active'];
    }else{
        
        $userId='';
        $productId='';
        $supplierId='';
        $ordernumber='';
        $puchaseId='';
        $order_date='';
        $statusId='';
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
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
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
                    <label>ordernumber:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="ordernumber" id="ordernumber"
                            value="<?php if(isset($ordernumber)) echo $ordernumber;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your ordernumber</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>puchaseId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="puchaseId" id="puchaseId"
                            value="<?php if(isset($puchaseId)) echo $puchaseId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your puchaseId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>order_date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="order_date" id="order_date"
                            value="<?php if(isset($order_date)) echo $order_date;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your order_date</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>statusId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="statusId" id="statusId"
                            value="<?php if(isset($statusId)) echo $statusId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your statusId</span>
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
var orderId = url.searchParams.get("orderId");
// var div_edit = document.getElementById("edits");
// if (orderId > 0) div_edit.style.display = "inline";
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
    var supplierId = $("#supplierId").val();
    var ordernumber = $("#ordernumber").val();
    var puchaseId = $("#puchaseId").val();
    var order_date = $("#order_date").val();
    var shipperId = $("#shipperId").val();
    var statusId = $("#statusId").val();
    var blockId = $("#blockId").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            userId: {
                required: true
            },
            productId: {
                required: true
            },
            supplierId: {
                required: true
            },
            ordernumber: {
                required: true
            },
            puchaseId: {
                required: true
            },
            order_date: {
                required: true
            },
            shipperId: {
                required: true
            },
            statusId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_order.php",
        dataType: "json",
        data: {
            orderId: orderId,
            userId: userId,
            productId: productId,
            supplierId: supplierId,
            ordernumber: ordernumber,
            puchaseId: puchaseId,
            order_date: order_date,
            shipperId: shipperId,
            statusId: statusId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_orders.php"
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