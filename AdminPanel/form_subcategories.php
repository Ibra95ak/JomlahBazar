<?php
//Get Subcategorie class
require_once 'libraries/Ser_Subcategories.php';
require_once 'libraries/Ser_Categories.php';
$db = new Ser_Subcategories();
$db1 = new Ser_Categories();
$err=-1;

if(isset($_GET['subcategoryId'])) $subcategoryId=$_GET['subcategoryId'];
else $subcategoryId=0;

if($subcategoryId>0){
    //Edit subcategory
    $get_subcategory=$db->GetSubcategoryById($subcategoryId);
    if($get_subcategory){
     $categoryId=$get_subcategory['categoryId'];
     $name=$get_subcategory['name'];
     $icon=$get_subcategory['icon'];
     $active=$get_subcategory['active'];
    }else{
        $categoryId='';
        $name='';
        $icon='';
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
                Edit Subcategories
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-lg-4">
            <label for="exampleSelectd">Default Select</label>
            <select class="form-control" id="categoryId" name="categoryId">
<?php
//Get all categories
$get_category=$db1->GetCategories();
if($get_category){
    foreach($get_category as $cat){
        echo "<option value='".$cat['categoryId']."'>".$cat['name']."</option>";
    }
}
?>
            </select>
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
                    <label>icon:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="icon" id="icon"
                            value="<?php if(isset($icon)) echo $icon;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your icon</span>
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
var subcategoryId = url.searchParams.get("subcategoryId");
var div_edit = document.getElementById("edits");
if (subcategoryId > 0) div_edit.style.display = "inline";
else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var categoryId = $("#categoryId").val();
    var name = $("#name").val();
    var icon = $("#icon").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            categoryId: {
                required: true
            },
            name: {
                required: true
            },
            icon: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_subcategory.php",
        dataType: "json",
        data: {
            subcategoryId: subcategoryId,
            categoryId: categoryId,
            name: name,
            icon: icon,
            active: active,
        },
        success: function(data) {
            alert(data);
            switch (data) {
                case 0:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        // Simulate an HTTP redirect:
                        window.location.replace(
                            "http://localhost/JomlahBazar/AdminPanel/por_subcategories.php"
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