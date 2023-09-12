//Function to create Ajax Object-----------------------------------------------------------------------------------
function createajax()
{
   var objectname = false;	
	try { objectname = new ActiveXObject('Msxml2.XMLHTTP'); } 
	catch (e)
	{
		try { objectname = new ActiveXObject('Microsoft.XMLHTTP'); } 
		catch (e)  
		{
			try { objectname = new XMLHttpRequest();	} 
			catch (e) {  alert('Your browser is not responding for Javascripts.'); return false; }
		}
	}
	return objectname;
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

function successsearchmessage(message)
{
	var msg = '<div class="successsearchbox">' + message + '</div>';
	return msg;
}


//Function to Validate the email ID---------------------------------------------------------------------------------
function checkemail(a)
{
	var r1 = new RegExp('(@.*@)|(\\.\\.)|(@\\.)|(^\\.)');
	var r2 = new RegExp('^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,4}|[0-9]{1,4})(\\]?)$');
	return (!r1.test(a) && r2.test(a));
}

function cellvalidation(cellnumber)
{
 var numericExpression = /^[7|8|9]+[0-9]{9,9}$/i;
 if(cellnumber.match(numericExpression)) return true;
 else return false;
}

function contactpersonvalidate(contactname)
{
 var numericExpression = /^([A-Z\s\()]+[a-zA-Z\s()])$/i;
 if(contactname.match(numericExpression)) return true;
 else return false;
}

function checkemail(mailid)
{
  var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
  var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
  return (!r1.test(mailid) && r2.test(mailid));
}

//Function to get the value of selected radio element---------------------------------------------------------------
function getradiovalue(radioname)
{
	if(radioname.value)
		return radioname.value;
	else
	{
		for(var i = 0; i < radioname.length; i++) 
		{
			if(radioname[i].checked) 
				return radioname[i].value;
		}
	}
}

//Function to set the value of selected radio element---------------------------------------------------------------
function setradiovalue(radioObj, newValue) 
{
	if(!radioObj)
		return false;
	var radioLength = radioObj.length;
	if(radioLength == undefined) 
	{
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) 
	{
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) 
		{
			radioObj[i].checked = true;
		}
	}
}

//Function to make the display as block as well as none-------------------------------------------------------------
function showhide(elementid,imgname)
{
	var element = document.getElementById(elementid);
	if(element.style.display == 'none')
	{
		element.style.display = 'block';
		if(document.getElementById(imgname))
			document.getElementById(imgname).src = "../images/minus.jpg";
	}
	else
	{
		element.style.display = 'none';
		if(document.getElementById(imgname))
			document.getElementById(imgname).src = "../images/plus.jpg";
	}
}
//function to validate the GSTIN
function validategstin(contactname)
{
 var numericExpression = /^[a-zA-Z0-9_.-]*$/i;
 if(contactname.match(numericExpression)) return true;
 else return false;
}

/*function validategstinregex(value,stategstcode) {
 var valueEntered = value;
 var stategstcode = stategstcode;
 
 
 var valueEntered_new = valueEntered.substring(0, 2);
 //alert(stategstcode + valueEntered)
 //if(contactname.match(numericExpression)) return true;
 //else return false;
  if(valueEntered_new != stategstcode) {
    return false;
  }
  else
  {
      return true;
  }
}*/

//Function to make the display as only block------------------------------------------------------------------------
function blockelement(elementid)
{
	var element = document.getElementById(elementid);
	if(element.style.display == 'none')
		element.style.display = 'block';
}

//Function to make the display as only hide-------------------------------------------------------------------------
function hideelement(elementid)
{
	var element = document.getElementById(elementid);
	if(element.style.display == 'block')
		element.style.display = 'none';
}

//Function to clear the values on new entry-------------------------------------------------------------------------
function newentry()
{
	if(document.getElementById('lastslno'))
		document.getElementById('lastslno').value = '';
		
	if(document.getElementById('displayregisters'))
		document.getElementById('displayregisters').innerHTML = '';
	if(enablesave())	
		enablesave();
	if(disabledelete())
		disabledelete();
		//gettime()
	/*if(formsubmitcustomer())
		formsubmitcustomer();*/
	$('#productversiondisplay').html('<select name="productversion" id="productversion" class="swiftselect"><option value="">Select a Product</option></select>');

}

//Function to clear the inner html on new entry/save/delete/gridtoform/---------------------------------------------
function clearinnerhtml()
{
	if(document.getElementById('form-error'))
		document.getElementById('form-error').innerHTML = '';
	if(document.getElementById('filter-form-error'))
		document.getElementById('filter-form-error').innerHTML = '';
}

//Function to enable the delete button------------------------------------------------------------------------------
function enabledelete()
{
	document.getElementById('delete').disabled = false;
	document.getElementById('delete').className = 'swiftchoicebutton';
}

//Function to enable the save button--------------------------------------------------------------------------------
function enablesave()
{
	document.getElementById('save').disabled = false;
	document.getElementById('save').className = 'swiftchoicebutton';
}

//Function to enable the error report button------------------------------------------------------------------------
function enableexcelreport()
{
	document.getElementById('errorreport').disabled = false;
	document.getElementById('errorreport').className = 'swiftchoicebutton-orange';
}

//Function to enable the requirement report button------------------------------------------------------------------
function enableexcelreport1()
{
	document.getElementById('requirementreport').disabled = false;
	document.getElementById('requirementreport').className = 'swiftchoicebutton-orange';
}

//Function to disable the delete button-----------------------------------------------------------------------------
function disabledelete()
{
	document.getElementById('delete').disabled = true;
	document.getElementById('delete').className = 'swiftchoicebuttondisabled';
	document.getElementById('delete').style.cursor = '';
}
//Function to disable the excel report button-----------------------------------------------------------------------
function disableexcelreport()
{
	document.getElementById('errorreport').disabled = true;
	document.getElementById('errorreport').className = 'swiftchoicebuttondisabled';
	document.getElementById('errorreport').style.cursor = '';
}

//Function to disable the excel report button-----------------------------------------------------------------------
function disableexcelreport1()
{
	document.getElementById('requirementreport').disabled = true;
	document.getElementById('requirementreport').className = 'swiftchoicebuttondisabled';
	document.getElementById('requirementreport').style.cursor = '';
}

//Function to disable the save button--------------------------------------------------------------------------------
function disablesave(){
	document.getElementById('save').disabled = true;
	document.getElementById('save').className = 'swiftchoicebuttondisabled';
	document.getElementById('delete').style.cursor = '';
}

//Function to change the css of active tab and select the tab in navigation part------------------------------------
function navigationtab(activetab,tabgroupname,hoverclass,divlinecolor,subdivcolor)
{
	var totaltabs = document.getElementById('navigationtabcount').value;
	var activetabheadclass = hoverclass;
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		var tabline = tabgroupname + 't' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabline).className = divlinecolor;
			document.getElementById(tabcontent).className = subdivcolor;
			document.getElementById(tabcontent).style.display = 'block';
			document.getElementById(tabline).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = '';
			document.getElementById(tabline).className = '';
			document.getElementById(tabcontent).className = '';
			document.getElementById(tabcontent).style.display = 'none';
			document.getElementById(tabline).style.display = 'none';
		}
	}
}

//Function to change the css of active tab and select the tab in dashboard part-------------------------------------
function dashboardtab(activetab,tabgroupname)
{
	var totaltabs = 8;
	var activetabheadclass = 'dashboard-active-tab';
	var tabheadclass = 'dashboard-tab';
	
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

//Function to change the css of active tab and select the tab in display grid part----------------------------------
function gridtab4(activetab,tabgroupname)
{
	var totaltabs = 4;
	var activetabheadclass = 'grid-active-tabclass';
	var tabheadclass = 'grid-tabclass';
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		var tabwaitbox = tabgroupname + 'wb' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
			document.getElementById(tabwaitbox).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
			document.getElementById(tabwaitbox).style.display = 'none';
		}
	}
}

//Function to change the css of active tab and select the tab in display grid part----------------------------------
function gridtab2(activetab,tabgroupname)
{
	var totaltabs = 2;
	var activetabheadclass = 'grid-active-tabclass';
	var tabheadclass = 'grid-tabclass';
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		var tabwaitbox = tabgroupname + 'wb' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
			document.getElementById(tabwaitbox).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
			document.getElementById(tabwaitbox).style.display = 'none';
		}
	}
}
//Function to make the display as block as well as none-------------------------------------------------------------
/*function displayelement(displayelementid,hideelementid)
{
	var delement = document.getElementById(displayelementid);
	var helement = document.getElementById(hideelementid);
	delement.style.display = 'block'; 
	helement.style.display = 'none'; 
}*/

function gridtabcus4(activetab,tabgroupname,tabdescription)
{
	var totaltabs = 3;
	var activetabheadclass = 'grid-active-tabbigclass';
	var tabheadclass = 'grid-tabbigclass';
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		var tabwaitbox = tabgroupname + 'wb' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
			if(document.getElementById(tabwaitbox)) { document.getElementById(tabwaitbox).style.display = 'block'; }
			document.getElementById('tabdescription').innerHTML = tabdescription;
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
			if(document.getElementById(tabwaitbox)) { document.getElementById(tabwaitbox).style.display = 'none'; }
			//document.getElementById('tabdescription').innerHTML = '';
		}
	}
}
//Function to display a error message if the script failed-Meghana[11/12/2009]
function scripterror()
{
	var msghtml = '<div class="errorbox">Unable to Connect....</div>';
	return msghtml;
}
//Function to check whether it is only a number---------------------------------------------------------------------
function isanumber(onechar)
{
	if(onechar.charCodeAt(0) >= 48 && onechar.charCodeAt(0) <= 57)
		return true;
	else
		return false;
}


//Function to load the functions on body load-----------------------------------------------------------------------
function bodyonload()
{
	if(!GetCookie('navigationcookie'))
		navigationtab('1','tabgroup1','home-nav','home-nav-div-line','home-nav-sub-div');  
	else
	{
		var getnavigationcookie = GetCookie('navigationcookie').split('|'); 
		navigationtab(getnavigationcookie[0],getnavigationcookie[1],getnavigationcookie[2],getnavigationcookie[3],getnavigationcookie[4]);  
		//alert(getnavigationcookie[0]);
	}
	if(window.datagrid) { datagrid(); }
	if(window.flags) { flags(); }
	if(window.formsubmitcustomer) { formsubmitcustomer(); }
	if(window.onsitependingvisitreport) { onsitependingvisitreport(); }
}

//Function to enable all the form elements--------------------------------------------------------------------------
function enableformelements(formname)
{
	var theform = document.getElementById(formname);
	if (document.all || document.getElementById) 
	{
		for (i = 0; i < theform.length; i++)
		{
			var formElement = theform.elements[i];
			if (true)
				formElement.disabled = false;
		}
	}
}

//Function to disable all the form elements-------------------------------------------------------------------------
function disableformelements(formname)
{
	var theform = document.getElementById(formname);
	if (document.all || document.getElementById) 
	{
		for (i = 0; i < theform.length; i++)
		{
			var formElement = theform.elements[i];
			if (false)
				formElement.disabled = true;
		}
	}
}

//Function to escape the single and convert as \' wherever it has been passed with single quotes--------------------
function escapesinglequotes(str)
{
	var character;
	var result = "";
	for(i=0;i<=str.length;i++)
	{
		character = str.charAt(i);
		if(character == "'")
 			character = "\'";
 		result = result + character;
	}
	return result;
}

//Function to block the getcustomer div and hide other divs [Common Function] used in most of the pages-------------
function getcustomerfunc()
{
	if(document.getElementById('contentdiv')) document.getElementById('contentdiv').style.display = 'none';
	if(document.getElementById('nameloaddiv')) document.getElementById('nameloaddiv').style.display = 'block';
	if(document.getElementById('questionload')) document.getElementById('questionload').style.display = 'none';
}

//Function to block the hetquestion div and hide other divs [Common Function] used in most of the pages
function getquestionfunc()
{
	if(document.getElementById('contentdiv')) document.getElementById('contentdiv').style.display = 'none';
	if(document.getElementById('nameloaddiv')) document.getElementById('nameloaddiv').style.display = 'none';
	if(document.getElementById('questionload')) document.getElementById('questionload').style.display = 'block';
}

//Function to block the main div and hide other divs [Common Function] used in most of the pages--------------------
function getcontentdivfunc()
{
	if(document.getElementById('contentdiv')) document.getElementById('contentdiv').style.display = 'block';
	if(document.getElementById('nameloaddiv')) document.getElementById('nameloaddiv').style.display = 'none';
	if(document.getElementById('questionload')) document.getElementById('questionload').style.display = 'none';
}

/*//Function to get the userid according to the supportunit selected--------------------------------------------------
function useronsupportunit(selectid, comparevalue)
{
	var supportunit = document.getElementById('supportunit').value;
		passData = "supportunit=" + supportunit  + "&dummy=" + Math.floor(Math.random()*1100011000000);
		userDisplay = document.getElementById('assignedtoDisplay');
	ajaxcall = createajax();
	var queryString = "../ajax/useridsonsupportunits.php";
	ajaxcall.open("POST", queryString, true);
	ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall.onreadystatechange = function()
	{
		if(ajaxcall.readyState == 4)
		{
			userDisplay.innerHTML = ajaxcall.responseText;
			if(selectid && comparevalue)
			autoselect(selectid, comparevalue);
		}
	}
	ajaxcall.send(passData);
}

//Function to get the userid according to the supportunit selected--------------------------------------------------
function useronsupportunit1(selectid, comparevalue)
{
	var supportunit = document.getElementById('supportunit').value;
		passData = "supportunit=" + supportunit  + "&dummy=" + Math.floor(Math.random()*1100011000000);
		userDisplay = document.getElementById('useridDisplay1');
	ajaxcall = createajax();
	var queryString = "../ajax/useridsonsupportunits1.php";
	ajaxcall.open("POST", queryString, true);
	ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall.onreadystatechange = function()
	{
		if(ajaxcall.readyState == 4)
		{
			userDisplay.innerHTML = ajaxcall.responseText;
			if(selectid && comparevalue)
			autoselect(selectid, comparevalue);
		}
	}
	ajaxcall.send(passData);return true;
}*/


//Function to select the particular option in <SELECT> Tag, with the compare value----------------------------------
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

//Function to check the particular option in <input type =check> Tag, with the compare value------------------------
function autocheck(selectid,comparevalue)
{
	var selection = selectid;
		if('yes' == comparevalue)
		{
			selection.checked = true;
			return;
		}
		else
		{
			selection.checked = false;
			return;
		}
}

//Function to toggle Div, with Plus/Minus image---------------------------------------------------------------------
function togPlus(objDiv,objImg)
{
	if(document.getElementById(objDiv))
	{
		var myElement = document.getElementById(objDiv);    
		if (myElement.style.display == "none")
		{
      myElement.style.display = "block";
      objImg.src = "getImage.php?src=collapse.gif";
		}
		else
		{
      myElement.style.display = "none";
      objImg.src = "getImage.php?src=expand.gif";
		}
	}
}

//Function to check whether it is a number--------------------------------------------------------------------------
function isInteger(s)
{
	var i;
	var myflag = true;
    for (i = 0; i < s.length; i++)
	{   
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
			myflag = false;
		else
			myflag = true;
    }
    return myflag;
}

//Function to check whether it is a number--------------------------------------------------------------------------
function isIntegerwithdecimal(s)
{
	var i;
	var myflag = true;
    for (i = 0; i < s.length; i++)
	{   
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
			myflag = false;
		else
			myflag = true;
    }
    return myflag;
}

//Function to check whether the string is alphanumeric--------------------------------------------------------------
function isAlpha(element)
{
	var myflag = true;
	for(i=0; i<element.length; i++)
	{
		if(((element.charCodeAt(i) >= 65 && element.charCodeAt(i) <= 90) || (element.charCodeAt(i) >= 97 && element.charCodeAt(i) <= 122) || (element.charCodeAt(i) == 32) || (element.charCodeAt(i) == 46)) && myflag == true)
			myflag = true;
		else
			myflag = false;
	}
	return myflag;
}

//Function to compare two date fields-------------------------------------------------------------------------------
function comapre2dates(firstdate,seconddate)
{
	var date1 = firstdate;
	var date2 = seconddate;
	if (date1 > date2)
		return false;
	else
		return true;
}

//Function to make the date field readonly if the key is not delete or backspace------------------------------------
function datemakereadonly(e,element)
{
	if(e.keyCode == 46 || e.keyCode == 8)
	{
		document.getElementById(element).readOnly = false;
	}
	else
	{
		document.getElementById(element).readOnly = true;
		displayDatePicker(element);
	}
}


//Function to generate random password------------------------------------------------------------------------------
function randomPassword()
{
  chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  pass = "";
  for(x=0;x<10;x++)
  {
    i = Math.floor(Math.random() * 62);
    pass += chars.charAt(i);
  }
  return pass;
}

//Function to print the selected content----------------------------------------------------------------------------
function printContent(id)
{
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}

//Function to the value of the check box which is in group----------------------------------------------------------
function get_check_value(checkboxname)
{
	var c_value = "";
	var checkbox = document.getElementsByName(checkboxname);
	for (var i=0; i < checkbox.length; i++)
	{
		if (checkbox[i].checked)
		{
			c_value = c_value + checkbox[i].value + "^^^";
		}
	}
return c_value;
}

function gettime()
{
		passData = "type=gettime&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall5 = createajax();
		//document.getElementById('tabgroupgridwb5').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/call-register.php";
		ajaxcall5.open("POST", queryString, true);
		ajaxcall5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall5.onreadystatechange = function()
		{
			if(ajaxcall5.readyState == 4)
			{
				var response = ajaxcall5.responseText;
				document.getElementById('time').value = response;
			}
		}
		ajaxcall5.send(passData);
}

function getprocessingimage()
{
	var imagehtml = '<img src="../images/imax-loading-image.gif" border="0"/>';
	return imagehtml;
}


function in_array(checkvalue, arrayobject) 
{
	for(var i = 0, l = arrayobject.length; i < l; i++) 
	{
		if(arrayobject[i] == checkvalue) 
		{
			return true;
		}
	}
	return false;
}


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


function productnamefunction(selectid,comparevalue,version)
{
	var productgroup = document.getElementById('productgroup').value;
	var nameDisplay = document.getElementById('productnamedisplay');
	passData = "productgroup=" + productgroup +"&dummy=" + Math.floor(Math.random()*1100011000000);
	//alert(passData);
	ajaxcallp = createajax();
	var queryString = "../inc/productname.php";
	ajaxcallp.open("POST", queryString, true);
	ajaxcallp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcallp.onreadystatechange = function()
	{
		if(ajaxcallp.readyState == 4)
		{
			nameDisplay.innerHTML = ajaxcallp.responseText;
			if(selectid && comparevalue)
			autoselect(selectid,comparevalue);
			//$('#productversiondisplay').html('<select name="productversion" id="productversion" class="swiftselect"><option value="">Select a Product</option></select>');

			productversionFunction('productversion',comparevalue,version);
		}
	}
	ajaxcallp.send(passData);return true;
}

//Function to get the product version according to the product selected---------------------------------------------
function productversionFunction(selectid,comparevalue,version)
{
	//alert (selectid + ' '+comparevalue);
	var productname = document.getElementById('productname').value;
	var versionDisplay = document.getElementById('productversiondisplay');
	passData = "productname=" + productname + "&productversion=" + version  + "&dummy=" + Math.floor(Math.random()*1100011000000);
	//alert(passData);
	ajaxcallp = createajax();
	var queryString = "../ajax/productversion.php";
	ajaxcallp.open("POST", queryString, true);
	ajaxcallp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcallp.onreadystatechange = function()
	{
		if(ajaxcallp.readyState == 4)
		{
			versionDisplay.innerHTML = ajaxcallp.responseText;
			if(selectid && comparevalue)
			autoselect(selectid, comparevalue);
		}
	}
	ajaxcallp.send(passData);return true;
}






function emailchk(email,chkmailbox)
{
	if($(chkmailbox).attr('checked'))
	{
		document.getElementById(email).style.display = 'block';
		/*var passData = "type=savemail&emailid=" + encodeURIComponent(document.getElementById('emailid').value) ;
		ajaxobject38 = $.ajax({
							type:"POST",
							data:passdata,
							url:"../inc/mail.php",
							cache:false,
							success: function(response,status)
							{
								$("#email").html(response);
							}
					});*/
	}
	else
	{
		document.getElementById(email).style.display = 'none';
	}
}


