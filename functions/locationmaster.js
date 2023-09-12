//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = $("#form-error");
	var field = form.locationname;
	if(!field.value) { error.innerHTML = errormessage('Enter the Location Name'); field.focus(); return false; }
	var field = form.businessname;
	if(!field.value) { error.innerHTML = errormessage('Enter the Business Name'); field.focus(); return false; }
	var field = form.address;
	if(!field.value) { error.innerHTML = errormessage('Enter the Address'); field.focus(); return false; }
	var field = form.place;
	if(!field.value) { error.innerHTML = errormessage('Enter the Place'); field.focus(); return false; }
	var field = form.district;
	if(!field.value) { error.innerHTML = errormessage('Enter the District'); field.focus(); return false; }
	var field = form.state;
	if(!field.value) { error.innerHTML = errormessage('Enter the State'); field.focus(); return false; }
	var field = form.phone;
	if(!field.value) { error.innerHTML = errormessage('Enter the Phone'); field.focus(); return false; }
	var field = form.emailid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Email ID'); field.focus(); return false; }
	if(field.value)
	{var a = checkemail(field.value); if(a==false){error.innerHTML = errormessage('Enter the correct Email ID.'); field.focus(); return false;}}
	var field = form.locationincharge;
	if(!field.value) { error.innerHTML = errormessage('Enter the Location Incharge'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value  + '&locationname=' + form.locationname.value  + '&businessname=' + encodeURIComponent(form.businessname.value)  + '&address=' + form.address.value  + '&place=' + form.place.value  + '&district=' + form.district.value  + '&state=' + form.state.value  + '&phone=' + form.phone.value + '&emailid=' + form.emailid.value  + '&locationincharge=' + form.locationincharge.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/location-master.php';
		var ajaxcall0 = createajax();
		document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		ajaxcall0.open('POST', queryString, true);
		ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxcall0.onreadystatechange = function()
		{
			if(ajaxcall0.readyState == 4)
			{
				document.getElementById('tabgroupgridwb1').innerHTML = '';
				var response = (ajaxcall0.responseText).split('^');
				if(response[0] == 1)
				{
					error.html(successmessage('Record Saved Successfully.')).fadeIn().delay(5000).fadeOut();
					newentry();	form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.html(successmessage('Record Deleted Successfully.')).fadeIn().delay(5000).fadeOut();
					newentry(); form.reset(); datagrid();
				}
				else
				error.innerHTML = scripterror();
			}
		}
		ajaxcall0.send(passData);
	}
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/location-master.php";
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
	var passData = "type=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall2 = createajax();
	var queryString = "../ajax/location-master.php";
	document.getElementById('form-error').innerHTML = '<img src="../images/processing.gif" border="0"/>';
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		document.getElementById('form-error').innerHTML = '';
		if(ajaxcall2.readyState == 4)
		{
			var response = (ajaxcall2.responseText).split("^");
			var form = document.getElementById('submitform');
			form.lastslno.value = response[0];
			form.locationname.value = response[1];
			form.businessname.value = response[2];
			form.address.value = response[3];
			form.place.value = response[4];
			form.district.value = response[5];
			form.state.value = response[6];
			form.phone.value = response[7];
			form.emailid.value = response[8];
			form.locationincharge.value = response[9];
			var loggedusertype = document.getElementById('loggedusertype').value;
			if(loggedusertype == 'TEAMLEADER' || loggedusertype == 'MANAGEMENT' || loggedusertype == 'ADMIN')
			{
				enabledelete();
				enablesave();
			}
			else
			{
				disablesave();
				disabledelete();
			}
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
		passData = "type=searchfilter&searchcriteria=" + encodeURIComponent(searchcriteria.value) + "&selection=" + selection + "&orderby=" + orderby.value + "&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/location-master.php";
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
		form.action = '../searchreport/locationmaster.php';
		form.target = '_blank';
	    form.submit();
	}
}