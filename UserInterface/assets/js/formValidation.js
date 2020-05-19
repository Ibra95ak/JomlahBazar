/*
1.	Removing spaces form both sides.
		checkTrim(txtString)
2.  Validation for field which should not be empty
		isEmpty(fieldname,fieldvalue)
    Validation for field which should not be selected
      isSelected(fieldname,fieldvalue)		
3.  Validation for field which can contain only alphanumeric value
		hasOnlyAlphaNumeric(fieldname , fieldvalue)
		hasOnlyAlphaNumericwithDot(fieldname , fieldvalue)
		hasOnlyAlphaNumericWithSymbol(fieldname , fieldvalue)
		isValidString(fieldname , fieldvalue)
4. 	Validation for field which cannot contain Space inbetween.
		isSpace(fieldname, fieldvalue)
5. 	Validation for field which cannot start with number
		isStartsWithNumber(fieldname , fieldvalue)
6. 	Validation for field which can allow only alphabets
		hasOnlyAlphabets(fieldname ,fieldvalue)
		hasOnlyAlphabetsAndSpecificChar(fieldname , fieldvalue)
7. 	Validation for field which allows only numbers
		hasOnlyNumeric(fieldname , fieldvalue)
		hasOnlyNumericAndSpecificChar(fieldname , fieldvalue)
		hasOnlyNumericAndComma(fieldname , fieldvalue)
8. 	Validation for length of the field
		isTooLong(fieldName,checkStr,length)
		isTooShort(fieldName,checkStr,length)
9. 	Check for Valid Email.
		validateEmail(fieldname, fieldvalue)
10.	Validation for two field to be same 			
		isDuplicate(firstValue, secondValue)
11.	returns true if it is a valid phone Number
		isValidPhoneNO(fieldname , fieldvalue)
		validatePhone(fieldname, frmField)
		check_usphone(phonenumber, useareacode)
12.	Validate Date
		validateSingleDate(dtDate)
		validateDate(startDate,endDate)
		isDateBefore(date1Name,date1Value,date2Name,date2Value)
		isDateAfter(date1Name,date1Value,date2Name,date2Value)
13.	Validation for field which cannot contains symebol
		isValidString(fieldname , fieldvalue)
14.	Validation for field which contains file name
		isValidFileName(fieldname , fieldvalue)]
15.	Validation for field which allows only float numbers - allow also negative values
		isValidFloat(fieldname , fieldvalue)
16.	Validation for field which allows only float numbers
		isFloat(fieldname , fieldvalue)
17.	Validation for special characters like < and >.
		isValid(fieldname , fieldvalue)
18.	Credit card validations for diffrent cards
		CheckCardNumber(frmObj)
*/ 

'use strict',
function checkTrim(txtString)
{
	txtString = LTrim(txtString);
	txtString = RTrim(txtString);
	return txtString;
}

//returns the string after deleting the trailing spaces


function LTrim(txtString) 
{
	ctr = 0;
	while( ctr < txtString.length && (txtString.substring(ctr,ctr+1) == " "))
	{
		ctr=ctr+1;
	}
	return txtString.substring(ctr);
}

// returns the string after deleting the leading spaces


function RTrim(txtString) 
{
	ctr = txtString.length;
	while( ctr > 0  && (txtString.substring(ctr,ctr-1) == " "))
	{
		ctr = ctr - 1;
	}
	return txtString.substring(0,ctr);
}

//Validation for field which should not be empty


function isEmpty(fieldname,fieldvalue)
{
	
	var str=checkTrim(fieldvalue)
	if(str.length==0)
	{
		alert(fieldname + ' cannot be blank ');
		return true;
	}
	return false;
}
//Validation for field which should not be selected


function isSelected(fieldname,fieldvalue)
{
	var str=checkTrim(fieldvalue)
	if(str.length==0)
	{
		alert(fieldname + ' not selected ');
		return true;
	}
	return false;
}

//Validation for field which can contain only alphanumeric value


function hasOnlyAlphaNumeric(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))|| ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') )))
		{
			alert(fieldname+' contains only alphanumeric values \n\nValid Characters :(A to Z),(a to z) and (0 to 9) ');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyAlphaNumericWithDotUnderScore(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))|| ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') )||(str.charAt(i) <= '.')||(str.charAt(i) <= '_')))
		{
			alert(fieldname+' contains only alphanumeric values \n\nValid Characters :(A to Z),(a to z),(0 to 9), Dot and Underscore');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyAlphaNumericwithDot(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))|| ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') )||(str.charAt(i) == '.')||(str.charAt(i) <= ' ')))
		{
			alert(fieldname+' contains only alphanumeric values \n\nValid Characters :(A to Z),(a to z) and (0 to 9) ');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyAlphaNumericWithSymbol(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||(str.charAt(i) <= '@')||((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))|| ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') )||(str.charAt(i) <= ' ')))
		{
			alert(fieldname+' contains only alphanumeric values \n\nValid Characters :(A to Z),(a to z) and (0 to 9) and @');
			return false;
		}
		i++;
	}
	return true;
}

//Validation for field which cannot contain Space inbetween.


function isSpace(fieldname , fieldvalue)
{
	var str=fieldvalue
	if((str).indexOf(" ")!=-1)
	{
		alert('Space is not allowed in '+fieldname);
		return false;
	}
	return true;
}

//Validation for field which cannot start with number


function isStartsWithNumber(fieldname , fieldvalue)
{
	var numbers = "0123456789";
	startsWithNumber=false;
	var str = checkTrim(fieldvalue)
	for(i=0;i<numbers.length;i++)
	{	
	   if(str.charAt(0)==numbers.charAt(i))
	   {
	   	alert(fieldname+' cannot start with number');
       	return false;
	   }
	}
	return true;
}

//Validation for field which can allow only alphabets


function hasOnlyAlphabets(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z'))))
		{
			alert(fieldname+' can contain only alphabets\n\nValid Characters: (A to Z),(a to z) ');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyAlphabetsWithSpace(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z'))|| (str.charAt(i) == " ")))
		{
			alert(fieldname+' can contain only alphabets\n\nValid Characters: (A to Z),(a to z) And Space ');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyAlphabetsAndSpecificChar(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') || (str.charAt(i) == " ") || (str.charAt(i) == "-") || (str.charAt(i) == "_") || (str.charAt(i) == ",") || (str.charAt(i) == ".") || (str.charAt(i) == "!") || (str.charAt(i) == "$") ||(str.charAt(i) == "'") || (str.charAt(i) >= "0") && (str.charAt(i) <= "9")))) {
			alert(fieldname+' can contain only alphabets\n\nValid Characters :(A to Z),(a to z),(0 to 9),($,_,!,.,-)whitespace and hyphen ');
			return false;
		}
		i++;
	}
	return true;
}



function validate_url(fieldvalue) {

     var theurl = checkTrim(fieldvalue);
     var tomatch = /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
     if (tomatch.test(theurl)){
         //window.alert("URL OK.");
         return true;
     } else {
         window.alert("URL invalid. Try again.\n It should be like http://www.domainname.com.");
         return false; 
     }
}



function hasOnlyAlphabetsAndSpecificCharBrackets(fieldname , fieldvalue)
{
	var fieldString = checkTrim(fieldvalue);
	var checkString = '~^><';
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}



function isUrlName(fieldname , fieldvalue)
{
	var fieldString = checkTrim(fieldvalue);
	var checkString = '~^><&%@#$!*(){}[],\',\\,\",?,:,;, ,';
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}
/*function hasOnlyAlphabetsAndSpecificCharBrackets(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z'))||((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z') || (str.charAt(i) == " ") || (str.charAt(i) == "-") || (str.charAt(i) == "_") || (str.charAt(i) == ",") || (str.charAt(i) == ".") || (str.charAt(i) == "!") || (str.charAt(i) == "$") || (str.charAt(i) == "(") || (str.charAt(i) == ")") || (str.charAt(i) == "[") || (str.charAt(i) == "]") || (str.charAt(i) == "@") || (str.charAt(i) == "#") || (str.charAt(i) == "+") || (str.charAt(i) == ";") || (str.charAt(i) == "\\")||(str.charAt(i) == "'") || (str.charAt(i) >= "0") && (str.charAt(i) <= "9")))) {
			alert(fieldname+' can contain only alphabets\n\nValid Characters :(A to Z),(a to z),(0 to 9),($,_,!,.,-,@,#,+,[,],(,),;)whitespace and hyphen ');
			return false;
		}
		i++;
	}
	return true;
}
*/
//Validation for field which allows only numbers


function hasOnlyNumeric(fieldname , fieldvalue)
{
	var str = fieldvalue;
	var i = 0;
	while(i < str.length)
	{
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9")))
		{
			alert(fieldname+' can contain only numeric value');
			return false;
		} else {
			i = i + 1;
		}
	}
	return true;
}



function hasOnlyNumericAndSpecificChar(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == "-") || (str.charAt(i) == " ") || (str.charAt(i) == ",") || (str.charAt(i) == "(") || (str.charAt(i) == ")") || (str.charAt(i) == "+") || ((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z')) || ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z')) ) ) {
			alert(fieldname+' can contain only numeric value,whitespace and hyphen');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyNumericWithspace(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	var len=str.length;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == "-") || (str.charAt(i) == " ")) ) {
			alert(fieldname+' can contain only numeric value and - and space');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyNumericAndUnderscore(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	var len=str.length;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == "_") ) ) {
			alert(fieldname+' can contain only numeric value and underscore');
			return false;
		}
		i++;
	}
	return true;
}


function hasOnlyNumericAndComma(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == ",") ) ) {
			alert(fieldname+' can contain only numeric value and comma');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyNumericAndDot(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == ".") ) ) {
			alert(fieldname+' can contain only numeric value and dot');
			return false;
		}
		i++;
	}
	return true;
}



function hasOnlyNumericAndInvertedComma(fieldname , fieldvalue) {
	var str = fieldvalue;
	var comma = "'";
	i = 0;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == '"' || (str.charAt(i) == "'") ) )) {
			alert(fieldname+' can contain only numeric value, '+comma+' and "');
			return false;
		}
		i++;
	}
	return true;
}

//Validation for length of the field


function isTooLong(fieldName,checkStr,length)
{
	checkStr = checkTrim(checkStr);
	if((checkStr.length)>length)
	{
		alert (fieldName+' cannot exceed ' + length + ' character');
		return true; // true if the length exceeds
	}
	else 
		return false;  // else false
}

//Validation for length of the field


function isTooShort(fieldName,checkStr,length)
{
	checkStr = checkTrim(checkStr);
	if((checkStr.length) < length)
	{
		alert (fieldName+' cannot shorter than ' + length + ' character');
		return true; // true if the length short
	}
	else 
		return false;  // else false
}

//Check for Valid Email.


function validateEmail(fieldname,frmField) {
	
    //Validating the email field
    //var emailRegxp = /^([\w]+)(.[\w]+){1,4}@([\w]+)(.[\w]+)([.][\w]{2,3}){1,2}$/;
	var emailRegxp = /^([\w-']+(?:\.[\w-']+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/ ;
	//var emailRegxp = /^[A-Za-z][A-Za-z0-9_'-.]+((?:\.[\w-']+)*)@([\w-]+(?:\.[\w-]+)*)(\.[\w]{2,3}){1,2}$/;
	if (!frmField.match(emailRegxp)) {
        alert('Invalid '+fieldname+' ');
        return (false);
    }
    return(true);
}/*
function validateEmail(fieldname, fieldvalue) {
	var fieldString = checkTrim(fieldvalue);
	var checkString = " ~!$%^*()+=?><,;#&|\/:";
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}
*/
//Validation for two field to be same

 			
function isDuplicate(firstValue, secondValue)
{
	if(firstValue == secondValue)
		return true;
	else
		return false;
}

//returns true if it is a valid phone Number


function isValidPhoneNO(fieldname , fieldvalue)
{
	
	var str = fieldvalue;
  var checkOK = "0123456789-";
  var checkStr = checkTrim(str);
  var allValid = true;
  var allNum = "";
  for (i = 0;  i < checkStr.length;  i++)
  {
	  if(checkStr.length<6)
	  {
		allValid=false;
		break;
		}
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length)
    {
      allValid = false;
      break;
    }
    if (ch != ",")
      allNum += ch;
  }
  if (allValid)
      return (true);
  else
  alert('Please enter valid '+fieldname +'\n\n e.g. XXX-XXX-XXXX OR XXXXXXXXXX');
  	  return (false);
}

//Phone Validation


function validatePhone(fieldname, frmField) {
    //Validating the Phone field
    //return isValid(fieldname, frmField);
	var fieldString = checkTrim(frmField);
	var checkString = " ~!$%^*@=?><,;&|\/:";
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}



function hasOnlyNumericDashAndPlus(fieldname , fieldvalue) {
	var str = fieldvalue;
	i = 0;
	while(i < str.length) {
		if(!((str.charAt(i) >= "0") && (str.charAt(i) <= "9") || (str.charAt(i) == "-") || (str.charAt(i) == " ") || (str.charAt(i) == "+")) ) {
			alert(fieldname+' can contain numeric,- and + only.');
			return false;
		}
		i++;
	}
	return true;
}



function check_usphone(phonenumber,useareacode) 
{ 
	if(!useareacode)useareacode=1; 
	if((phonenumber.match(/^[ ]*[(]{0,1}[ ]*[0-9]{3,3}[ ]*[)]{0,1}[-]{0,1}[ ]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/)==null) && ((useareacode!=1) && (phonenumber.match(/^[ ]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/)==null))) return false; 
	return true; 
} 

// Validate Single Date


function validateSingleDate(dtDate)
{
	if(dtDate=="")
	{
		alert("Date cannot be empty");
		return false;
	}
	var month;
	var dat;
	var year;
	var firstIndex;
	var secIndex;
	var str = dtDate;
	var i = 0;
	var count=0;
	
	if(str.charAt(0)=="0" && str.charAt(1)=="0")
	{
		alert("Please enter valid Month");
		return false;
	}
	if(str.charAt(3)=="0" && str.charAt(4)=="0")
	{
		alert("Please enter valid Date");
		return false;
	}
	if(str.charAt(6)=="0" && str.charAt(7)=="0" && str.charAt(8)=="0" && str.charAt(9)=="0")
	{
		alert("Please enter valid Year");
		return false;
	}
	if(str.charAt(2)!="/")
	{
		alert("Please enter valid Date (e.g. 02/07/2002)");
		return false;
	}
	
	if(str.charAt(5)!="/")
	{
		alert("Please enter valid Date (e.g. 02/07/2002)");
		return false;
	}
	while(i < str.length)
	{
		if(!(((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))|| (str.charAt(i) == '/')))
		{
			alert("Please enter valid Date (e.g. 12/27/2002)");
			return false;
		}
		else
		{
			if(str.charAt(i) == '/')
			count=count+1;
		}
		i++;
	}
	if(count>2)
	{
		alert("Please enter valid Date (e.g. 12/27/2002)");
		return false;
	}
	month=dtDate.substring(0,2);
	dat=dtDate.substring(3,5);
	year=dtDate.substring(6,10);
	if(month>12)
	{
		alert("Please enter valid Date (e.g. 12/27/2002)");
		return false;
	}
	if(month==1 || month==3 ||month==5||month==7||month==8||month==10||month==12)
	{
		if(dat>31)
		{
			alert("Please enter valid Date (e.g. 12/27/2002)");
			return false;
		}
	}
	if(month==2 || month==4 ||month==6||month==9||month==11)
	{
		if(dat>30)
		{
			alert("Please enter valid Date (e.g. 12/27/2002)");
			return false;
		}
	}
	if((year%4==0 && year%100!=0) || year%400==0)
	{
		if(month==2)
		{
			if(dat>29)
			{
				alert("Please enter valid Date (e.g. 12/27/2002)");
				return false;
			}
		}
	}
	else
	{
		if(month==2)
		{
			if(dat>28)
			{
				alert("Please enter valid Date (e.g. 12/27/2002)");
				return false;
			}	
		}
	}
	if(year < 1900 || year > 2050)
	{
		alert("Please enter year between 1900 and 2050");
		return false;
	}
	return true;
}

// Validate Date


function validateDate(startDate,endDate)
{
	
	var TodayDate
	var stDate
	TodayDate = new Date()
	stDate = new Date(startDate)
	enDate = new Date(endDate)
			
	if (TodayDate < stDate)
	{
		alert("From Date cannot be the future date")
		return false;
	}
	if (TodayDate < enDate)
	{
		alert("To Date cannot be the future date")
		return false;
	}
	if (enDate < stDate)
	{
		alert("Invalid Date range selection");
		return false;
	}
	return true;
}

// Validate Date


function isDateBefore(date1Name,date1Value,date2Name,date2Value)
{
	//check that the renew date is not lesser than the date rented
	var vDate1 = convertStringToDate(date1Value,5);
	var vDate2= convertStringToDate(date2Value,5);
	
	if(vDate1<vDate2)
	{
		alert(date1Name+" cannot be earlier than the "+date2Name+".");
		return false;
	}
	return true;
}

// Validate Date


function isDateAfter(date1Name,date1Value,date2Name,date2Value)
{
	//check that the renew date is not lesser than the date rented
	var vDate1 = convertStringToDate(date1Value,5);
	var vDate2= convertStringToDate(date2Value,5);
	
	if(vDate1>vDate2)
	{
		alert(date1Name+" cannot be later than the "+date2Name+".");
		return false;
	}
	return true;
}

//Validation for field which cannot contains symebol


function isValidString(fieldname , fieldvalue)
{
	var fieldString = checkTrim(fieldvalue);
	var checkString = '~!@$%^*()-+=?><"';
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}

//Validation for field which contains file name


function isValidFileName(fieldname , fieldvalue)
{
	var fieldString = checkTrim(fieldvalue);
	var checkString = "\"~!@#$%^&*()+=|[]{}?><,:;'/\\";
	
	for(i=0;i<fieldString.length;i++) {
		for(j=0;j<checkString.length;j++) {
		   	if(fieldString.charAt(i) == checkString.charAt(j)) {
		   		alert('Invalid '+fieldname+'');
    	   		return false;
			}
	   }
	}
	return true;
}

//Validation for field which allows only float numbers - allow also negative values


function isValidFloat(fieldname , fieldvalue)
{
	var str = fieldvalue;
	var str1;
	i = 0;
	j=0;
	while(i < str.length)
	{
		if((!((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))) && (str.charAt(i) != ".") && (str.charAt(i) != "-"))
		{
			alert(fieldname+' is not valid\n\n e.g -57.55');
			return false;
		}

		if(str.charAt(i) == ".")
			j++;
			
		if(str.charAt(i) == "-"){
			if( i != 0 ){
				alert(fieldname+' is not valid\n\n e.g 57.55');
				return false;
			}
		}
		i++;
	}
	if(j>1)
	{
		alert(fieldname+' is not valid\n\n e.g 57.55');
		return false;
	}
	if(str.indexOf('.')>=0)
	{
		str1=str.substring(str.indexOf('.'),str.length-1);
		if(str1.length>2)
		{
			alert(fieldname+' is not valid\n\n e.g 57.55');
			return false;
		}
	}
	return true;
}

//Validation for field which allows only numbers


function isFloat(fieldname , fieldvalue)
{
	var str = fieldvalue;
	var str1;
	i = 0;
	j=0;
	if(str.charAt(0)==".")
	{
		alert(fieldname+' is not valid\n\n e.g 57.55');
		return false;
	}
	while(i < str.length)
	{
		if((!((str.charAt(i) >= "0") && (str.charAt(i) <= "9"))) && (str.charAt(i) != "."))
		{
			alert(fieldname+' is not valid\n\n e.g 57.55');
			return false;
		}
		if(str.charAt(i) == ".")
			j++;
		i++;
	}
	if(j>1)
	{
		alert(fieldname+' is not valid\n\n e.g 57.55');
		return false;
	}
	if(str.indexOf('.')>=0)
	{
		str1=str.substring(str.indexOf('.'),str.length-1);
		if(str1.length>2)
		{
			alert(fieldname+' is not valid\n\nOnly 2 digits allowed after the decimal');
			return false;
		}
	}
	return true;
}

//Validation for field which can not allow < and > and ".


function isValid(fieldname , fieldvalue)
{
	var str = fieldvalue;
	i = 0;
	while(i < str.length)
	{
		if((str.charAt(i) == '<') || (str.charAt(i) == '>') || (str.charAt(i) == '\"') || (str.charAt(i) == '\'') || (str.charAt(i) == ' '))
		{
			alert('Invalid '+ fieldname+'');
			return false;
		}
		i++;
	}
	return true;
}


/*************************************************************************\
String getExpiryDate()
return the expiry date.
\*************************************************************************/


function getExpiryDate() {
	return this.month + "/" + this.year;
}



function getSelectedCount(frm, FieldID, FieldType)
{
	var total = 0;
	
	for(var i = 0; i < frm.length; i++) {
		var element = frm.elements[i];
		var type = element.type;
		var id = element.id;
		if(type == FieldType && id == FieldID && element.checked == true) {
			total = parseInt(total) + 1;
		}
	}
	
	total = parseInt(total);
	return total;
}


function isConfirmpass(fieldname1,fieldname2)
{
	if(fieldname1!=fieldname2)
	{
		alert("Passwords do not match.");
		return true;
	}
	return false;
}



function IsSpecial_Char(fieldname,fieldvalue){
  
  var iChars = "!@#$%^&*()+=[]\\\';,./{}|\":<>?";

  for (var i = 0; i < fieldvalue.length; i++) {
  	if (iChars.indexOf(fieldvalue.charAt(i)) != -1) {
  	
	alert (fieldname+" has special characters. \nThese are not allowed.");
  	
	return true;
  	
	}
  }
  return false;
}


//for validate image


function isValidateimage(fieldvalue,exten) {
var fup =checkTrim(fieldvalue);
var fileName = fup;
var stringArray = exten.split(",");
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
for (var i = 0; i < stringArray.length; i++){
if(ext == stringArray[i])
{
return true;
}
}
window.alert("Upload "+exten+" images only.");
return false;
}
//example
//if(!isValidateimage(document.getElementById('uploader').value,"jpg,JPEG,jpeg,JPG")){
//document.getElementById('uploader').focus();
//return false;
//}

//to print a particular div


function printDiv(id)
{
//alert("Hello world");
var content = "<html>";
content += document.getElementById(id).innerHTML ;
content += "</body>";
<!-- // Body -->";
content += "</html>";
<!-- // HTML -->";

var printWin = window.open('','','left=0,top=0,width=1000,height=500,toolbar=0,scrollbars=0,status =0');
printWin.document.write(content);
printWin.document.close();
printWin.focus();
printWin.print();
printWin.close();
}



function ajax_call(controller,data)
{
	var ajax_new_data=$.ajax({
		url:controller,
		data:data,
		cache:false,
		async:false,
		success:function(response)
		{}
	}).reponseText;
	return ajax_new_data;
}




function selectAll()
{   
 var cnt=document.getElementById("counter").value;
	if(document.getElementById("select").checked==true)
		
	{
		for( var i=0;i<cnt;i++)
		{
			document.getElementById("c"+i).checked=true;
			$('#uniform-c'+i).attr('class','checker focus');
			$('#uniform-c'+i+' span').attr('class','checker checked');
			//alert(document.getElementById("c"+i).checked);
			
		}
	}
	if(document.getElementById("select").checked==false)
	{
		for( var i=0;i<cnt;i++)
		{
			document.getElementById("c"+i).checked=false;
			$('#uniform-c'+i).attr('class','checker');
			$('#uniform-c'+i+' span').attr('class','checker');
			
		}
	}
}
//for checking checked value


function deleteselected(cnt,doc_name){
	var t='';
	for( var i=0;i<cnt;i++){
		if(document.getElementById(doc_name+i).checked==true){
			 t = 1;
			break;
		}
	}
	if(t!=1){
		alert("Please select atleast one value to delete.");
		return false;
	} else {
		return confirm('Are you sure you want to delete?');
		return true;
	}
}




function atleastOneChecked(name,confirm_val,msg){
	//alert(name);
	if($("[name='"+name+"']:checked").length>0)
	{
		return confirm(confirm_val);
	}{
		alert(msg);	
	}
	return false;
}

	

	 
function limits(obj, limit){
			var text = $(obj).val(); 
			var length = text.length;
			if(length > limit){
			   $(obj).val(text.substr(0,limit));
			 } else { // alert the user of the remaining char. I do alert here, but you can do any other thing you like
			 }
		 }
	

	 
function dmydate(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}		 



function in_array (needle, haystack, argStrict) {
  // From: http://phpjs.org/functions
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: vlado houba
  // +   input by: Billy
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
  // *     returns 1: true
  // *     example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
  // *     returns 2: false
  // *     example 3: in_array(1, ['1', '2', '3']);
  // *     returns 3: true
  // *     example 3: in_array(1, ['1', '2', '3'], false);
  // *     returns 3: true
  // *     example 4: in_array(1, ['1', '2', '3'], true);
  // *     returns 4: false
  var key = '',
    strict = !! argStrict;

  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }

  return false;
}



function act(sym,id)
{
	var a=document.getElementById(id).value;
	if(sym=='dec')
	{
		a=parseInt(a)-1;	
	}else{
		a=parseInt(a)+1;	
	}
	a=(a==0)?1:a;
	document.getElementById(id).value=a;
}




function commaSepEmail(emailValue2) {
var emailFilter2=/(([a-zA-Z0-9\-?\.?]+)@(([a-zA-Z0-9\-_]+\.)+)([a-z]{2,3})(\W?[,;]\W?(?!$))?)+$/i;

if (!(emailFilter2.test(emailValue2))) {
return false;
}else{
return true;
}
} 