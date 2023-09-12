//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = $("#form-error");
	var field = form.oscompanyname;
	if(!field.value) { error.innerHTML = errormessage('Enter the OS Employee Company Name'); field.focus(); return false; }
	var field = form.osname;
	if(!field.value) { error.innerHTML = errormessage('Enter the OS Employee Name'); field.focus(); return false; }
	var field = form.contactnumber;
	if(!field.value) { error.innerHTML = errormessage('Enter the Contact Number'); field.focus(); return false; }
	var field = form.emailid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Email ID'); field.focus(); return false; }
	if(field.value) { var a = checkemail(field.value); if(a==false) { error.innerHTML = errormessage('Enter the correct Email ID.'); field.focus(); return false; } }
	var field = form.place;
	if(!field.value) { error.innerHTML = errormessage('Enter the Place'); field.focus(); return false; }
	var field = form.district;
	if(!field.value) { error.innerHTML = errormessage('Enter the District'); field.focus(); return false; }
	var field = form.state;
	if(!field.value) { error.innerHTML = errormessage('Enter the State'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value + '&oscompanyname=' + form.oscompanyname.value + '&osname=' + form.osname.value + '&contactnumber=' + form.contactnumber.value + '&emailid=' + form.emailid.value + '&category=' + form.category.value + '&place=' + form.place.value + '&district=' + form.district.value + '&state=' + form.state.value + '&skypeid=' + form.skypeid.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/os-master.php';
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
		ajaxcall.send(passData);
	}
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall0 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/os-master.php";
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
function gridtoform(slno)
{
	clearinnerhtml();
	var passData = "type=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall1 = createajax();
	var queryString = "../ajax/os-master.php";
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
			form.oscompanyname.value = response[1];
			form.osname.value = response[2];
			form.contactnumber.value = response[3];
			form.emailid.value = response[4];
			form.category.value = response[5];
			form.place.value = response[6];
			form.district.value = response[7];
			form.state.value = response[8];
			form.skypeid.value = response[9];
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
	ajaxcall1.send(passData);
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
		ajaxcall2 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/os-master.php";
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
		form.action = '../searchreport/osmaster.php';
		form.target = '_blank';
	    form.submit();
	}
}