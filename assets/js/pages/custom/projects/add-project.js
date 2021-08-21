"use strict";

// Class definition
var KTProjectsAdd = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var avatar;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_projects_add', {
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
						var name = document.getElementById('name').value;
						document.getElementById('pro_name').innerHTML="Product Name: "+name;
						var brandId = document.getElementById('brandId').selectedOptions[0].text;
						document.getElementById('pro_brand').innerHTML="Brand: "+brandId;
						var categoryId = document.getElementById('categoryId').selectedOptions[0].text;
						document.getElementById('pro_category').innerHTML="category: "+categoryId;
						var subcategoryId = document.getElementById('subcategoryId').selectedOptions[0].text;
						document.getElementById('pro_subcategory').innerHTML="subcategory: "+subcategoryId;
						var description = document.getElementById('description').value;
						document.getElementById('pro_description').innerHTML="Description: "+description;
						var asin = document.getElementById('asin').value;
						document.getElementById('pro_asin').innerHTML="ASIN: "+asin;
						var barcode = document.getElementById('barcode').value;
						document.getElementById('pro_barcode').innerHTML="Barcode: "+barcode;
						break;
					case 2:
						var size = document.getElementById('size1').value;
						document.getElementById('pro_size').innerHTML="Size: "+size;
						var count = document.getElementById('count').value;
						document.getElementById('pro_count').innerHTML="Count: "+count;
						var ingredients = document.getElementById('ingredients1').value;
						document.getElementById('pro_ingredients').innerHTML="Ingredients: "+ingredients;
						var highlights = document.getElementById('highlights1').value;
						document.getElementById('pro_highlights').innerHTML="Highlights: "+highlights;
						var hair_skintypes = document.getElementById('hair_skintypes').value;
						document.getElementById('pro_hair_skintypes').innerHTML="Hair or skin types: "+hair_skintypes;
						break;
						case 3:
							var path = document.getElementById('path').value;
							document.getElementById('pro_pic').src=DIR_MED+DIR_PRO+path;
							break;
					default:
				}
			}
		})

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
				// Step 1
				// name: {
				// 	required: true
				// },
				// brandId: {
				// 	required: true
				// },
				// categoryId: {
				// 	required: true
				// },
				// description: {
				// 	required: true
				// }
			},

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"buttonStyling": false,
					"confirmButtonClass": "btn btn-brand btn-sm btn-bold"
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
					url: DIR_CONT+'CON_products.php?action=post',
					type: "POST",
					success: function() {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

						swal.fire({
							"title": "",
							"text": "The application has been successfully submitted!",
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						});
					}
				});
			}
		});
	}

	var initAvatar = function() {
		avatar = new KTAvatar('kt_projects_add_avatar');
	}

	return {
		// public functions
		init: function() {
			formEl = $('#kt_projects_add_form');

			initWizard();
			initValidation();
			initSubmit();
			initAvatar();
		}
	};
}();

jQuery(document).ready(function() {
	KTProjectsAdd.init();
});
