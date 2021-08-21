"use strict";
// Class Definition
var KTLoginGeneral = function() {

    var login = $('#kt_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
			<div class="alert-text">'+msg+'</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        KTUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    // Private Functions
    var displaySignUpForm = function() {
        login.removeClass('kt-login--otp');
        login.removeClass('kt-login--forgot');
        login.removeClass('kt-login--signin');
        login.removeClass('kt-login--phone');
        login.removeClass('kt-login--signupotp');
        $('#kt_login_signup').hide();
        login.addClass('kt-login--signup');
        KTUtil.animateClass(login.find('.kt-login__signup')[0], 'flipInX animated');
    }

    // Private Functions
    var displayPhoneSignInForm = function() {
        login.removeClass('kt-login--otp');
        login.removeClass('kt-login--signup');
        login.removeClass('kt-login--signupotp');
        $('#kt_login_signup').show();
        login.addClass('kt-login--phone');
        KTUtil.animateClass(login.find('.kt-login__phone')[0], 'flipInX animated');
    }

    var displayOtpForm = function() {
        login.removeClass('kt-login--phone');
        login.removeClass('kt-login--signupotp');

        login.addClass('kt-login--otp');
        //login.find('.kt-login--forgot').animateClass('flipInX animated');
        KTUtil.animateClass(login.find('.kt-login__otp')[0], 'flipInX animated');
        $('#login_token').focus();

    }
    var displaySignupOtpForm = function() {
        login.removeClass('kt-login--signup');

        login.addClass('kt-login--signupotp');
        //login.find('.kt-login--forgot').animateClass('flipInX animated');
        KTUtil.animateClass(login.find('.kt-login__signupotp')[0], 'flipInX animated');

    }


    var handleFormSwitch = function() {
        $('#kt_login_signup,#kt_login_signup1').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });
        $('#kt_login_signup_cancel').click(function(e) {
            e.preventDefault();
            location.href = DIR_VIEW+DIR_USR+"login.php";
        });
    }

    var handlePhoneSignInFormSubmit = function() {
        $('#kt_login_phone_signin_submit').click(function(e) {
            $('#kt_login_email_resend_submit').attr('data-type' , '1');
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    login_phone: {
                        required: true,
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=login',
                type: "POST",
                success: function(response, status, xhr, $form) {
                  var res = JSON.parse(response);
                  switch(res.err) {
                    case 0:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        var phone = $("#login_phone").val();
                        var cc = $("#cc").val();
                        $('#otp').val(cc+phone);
                        form.clearForm();
                        form.validate().resetForm();
                        displayOtpForm();
                    }, 2000);
                      break;
                    case 1:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();
                        // display signup form
                        displayPhoneSignInForm();
                        var signInForm = login.find('.kt-login__phone form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();
                        showErrorMsg(signInForm, 'danger', 'User is not activated! Please check email for activation link.');
                    }, 2000);
                      break;
                    case 2:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displayPhoneSignInForm();
                        var signInForm = login.find('.kt-login__phone form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();

                        showErrorMsg(signInForm, 'danger', 'User not found!');
                    }, 2000);
                      break;
                    default:
                      // code block
                  }
                }
            });
        });
    }

    var handlePhoneVerifyFormSubmit = function() {
        $('#kt_login_otp_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    login_token: {
                        required: true,
                    },
                    otp: {
                        required: true,
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=verify',
                type: "POST",
                success: function(response, status, xhr, $form) {
                  var res = JSON.parse(response);
                  switch(res.err) {
                    case 0:
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        $('#kt_modal_welcome').modal('show');
                        form.clearForm();
                        form.validate().resetForm();
                        var redirect = getCookie('redirect');
                        var param1 = getCookie('params1');
                        var param2 = getCookie('params2');
                        var param3 = getCookie('params3');
                        var userId = res.userId;
                        console.log(redirect);
                        switch (redirect) {
                          case '0':
                            location.href=DIR_ROOT+"";
                            break;
                          case '1':
                            addToWishList(userId,param2,param1);
                            break;
                          case '2':
                            location.href=DIR_VIEW+DIR_ORD+"quotation.php?productId="+param1+"&sellerId="+param2+"&price="+param3;
                            break;
                          case '3':
                            location.href=DIR_VIEW+DIR_CAR+"checkout.php?return=checkout";
                            break;
                          default:
                            location.href=DIR_ROOT+"";
                        }
                        setCookie('redirect', 0);
                      break;
                      case 3:
                      // similate 2s delay
                      setTimeout(function() {
                          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                          form.clearForm();
                          form.validate().resetForm();

                          // display otp form
                          displayOtpForm();
                          var signOtpForm = login.find('.kt-login__otp form');
                          signOtpForm.clearForm();
                          signOtpForm.validate().resetForm();

                          showErrorMsg(signOtpForm, 'danger', 'OTP code did not match!');
                      }, 2000);
                      break;
                      case 4:
                      // similate 2s delay
                      setTimeout(function() {
                          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                          form.clearForm();
                          form.validate().resetForm();

                          // display otp form
                          displayOtpForm();
                          var signOtpForm = login.find('.kt-login__otp form');
                          signOtpForm.clearForm();
                          signOtpForm.validate().resetForm();

                          showErrorMsg(signOtpForm, 'danger', 'OTP code Expired!');
                      }, 2000);
                      break;
                    default:
                      // code block
                  }
                }
            });
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#kt_login_signup_submit').click(function(e) {
            $('#kt_login_email_resend_submit').attr('data-type' , '2');
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var fullname = $("#fullname").val();
            var email = $("#email").val();
            var usertypesu = $("#usertypesu").val();
            var phone = $("#login_phone_signup").val();
            var cc = $("#ccsu").val();
            var otp_versignup = $("#otp_versignup").val();
            $('#otp_signup').val(cc+phone);
            $('#otp_versignup').val(cc+phone);
            $("#signup_fullname").val(fullname);
            $("#signup_email").val(email);
            $("#signup_usertypesu").val(usertypesu);
            form.validate({
                rules: {
                    fullname: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    login_phone_signup: {
                        required: true,
                    },
                    agree: {
                        required: true,
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
            form.ajaxSubmit({
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=signup',
                type: "POST",
                success: function(response, status, xhr, $form) {
                  var res = JSON.parse(response);
                  switch(res.err) {
                    case 0:
                      btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                      displaySignupOtpForm();
                      break;
                    case 1:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();
                        // display signup form
                        displayPhoneSignInForm();
                        var signInForm = login.find('.kt-login__phone form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();
                        showErrorMsg(signInForm, 'danger', 'Account Already exist!');
                    }, 2000);
                      break;
                    case 2:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displaySignUpForm();
                        var signUpForm = login.find('.kt-login__signup form');
                        signUpForm.clearForm();
                        signUpForm.validate().resetForm();

                        showErrorMsg(signUpForm, 'danger', 'Sign up failed! Please try again.');
                    }, 2000);
                      break;
                    case 3:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displaySignUpForm();
                        var signUpForm = login.find('.kt-login__signup form');
                        signUpForm.clearForm();
                        signUpForm.validate().resetForm();

                        showErrorMsg(signUpForm, 'danger', 'Sign up failed! Missing Inputs.');
                    }, 2000);
                      break;
                    case 4:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displaySignUpForm();
                        var signUpForm = login.find('.kt-login__signup form');
                        signUpForm.clearForm();
                        signUpForm.validate().resetForm();

                        showErrorMsg(signUpForm, 'danger', 'Invalid mobile number.');
                    }, 2000);
                      break;
                    default:
                    setTimeout(function() {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displaySignUpForm();
                        var signUpForm = login.find('.kt-login__signup form');
                        signUpForm.clearForm();
                        signUpForm.validate().resetForm();

                        showErrorMsg(signUpForm, 'warning', 'Default Error!');
                    }, 2000);
                  }
                }
            });
        });
    }

    var handlePhoneVerifyFormSignup = function() {
        $('#kt_register_phone_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            form.validate({
                rules: {
                    signup_token: {
                        required: true,
                    },
                    otp_versignup: {
                        required: true,
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            form.ajaxSubmit({
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=verify-signup',
                type: "POST",
                success: function(response, status, xhr, $form) {
                  var res = JSON.parse(response);
                  switch(res.err) {
                    case 0:
                      btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                      $('#kt_modal_welcome').modal('show');
                      form.clearForm();
                      form.validate().resetForm();
                      var redirect = getCookie('redirect');
                      var param1 = getCookie('params1');
                      var param2 = getCookie('params2');
                      var param3 = getCookie('params3');
                      var userId = res.userId;
                      switch (redirect) {
                        case '0':
                          location.href=DIR_VIEW+DIR_USR+"thankyou.php";
                          break;
                        case '1':
                          addToWishList(userId,param2,param1);
                          break;
                        case '2':
                          location.href=DIR_VIEW+DIR_ORD+"quotation.php?productId="+param1+"&sellerId="+param2+"&price="+param3;
                          break;
                        case '3':
                          location.href=DIR_VIEW+DIR_CAR+"checkout.php?return=checkout";
                          break;
                        default:
                          location.href=DIR_VIEW+DIR_USR+"thankyou.php";
                      }
                      setCookie('redirect', 0);
                      break;
                      case 3:
                      // similate 2s delay
                      setTimeout(function() {
                          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                          form.clearForm();
                          form.validate().resetForm();

                          displaySignupOtpForm();
                          var signupOtpForm = login.find('.kt-login__signupotp form');
                          signupOtpForm.clearForm();
                          signupOtpForm.validate().resetForm();

                          showErrorMsg(signupOtpForm, 'danger', 'OTP code did not match!');
                      }, 2000);
                      break;
                      case 4:
                      // similate 2s delay
                      setTimeout(function() {
                          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                          form.clearForm();
                          form.validate().resetForm();

                          displaySignupOtpForm();
                          var signupOtpForm = login.find('.kt-login__signupotp form');
                          signupOtpForm.clearForm();
                          signupOtpForm.validate().resetForm();

                          showErrorMsg(signupOtpForm, 'danger', 'OTP code Expired!');
                      }, 2000);
                      break;
                    default:
                      // code block
                  }
                }
            });
        });
    }

    var handlePhoneResendOTP = function() {
        $('#kt_login_phone_resend_submit').click(function(e) {
          var btn = $(this);
          btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
          var saveData = $.ajax({
                type: 'POST',
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=resendotp',
                data: {otp: $('#otp').val()},
                success: function(resultData) {
                  var cookies = getCookie("otp-verify-count");
                  if (cookies == "") {
                    setCookie("otp-verify-count", 1);
                  }else {
                    setCookie("otp-verify-count", parseInt(cookies)+1);
                  }
                  if (cookies>=2) {
                    var signOtpForm = login.find('.kt-login__otp form');
                    signOtpForm.clearForm();
                    signOtpForm.validate().resetForm();
                    showErrorMsg(signOtpForm, 'danger', 'OTP code Expired please try again after 1 minute!');
                    setTimeout(function(){ setCookie("otp-verify-count", 0); }, 60*1000);
                  }
                  $('#resend_note').text("Please check your Phone to complete required action!");
                },
                error: function() { alert("Something went wrong"); }
          });
          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                  });
        $('#kt_login_email_resend_submit').click(function(e) {
          $('#resend_note').text("");
          var btn = $(this);
          btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
          var saveData = $.ajax({
                type: 'POST',
                url: DIR_CONT+DIR_USR+'CON_user_otp.php?action=resendemail',
                data: {otp: $('#otp').val(), reg_lgn:$('#kt_login_email_resend_submit').attr("data-type"),otp_versignup:$('#otp').val(),signup_fullname:$('#signup_fullname').val(),signup_email:$('#signup_email').val(),signup_usertypesu:$('#signup_usertypesu').val()},
                success: function(resultData) {
                  var cookies = getCookie("otp-verify-count");
                  if (cookies == "") {
                    setCookie("otp-verify-count", 1);
                  }else {
                    setCookie("otp-verify-count", parseInt(cookies)+1);
                  }
                  if (cookies>=2) {
                    var signOtpForm = login.find('.kt-login__otp form');
                    signOtpForm.clearForm();
                    signOtpForm.validate().resetForm();
                    showErrorMsg(signOtpForm, 'danger', 'OTP code Expired please try again after 1 minute!');
                    setTimeout(function(){ setCookie("otp-verify-count", 0); }, 60*1000);
                  }
                  $('#resend_note').text("Please check your email to complete required action!");
                },
                error: function() { alert("Something went wrong"); }
          });
          btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                  });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handlePhoneSignInFormSubmit();
            handlePhoneVerifyFormSubmit();
            handleSignUpFormSubmit();
            handlePhoneVerifyFormSignup();
            handlePhoneResendOTP();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLoginGeneral.init();
});

//Google Scripts
function onSignIn(googleUser) {
  // The ID token you need to pass to your backend:
  var id_token = googleUser.getAuthResponse().id_token;
  $.ajax({url: DIR_CONT+"CON_user_access.php?action=g-signin&idtoken="+id_token, success: function(result){
    //location.href=DIR_ROOT+'dashboard.php';
  }});
}
//LinkedIn
$('#linkedinSignin').click(function(e) {
    location.href=DIR_CONT+'CON_user_access.php?action=l-signin';
});

function addToWishList(userId,sellerId,productId){
  $.ajax({
    method: "GET",
    url: DIR_CONT+DIR_CAR+"CON_functions.php?action=addtowishlist",
    data: { userId: userId, sellerId: sellerId, productId: productId },
    success: function(result){
      location.href=DIR_VIEW+DIR_CAR+"wishlist.php";
    }
  });
}
