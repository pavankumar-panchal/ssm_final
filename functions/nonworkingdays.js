//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.date;
	if(!field.value) { error.innerHTML = errormessage('Enter the Date.'); field.focus(); return false; }
	var field = form.occassion;
	if(!field.value) { error.innerHTML = errormessage('Enter the Occassion.'); field.focus(); return false; }
	var field = form.remarks;
	if(!field.value) { error.innerHTML = errormessage('Enter the Remarks.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value + '&date=' + form.date.value + '&occassion=' + form.occassion.value + '&remarks=' + form.remarks.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/nonworkingdays-master.php';
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
					error.innerHTML = successmessage('Record Saved Successfully.');
					newentry();	form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage('Record Deleted Successfully.');
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
	var startlimit = '';
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000)+ 
					"&startlimit=" + encodeURIComponent(startlimit);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/nonworkingdays-master.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split('|^^|');
			gridtab2('1','tabgroupgrid');
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1_2').innerHTML = response[0];
			document.getElementById('tabgroupgridc1link1').innerHTML = response[2];
		}
	}
	ajaxcall1.send(passData);
}
function getmore(startlimit,slno,showtype)
{
	
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10000789641000)+ 
					"&startlimit=" + encodeURIComponent(startlimit)+ 
					"&slno=" + encodeURIComponent(slno) + 
					"&showtype=" + showtype;//alert(passData)
	//alert(passData);
	var queryString = "../ajax/nonworkingdays-master.php";
	ajaxcall6 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	ajaxcall6.open("POST", queryString, true);
	ajaxcall6.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall6.onreadystatechange = function()
	{
	if(ajaxcall6.readyState == 4)
		{
			if(ajaxcall6.status == 200)
			{
				var ajaxresponse = ajaxcall6.responseText;//alert(ajaxresponse);
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('|^^|');
					document.getElementById('regresultgrid').innerHTML =  document.getElementById('tabgroupgridc1_2').innerHTML;
					document.getElementById('tabgroupgridc1_2').innerHTML =   document.getElementById('regresultgrid').innerHTML.replace(/\<\/table\>/gi,'')+ response[0] ;
					document.getElementById('tabgroupgridc1link1').innerHTML =  response[2];
					document.getElementById('tabgroupgridwb1').innerHTML = response[1];
					gridtab2('1','tabgroupgrid');
				}
			}
			else
				document.getElementById('tabgroupgridc1_2').innerHTML = scripterror();
		}
	}
	ajaxcall6.send(passData);
}

//Function to load the grid to form-------------------------------------------------------------------------------
function gridtoform(slno)
{
	clearinnerhtml();
	var passData = "type=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall2 = createajax();
	var queryString = "../ajax/nonworkingdays-master.php";
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
			form.date.value = response[1];
			form.occassion.value = response[2];
			form.remarks.value = response[3];
			var loggedusertype = document.getElementById('loggedusertype').value;
			if(loggedusertype == 'ADMIN')
			{
				enabledelete();
				enablesave();
			}
			else
			{
				disabledelete();
				disablesave();
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
	var startlimit = '';
	var error = document.getElementById('filter-form-error');
	if(!searchcriteria.value) { error.innerHTML = errormessage('Enter the Search Text'); searchcriteria.focus(); return false; }
	if(command == 'view')
	{
		passData = "type=searchfilter&searchcriteria=" + encodeURIComponent(searchcriteria.value) 
					+ "&selection=" + selection 
					+ "&orderby=" + orderby.value 
					+ "&dummy=" + Math.floor(Math.random()*10000789641000) +
					"&startlimit=" + encodeURIComponent(startlimit);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/nonworkingdays-master.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');
				gridtab2('2','tabgroupgrid');
				document.getElementById('tabgroupgridwb2').innerHTML = response[1];
				document.getElementById('tabgroupgridc1_1').innerHTML = response[0];
				document.getElementById('tabgroupgridc1link').innerHTML = response[2];
			}
		}
		clearinnerhtml();
		ajaxcall3.send(passData);
	}
	else if(command == 'toexcel')
	{
		form.action = '../searchreport/nonworkingdays.php';
		form.target = '_blank';
	    form.submit();
	}
}
function getmorerecords(startlimit,slno,showtype)
{
	var form = document.getElementById('filterform');
	var searchcriteria = form.searchcriteria;
	var selection = getradiovalue(form.databasefield);
	var orderby = form.orderby;
	var error = document.getElementById('filter-form-error');
	
	
	var passData = "type=searchfilter&searchcriteria=" + encodeURIComponent(searchcriteria.value) +
					"&selection=" + selection + 
					"&orderby=" + orderby.value + 
					"&dummy=" + Math.floor(Math.random()*10000789641000) + 
					"&startlimit=" + encodeURIComponent(startlimit)+ 
					"&slno=" + encodeURIComponent(slno) + 
					"&showtype=" + showtype;//alert(passData)
	//alert(passData);
	var queryString = "../ajax/nonworkingdays-master.php";
	ajaxcall5 = createajax();
	document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	ajaxcall5.open("POST", queryString, true);
	ajaxcall5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall5.onreadystatechange = function()
	{
		if(ajaxcall5.readyState == 4)
		{
			if(ajaxcall5.status == 200)
			{
				var ajaxresponse = ajaxcall5.responseText;//alert(ajaxresponse);
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('|^^|');
					document.getElementById('regresultgrid').innerHTML =  document.getElementById('tabgroupgridc1_1').innerHTML;
					document.getElementById('tabgroupgridc1_1').innerHTML =   document.getElementById('regresultgrid').innerHTML.replace(/\<\/table\>/gi,'')+ response[0] ;
					document.getElementById('tabgroupgridc1link').innerHTML =  response[2];
					document.getElementById('tabgroupgridwb2').innerHTML = response[1];
					gridtab2('2','tabgroupgrid');
				}
			}
			else
				document.getElementById('tabgroupgridc1_1').innerHTML = scripterror();
		}
	}
	ajaxcall5.send(passData);
}
