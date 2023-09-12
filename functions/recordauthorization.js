//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	if(document.getElementById('displayregisters').innerHTML == '') { error.innerHTML = errormessage('Make A Selection of Record from the grid below'); field.focus(); return false; }
	var authorizedatabasefield = getradiovalue(form.authorizedatabasefield);
	var flagdatabasefield = form.flagdatabasefield;
	var publishdatabasefield = form.publishdatabasefield;
	var authorizedgroup = form.authorizedgroup;
	var field =  form.authorizedgroup
	if(!field.value) 
	{ error.innerHTML = errormessage('Make A Selection of Authorization group'); field.focus(); return false; }
	var field = form.teamleaderremarks;
	if(authorizedatabasefield == 'no' && !field.value)
	{
	 error.innerHTML = errormessage('Enter the Remarks'); field.focus(); return false; 
	}
	else
	{
		var passData = "";
		if(command == 'save') 
		{
			var registervalue = document.getElementById('registervalue').value;
			if(registervalue == 'call')
			{
				passData = 'type=save&databasefield=call&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							authorizedatabasefield + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + 
							'&publishdatabasefield=' + getradiovalue(form.publishdatabasefield) + 
							'&authorizedgroup=' + form.authorizedgroup.value + 
							'&teamleaderremarks=' + form.teamleaderremarks.value + 
							'&dummy=' + Math.floor(Math.random()*10019200000);
			if(registervalue == 'email')
			{
				passData = 'type=save&databasefield=email&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'error')
			{
				passData = 'type=save&databasefield=error&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + 
							'&flagdatabasefield=' + getradiovalue(form.flagdatabasefield) + 
							'&publishdatabasefield=' + getradiovalue(form.publishdatabasefield) +
							'&authorizedgroup=' + form.authorizedgroup.value + 
							'&teamleaderremarks=' + form.teamleaderremarks.value + 
							'&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'inhouse')
			{
				passData = 'type=save&databasefield=inhouse&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' +
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'onsite')
			{
				passData = 'type=save&databasefield=onsite&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'reference')
			{
				passData = 'type=save&databasefield=reference&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' +
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'requirement')
			{
				passData = 'type=save&databasefield=requirement&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'skype')
			{
				passData = 'type=save&databasefield=skype&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' +
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'invoice')
			{
				passData = 'type=save&databasefield=invoice&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' + 
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' +
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == 'receipt')
			{
				passData = 'type=save&databasefield=receipt&lastslno=' + 
							form.lastslno.value + '&authorizedatabasefield=' + 
							getradiovalue(form.authorizedatabasefield) + '&flagdatabasefield=' +
							getradiovalue(form.flagdatabasefield) + '&publishdatabasefield=' + 
							getradiovalue(form.publishdatabasefield) + '&authorizedgroup=' + 
							form.authorizedgroup.value + '&teamleaderremarks=' + 
							form.teamleaderremarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
			}
			if(registervalue == '')
			{
				 error.innerHTML = errormessage('Make A Selection of the Record from the grid below'); 
				 return false;
			}
		}
		queryString = '../ajax/record-authorization.php';
		var ajaxcall = createajax();
		document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		ajaxcall.open('POST', queryString, true);
		ajaxcall.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxcall.onreadystatechange = function()
		{
			if(ajaxcall.readyState == 4)
			{
				document.getElementById('tabgroupgridwb1').innerHTML = '';
				var response = (ajaxcall.responseText).split('^');
				if(response[0] == 1)
				{
					error.innerHTML = successmessage(response[1]);
					datagrid(); form.reset(); newentry(); 
				}
				else
				error.innerHTML = errormessage('Unable to Connect...' + ajaxcall.responseText);
			}
		}
		ajaxcall.send(passData);
	}
	}
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall0 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/record-authorization.php";
	ajaxcall0.open("POST", queryString, true);
	ajaxcall0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall0.onreadystatechange = function()
	{
		if(ajaxcall0.readyState == 4)
		{
			var response = (ajaxcall0.responseText).split('|^^|');
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1').innerHTML = response[0];
		}
	}
	ajaxcall0.send(passData);
}

//Function to load the grid to form-------------------------------------------------------------------------------
function gridtoform(slno,command)
{
	document.getElementById('form-error').innerHTML = '';
	var passData = '';
	if(command == 'call') { passData = "type=gridtoform&databasefield=call&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'call'; }
	if(command == 'email'){ passData = "type=gridtoform&databasefield=email&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'email'; }
	if(command == 'error') { passData = "type=gridtoform&databasefield=error&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'error'; }
	if(command == 'inhouse') { passData = "type=gridtoform&databasefield=inhouse&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'inhouse'; }
	if(command == 'onsite') { passData = "type=gridtoform&databasefield=onsite&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'onsite'; }
	if(command == 'reference') { passData = "type=gridtoform&databasefield=reference&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'reference'; }
	if(command == 'requirement') { passData = "type=gridtoform&databasefield=requirement&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'requirement'; }
	if(command == 'skype') { passData = "type=gridtoform&databasefield=skype&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'skype'; }
	if(command == 'invoice') { passData = "type=gridtoform&databasefield=invoice&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'invoice'; }
	if(command == 'receipt') { passData = "type=gridtoform&databasefield=receipt&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100); document.getElementById('registervalue').value = 'receipt'; }
	ajaxcall1 = createajax();
	var queryString = "../ajax/record-authorization.php";
	document.getElementById('form-error').innerHTML = '<img src="../images/processing.gif" border="0"/>';
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		document.getElementById('form-error').innerHTML = '';
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split("^");
			var form = document.getElementById('submitform');
			form.lastslno.value = response[0];
			document.getElementById('displayregisters').innerHTML = response[1];
			autoselect('authorizedgroup',response[3]);
			form.teamleaderremarks.value = response[4];
			if(!response[2])
				setradiovalue(form.authorizedatabasefield, 'yes');
			else
				setradiovalue(form.authorizedatabasefield, response[2]);
			if(!response[5])
				setradiovalue(form.flagdatabasefield, 'no');
			else
				setradiovalue(form.flagdatabasefield,response[5]);
			setradiovalue(form.publishdatabasefield,response[8]);
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[6]) || (loggeduser == response[7]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
			{
				enablesave();
			}
			else
			{
				disablesave();
			}
		}
	}
	ajaxcall1.send(passData); 
}

//Function to filter the records from database--------------------------------------------------------------------
function formfilter(command)
{
	var form = document.getElementById('filterform');
	var fromdate = form.fromdate; 
	var todate = form.todate; 
	var databasefield = getradiovalue(form.databasefield);
	var error = document.getElementById('filter-form-error');
	if(!fromdate.value) { error.innerHTML = errormessage('Enter the From Date'); fromdate.focus(); return false; }
	if(!todate.value) { error.innerHTML = errormessage('Enter the To Date'); todate.focus(); return false; }
	if(command == 'view')
	{
		if(databasefield == 'call')
			document.getElementById('tabgroupgridh2').innerHTML = 'Calls';
		if(databasefield == 'email')
			document.getElementById('tabgroupgridh2').innerHTML = 'Emails';
		if(databasefield == 'error')
			document.getElementById('tabgroupgridh2').innerHTML = 'Errors';
		if(databasefield == 'inhouse')
			document.getElementById('tabgroupgridh2').innerHTML = 'Inhouse';
		if(databasefield == 'onsite')
			document.getElementById('tabgroupgridh2').innerHTML = 'Onsite';
		if(databasefield == 'reference')
			document.getElementById('tabgroupgridh2').innerHTML = 'Reference';
		if(databasefield == 'requirement')
			document.getElementById('tabgroupgridh2').innerHTML = 'Requirement';
		if(databasefield == 'skype')
			document.getElementById('tabgroupgridh2').innerHTML = 'Skype';
		if(databasefield == 'invoice')
			document.getElementById('tabgroupgridh2').innerHTML = 'Invoices';
		if(databasefield == 'receipt')
			document.getElementById('tabgroupgridh2').innerHTML = 'Receipts';
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&databasefield=" + databasefield + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_category=" + encodeURIComponent(form.s_category.value) + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value)+ "&s_customerid=" + encodeURIComponent(form.s_customerid.value) + "&s_problem=" + encodeURIComponent(form.s_problem.value) + "&s_transferredto=" + encodeURIComponent(form.s_transferredto.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_compliantid=" + encodeURIComponent(form.s_compliantid.value)+ "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value)+ "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_authorizedatabasefield=" + getradiovalue(form.s_authorizedatabasefield) + "&s_flagdatabasefield=" + getradiovalue(form.s_flagdatabasefield) + "&s_publishdatabasefield=" + getradiovalue(form.s_publishdatabasefield) + "&s_compliantid=" + encodeURIComponent(form.s_compliantid.value) + "&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall2 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/record-authorization.php";
		ajaxcall2.open("POST", queryString, true);
		ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall2.onreadystatechange = function()
		{
			if(ajaxcall2.readyState == 4)
			{
				var response = (ajaxcall2.responseText).split('|^^|');
				gridtab2('2','tabgroupgrid');
				document.getElementById('tabgroupgridwb2').innerHTML = response[1];
				document.getElementById('tabgroupgridc2').innerHTML = response[0];
			}
		}
		clearinnerhtml();
		ajaxcall2.send(passData);
	}
	else if(command == 'toexcel')
	{
		form.action = '../searchreport/recordauthorization.php';
		form.target = '_blank';
	    form.submit();
	}
}
