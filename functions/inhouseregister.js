//Function to change the mandatory fields according to the radio value--------------------------------------------
function formsubmitcustomer()
{
	var form = document.getElementById('submitform');
	if(getradiovalue(form.anonymous) == 'no')
	{
		form.customername.value=''; form.customername.readOnly = true; form.customername.style.background="#FEFFE6";
		form.customerid.value=''; form.customerid.readOnly = true; form.customerid.style.background="#FEFFE6";
		form.category.value=''; form.category.readOnly = true; form.category.style.background="#FEFFE6";
		form.state.value=''; form.state.disabled = true; form.state.style.background="#FEFFE6";
		form.callertype.value=''; form.callertype.readOnly = true; form.callertype.style.background="#FEFFE6";
		document.getElementById('getcustomerlink').style.visibility = 'visible';
	}
	else
	{
		form.customername.value=''; form.customername.readOnly = false; form.customername.style.background="#FFFFFF";
		form.customerid.value=''; form.customerid.readOnly = false; form.customerid.style.background="#FFFFFF";
		form.category.value=''; form.category.readOnly = false; form.category.style.background="#FFFFFF";
		form.state.value=''; form.state.disabled = false; form.state.style.background="#FFFFFF";
		form.callertype.value=''; form.callertype.readOnly = false; form.callertype.style.background="#FFFFFF";
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
		var field = form.customerid;
		if(!field.value) { error.innerHTML = errormessage('Get the customerid from Get Customer.'); field.focus(); return false; }
		var field = form.callertype;
		if(!field.value) { error.innerHTML = errormessage('Get the callertype from Get Customer.'); field.focus(); return false; }
		var field = form.category;
		if(!field.value) { error.innerHTML = errormessage('Get the callertype from Get Customer.'); field.focus(); return false; }
	}

	var field = form.productgroup;
	if(!field.value) { error.innerHTML = errormessage('Select the Product Group.'); field.focus(); return false; }
	
	var field = form.problem;
	if(!field.value) { error.innerHTML = errormessage('Enter the Problem.'); field.focus(); return false; }
	var field = form.contactperson;
	if(!field.value) { error.innerHTML = errormessage('Enter the Contact Person.'); field.focus(); return false; }
	if(isAlpha(field.value) == false) { error.innerHTML = errormessage('Contact Person Name should only be Alphabets.'); field.focus(); return false; }
	var servicecharge;
	var field = form.servicecharge;
	if (field.checked == true)
	servicecharge = 'yes'; else servicecharge = 'no';
	var field = form.assignedto;
	if(!field.value && (field.disabled == false)) { error.innerHTML = errormessage('Select to whom the problem is to be assigned.'); field.focus(); return false; }
	var field = form.status;
	if(!field.value) { error.innerHTML = errormessage('Select the Status.'); field.focus(); return false; }
	var field = form.solvedby;
	if(!field.value && (field.disabled == false) && (form.status.value == 'solved')) { error.innerHTML = errormessage('Select who has solved the problem.'); field.focus(); return false; }
	if ((field.value) && (form.status.value != 'solved') && (field.disabled == false)) { error.innerHTML = errormessage("Solved Person should be null as status is not solved ."); field.focus(); return false; }
	if(form.status.value=='solved' && field.value != form.assignedto.value) { error.innerHTML = errormessage("Assigned To and Solved Person should not differ"); field.focus(); return false; }
	var field = form.acknowledgementno;
	if(!field.value && (field.disabled == false) && (form.status.value == 'solved')) { error.innerHTML = errormessage('Enter the acknowledgement Number.'); field.focus(); return false; }
	if ((field.value) && (form.status.value != 'solved') && (field.disabled == false)) { error.innerHTML = errormessage("Acknowledgement Number should be null as status is not solved ."); field.focus(); return false;}
	if(field.value)	{
	if(isNaN(field.value)) { error.innerHTML = errormessage('Acknowledgement Number should contain only integers.'); field.focus(); return false; }}
	var field = form.remarks;
	if(!field.value && (field.disabled == false) && (form.status.value == 'solved')) { error.innerHTML = errormessage('Enter the Remarks.'); field.focus(); return false; }
	if ((field.value) && (form.status.value != 'solved') && (field.disabled == false)) { error.innerHTML = errormessage("Remarks should be null as status is not solved ."); field.focus(); return false;}

	var field = form.userid;
	if(!field.value && (field.disabled == false)) { error.innerHTML = errormessage('Enter the userid.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
		{
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		}
		else
		{
			passData = 'type=save&lastslno=' + form.lastslno.value + '&anonymous=' + getradiovalue(form.anonymous) + '&customername=' + encodeURIComponent(form.customername.value) + '&customerid=' + encodeURIComponent(form.customerid.value) + '&date=' + encodeURIComponent(form.date.value) + '&time=' + encodeURIComponent(form.time.value) + '&productgroup=' + encodeURIComponent(form.productgroup.value) + '&productname=' + encodeURIComponent(form.productname.value) + '&productversion=' + encodeURIComponent(form.productversion.value) + '&category=' + encodeURIComponent(form.category.value) + '&state=' + encodeURIComponent(form.state.value) + '&callertype=' + encodeURIComponent(form.callertype.value) + '&servicecharge=' + servicecharge + '&problem=' + encodeURIComponent(form.problem.value) + '&contactperson=' + encodeURIComponent(form.contactperson.value) + '&assignedto=' + encodeURIComponent(form.assignedto.value) + '&status=' + encodeURIComponent(form.status.value) + '&solvedby=' + encodeURIComponent(form.solvedby.value) + '&billno=' + encodeURIComponent(form.billno.value) + '&acknowledgementno=' + encodeURIComponent(form.acknowledgementno.value) + '&remarks=' + encodeURIComponent(form.remarks.value) + '&userid=' + encodeURIComponent(form.userid.value) + '&complaintid=' + encodeURIComponent(form.complaintid.value) + '&dummy=' + Math.floor(Math.random()*10019200000);
		}
		queryString = '../ajax/inhouse-register.php';
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
					error.innerHTML = successmessage(response[1]);
					newentry();	formsubmitcustomer(); datagrid();	form.reset();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage(response[1]);
					newentry();	formsubmitcustomer(); datagrid(); form.reset();
				}
				else
				error.innerHTML = errormessage('Unable to Connect...' + response);
			}
		}
		ajaxcall0.send(passData);
	}
}


//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var startlimit = '';
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000)+ "&startlimit=" + encodeURIComponent(startlimit);//alert(passData);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/inhouse-register.php";
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
	
		ajaxcall1.send(passData);
}

function getmore(startlimit,slno,showtype)
{
	
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) + "&showtype=" + showtype;//alert(passData)
	//alert(passData);
	var queryString = "../ajax/inhouse-register.php";
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
	ajaxcall2 = createajax();
	var queryString = "../ajax/inhouse-register.php";
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
			setradiovalue(form.anonymous,response[1]);
			formsubmitcustomer();
			form.customername.value = response[2];
			form.customerid.value = response[3];
			form.date.value = response[4];
			form.time.value = response[5];
			form.productgroup.value = response[6];
		
			productnamefunction('productname',response[7],response[8]); 
		
			form.category.value = response[9];
			form.callertype.value = response[10];
			autocheck(form.servicecharge,response[11]);
			form.problem.value = response[12];
			form.contactperson.value = response[13];
			form.assignedto.value = response[14];
			form.status.value = response[15];
			form.solvedby.value = response[16];
			form.billno.value = response[17];
			form.acknowledgementno.value = response[18];
			form.remarks.value = response[19];
			form.userid.value = response[20];
			form.complaintid.value = response[21];
			if(response[30] == '')
			{
				form.state.disabled = false;
				form.state.value = response[30];
			}
			else
			{
				form.state.value = response[30];
			}
			document.getElementById('teamleaderremarks').innerHTML = response[24];
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[28]) || (loggeduser == response[29]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
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
	ajaxcall2.send(passData);
}

//Function to filter the records from database--------------------------------------------------------------------
function formfilter(command)
{
	var form = document.getElementById('filterform');
	var fromdate = form.fromdate; 
	var todate = form.todate; 
	var startlimit = '';
	var error = document.getElementById('filter-form-error');
	if(!fromdate.value) { error.innerHTML = errormessage('Enter the From Date'); fromdate.focus(); return false; }
	if(!todate.value) { error.innerHTML = errormessage('Enter the To Date'); todate.focus(); return false; }
	//if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	//if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }
	if(form.s_customer.checked == true) { customer = "true"; } else { customer = "false"; }
	if(form.s_dealer.checked == true) { dealer = "true"; } else { dealer = "false"; }
	if(form.s_employee.checked == true) { employee = "true"; } else { employee = "false"; }
	if(form.s_ssmuser.checked == true) { ssmuser = "true"; } else { ssmuser = "false"; }
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	if(command == 'view')
	{
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value  + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_state=" + encodeURIComponent(form.s_state.value)  + "&s_customerid=" + encodeURIComponent(form.s_customerid.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd + "&s_customer=" + customer + "&s_dealer=" + dealer + "&s_employee=" + employee + "&s_ssmuser=" + ssmuser + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_problem=" + encodeURIComponent(form.s_problem.value) + "&s_solvedby=" + encodeURIComponent(form.s_solvedby.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + "&s_acknowledgementno=" + encodeURIComponent(form.s_acknowledgementno.value) + "&s_complaintid=" + encodeURIComponent(form.s_complaintid.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit);//alert(passData)
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/inhouse-register.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');
				gridtab4('2','tabgroupgrid');
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
		form.action = '../searchreport/inhouseregister.php';
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
	//if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	//if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }
	if(form.s_customer.checked == true) { customer = "true"; } else { customer = "false"; }
	if(form.s_dealer.checked == true) { dealer = "true"; } else { dealer = "false"; }
	if(form.s_employee.checked == true) { employee = "true"; } else { employee = "false"; }
	if(form.s_ssmuser.checked == true) { ssmuser = "true"; } else { ssmuser = "false"; }
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	var	passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value  + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_state=" + encodeURIComponent(form.s_state.value) + "&s_customerid=" + encodeURIComponent(form.s_customerid.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd + "&s_customer=" + customer + "&s_dealer=" + dealer + "&s_employee=" + employee + "&s_ssmuser=" + ssmuser + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) +"&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_problem=" + encodeURIComponent(form.s_problem.value) + "&s_solvedby=" + encodeURIComponent(form.s_solvedby.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + "&s_acknowledgementno=" + encodeURIComponent(form.s_acknowledgementno.value) + "&s_complaintid=" + encodeURIComponent(form.s_complaintid.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) + "&showtype=" + showtype;
	//alert(passData);
	var queryString = "../ajax/inhouse-register.php";
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
		ajaxcall4 = createajax();
		document.getElementById('tabgroupgridwb3').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/inhouse-register.php";
		ajaxcall4.open("POST", queryString, true);
		ajaxcall4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall4.onreadystatechange = function()
		{
			if(ajaxcall4.readyState == 4)
			{
				var response = (ajaxcall4.responseText).split('|^^|');
				document.getElementById('tabgroupgridwb3').innerHTML = response[1];
				document.getElementById('tabgroupgridc3').innerHTML = response[0];
			}
		}
		clearinnerhtml();
		ajaxcall4.send(passData);
}
