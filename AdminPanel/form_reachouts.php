<?php 
//Get reachoutId class
require_once 'libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
$err=-1;

if(isset($_GET['reachoutId'])) $reachoutId=$_GET['reachoutId'];
else $reachoutId=1;

if($reachoutId>0){
    //Edit reachoutId
    $get_reachout=$db->GetReachoutById($reachoutId);
    if($get_reachout){
     $userId=$get_reachout['userId'];
     $phone=$get_reachout['phone'];
     $whatsapp=$get_reachout['whatsapp'];
     $telegram=$get_reachout['telegram'];
     $messenger=$get_reachout['messenger'];
     $skype=$get_reachout['skype'];
     $sms=$get_reachout['sms'];
    }else{
        $userId='';
        $phone='';
        $whatsapp='';
        $telegram='';
        $messenger='';
        $skype='';
        $sms='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            Edit Reachout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>reachoutId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="reachoutId" id="reachoutId"
                            value="<?php if(isset($reachoutId)) echo $reachoutId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>userId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="userId" id="userId"
                            value="<?php if(isset($userId)) echo $userId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your userId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>phone:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="phone" id="phone"
                            value="<?php if(isset($phone)) echo $phone;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your phone</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>whatsapp:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="whatsapp" id="whatsapp"
                            value="<?php if(isset($whatsapp)) echo $whatsapp;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your whatsapp</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>telegram:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="telegram" id="telegram"
                            value="<?php if(isset($telegram)) echo $telegram;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your telegram</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>messenger:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="messenger" id="messenger"
                            value="<?php if(isset($messenger)) echo $messenger;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your messenger</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>skype:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="skype" id="skype"
                            value="<?php if(isset($skype)) echo $skype;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your skype</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>sms:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="sms" id="sms"
                            value="<?php if(isset($sms)) echo $sms;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your sms</span>
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
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var reachoutId = url.searchParams.get("reachoutId");
// var div_edit = document.getElementById("edits");
// if (reachout > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var userId = $("#userId").val();
    var phone = $("#phone").val();
    var whatsapp = $("#whatsapp").val();
    var telegram = $("#telegram").val();
    var messenger = $("#messenger").val();
    var skype = $("#skype").val();
    var sms = $("#sms").val();
    form.validate({
        rules: {
            userId: {
                required: true
            },
            phone: {
                required: true
            },
            whatsapp: {
                required: true
            },
            telegram: {
                required: true
            },
            messenger: {
                required: true
            },
            skype: {
                required: true
            },
            sms: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_reachout.php",
        dataType: "json",
        data: {
            reachoutId: reachoutId,
            userId: userId,
            phone: phone,
            whatsapp: whatsapp,
            telegram: telegram,
            messenger: messenger,
            skype: skype,
            sms: sms,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_reachouts.php"
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