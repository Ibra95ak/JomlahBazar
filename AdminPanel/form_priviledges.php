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
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
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
                    <label>c:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="c" id="c"
                            value="<?php if(isset($c)) echo $c;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your c</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>r:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="r" id="r"
                            value="<?php if(isset($r)) echo $r;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your r</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>u:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="u" id="u"
                            value="<?php if(isset($u)) echo $u;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your u</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>d:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="d" id="d"
                            value="<?php if(isset($d)) echo $d;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your d</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>extra:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="extra" id="extra"
                            value="<?php if(isset($extra)) echo $extra;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your extra</span>
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
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var priviledgeId = url.searchParams.get("priviledgeId");
// var div_edit = document.getElementById("edits");
// if (priviledgeId > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var name = $("#name").val();
    var c = $("#c").val();
    var r = $("#r").val();
    var u = $("#u").val();
    var d = $("#d").val();
    var extra = $("#extra").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            name: {
                required: true
            },
            c: {
                required: true
            },
            r: {
                required: true
            },
            u: {
                required: true
            },
            d: {
                required: true
            },
            extra: {
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
        dataType: "json",
        data: {
            priviledgeId: priviledgeId,
            name: name,
            c: c,
            r: r,
            u: u,
            d: d,
            extra: extra,
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