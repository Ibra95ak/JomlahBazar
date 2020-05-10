<?php 
//Get category class
require_once 'libraries/Ser_Categories.php';
$db = new Ser_Categories();
$err=-1;

if(isset($_GET['categoryId'])) $categoryId=$_GET['categoryId'];
else $categoryId=0;

if($categoryId>0){
    //Edit category
    $get_category=$db->GetCategoryById($categoryId);
    if($get_category){
     $name=$get_category['name'];
     $icon=$get_category['icon'];
     $active=$get_category['active'];
    }else{
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
            Edit Category
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" enctype="multipart/form-data">
        <div class="kt-portlet__body">
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
						<label>Choose Icon</label>
						<div></div>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="icon" name="icon">
							<label class="custom-file-label" for="icon">Choose file</label>
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
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var categoryId = url.searchParams.get("categoryId");
// var div_edit = document.getElementById("edits");
// if (categoryId > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var name = $("#name").val();
    var fakeicon = $("#icon").val();
    var icon = fakeicon.substr(12);
    var active = $("#active").val();
    alert(icon);
    var formData = new FormData($(this)[0]);
    form.validate({
        rules: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_category.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        data: {
            categoryId: categoryId,
            name: name,
            icon: data,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_Categories.php"
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