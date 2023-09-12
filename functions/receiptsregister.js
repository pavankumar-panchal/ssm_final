   //Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.customername;
	if(!field.value) { error.innerHTML = errormessage('Enter the Customer Name.'); field.focus(); return false; }
	var field = form.customerid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Customer ID.'); field.focus(); return false; }
	var field = form.date;
	if(!field.value) { error.innerHTML = errormessage('Enter the Date.'); field.focus(); return false; }
	var field = form.time;
	if(!field.value) { error.innerHTML = errormessage('Enter the Time.'); field.focus(); return false; }
	var field = form.billdate;
	if(!field.value) { error.innerHTML = errormessage('Enter the Bill Date.'); field.focus(); return false; }
	var field = form.billno;
	if(!field.value) { error.innerHTML = errormessage('Enter the Bill Number.'); field.focus(); return false; }
	var field = form.receiptno;
	if(!field.value) { error.innerHTML = errormessage('Enter the Receipt Number.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Receipt Number should contain only Numerals.'); field.focus(); return false; }
	var field = form.receiptdate;
	if(!field.value) { error.innerHTML = errormessage('Enter the Receipt Date.'); field.focus(); return false; }
	var field = form.cheque_cash;
	if(!field.value) { error.innerHTML = errormessage('Enter whether Cheque or Cash.'); field.focus(); return false; }
	var field = form.chequeno;
	if((!field.value) && form.cheque_cash.value == 'cheque') { error.innerHTML = errormessage('Enter the Cheque Number.'); field.focus(); return false; }
	if((field.value) && form.cheque_cash.value == 'cash') { error.innerHTML = errormessage('Cheque Number should be null as Paid by is Cash.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Cheque Number should contain only Numerals.'); field.focus(); return false; }
	var field = form.amount;
	if(isNaN(field.value)) { error.innerHTML = errormessage('Amount should contain only Numerals.'); field.focus(); return false; }
	if(!field.value) { error.innerHTML = errormessage('Enter the Amount.'); field.focus(); return false; }
	var field = form.remarks;
	if(!field.value) { error.innerHTML = errormessage('Enter the Remarks.'); field.focus(); return false; }
	var field = form.userid;	
	if(!field.value) { error.innerHTML = errormessage('Enter the User ID.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value + '&customername=' + form.customername.value + '&customerid=' + form.customerid.value + '&date=' + form.date.value + '&time=' + form.time.value + '&billdate=' + form.billdate.value + '&billno=' + form.billno.value + '&receiptno=' + form.receiptno.value + '&receiptdate=' + form.receiptdate.value + '&cheque_cash=' + form.cheque_cash.value + '&chequeno=' + form.chequeno.value + '&amount=' + form.amount.value + '&remarks=' + form.remarks.value + '&userid=' + form.userid.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/receipts-billing.php';
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
					newentry();	form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage(response[1]);
					newentry(); form.reset(); datagrid();
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
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000)+ "&startlimit=" + encodeURIComponent(startlimit);
	var ajaxcall0 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/receipts-billing.php";
	ajaxcall0.open("POST", queryString, true);
	ajaxcall0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall0.onreadystatechange = function()
	{
		if(ajaxcall0.readyState == 4)
		{
			var response = (ajaxcall0.responseText).split('|^^|');
			gridtab4('1','tabgroupgrid');
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1_2').innerHTML = response[0];
			document.getElementById('tabgroupgridc1link1').innerHTML = response[2];
		}
	}
	ajaxcall0.send(passData);
}

function getmore(startlimit,slno,showtype)
{
	
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) + "&showtype=" + showtype;//alert(passData)
	//alert(passData);
	queryString = "../ajax/receipts-billing.php";
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
	clearinnerhtml();
	var passData = "type=gridtoform&lastslno=" + slno + "&dummy=" + Math.floor(Math.random()*100032680100);
	ajaxcall1 = createajax();
	var queryString = "../ajax/receipts-billing.php";
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
			form.customername.value = response[1];
			form.customerid.value = response[2];
			form.date.value = response[3];
			form.time.value = response[4];
			form.billdate.value = response[5];
			form.billno.value = response[6];
			form.receiptno.value = response[7];
			form.receiptdate.value = response[8];
			form.cheque_cash.value = response[9];
			form.chequeno.value = response[10];
			form.amount.value = response[11];
			form.remarks.value = response[12];
			form.userid.value = response[13];
			document.getElementById('teamleaderremarks').innerHTML = response[16];
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[20]) || (loggeduser == response[21]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
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
	ajaxcall1.send(passData);
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
	if(command == 'view')
	{
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_customerid=" + encodeURIComponent(form.s_customerid.value) + "&s_billdate=" + encodeURIComponent(form.s_billdate.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + "&s_receiptno=" + encodeURIComponent(form.s_receiptno.value) + "&s_receiptdate=" + encodeURIComponent(form.s_receiptdate.value) + "&s_chequeno=" + encodeURIComponent(form.s_chequeno.value) + "&s_amount=" + encodeURIComponent(form.s_amount.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000) + "&startlimit=" + encodeURIComponent(startlimit);
		ajaxcall2 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/receipts-billing.php";
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
		form.action = '../searchreport/receiptsbilling.php';
		form.target = '_blank';
	    form.submit();
	}
}

function getmorerecords(startlimit,slno,showtype)
{
	var form = document.getElementById('filterform');
	var fromdate = form.fromdate; 
	var todate = form.todate;
	var error = document.getElementById('filter-form-error');
	if(!fromdate.value) { error.innerHTML = errormessage('Enter the From Date'); fromdate.focus(); return false; }
	if(!todate.value) { error.innerHTML = errormessage('Enter the To Date'); todate.focus(); return false; }
	
	passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + 
	"&s_customername=" + encodeURIComponent(form.s_customername.value) + 
	"&s_customerid=" + encodeURIComponent(form.s_customerid.value) + 
	"&s_billdate=" + encodeURIComponent(form.s_billdate.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + 
	"&s_receiptno=" + encodeURIComponent(form.s_receiptno.value) + 
	"&s_receiptdate=" + encodeURIComponent(form.s_receiptdate.value) + 
	"&s_chequeno=" + encodeURIComponent(form.s_chequeno.value) + "&s_amount=" + encodeURIComponent(form.s_amount.value) + 
	"&s_userid=" + encodeURIComponent(form.s_userid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + 
	"&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+
	"&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) +
	"&showtype=" + showtype;//alert(passData)
	//alert(passData);
	queryString = "../ajax/receipts-billing.php";
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


//Function to Search the data from Inventory/Dealers through AJAX-------------------------------------------------
function invoiceregisterload(formid)
{
	var form = document.getElementById(formid);
	var textfield = form.searchcriteria.value;
	var subselection = getradiovalue(form.databasefield);
	var orderby = form.orderby.value;
	passData = "type=gridtoform&textfield=" + encodeURIComponent(textfield) + "&subselection=" + subselection + "&orderby=" + orderby + "&dummy=" + Math.floor(Math.random()*1001235800000);
	callajax = createajax();
	var queryString = "../ajax/receiptsregisterloadscript.php";
	callajax.open("POST", queryString, true);
	callajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	callajax.onreadystatechange = function()
	{
		if(callajax.readyState == 4)
		{
			var ajaxresponse = callajax.responseText;
			document.getElementById('invoiceregisterloadgrid').innerHTML = ajaxresponse;
		}
	}
	callajax.send(passData);
}


//Function to Load the invoice name and value into the hidden field-----------------------------------------------
function loadinvoiceregistersetselect(cusName,cusId,bilno,bildate)
{
	document.getElementById('hiddenlastslno').value = cusName + "^" + cusId + "^" + bilno + "^" + bildate;
}

//Function to Store the values of invoice name and id into respective field from the hidden field-----------------
function loadinvoicesubmit(hiddenid)
{
	var temp = document.getElementById(hiddenid).value.split('^');
	document.getElementById('customername').value = temp[0];
	document.getElementById('customerid').value = temp[1];
	document.getElementById('billno').value = temp[2];
	document.getElementById('billdate').value = temp[3];
}

//Function which has been called on get receipts link--------------------------------------------------------------
function getinvoiceregister()
{
	document.getElementById('invoiceregisterloadform').reset();
	invoiceregisterload('invoiceregisterloadform');
}

//Function to display the flagged entries the records from database-----------------------------------------------
function flags()
{
	passData = "type=flags&dummy=" + Math.floor(Math.random()*10000789641000);
	ajaxcall3 = createajax();
	document.getElementById('tabgroupgridwb3').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	var queryString = "../ajax/receipts-billing.php";
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
