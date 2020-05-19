<?php 
//Get storeId class
require_once 'libraries/Ser_Stores.php';
$db = new Ser_Stores();
$err=-1;

if(isset($_GET['storeId'])) $storeId=$_GET['storeId'];
else $storeId=0;

if($storeId>0){
    //Edit storeId
    $get_store=$db->GetStoreById($storeId);
    if($get_store){
     $supplierId=$get_store['supplierId'];
     $addressId=$get_store['addressId'];
     $reachoutId=$get_store['reachoutId'];
     $name=$get_store['name'];
     $description=$get_store['description'];
     $theme=$get_store['theme'];
     $blockId=$get_store['blockId'];
     $active=$get_store['active'];
    }else{
        $supplierId='';
        $addressId='';
        $reachoutId='';
        $name='';
        $description='';
        $theme='';
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
            Edit  Stores
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>storeId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="storeId" id="storeId"
                            value="<?php if(isset($storeId)) echo $storeId;else echo '';?>">
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
                    <label>theme:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="theme" id="theme"
                            value="<?php if(isset($theme)) echo $theme;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your theme</span>
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
                    <input name="active" id="active" type="checkbox" <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
                    <span></span>
                </label>
                <span class="form-text text-muted">Activate</span>
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
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
            supplierId: {
                required: true
            },
            addressId: {
                required: true
            },
            reachoutId: {
                required: true
            },
            name: {
                required: true
            },
            description: {
                required: true
            },
            theme: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_store.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
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
                            "localhost/JomlahBazar/AdminPanel/por_stores.php"
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