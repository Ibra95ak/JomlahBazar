<?php 
//Get adminpriviledge class
require_once 'libraries/Ser_Adminpriviledges.php';
$db = new Ser_Adminpriviledges();
$err=-1;

if(isset($_GET['adminpriviledgeId'])) $adminpriviledgeId=$_GET['adminpriviledgeId'];
else $adminpriviledgeId=0;
if($adminpriviledgeId>0){
    //Edit adminpriviledge adminId priviledgeId

    $get_adminpriviledge=$db->GetAdminpriviledgeById($adminpriviledgeId);
    if($get_adminpriviledge){
     $adminId=$get_adminpriviledge['adminId'];
     $priviledgeId=$get_adminpriviledge['priviledgeId'];
    }else{
        $adminId='';
        $priviledgeId='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>AdminId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="adminId" id="adminId"
                            value="<?php if(isset($adminId)) echo $adminId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your adminId</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>PrivilidgeID:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="priviledgeId" id="priviledgeId"
                            value="<?php if(isset($priviledgeId)) echo $priviledgeId;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your priviledgeId</span>
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
var adminpriviledgeId = url.searchParams.get("adminpriviledgeId");
// var div_edit = document.getElementById("edits");
// if (adminpriviledge > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var adminId = $("#adminId").val();
    var priviledgeId = $("#priviledgeId").val();
    form.validate({
        rules: {
            adminId: {
                required: true
            },
            priviledgeId: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_adminpriviledge.php",
        dataType: "json",
        data: {
            adminpriviledgeId: adminpriviledgeId,
            adminId: adminId,
            priviledgeId: priviledgeId,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_adminpriviledge.php"
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