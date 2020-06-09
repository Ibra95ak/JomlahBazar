<?php
include('libraries/base.php');
session_start();
if(isset($_SESSION['adminId'])){
    //Get admin class
    require_once 'libraries/Ser_Admin.php';
    $db = new Ser_Admin();
    $checklogin= $db->islogin($_SESSION['adminId']);  
}else{
    //redirect to error page
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
if($checklogin){
/*Get settings class*/
require_once 'libraries/Ser_Settings.php';
$db = new Ser_Settings();
$err=-1;
/*Get settings data*/
$get_settings=$db->GetSettings();
if($get_settings){
    $settingsId=$get_settings[0]['settingsId'];
    $aboutus=$get_settings[0]['aboutus'];
}else{
    $settingsId='';
    $aboutus='';
}
include('header.php');
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>settingsId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="settingsId" id="settingsId" value="<?php if(isset($settingsId)) echo $settingsId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label for="exampleTextarea">About Us</label>
                    <textarea class="form-control" id="aboutus" name="aboutus" rows="3" spellcheck="false" required><?php echo $aboutus;?></textarea>
                </div>
            </div>
<!--
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Choose Picture</label>
                    <div></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path" name="path">
                        <label class="custom-file-label" for="icon">Choose file</label>
                    </div>
                </div>
            </div>
-->
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
<!-- end:: Content -->
<?php 
include("footer.php");
//end login if clause
}else{
    //redirect to error page
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
            aboutus: {
                required: true
            }
        }
    });

    if (!form.valid()) {
        return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_aboutus.php",
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
                            "http://localhost/JomlahBazar/AdminPanel/form_aboutus.php"
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