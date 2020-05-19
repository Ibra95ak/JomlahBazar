//---------------------------- Reset Button ---------------------------------

"use strict",
function PageReset(){
	window.location.reload();
}
//---------------------------- contact section ------------------------------

function ckhcontactform(){

	if(document.getElementById("name").value==''){
		alert("Please Enter Your Full Name"); 
		document.getElementById("name").value='';
		document.getElementById("name").focus();
		return false;
	}
	if(document.getElementById("email").value==''){
		alert("Please Enter Your Email"); 
		document.getElementById("email").value='';
		document.getElementById("email").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("email").value))	
	{
		document.getElementById("email").click();
		document.getElementById("email").focus();
		return false;
	}
	if(document.getElementById("message").value==''){
		alert("Please Enter Your Message"); 
		document.getElementById("message").value='';
		document.getElementById("message").focus();
		return false;
	}
    return true;
}

function ajaxmailcontact(){
	
if(ckhcontactform() == true){
	
	//alert(email);
	var form_data=$('#contactForm').serialize();
		 $.ajax({
		url:"assets/php/mailcontroller.php?mode=contactForm",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			//window.location = "thankyou.html";
			$('#contactForm')[0].reset();
			//$('#quoteClose').click();
			}else if(data==0){
			alert('Please Enter Your Full Name')
			document.getElementById("name").focus();
			}else if(data==2){
			alert('Please Enter Email Address')
			document.getElementById("email").focus();
			}
			else if(data==3){
			alert('Please Enter Valid Email Address')
			document.getElementById("email").focus();
			}
			else if(data==4){
			alert('Please Enter Message')
			document.getElementById("message").focus();
			}
		}
		
		});
}
}


//---------------------------- subscriber section ------------------------------

function ckhformsubscribe(){
	if(document.getElementById("subsemail").value==''){
		alert("Please Enter Your Email Address"); 
		document.getElementById("subsemail").value='';
		document.getElementById("subsemail").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("subsemail").value))	
	{
		document.getElementById("subsemail").click();
		document.getElementById("subsemail").focus();
		return false;
	}
    return true;
}

function ajaxmailsubscribe(){
	
if(ckhformsubscribe() == true){
	//alert(2);
	var form_data=$('#subsForm').serialize();
	//alert(form_data);
		 $.ajax({
		url:"assets/php/mailcontroller.php?mode=subscriber",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			//window.location = "thankyou.html";
			$('#subsForm')[0].reset();
			}else if(data==0){
			alert('Please Enter Subscription Email')
			document.getElementById("subsemail").focus();
			$('#subsForm')[0].reset();	
			}else if(data==2){
			alert('Please Enter Valid Email Address')
			document.getElementById("subsemail").focus();
			$('#subsForm')[0].reset();	
			}
		}
		});
}
}


//---------------------------- coming soon section ------------------------------

function ckhformcomingsoon(){
	if(document.getElementById("comemail").value==''){
		alert("Please Enter Your Email Address"); 
		document.getElementById("comemail").value='';
		document.getElementById("comemail").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("comemail").value))	
	{
		document.getElementById("comemail").click();
		document.getElementById("comemail").focus();
		return false;
	}
    return true;
}

function ajaxmailcomingsoon(){
	
if(ckhformcomingsoon() == true){
	//alert(2);
	var form_data=$('#comingForm').serialize();
	//alert(form_data);
		 $.ajax({
		url:"assets/php/mailcontroller.php?mode=comingsoon",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			//window.location = "thank-you.html";
			$('#comingForm')[0].reset();
			}else if(data==0){
			alert('Please Enter Subscription Email')
			document.getElementById("comemail").focus();
			$('#comingForm')[0].reset();	
			}else if(data==2){
			alert('Please Enter Valid Email Address')
			document.getElementById("comemail").focus();
			$('#comingForm')[0].reset();	
			}
		}
		});
}
}

//---------------------------- home section ------------------------------

function ckhformhome(){
	if(document.getElementById("homemail").value==''){
		alert("Please Enter Your Email Address"); 
		document.getElementById("homemail").value='';
		document.getElementById("homemail").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("homemail").value))	
	{
		document.getElementById("homemail").click();
		document.getElementById("homemail").focus();
		return false;
	}
    return true;
}

function ajaxmailhome(){
	
if(ckhformhome() == true){
	//alert(2);
	var form_data=$('#homeForm').serialize();
	//alert(form_data);
		 $.ajax({
		url:"assets/php/mailcontroller.php?mode=homesubscribe",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			//window.location = "thankyou.html";
			$('#homeForm')[0].reset();
			}else if(data==0){
			alert('Please Enter Subscription Email')
			document.getElementById("homemail").focus();
			$('#homeForm')[0].reset();	
			}else if(data==2){
			alert('Please Enter Valid Email Address')
			document.getElementById("homemail").focus();
			$('#homeForm')[0].reset();	
			}
		}
		});
}
}
