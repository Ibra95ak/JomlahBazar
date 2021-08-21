"use strict";

// Class definition
var KTWizard1 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v1', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
			if(wizard.currentStep==3){
				if ($('#featured_path').val()=='') {
					wizardObj.stop();  // don't go to the next step
				}
			}
		});

		wizard.on('beforePrev', function(wizardObj) {
		});

		// Change event
		wizard.on('change', function(wizard) {
			setTimeout(function() {
				KTUtil.scrollTop();
			}, 500);
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {

				//= Step 1
				name: {
					required: true
				},
				maincategoryId: {
					required: true
				},
				categoryId: {
					required: true
				},
				brandId: {
					required: true
				},
				weight: {
					required: true,
					number:true
				},
				//= Step 2
				food_size: {
					required: true
				},
				perfume_size: {
					required: true
				},
				makeup_size: {
					required: true
				},
				care_size: {
					required: true
				},
				//= Step 3
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
					url: DIR_CONT+DIR_PRO+'CON_products.php?action=post',
					type: "POST",
					success: function(response, status, xhr, $form) {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

						swal.fire({
							"title": "",
							"text": "The product has been successfully submitted!",
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						}).then(function(result) {
							if (result.value || result.dismiss) {
								location.href = DIR_VIEW+DIR_PRO+"dt_myproducts.php";
							}
			      });
					}
				});
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v1');
			formEl = $('#kt_form');

			initWizard();
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard1.init();
});
