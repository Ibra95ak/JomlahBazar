<?php
//Get Faq class
require_once 'libraries/Ser_Faqs.php';
$db = new Ser_Faqs();
$err=-1;

if(isset($_GET['faqId'])) $faqId=$_GET['faqId'];
else $faqId=0;

if($faqId>0){
    //Edit faq
    $get_faq=$db->GetFaqById($faqId);
    if($get_faq){
     $question=$get_faq['question'];
     $answer=$get_faq['answer'];
     $position=$get_faq['position'];
     $active=$get_faq['active'];
    }else{
        $question='';
        $answer='';
        $position='';
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
            Edit Faq
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
        <div class="form-group row">
                <div class="col-lg-4">
                    <label>faqId:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" disabled class="form-control" placeholder="" name="faqId" id="faqId"
                            value="<?php if(isset($faqId)) echo $faqId;else echo '';?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>question:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="question" id="question"
                            value="<?php if(isset($question)) echo $question;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your question</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>answer:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="answer" id="answer"
                            value="<?php if(isset($answer)) echo $answer;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your answer</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>position:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="position" id="position"
                            value="<?php if(isset($position)) echo $position;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your position</span>
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
var faqId = url.searchParams.get("faqId");
// var div_edit = document.getElementById("edits");
// if (faqId > 0) div_edit.style.display = "inline";
// else div_edit.style.display = "none";
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var question = $("#question").val();
    var answer = $("#answer").val();
    var position = $("#position").val();
    var active = $("#active").val();
    form.validate({
        rules: {
            question: {
                required: true
            },
            answer: {
                required: true
            },
            position: {
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
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_faq.php",
        dataType: "json",
        data: {
            faqId: faqId,
            question: question,
            answer: answer,
            position: position,
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
                            "http://localhost/JomlahBazar/AdminPanel/por_faqs.php"
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