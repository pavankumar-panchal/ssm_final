//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.username;
	if(!field.value) { error.innerHTML = errormessage('Enter User ID'); field.focus(); return false; }
	var field = form.type;
	if(!field.value) { error.innerHTML = errormessage('Select the Type'); field.focus(); return false; }
	var field = form.existinguser;
	if(!field.value) { error.innerHTML = errormessage('Select Existing user or not'); field.focus(); return false; }
	var field = form.reportingauthority;
	if(form.type.value == 'EXECUTIVE-OTHERS' || form.type.value == 'EXECUTIVE-ONSITE')
	{
	if(!field.value) { error.innerHTML = errormessage('Select reporting Authority'); field.focus(); return false; }
	}
	var field = form.supportunit;
	if(form.type.value == 'EXECUTIVE-OTHERS' || form.type.value == 'EXECUTIVE-ONSITE' || form.type.value == 'TEAMLEADER')
	{
	if(!field.value) { error.innerHTML = errormessage('Select Support Unit'); field.focus(); return false; }
	}
	var field = form.mobile;
	if(field.value)	{
	if(isNaN(field.value)) { error.innerHTML = errormessage('Mobile Number should contain only the Numerals.'); field.focus(); return false; }}
	var field = form.emergencynumber;
	if(field.value)	{
	if(isNaN(field.value)) { error.innerHTML = errormessage('Emergency Contact Number should contain only integers.'); field.focus(); return false; }}
	var field = form.personalemail;
	if(field.value)	{ var a = checkemail(field.value); if(a == false) { error.innerHTML = errormessage('Enter the correct Personal Email ID.'); field.focus(); return false; } }
	var field = form.officialemail;
	if(field.value)
	{var b = checkemail(field.value); if(b==false){error.innerHTML = errormessage('Enter the correct Official Email ID.'); field.focus(); return false;}}
	var field = form.locationname;
	if(!field.value) { error.innerHTML = errormessage('Select the Location Name'); field.focus(); return false; }
	var field = form.fullname;
	if(!field.value) { error.innerHTML = errormessage('Enter the full name'); field.focus(); return false; }
	else
	{
		if(command == 'delete')
			passData = 'switchtype=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			
			passData = 'switchtype=save&lastslno=' + form.lastslno.value + '&username=' + form.username.value + '&password=' + form.password.value + '&type=' + form.type.value + '&existinguser=' + form.existinguser.value + '&reportingauthority=' + form.reportingauthority.value + '&supportunit=' + form.supportunit.value + '&locationname=' + form.locationname.value + '&fullname=' + form.fullname.value + '&gender=' + form.gender.value + '&presentaddress=' + form.presentaddress.value + '&permanentaddress=' + form.permanentaddress.value + '&mobile=' + form.mobile.value + '&emergencynumber=' + form.emergencynumber.value + '&emergencyremarks=' + form.emergencyremarks.value + '&dob=' + form.dob.value + '&doj=' + form.doj.value + '&designation=' + form.designation.value + '&personalemail=' + form.personalemail.value + '&officialemail=' + form.officialemail.value  + '&dol=' + form.dol.value + '&dummy=' + Math.floor(Math.random()*10019200000);//alert(passData)
		queryString = '../ajax/create-user.php';
		var ajaxcall0 = createajax();
		document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		ajaxcall0.open('POST', queryString, true);
		ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxcall0.onreadystatechange = function()
		{
			if(ajaxcall0.readyState == 4)
			{
				document.getElementById('tabgroupgridwb1').innerHTML = '';
				var response = (ajaxcall0.responseText).split('^');//alert(response)
				if(response[0] == 1)
				{
					error.innerHTML = successmessage('Record Saved Successfully.');
					form.reset(); 
					newentry();	
					datagrid();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage('Record Deleted Successfully.');
					form.reset(); 
					newentry(); 
					datagrid();
					
				}
				else
				error.innerHTML = errormessage('Unable to Connect...'+response);
			}
		}
		ajaxcall0.send(passData);
	}
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var passData = "switchtype=generategrid&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/create-user.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split('|^^|');
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1').innerHTML = response[0];
		}
	}
	ajaxcall1.send(passData);
}

//Function to load the grid to form-------------------------------------------------------------------------------
function gridtoform(slno)
{
	clearinnerhtml();
	var passData = "switchtype=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall2 = createajax();alert
	var queryString = "../ajax/create-user.php";
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			var response = (ajaxcall2.responseText).split("^");
			var form = document.getElementById('submitform');
			form.lastslno.value = response[0];
			form.username.value = response[1];
			form.password.value = response[2];
			form.type.value = response[3];
			form.existinguser.value = response[4];
			form.reportingauthority.value = response[5];
			form.supportunit.value = response[6];
			//response[6]; carries the reference id value
			form.locationname.value = response[7];
			form.fullname.value = response[8];
			form.gender.value = response[9];
			form.presentaddress.value = response[10];
			form.permanentaddress.value = response[11];
			form.mobile.value = response[12];
			form.emergencynumber.value = response[13];
			form.emergencyremarks.value = response[14];
			form.dob.value = response[15];
			form.doj.value = response[16];
			form.designation.value = response[17];
			form.personalemail.value = response[18];
			form.officialemail.value = response[19];
			form.dol.value = response[20];
			if(form.loggedusertype.value != 'ADMIN') { disabledelete(); disablesave(); }
			else {  enabledelete(); enablesave(); }
		}
	}
	ajaxcall2.send(passData);
}

//Function to filter the records from database--------------------------------------------------------------------
function formfilter(command)
{
	var form = document.getElementById('filterform');
	var searchcriteria = form.searchcriteria;
	var selection = getradiovalue(form.databasefield);
	var orderby = form.orderby;
	var error = document.getElementById('filter-form-error');
	if(!searchcriteria.value) { error.innerHTML = errormessage('Enter the Search Text'); searchcriteria.focus(); return false; }
	if(command == 'view')
	{
		passData = "switchtype=searchfilter&searchcriteria=" + encodeURIComponent(searchcriteria.value) + "&selection=" + selection + "&orderby=" + orderby.value + "&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/create-user.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');
				gridtab2('2','tabgroupgrid');
				document.getElementById('tabgroupgridwb2').innerHTML = response[1];
				document.getElementById('tabgroupgridc2').innerHTML = response[0];
			}
		}
		clearinnerhtml();
		ajaxcall3.send(passData);
	}
	else if(command == 'toexcel')
	{
		form.action = '../searchreport/createuser.php';
		form.target = '_blank';
	    form.submit();
	}
}