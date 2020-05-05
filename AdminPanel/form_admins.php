<?php 
//Get admin class
require_once 'libraries/Ser_Admin.php';
$db = new Ser_Admin();
$err=-1;

if(isset($_GET['adminId'])) $adminId=$_GET['adminId'];
else $adminId=0;

if($adminId>0){
    //Edit admin
    $get_admin=$db->GetAdminById($adminId);
    if($get_admin){
     $username=$get_admin['username'];
     $active=$get_admin['active'];
    }else{
        $username='';
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
            Edit Admin
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Username:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="username" id="username" value="<?php if(isset($username)) echo $username;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your username</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Password:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="password" class="form-control" placeholder="" name="password" id="password">
                    </div>
                    <span class="form-text text-muted">Please enter your password</span>
                </div>
            </div>
            <div class="form-group" id="edits">
						<label>Status</label>
							<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
								<input id="active" type="checkbox" value="1" <?php if(isset($active) && $active==1) echo "checked"; else echo '';?>> Active
								<span></span>
							</label>
						<span class="form-text text-muted">Some help text goes here</span>
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
var adminId = url.searchParams.get("adminId");
var div_edit = document.getElementById("edits");    
    if(adminId>0) div_edit.style.display = "inline";
    else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var username = $("#username").val();
            var password = $("#password").val();
            var active = $("#active").val();
            form.validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
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
                url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_admin.php",
                dataType: "json",
                data: {adminId:adminId,username:username, password:password,active:active},
                success : function(data){
                switch(data) {
                  case 0:
                    // similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                    // Simulate an HTTP redirect:
                        window.location.replace("http://localhost/JomlahBazar/AdminPanel/por_admins.php");
                    }, 2000);
                    break;
                  case 1:
                   // similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                    showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                    }, 2000);
                    break;
                  case 2:
                    // similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
	                    showErrorMsg(form, 'danger', 'Missing required parameters. Please try again.');
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