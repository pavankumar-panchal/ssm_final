//Function to change the mandatory fields according to the radio value--------------------------------------------
function formsubmitcustomer()
{
	var form = document.getElementById('submitform');
	if(getradiovalue(form.anonymous) == 'no')
	{
		form.customername.value=''; form.customername.readOnly = true; form.customername.style.background="#FEFFE6";
		form.customerid.value=''; form.customername.readOnly = true; form.customername.style.background="#FEFFE6";
		form.state.value=''; form.state.disabled = true; form.state.style.background="#FEFFE6";
		document.getElementById('getcustomerlink').style.visibility = 'visible';
	}
	else
	{
		form.customername.value=''; form.customername.readOnly = false; form.customername.style.background="#FFFFFF";
		form.customerid.value=''; form.customername.readOnly = false; form.customername.style.background="#FFFFFF";
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
	}
	var field = form.productgroup;
	if(!field.value) { error.innerHTML = errormessage('Select the Product Group.'); field.focus(); return false; }

	var field = form.database;
	if(!field.value) { error.innerHTML = errormessage('Database'); field.focus(); return false; }
	var field = form.errorreported;
	if(!field.value) { error.innerHTML = errormessage('Enter the Error Reported.'); field.focus(); return false; }
	var field = form.errorunderstood;
	if(!field.value) { error.innerHTML = errormessage('Enter the Error Understood by You.'); field.focus(); return false; }
	var field = form.reportedto;
	if(!field.value) { error.innerHTML = errormessage('Enter to whom the error has been reported.'); field.focus(); return false; }
	if(isAlpha(field.value) == false) { error.innerHTML = errormessage('Reported To should only be Alphabets.'); field.focus(); return false; }
	var field = form.status;
	if(!field.value) { error.innerHTML = errormessage('Select the Status.'); field.focus(); return false; }
	var field = form.solveddate;
	if((!field.value) && (form.status.value == 'solved')) { error.innerHTML = errormessage("Enter the Solved Date."); field.focus(); return false;}
	if((field.value) && (form.status.value == 'unsolved')) { error.innerHTML = errormessage("Solved Date should be null as status is unsolved"); field.focus(); return false;}
	var field = form.solutiongiven;
	if((!field.value) && (form.status.value == 'solved')) { error.innerHTML = errormessage("Enter the Solution Given."); field.focus(); return false; }
	if((field.value) && (form.status.value == 'unsolved')) { error.innerHTML = errormessage("Solution given should be null as status is unsolved"); field.focus(); return false;}
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else if(command == 'save')
			passData = 'type=save&lastslno=' + form.lastslno.value + '&anonymous=' + getradiovalue(form.anonymous) + '&customername=' + encodeURIComponent(form.customername.value) + '&customerid=' + encodeURIComponent(form.customerid.value) + '&productgroup=' + encodeURIComponent(form.productgroup.value) + '&productname=' + encodeURIComponent(form.productname.value) + '&productversion=' + encodeURIComponent(form.productversion.value) + '&database=' + encodeURIComponent(form.database.value) + '&date=' + encodeURIComponent(form.date.value) + '&time=' + encodeURIComponent(form.time.value) +  '&state=' + encodeURIComponent(form.state.value) + '&errorreported=' + encodeURIComponent(form.errorreported.value) + '&errorunderstood=' + encodeURIComponent(form.errorunderstood.value) + '&reportedto=' + encodeURIComponent(form.reportedto.value) + '&errorfile=' + encodeURIComponent(form.errorfile.value) + '&status=' + encodeURIComponent(form.status.value) + '&solveddate=' + encodeURIComponent(form.solveddate.value) + '&solutiongiven=' + encodeURIComponent(form.solutiongiven.value) + '&solutionenteredtime=' + encodeURIComponent(form.solutionenteredtime.value) + '&solutionfile=' + encodeURIComponent(form.solutionfile.value) + '&remarks=' + encodeURIComponent(form.remarks.value) + '&userid=' + encodeURIComponent(form.userid.value) + '&errorid=' + encodeURIComponent(form.errorid.value) + '&dummy=' + Math.floor(Math.random()*10019200000);//alert(passData)
		else
			passData = 'type=errorreport&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*10120000000);
		//alert(passData)
		queryString = '../ajax/error-register.php';
		var ajaxcall0 = createajax();
		document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		ajaxcall0.open('POST', queryString, true);
		ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxcall0.onreadystatechange = function()
		{
			if(ajaxcall0.readyState == 4)
			{
				document.getElementById('tabgroupgridwb1').innerHTML = '';
				if(command == 'errorreport')
				{
					document.getElementById('errorreportgrid').value = ajaxcall0.responseText;						
					form.action = '../reports-excel/bug-report.php';
					form.submit();
				}
				else
				{
					var response = (ajaxcall0.responseText).split('^');
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
	queryString = "../ajax/error-register.php";
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
	var queryString = "../ajax/error-register.php";
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
	var queryString = "../ajax/error-register.php";
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
			form.productgroup.value = response[3];
			//form.productname.value = response[4];
			productnamefunction('productname',response[4],response[5]); 
			//productversionFunction('productversion',response[5]);
			form.database.value = response[6];
			form.date.value = response[7];
			form.time.value = response[8];
			form.errorreported.value = response[9];
			
			form.reportedto.value = response[10];
			form.errorfile.value = response[11];
			if(response[11])
			{
			document.getElementById('downloadlinkfile').innerHTML = '&nbsp;<a href="' + response[26]+response[11] + '"><img src="../images/download.jpg"  align="absmiddle"  border="0"/></a>';
			}
			else
			{
			document.getElementById('downloadlinkfile').innerHTML = '';
			}
			form.status.value = response[12];
			form.solveddate.value = response[13];
			form.solutiongiven.value = response[14];
			form.solutionenteredtime.value = response[15];
			form.solutionfile.value = response[16];
			if(response[16])
			{
			document.getElementById('downloadlinkfile').innerHTML = '&nbsp;<a href="' + response[26]+response[16] + '"><img src="../images/download.jpg"  align="absmiddle"  border="0"/></a>';
			}
			else
			{
			document.getElementById('downloadlinkfile').innerHTML = '';
			}
			form.remarks.value = response[17];
			form.userid.value = response[18];
			form.errorid.value = response[19];	
			form.customerid.value = response[29];	
			form.errorunderstood.value = response[30];	
			
			if(response[31] == '')
			{
				form.state.disabled = false;
				form.state.value = response[31];
			}
			else
			{
				form.state.value = response[31];
			}	
			document.getElementById('teamleaderremarks').innerHTML = response[22];
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[26]) || (loggeduser == response[27]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
			{
				//formsubmitcustomer();
				enabledelete();
				enableexcelreport();
				enablesave();
			}
			else
			{
				//formsubmitcustomer();
				disabledelete();
				disableexcelreport();
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
	/*if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }*/
	if(command == 'view')
	{
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_state=" + encodeURIComponent(form.s_state.value) + "&s_productgroup=" + form.s_productgroup.value + "&s_productname=" + form.s_productname.value + "&s_errorreported=" + encodeURIComponent(form.s_errorreported.value) + "&s_reportedto=" + encodeURIComponent(form.s_reportedto.value) + "&s_errorfile=" + form.s_errorfile.value + "&s_status=" + form.s_status.value + "&s_solveddate=" + form.s_solveddate.value + "&s_solutiongiven=" + encodeURIComponent(form.s_solutiongiven.value) + "&s_solutionfile=" + encodeURIComponent(form.s_solutionfile.value) + "&s_remarks=" + encodeURIComponent(form.s_remarks.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_errorid=" + encodeURIComponent(form.s_errorid.value) + "&orderby=" + form.orderby.value + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000) +"&startlimit=" + encodeURIComponent(startlimit);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/error-register.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');//alert(response[2])
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
		form.action = '../searchreport/errorregister.php';
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
	var	passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_state=" + encodeURIComponent(form.s_state.value) + "&s_productgroup=" + form.s_productgroup.value + "&s_productname=" + form.s_productname.value + "&s_errorreported=" + encodeURIComponent(form.s_errorreported.value) + "&s_reportedto=" + encodeURIComponent(form.s_reportedto.value) + "&s_errorfile=" + form.s_errorfile.value + "&s_status=" + form.s_status.value + "&s_solveddate=" + form.s_solveddate.value + "&s_solutiongiven=" + encodeURIComponent(form.s_solutiongiven.value) + "&s_solutionfile=" + encodeURIComponent(form.s_solutionfile.value) + "&s_remarks=" + encodeURIComponent(form.s_remarks.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_errorid=" + encodeURIComponent(form.s_errorid.value) + "&orderby=" + form.orderby.value + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000) +"&startlimit=" + encodeURIComponent(startlimit) + "&slno=" + encodeURIComponent(slno)+ "&showtype=" + showtype;
	//alert(passData);
	var queryString = "../ajax/error-register.php";
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
	var queryString = "../ajax/error-register.php";
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

