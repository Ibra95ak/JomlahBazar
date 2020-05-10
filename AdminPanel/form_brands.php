<?php 
//Get brand class
require_once 'libraries/Ser_Brands.php';
$db = new Ser_Brands();
$err=-1;

if(isset($_GET['brandId'])) $brandId=$_GET['brandId'];
else $brandId=0;

if($brandId>0){
    //Edit brand
    $get_brand=$db->GetBrandById($brandId);
    if($get_brand){
     $brandcategoryId=$get_brand['brandcategoryId'];
     $brand_name=$get_brand['brand_name'];
     $pictureId=$get_brand['pictureId'];
     $active=$get_brand['active'];
    }else{
        $brandcategoryId='';
        $brand_name='';
        $pictureId='';
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
            Edit Brand
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>brandId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" diabled class="form-control" placeholder="" name="brandId" id="brandId"
                            value="<?php if(isset($brandId)) echo $brandId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>brandcategoryId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="brandcategoryId" id="brandcategoryId"
                            value="<?php if(isset($brandcategoryId)) echo $brandcategoryId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your brandcategoryId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>brand_name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="brand_name" id="brand_name"
                            value="<?php if(isset($brand_name)) echo $brand_name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your brand_name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>pictureId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="pictureId" id="pictureId"
                            value="<?php if(isset($pictureId)) echo $pictureId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your pictureId</span>
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
var brandId = url.searchParams.get("brandId");
// var div_edit = document.getElementById("edits");
// if (brandId > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var brandcategoryId = $("#brandcategoryId").val();
    var brand_name = $("#brand_name").val();
    var pictureId = $("#pictureId").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            brandcategoryId: {
                required: true
            },
            brand_name: {
                required: true
            },
            pictureId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_brand.php",
        dataType: "json",
        data: {
            brandId: brandId,
            brandcategoryId: brandcategoryId,
            brand_name: brand_name,
            pictureId: pictureId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_brands.php"
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