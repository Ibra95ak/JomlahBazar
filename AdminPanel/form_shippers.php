<?php 
//Get ShipperId class
require_once 'libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
$err=-1;

if(isset($_GET['ShipperId'])) $ShipperId=$_GET['ShipperId'];
else $ShipperId=0;

if($ShipperId>0){
    //Edit ShipperId
    $get_Shipper=$db->GetShipperById($ShipperId);
    if($get_ShipperId){
     $addressId=$get_ShipperId['addressId'];
     $reachoutId=$get_ShipperId['reachoutId'];
     $shipperdetailsId=$get_ShipperId['shipperdetailsId'];
     $active=$get_ShipperId['active'];
    }else{
        $addressId='';
        $reachoutId='';
        $shipperdetailsId='';
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
                    <label>addressId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="addressId" id="addressId"
                            value="<?php if(isset($addressId)) echo $addressId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your addressId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>reachoutId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="reachoutId" id="reachoutId"
                            value="<?php if(isset($reachoutId)) echo $reachoutId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your reachoutId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>shipperdetailsId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="shipperdetailsId" id="shipperdetailsId"
                            value="<?php if(isset($shipperdetailsId)) echo $shipperdetailsId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your shipperdetailsId</span>
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
var ShipperID = url.searchParams.get("ShipperID");
// var div_edit = document.getElementById("edits");
// if (Shipper > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var addressId = $("#addressId").val();
    var reachoutId = $("#reachoutId").val();
    var shipperdetailsId = $("#shipperdetailsId").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            addressId: {
                required: true
            },
            reachoutId: {
                required: true
            },
            shipperdetailsId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_Shipper.php",
        dataType: "json",
        data: {
            ShipperId: ShipperId,
            addressId: addressId,
            reachoutId: reachoutId,
            shipperdetailsId: shipperdetailsId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_shippers.php"
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