"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }else{

              switch (wizard.currentStep) {
                case 1:
                  var fullname = document.getElementById('fullname').value;
                  document.getElementById('l_fullname').innerHTML=fullname;
                  var otp = document.getElementById('otp').value;
                  document.getElementById('l_otp').innerHTML=otp;
                  var email = document.getElementById('email').value;
                  document.getElementById('l_email').innerHTML=email;
                  var role = document.getElementById('roleId');
                  document.getElementById('l_roleId').innerHTML=role.selectedOptions[0].text;
                  break;
                case 2:
                  var phone = document.getElementById('phone').value;
                  if(phone!='') document.getElementById('l_phone').innerHTML="connected";
                  var whatsapp = document.getElementById('whatsapp').value;
                  if(whatsapp!='') document.getElementById('l_whatsapp').innerHTML="connected";
                  var telegram = document.getElementById('telegram').value;
                  if(telegram!='') document.getElementById('l_telegram').innerHTML="connected";
                  var messenger = document.getElementById('messenger').value;
                  if(messenger!='') document.getElementById('l_messenger').innerHTML="connected";
                  var linkedin = document.getElementById('linkedin').value;
                  if(linkedin!='') document.getElementById('l_linkedin').innerHTML="connected";
                  var sms = document.getElementById('sms').value;
                  if(sms!='') document.getElementById('l_sms').innerHTML="connected";
                  break;
                default:
              }
            }
        });

        wizard.on('beforePrev', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
               	//= Step 1
				// fullname: {
				// 	required: true
				// },
				// otp: {
				// 	required: true
				// },
				// email: {
				// 	required: true,
				// 	email: true
				// },
				// roleId: {
				// 	required: true,
				// },
        //
				// //= Step 2
				address1: {
					required: true
				},
				// postalcode: {
				// 	required: true
				// },
				// city: {
				// 	required: true
				// },
				// state: {
				// 	required: true
				// },
				// country: {
				// 	required: true
				// },
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                  url: DIR_CONT+DIR_USR+'CON_user_profile.php?action=post',
                  type: "POST",
                    success: function() {
                        KTApp.unprogress(btn);
                        //KTApp.unblock(formEl);

                        swal.fire({
                            "title": "",
                            "text": "Your profile has been edited!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});
