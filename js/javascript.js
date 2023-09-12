// JavaScript Document

/* Author: Bhavesh Patel, Relyon Softech Ltd*/
/* All codes below are Copyright Protected */

function tabopen5(activetab,tabgroupname)
{
	var totaltabs = 2;
	var activetabheadclass = "producttabheadactive";
	var tabheadclass = "producttabhead";
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
		}
	}
}

function tabopen3(activetab,tabgroupname)
{
	var totaltabs = 3;
	var activetabheadclass = "vertabheadactive";
	var tabheadclass = "vertabhead";
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
		}
	}
}

function getprocessingimage()
{
	var imagehtml = '<img src="./images/imax-loading-image.gif" border="0"/>';
	return imagehtml;
}

function getsuccessimage()
{
	var imagehtml = '<img src="./images/green-status.gif" border="0"/>';
	return imagehtml;
}

function getunsuccessimage()
{
	var imagehtml = '<img src="./images/icon_error.gif" border="0"/>';
	return imagehtml;
}


function autoselect(selectid,comparevalue)
{
	var selection = document.getElementById(selectid);
	for(var i = 0; i < selection.length; i++) 
	{
		if(selection[i].value == comparevalue)
		{
			selection[i].selected = "1";
			return;
		}
	}
}


function numbervalid(element)
{
	if (isNaN(element.value))
	{
		element.value = "";
		element.focus();
		return false;
	}
}

//Function to check whether the string is alphanumeric
function isAlpha(element)
{
	var myflag = true;
	for(i=0; i<element.length; i++)
	{
		if(((element.charCodeAt(i) == 46) || (element.charCodeAt(i) == 32) || (element.charCodeAt(i) >= 65 && element.charCodeAt(i) <= 90) || (element.charCodeAt(i) >= 97 && element.charCodeAt(i) <= 122) || (element.charCodeAt(i) >= 45 && element.charCodeAt(i) <= 57)) && myflag == true)
		{
			myflag = true;
		}
		else
		{
			myflag = false;
		}
	}
	return myflag;
}

//Function to check whether the string is alphanumeric
function validatecontactnumber(element)
{
	var myflag = true;
	for(i=0; i<element.length; i++)
	{
		if(((element.charCodeAt(i) == 32) || (element.charCodeAt(i) == 45) || (element.charCodeAt(i) >= 48 && element.charCodeAt(i) <= 57)) && myflag == true)
		{
			myflag = true;
		}
		else
		{
			myflag = false;
		}
	}
	return myflag;
}

//Function to check the vaslid format of email ID [Common Function]
function checkemail(a)
{
  var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
  var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
  return (!r1.test(a) && r2.test(a));
}

//Function to display the error message in box---------------------------------------------------------------------
function errormessage(message)
{
	var msg = '<div class="errorbox">' + message + '</div>';
	return msg;
}

//Function to display the success message in box-------------------------------------------------------------------
function successmessage(message)
{
	var msg = '<div class="successbox">' + message + '</div>';
	return msg;
}

function validatephone(phonenumber)
{
	var numericExpression = /^([^9]\d{5,9})(?:(?:[,;]([^9]\d{5,9})))*$/i;
	if(phonenumber.match(numericExpression)) return true;
	else return false;
}

function validatestdcode(stdcodenumber)
{
	var numericExpression = /^[0]+[0-9]{2,4}$/i;
	if(stdcodenumber.match(numericExpression)) return true;
	else return false;
}

function createajax()
{
   var objectname = false;	
	try { /*Internet Explorer Browsers*/ objectname = new ActiveXObject('Msxml2.XMLHTTP'); } 
	catch (e)
	{
		try { objectname = new ActiveXObject('Microsoft.XMLHTTP'); } 
		catch (e)  
		{
			try { /*// Opera 8.0+, Firefox, Safari*/ objectname = new XMLHttpRequest();	} 
			catch (e) { /*Something went wrong*/ alert('Your browser is not responding for Javascripts.'); return false; }
		}
	}
	return objectname;
}

function successsearchmessage(message)
{
	var msg = '<div class="successsearchbox">' + message + '</div>';
	return msg;
}

function validatecell(cellnumber)
{
	var numericExpression = /^[7|8|9]\d{9}(?:(?:([,][\s]|[;][\s]|[,;])[7|8|9]\d{9}))*$/i;
	//var numericExpression = /^((\+)?(\d{2}[-]))?(\d{10})?$/i ;
	if(cellnumber.match(numericExpression)) return true;
	else return false;
}

function processing()
{
return '<img src="./images/aj_loader.gif" width="43" height="11" />';	
}

//Function to display a error message if the script failed
function scripterror()
{
	var msghtml = "<div class='msgboxred'>Unable to Connect....</div>";
	return msghtml;
}
function scripterror1()
{
	var msghtml = "<strong>Unable to Connect....</strong>";
	return msghtml;
}

//comparing two dates
function compare2dates(smallone,largeone)
{
   var str1  = smallone;
   var str2  = largeone;
   var dt1   = parseInt(str1.substring(0,2),10);
   var mon1  = parseInt(str1.substring(3,5),10);
   var yr1   = parseInt(str1.substring(6,10),10);
   var dt2   = parseInt(str2.substring(0,2),10);
   var mon2  = parseInt(str2.substring(3,5),10);
   var yr2   = parseInt(str2.substring(6,10),10);
   var date1 = new Date(yr1, mon1, dt1);
   var date2 = new Date(yr2, mon2, dt2);

   if(date2 < date1)
      return false;
   else
      return true;
} 

function checkdate(datevalue) //dd-mm-yyyy Eg: 01-04-2008
{
	if(datevalue.length == 10)
	{
		if(isanumber(datevalue.charAt(0)) && isanumber(datevalue.charAt(1)) && isanumber(datevalue.charAt(3)) && isanumber(datevalue.charAt(4)) && isanumber(datevalue.charAt(6)) && isanumber(datevalue.charAt(7)) && isanumber(datevalue.charAt(8)) && isanumber(datevalue.charAt(9)) && datevalue.charAt(2) == '-' && datevalue.charAt(5) == '-')
			return true;
		else
			return false;
	}
	else
		return false;
}

function isanumber(onechar)
{
	if(onechar.charCodeAt(0) >= 48 && onechar.charCodeAt(0) <= 57)
	{
		return true;
	}
	else
		return false;
}

