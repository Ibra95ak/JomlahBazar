"use strict";var KTLayoutBuilder=function(){function t(){i.init(),$('[href^="#kt_builder_"]').click(function(t){var e=$(this).attr("href"),a=$('[name="builder_submit"]'),i=$('[name="builder[tab]"]');0===$(i).length?$("<input/>").attr("type","hidden").attr("name","builder[tab]").val(e).insertBefore(a):$(i).val(e)}).each(function(){var t,e,a;$(this).hasClass("active")&&(t=$(this).attr("href"),e=$('[name="builder_submit"]'),a=$('[name="builder[tab]"]'),0===$(a).length?$("<input/>").attr("type","hidden").attr("name","builder[tab]").val(t).insertBefore(e):$(a).val(t))}),$('[name="builder_submit"]').click(function(t){t.preventDefault();t=$(this);$(t).addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").closest(".kt-form__actions").find(".btn").attr("disabled",!0),$.ajax("index.php?demo="+$(t).data("demo"),{method:"POST",data:$("[name]").serialize()}).done(function(t){toastr.success("Preview updated","Preview has been updated with current configured layout.")}).always(function(){setTimeout(function(){location.reload()},600)})}),$('[name="builder_reset"]').click(function(t){t.preventDefault();t=$(this);$(t).addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").closest(".kt-form__actions").find(".btn").attr("disabled",!0),$.ajax("index.php?demo="+$(t).data("demo"),{method:"POST",data:{builder_reset:1,demo:$(t).data("demo")}}).done(function(t){}).always(function(){location.reload()})})}var i={init:function(){$("#kt-btn-howto").click(function(t){t.preventDefault(),$("#kt-howto").slideToggle()})},startLoad:function(t){$("#builder_export").addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").find("span").text("Exporting...").closest(".kt-form__actions").find(".btn").attr("disabled",!0),toastr.info(t.title,t.message)},doneLoad:function(){$("#builder_export").removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").find("span").text("Export").closest(".kt-form__actions").find(".btn").attr("disabled",!1)},exportHtml:function(t){i.startLoad({title:"Generate HTML Partials",message:"Process started and it may take about 1 to 10 minutes."}),$.ajax("index.php",{method:"POST",data:{builder_export:1,export_type:"partial",demo:t,theme:"metronic"}}).done(function(t){var e,a=JSON.parse(t);a.message?i.stopWithNotify(a.message):e=setInterval(function(){$.ajax("index.php",{method:"POST",data:{builder_export:1,builder_check:a.id}}).done(function(t){t=JSON.parse(t);void 0!==t&&1===t.export_status&&$("<iframe/>").attr({src:"index.php?builder_export&builder_download&id="+t.id,style:"visibility:hidden;display:none"}).ready(function(){toastr.success("Export HTML Version Layout","HTML version exported."),i.doneLoad(),clearInterval(e)}).appendTo("body")})},15e3)})},exportHtmlStatic:function(t){i.startLoad({title:"Generate HTML Static Version",message:"Process started and it may take about 1 to 10 minutes."}),$.ajax("index.php",{method:"POST",data:{builder_export:1,export_type:"html",demo:t,theme:"metronic"}}).done(function(t){var e,a=JSON.parse(t);a.message?i.stopWithNotify(a.message):e=setInterval(function(){$.ajax("index.php",{method:"POST",data:{builder_export:1,builder_check:a.id}}).done(function(t){t=JSON.parse(t);void 0!==t&&1===t.export_status&&$("<iframe/>").attr({src:"index.php?builder_export&builder_download&id="+t.id,style:"visibility:hidden;display:none"}).ready(function(){toastr.success("Export Default Version","Default HTML version exported with current configured layout."),i.doneLoad(),clearInterval(e)}).appendTo("body")})},15e3)})},stopWithNotify:function(t,e){e=e||"danger",void 0!==toastr[e]&&toastr[e]("Verification failed",t),i.doneLoad()},runGenerate:function(){$.ajax("../tools/builder/cron-generate.php",{method:"POST",data:{theme:"metronic"}}).done(function(t){})}},e={reCaptchaVerified:function(){return $.ajax("../tools/builder/recaptcha.php?recaptcha",{method:"POST",data:{response:$("#g-recaptcha-response").val()}}).fail(function(){grecaptcha.reset(),$("#alert-message").removeClass("alert-success kt-hide").addClass("alert-danger").html("Invalid reCaptcha validation")})},init:function(){var a;$("#builder_export").click(function(t){t.preventDefault(),a=$(this),$("#kt-modal-purchase").modal("show"),$("#alert-message").addClass("kt-hide"),grecaptcha.reset()}),$("#submit-verify").click(function(t){t.preventDefault(),$("#g-recaptcha-response").val()?e.reCaptchaVerified().done(function(t){if(t.success){$('[data-dismiss="modal"]').trigger("click");var e=$(a).data("demo");switch($(a).attr("id")){case"builder_export":case"builder_export_html":i.exportHtml(e);break;case"builder_export_html_static":i.exportHtmlStatic(e)}}else grecaptcha.reset(),$("#alert-message").removeClass("alert-success kt-hide").addClass("alert-danger").html("Invalid reCaptcha validation")}):$("#alert-message").removeClass("alert-success kt-hide").addClass("alert-danger").html("Invalid reCaptcha validation")})}};return{init:function(){e.init(),t()}}}();jQuery(document).ready(function(){KTLayoutBuilder.init()});