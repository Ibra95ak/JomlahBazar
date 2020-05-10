<?php 
//Get aaaId class
require_once 'libraries/Ser_AAA.php';
$db = new Ser_AAA();
$err=-1;

if(isset($_GET['aaaId'])) $aaaId=$_GET['aaaId'];
else $aaaId=1;

if($aaaId>0){
    //Edit aaaId
    $get_aaa=$db->getBYId_aaa($aaaId);
    if($get_aaa){
     $email=$get_aaa['email'];
     $otp=$get_aaa['otp'];
     $addressId=$get_aaa['addressId'];
    }else{
        $email='';
        $otp='';
        $addressId='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            Edit aaa
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>aaaId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="aaaId" id="aaaId"
                            value="<?php if(isset($aaaId)) echo $aaaId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="email" id="email"
                            value="<?php if(isset($email)) echo $email;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your email</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>otp:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="otp" id="otp"
                            value="<?php if(isset($otp)) echo $otp;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your otp</span>
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
var aaaId = url.searchParams.get("aaaId");
// var div_edit = document.getElementById("edits");
// if (aaa > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var email = $("#email").val();
    var otp = $("#otp").val();
    var addressId = $("#addressId").val();
    form.validate({
        rules: {
            email: {
                required: true
            },
            otp: {
                required: true
            },
            addressId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_aaa.php",
        dataType: "json",
        data: {
            aaaId: aaaId,
            email: email,
            otp: otp,
            addressId: addressId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_aaa.php"
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