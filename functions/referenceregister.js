//Function to change the mandatory fields according to the radio value--------------------------------------------
function formsubmitcustomer()
{
	var form = document.getElementById('submitform');
	if(getradiovalue(form.anonymous) == 'no')
	{
		form.customername.value=''; form.customername.readOnly = true; form.customername.style.background="#FEFFE6";
		form.category.value=''; form.category.readOnly = true; form.category.style.background="#FEFFE6";
		form.state.value=''; form.state.disabled = true; form.state.style.background="#FEFFE6";
		document.getElementById('getcustomerlink').style.visibility = 'visible';
	}
	else
	{
		form.customername.value=''; form.customername.readOnly = false; form.customername.style.background="#FFFFFF";
		form.category.value=''; form.category.readOnly = false; form.category.style.background="#FFFFFF";
		form.state.value=''; form.state.disabled = false; form.state.style.background="#FFFFFF";
		document.getElementById('getcustomerlink').style.visibility = 'hidden';
	}
}

//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.anonymous;
	if(!getradiovalue(field)) { error.innerHTML = errormessage('Select whether customer or non-customer.'); field.focus(); return false; }
	if(getradiovalue(field) == 'no') 
	{
		var field = form.customername;
		if(!field.value) { error.innerHTML = errormessage('Get the customername from Get Customer.'); field.focus(); return false; }
		var field = form.category;
		if(!field.value) { error.innerHTML = errormessage('Get the callertype from Get Customer.'); field.focus(); return false; }
	}
	var field = form.productgroup;
	if(!field.value) { error.innerHTML = errormessage('Select the Product Group.'); field.focus(); return false; }

	var field = form.referencethrough;
	if(!field.value) { error.innerHTML = errormessage('Select the Refernce Through.'); field.focus(); return false; }
	var field = form.contactperson;
	if(!field.value) { error.innerHTML = errormessage('Enter the Contact Person.'); field.focus(); return false; }
	if(isAlpha(field.value) == false) { error.innerHTML = errormessage('Contact Person Name should only be Alphabets.'); field.focus(); return false; }
	var field = form.contactno;
	if(!field.value) { error.innerHTML = errormessage('Enter the contact number.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Contact Number should contain Only Numerals.'); field.focus(); return false; }
	var field = form.contactaddress;
	if(!field.value) { error.innerHTML = errormessage('Enter the contact address.'); field.focus(); return false; }
	var field = form.email;
	if(!field.value) { error.innerHTML = errormessage('Enter the Email ID.'); field.focus(); return false; }
	if(checkemail(field.value)==false) { error.innerHTML = errormessage('Enter the correct Email ID.'); field.focus(); return false; } 
	
	var field = form.remarks;
	if(!field.value) { error.innerHTML = errormessage('Enter the Remarks.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value + '&anonymous=' + getradiovalue(form.anonymous) + '&customername=' + encodeURIComponent(form.customername.value) + '&customerid=' + encodeURIComponent(form.customerid.value) +  '&productgroup=' + encodeURIComponent(form.productgroup.value) +'&productname=' + encodeURIComponent(form.productname.value) + '&date=' + encodeURIComponent(form.date.value) + '&time=' + encodeURIComponent(form.time.value) + '&referencethrough=' + encodeURIComponent(form.referencethrough.value) + '&category=' + encodeURIComponent(form.category.value) + '&state=' + encodeURIComponent(form.state.value)  + '&contactperson=' + encodeURIComponent(form.contactperson.value) + '&contactno=' + encodeURIComponent(form.contactno.value) + '&contactaddress=' + encodeURIComponent(form.contactaddress.value) + '&email=' + encodeURIComponent(form.email.value) + '&status=' + encodeURIComponent(form.status.value) + '&remarks=' + encodeURIComponent(form.remarks.value) + '&userid=' + encodeURIComponent(form.userid.value) + '&referenceid=' + encodeURIComponent(form.referenceid.value) + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/reference-register.php';
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
				var response = (ajaxcall.responseText).split('^');
				if(response[0] == 1)
				{
					error.innerHTML = successmessage(response[1]);
					newentry();	formsubmitcustomer(); form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage(response[1]);
					newentry();	formsubmitcustomer(); form.reset(); datagrid();
				}
				else
				error.innerHTML = errormessage('Unable to Connect...' + response);
			}
		}
		ajaxcall.send(passData);
	}
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var startlimit = '';
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000)+ "&startlimit=" + encodeURIComponent(startlimit);//alert(passData);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/reference-register.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split('|^^|');
			gridtab4('1','tabgroupgrid');
			formsubmitcustomer();
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1_2').innerHTML = response[0];
			document.getElementById('tabgroupgridc1link1').innerHTML = response[2];
		}
	}
		//clearinnerhtml();
		ajaxcall1.send(passData);
}

function getmore(startlimit,slno,showtype)
{
	
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno)+ "&showtype=" + showtype;//alert(passData)
	//alert(passData);
	queryString = "../ajax/reference-register.php";
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
					gridtab4('1','tabgroupgrid');
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
	clearinnerhtml(); setradiovalue(document.getElementById('submitform').anonymous, 'no');
	var passData = "type=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall1 = createajax();
	var queryString = "../ajax/reference-register.php";
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
			setradiovalue(form.anonymous,response[1]);
			formsubmitcustomer();
			form.customername.value = response[2];
			form.productgroup.value = response[3];
			productnamefunction('productname',response[4]); 
		
			form.date.value = response[5];
			form.time.value = response[6];
			form.referencethrough.value = response[7];
			form.category.value = response[8];
			form.contactperson.value = response[9];
			form.contactno.value = response[10];
			form.contactaddress.value = response[11];
			form.email.value = response[12];
			form.status.value = response[13];
			form.remarks.value = response[14];
			form.userid.value = response[15];
			form.referenceid.value = response[16];
			form.customerid.value = response[25];
			if(response[26] == '')
			{
				form.state.disabled = false;
				form.state.value = response[26];
			}
			else
			{
				form.state.value = response[26];
			}
			document.getElementById('teamleaderremarks').innerHTML = response[19];
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[23]) || (loggeduser == response[24]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
			{
				//formsubmitcustomer();
				enabledelete();
				enablesave();
			}
			else
			{
				//formsubmitcustomer();
				disabledelete();
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
	var error = document.getElementById('filter-form-error');
	var startlimit = '';
	if(!fromdate.value) { error.innerHTML = errormessage('Enter the From Date'); fromdate.focus(); return false; }
	if(!todate.value) { error.innerHTML = errormessage('Enter the To Date'); todate.focus(); return false; }
	/*if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }*/
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	if(command == 'view')
	{
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + "&s_state=" + encodeURIComponent(form.s_state.value) +"&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_referencethrough=" + encodeURIComponent(form.s_referencethrough.value) + "&s_contactperson=" + encodeURIComponent(form.s_contactperson.value) + "&s_contactno=" + encodeURIComponent(form.s_contactno.value) + "&s_contactaddress=" + encodeURIComponent(form.s_contactaddress.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_email=" + form.s_email.value + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_referenceid=" + encodeURIComponent(form.s_referenceid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit);//alert(passData)
		ajaxcall2 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/reference-register.php";
		ajaxcall2.open("POST", queryString, true);
		ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall2.onreadystatechange = function()
		{
			if(ajaxcall2.readyState == 4)
			{
				var response = (ajaxcall2.responseText).split('|^^|');
				gridtab4('2','tabgroupgrid');
				document.getElementById('tabgroupgridwb2').innerHTML = response[1];
				document.getElementById('tabgroupgridc1_1').innerHTML = response[0];
				document.getElementById('tabgroupgridc1link').innerHTML = response[2];
			}
		}
		clearinnerhtml();
		ajaxcall2.send(passData);
	}
	else if(command == 'toexcel')
	{
		form.action = '../searchreport/referenceregister.php';
		form.target = '_blank';
	    form.submit();
	}
}

//Function for "show more records" link - to get registration records
function getmorerecords(startlimit,slno,showtype)
{
	var form = document.getElementById('filterform');
	var fromdate = form.fromdate; 
	var todate = form.todate; 
	var error = document.getElementById('filter-form-error');
	if(!fromdate.value) { error.innerHTML = errormessage('Enter the From Date'); fromdate.focus(); return false; }
	if(!todate.value) { error.innerHTML = errormessage('Enter the To Date'); todate.focus(); return false; }
	/*if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }*/
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	var	passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) +  "&s_state=" + encodeURIComponent(form.s_state.value) + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_referencethrough=" + encodeURIComponent(form.s_referencethrough.value) + "&s_contactperson=" + encodeURIComponent(form.s_contactperson.value) + "&s_contactno=" + encodeURIComponent(form.s_contactno.value) + "&s_contactaddress=" + encodeURIComponent(form.s_contactaddress.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_email=" + form.s_email.value + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_referenceid=" + encodeURIComponent(form.s_referenceid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno)+ "&showtype=" + showtype;
	//alert(passData);
	var queryString = "../ajax/reference-register.php";
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
					gridtab4('2','tabgroupgrid');
				}
			}
			else
				document.getElementById('tabgroupgridc1_1').innerHTML = scripterror();
		}
	}
	ajaxcall5.send(passData);
}

//Function to display the flagged entries the records from database-----------------------------------------------
function flags()
{
		passData = "type=flags&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb3').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/reference-register.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');
				document.getElementById('tabgroupgridwb3').innerHTML = response[1];
				document.getElementById('tabgroupgridc3').innerHTML = response[0];
			}
		}
		clearinnerhtml();
		ajaxcall3.send(passData);
}
