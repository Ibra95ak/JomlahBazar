<?php 
//Get productdetailId class
require_once 'libraries/Ser_Productdetails.php';
$db = new Ser_Productdetails();
$err=-1;

if(isset($_GET['productdetailId'])) $productdetailId=$_GET['productdetailId'];
else $productdetailId=0;

if($productdetailId>0){
    //Edit productdetailId
    $get_productdetail=$db->GetproductdetailById($productdetailId);
    if($get_productdetail){
     $description=$get_productdetail['description'];
     $size=$get_productdetail['size'];
     $color=$get_productdetail['color'];
     $weight=$get_productdetail['weight'];
     $barcode=$get_productdetail['barcode'];
    }else{
        $description='';
        $size='';
        $color='';
        $weight='';
        $barcode='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            Edit Productdetail
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>productdetailId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="productdetailId" id="productdetailId"
                            value="<?php if(isset($productdetailId)) echo $productdetailId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>description:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="description" id="description"
                            value="<?php if(isset($description)) echo $description;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your description</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>size:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="size" id="size"
                            value="<?php if(isset($size)) echo $size;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your size</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>color:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="color" id="color"
                            value="<?php if(isset($color)) echo $color;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your color</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>weight:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="weight" id="weight"
                            value="<?php if(isset($weight)) echo $weight;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your weight</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>barcode:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="barcode" id="barcode"
                            value="<?php if(isset($barcode)) echo $barcode;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your barcode</span>
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
var productdetailId = url.searchParams.get("productdetailId");
// var div_edit = document.getElementById("edits");
// if (productdetail > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var description = $("#description").val();
    var size = $("#size").val();
    var color = $("#color").val();
    var weight = $("#weight").val();
    var barcode = $("#barcode").val();
    form.validate({
        rules: {
            description: {
                required: true
            },
            size: {
                required: true
            },
            color: {
                required: true
            },
            weight: {
                required: true
            },
            barcode: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_productdetail.php",
        dataType: "json",
        data: {
            productdetailId: productdetailId,
            description: description,
            size: size,
            color: color,
            weight: weight,
            barcode: barcode,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_productdetails.php"
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