<?php 
//Get userId class
require_once 'libraries/Ser_Buyers.php';
$db = new Ser_Buyers();
$err=-1;

if(isset($_GET['userId'])) $userId=$_GET['userId'];
else $userId=0;

if($userId>0){
    //Edit userId
    $get_user=$db->GetBuyerById($userId);
    if($get_user){
     $aaaId=$get_user['aaaId'];
     $first_name=$get_user['first_name'];
     $last_name=$get_user['last_name'];
     $addressId=$get_user['addressId'];
     $reachoutId=$get_user['reachoutId'];
     $walletId=$get_user['walletId'];
     $identityId=$get_user['identityId'];
     $blockId=$get_user['blockId'];
    }else{
        $aaaId='';
        $first_name='';
        $last_name='';
        $addressId='';
        $reachoutId='';
        $walletId='';
        $identityId='';
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
            Edit user
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
                        <input type="text" disabled class="form-control" placeholder="" name="userId" id="userId"
                            value="<?php if(isset($userId)) echo $userId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>aaaId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="aaaId" id="aaaId"
                            value="<?php if(isset($aaaId)) echo $aaaId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your aaaId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>first_name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="first_name" id="first_name"
                            value="<?php if(isset($first_name)) echo $first_name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your first_name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>last_name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="last_name" id="last_name"
                            value="<?php if(isset($last_name)) echo $last_name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your last_name</span>
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
                    <label>walletId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="walletId" id="walletId"
                            value="<?php if(isset($walletId)) echo $walletId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your walletId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>identityId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="identityId" id="identityId"
                            value="<?php if(isset($identityId)) echo $identityId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your identityId</span>
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
var userId = url.searchParams.get("userId");
// var div_edit = document.getElementById("edits");
// if (user > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var aaaId = $("#aaaId").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var addressId = $("#addressId").val();
    var reachoutId = $("#reachoutId").val();
    var walletId = $("#walletId").val();
    var identityId = $("#identityId").val();
    var blockId = $("#blockId").val();
    form.validate({
        rules: {
            aaaId: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            addressId: {
                required: true
            },
            reachoutId: {
                required: true
            },
            walletId: {
                required: true
            },
            identityId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_buyer.php",
        dataType: "json",
        data: {
            userId: userId,
            aaaId: aaaId,
            first_name: first_name,
            last_name: last_name,
            addressId: addressId,
            reachoutId: reachoutId,
            walletId: walletId,
            identityId: identityId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_buyers.php"
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