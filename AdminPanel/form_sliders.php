<?php
/*get sliders class*/
require_once 'libraries/Ser_Sliders.php';
/*create sliders instance*/
$db = new Ser_Sliders();
/*initialize error flag*/
$err=-1;
/*fetch sliderId from url*/
if (isset($_GET['sliderId'])) {
    $sliderId=$_GET['sliderId'];
} else {
    $sliderId=0;
}
if ($sliderId>0) {
    /*Edit slider*/
    $get_slider=$db->GetSliderById($sliderId);
    if ($get_slider) {
        $header1=$get_slider['header1'];
        $header2=$get_slider['header2'];
        $path=$get_slider['path'];
        $btn_link=$get_slider['btn_link'];
        $btn_text=$get_slider['btn_text'];
        $active=$get_slider['active'];
    } else {
        $header1='';
        $header2='';
        $path='';
        $btn_link='';
        $btn_text='';
        $active='';
    }
}
/*get page header*/
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            Manage Slider
            </h3>
        </div>
    </div>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Slider Id:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" readonly class="form-control" name="sliderId" id="sliderId" value="<?php if(isset($sliderId)){echo $sliderId;}else{echo '';}?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Header 1:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" name="header1" id="header1" value="<?php if(isset($header1)) {echo $header1;}else{echo '';}?>">
                    </div>
                    <span class="form-text text-muted">Please enter slide header 1</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Header 2:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" name="header2" id="header2" value="<?php if(isset($header2)) {echo $header2;}else{echo '';}?>">
                    </div>
                    <span class="form-text text-muted">Please enter slide header 2</span>
                </div>
            </div>
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
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Button Link:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" name="btn_link" id="btn_link" value="<?php if(isset($btn_link)) {echo $btn_link;}else{echo '';}?>">
                    </div>
                    <span class="form-text text-muted">Please enter slider link</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Button Text:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" name="btn_text" id="btn_text" value="<?php if(isset($btn_text)) {echo $btn_text;}else{echo '';}?>">
                    </div>
                    <span class="form-text text-muted">Please enter slider text</span>
                </div>
            </div>
        <div class="form-group" id="edits">
            <label>Status</label>
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="active" id="active" type="checkbox" <?php if (isset($active) && $active==1) {echo "checked";}else{echo '';}?>> Active
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
<?php
/*get page footer*/
include("footer.php");
?>
<script>
/*submit form*/
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
            header1: {
                required: true
            },
            header2: {
                required: true
            },
            btn_link: {
                required: true
            },
            btn_text: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_slider.php",
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
                            "http://localhost/JomlahBazar/AdminPanel/por_sliders.php"
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
