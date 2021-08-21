"use strict";

// Class definition
var KTWizard3 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var orderId;
	var orderNumber;
	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v3', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function (wizardObj) {
			var order_address = $('#hiddenaddress').val();
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			} else {
				switch (wizard.currentStep) {
					case 1:
						$('#checkout-s1').show();
						$('#checkout-s2').hide();
						$('#checkout-s3').hide();
						ispickable();
						if (order_address=='') wizardObj.stop();
						break;
					case 2:
						$('#checkout-s1').hide();
						$('#checkout-s2').show();
						$('#checkout-s3').hide();
						break;
					case 3:
						$('#checkout-s1').hide();
						$('#checkout-s2').hide();
						$('#checkout-s3').show();
						break;
					default:
				}
			}
		});

		wizard.on('beforePrev', function (wizardObj) {
		});

		// Change event
		wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
			switch (wizard.currentStep) {
				case 1:
					$('#checkout-s1').show();
					$('#checkout-s2').hide();
					$('#checkout-s3').hide();
					break;
				case 2:
				  $('#jbmethod').trigger('change');
					$('#checkout-s1').hide();
					$('#checkout-s2').show();
					$('#checkout-s3').hide();
					break;
				case 3:
					$('#checkout-s1').hide();
					$('#checkout-s2').hide();
					$('#checkout-s3').show();
					break;
				default:
			}
		});
	}

	var initValidation = function () {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				address1: {
					required: true
				},
				postalcode: {
					required: true
				},
				city: {
					required: true
				},
				state: {
					required: true
				},
				country: {
					required: true
				},
				jbmethod: {
					required: true
				},
			},

			// Display error
			invalidHandler: function (event, validator) {
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

	var initSubmit = function () {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function (e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					url: DIR_CONT+DIR_CAR+'CON_functions.php?action=submit_order',
					type: "POST",
					success: function (response, status, xhr, $form) {
						var res = JSON.parse(response);
						KTApp.unprogress(btn);
						orderNumber = res.orderNumber;
						var addressId = $('#hiddenaddress').val();
						var userId = $('#hiddenuser').val();
						var total = $('#order_total_pay_value').val();
						var payment_method = $('#jbmethod').val();
					  //setCookie("cookiestp", 1);
					  setCookie("cookiestp", total);
					  setCookie("cookiesuserId", userId);
					  setCookie("cookiesaddressId", addressId);
					  setCookie("cookiesorderNumber", orderNumber);
						$('#order_id').val(orderNumber);
						if(payment_method==2){
							window.location.replace(DIR_VIEW+DIR_CAR+"payment.php");
						}else {
							window.location.replace(DIR_VIEW+DIR_ORD+"b2c-my-orders.php");
						}
					}
				});
			}
		});
	}
	return {
		// public functions
		init: function () {
			wizardEl = KTUtil.get('kt_wizard_v3');
			formEl = $('#kt_form');

			initWizard();
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard3.init();
});
