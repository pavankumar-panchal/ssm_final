//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command,action)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.fullname;
	if(!field.value)	{ error.innerHTML = errormessage('Enter your Full Name.'); field.focus(); return false; }
	var field = form.gender;
	if(!field.value)	{ error.innerHTML = errormessage('Select the Gender.'); field.focus(); return false; }
	var field = form.presentaddress;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Present Address.'); field.focus(); return false; }
	var field = form.permanentaddress;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Permanent Address.'); field.focus(); return false; }
	var field = form.mobile;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Mobile Number.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Mobile Number should contain only integers.'); field.focus(); return false; }
	var field = form.emergencynumber;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Contact Number whom to be Contacted in case of Emergency.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Contact Number should contain only integers.'); field.focus(); return false; }
	var field = form.emergencyremarks;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the details of the person whom to be Contacted in case of Emergency.'); field.focus(); return false; }
	var field = form.dob;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Date of Birth.'); field.focus(); return false; }
	var field = form.doj;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Date of Joining.'); field.focus(); return false; }
	var field = form.personalemail;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Personal Email ID.'); field.focus(); return false; }
	if(field.value)	{ var a = checkemail(field.value); if(a==false) { error.innerHTML = errormessage('Enter the correct Personal Email ID.'); field.focus(); return false; } }
	var field = form.officialemail;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Official Email ID.'); field.focus(); return false; }
	if(field.value)	{ var a = checkemail(field.value); if(a==false) { error.innerHTML = errormessage('Enter the correct Official Email ID.'); field.focus(); return false; } }
	var field = form.designation;
	if(!field.value)	{ error.innerHTML = errormessage('Enter the Designation.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'update')
			passData = 'type=update&fullname=' + form.fullname.value + '&gender=' + form.gender.value + '&presentaddress=' + form.presentaddress.value + '&permanentaddress=' + form.permanentaddress.value + '&mobile=' + form.mobile.value + '&emergencynumber=' + form.emergencynumber.value + '&emergencyremarks=' + form.emergencyremarks.value + '&dob=' + form.dob.value + '&doj=' + form.doj.value + '&designation=' + form.designation.value + '&personalemail=' + form.personalemail.value + '&officialemail=' + form.officialemail.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			queryString = '../ajax/editprofile.php';
			var ajaxcall0 = createajax();
			ajaxcall0.open('POST', queryString, true);
			ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			ajaxcall0.onreadystatechange = function()
			{
				if(ajaxcall0.readyState == 4)
				{
					var response = (ajaxcall0.responseText).split('^');
					if(response[0] == 1)
					{
						if(action == 'yes')
						{
						error.innerHTML = successmessage(response[1] + ' Proceed further to make use of Saral SSM');
						newentry();	form.reset(); datagrid();
						}
						else
						{
						error.innerHTML = successmessage(response[1]);
						newentry();	form.reset(); datagrid();
						}
					}
					else
					error.innerHTML = errormessage('Unable to Connect...' + response);
				}
			}
			ajaxcall0.send(passData);
	}
}

//Function to load the data on load of the page-------------------------------------------------------------------
function datagrid()
{
	var form = document.getElementById('submitform');
	var passData = "type=generatedata&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall1 = createajax();
	queryString = "../ajax/editprofile.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split('^');
			form.fullname.value = response[1];
			form.gender.value = response[2];
			form.presentaddress.value = response[3];
			form.permanentaddress.value = response[4];
			form.mobile.value = response[5];
			form.emergencynumber.value = response[6];
			form.emergencyremarks.value = response[7];
			form.dob.value = response[8];
			form.doj.value = response[9];
			form.designation.value = response[10];
			form.personalemail.value = response[11];
			form.officialemail.value = response[12];
		}
	}
	ajaxcall1.send(passData);
}
