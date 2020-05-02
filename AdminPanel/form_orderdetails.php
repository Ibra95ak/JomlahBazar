<?php 
//Get orderdetailid class
require_once 'libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
$err=-1;

if(isset($_GET['orderdetailid'])) $orderdetailid=$_GET['orderdetailid'];
else $orderdetailid=0;

if($orderdetailid>0){
    //Edit orderdetailid
    $get_orderdetail=$db->GetOrderdetailById($orderdetailid);
    if($get_orderdetail){
        print_r($get_orderdetail);
     $orderId=$get_orderdetail['orderId'];
     $ordernumber=$get_orderdetail['ordernumber'];
     $discount=$get_orderdetail['discount'];
     $totalprice=$get_orderdetail['totalprice'];
     $productdetailsId=$get_orderdetail['productdetailsId'];
     $shipperId=$get_orderdetail['shipperId'];
     $ship_date=$get_orderdetail['ship_date'];
     $statusId=$get_orderdetail['statusId'];
     $blockId=$get_orderdetail['blockId'];
     $active=$get_orderdetail['active'];
    }else{
        $orderId='';
        $ordernumber='';
        $discount='';
        $totalprice='';
        $productdetailsId='';
        $shipperId='';
        $ship_date='';
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
                    <label>totalprice:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="totalprice" id="totalprice"
                            value="<?php if(isset($totalprice)) echo $totalprice;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your totalprice</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>productdetailsId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="productdetailsId" id="productdetailsId"
                            value="<?php if(isset($productdetailsId)) echo $productdetailsId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your productdetailsId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>shipperId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="shipperId" id="shipperId"
                            value="<?php if(isset($shipperId)) echo $shipperId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your shipperId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>ship_date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="ship_date" id="ship_date"
                            value="<?php if(isset($ship_date)) echo $ship_date;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your ship_date</span>
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
var orderdetailid = url.searchParams.get("orderdetailid");
// var div_edit = document.getElementById("edits");
// if (orderdetail > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var orderId = $("#orderId").val();
    var ordernumber = $("#ordernumber").val();
    var discount = $("#discount").val();
    var totalprice = $("#totalprice").val();
    var productdetailsId = $("#productdetailsId").val();
    var shipperId = $("#shipperId").val();
    var ship_date = $("#ship_date").val();
    var statusId = $("#statusId").val();
    var blockId = $("#blockId").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            orderId: {
                required: true
            },
            ordernumber: {
                required: true
            },
            discount: {
                required: true
            },
            totalprice: {
                required: true
            },
            productdetailsId: {
                required: true
            },
            shipperId: {
                required: true
            },
            ship_date: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_orderdetail.php",
        dataType: "json",
        data: {
            orderdetailid: orderdetailid,
            orderId: orderId,
            ordernumber: ordernumber,
            discount: discount,
            totalprice: totalprice,
            productdetailsId: productdetailsId,
            shipperId: shipperId,
            ship_date: ship_date,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_orderdetails.php"
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