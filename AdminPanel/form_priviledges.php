<?php 
//Get priviledge class
require_once 'libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
$err=-1;

if(isset($_GET['priviledgeId'])) $priviledgeId=$_GET['priviledgeId'];
else $priviledgeId=0;

if($priviledgeId>0){
    //Edit priviledge
    $get_priviledge=$db->GetPriviledgeById($priviledgeId);
    if($get_priviledge){
$name=$get_priviledge['name'];
$c=$get_priviledge['c'];
$r=$get_priviledge['r'];
$u=$get_priviledge['u'];
$d=$get_priviledge['d'];
$extra=$get_priviledge['extra'];
$active=$get_priviledge['active'];
    }else{
        
        $name='';
        $c='';
        $r='';
        $u='';
        $d='';
        $extra='';
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
            Edit Priviledge
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="jbform">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>priviledgeId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="priviledgeId" id="priviledgeId" value="<?php if(isset($priviledgeId)) echo $priviledgeId;else echo '';?>">
                    </div>
                </div>
            </div>
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="name" id="name" value="<?php if(isset($name)) echo $name;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>c:</label>
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="c" id="c" type="checkbox" <?php if(isset($c) && $c==1) echo "checked"; else echo '';?>> Create
                <span></span>
            </label>
                    <span class="form-text text-muted">Create</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>r:</label>
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="r" id="r" type="checkbox" <?php if(isset($r) && $r==1) echo "checked"; else echo '';?>> Read
                <span></span>
            </label>
                    <span class="form-text text-muted">Read</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>u:</label>
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="u" id="u" type="checkbox" <?php if(isset($u) && $u==1) echo "checked"; else echo '';?>> Update
                <span></span>
            </label>
                    <span class="form-text text-muted">Update</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>d:</label>
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="d" id="d" type="checkbox" <?php if(isset($d) && $d==1) echo "checked"; else echo '';?>> Delete
                <span></span>
            </label>
                    <span class="form-text text-muted">Delete</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>extra:</label>
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="extra" id="extra" type="checkbox" <?php if(isset($extra) && $extra==1) echo "checked"; else echo '';?>> Extra
                <span></span>
            </label>
                    <span class="form-text text-muted">Please enter your extra</span>
                </div>
            </div>
        
        <div class="form-group">
            <label>Status</label>
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input name="active" id="active" type="checkbox" <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
                <span></span>
            </label>
            <span class="form-text text-muted">Activate</span>
        </div></div>
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
            name: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_priviledge.php",
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
                            "http://localhost/JomlahBazar/AdminPanel/por_priviledges.php"
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