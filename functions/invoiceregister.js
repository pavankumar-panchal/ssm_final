//Function to submit the form on save and delete------------------------------------------------------------------
function formsubmit(command)
{
	alert('Imax Under Maintenance');
	return false;
	
	var form = document.getElementById('submitform');
	var error = $("#form-error");
	var field = form.customername;
	if(!field.value) { error.innerHTML = errormessage('Enter the Customer Name.'); field.focus(); return false; }
	var field = form.customerid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Customer ID.'); field.focus(); return false; }
	var field = form.date;
	if(!field.value) { error.innerHTML = errormessage('Enter the Date.'); field.focus(); return false; }
	var field = form.time;
	if(!field.value) { error.innerHTML = errormessage('Enter the Time.'); field.focus(); return false; }
	var field = form.productname;
	if(!field.value) { error.innerHTML = errormessage('Enter the Product Name.'); field.focus(); return false; }
	var field = form.productversion;
	if(!field.value) { error.innerHTML = errormessage('Enter the Product Version.'); field.focus(); return false; }
	var field = form.billdate;
	if(!field.value) { error.innerHTML = errormessage('Enter the Bill Date.'); field.focus(); return false; }
	var field = form.registername;
	if(!field.value) { error.innerHTML = errormessage('Enter the Register Name.'); field.focus(); return false; }
	var field = form.billno;
	if(!field.value) { error.innerHTML = errormessage('Enter the Bill Number.'); field.focus(); return false; }
	var field = form.billto;
	if(!field.value) { error.innerHTML = errormessage('Enter the Bill Given To.'); field.focus(); return false; }
	if(isAlpha(field.value) == false) { error.innerHTML = errormessage('Bill Given To should only be Alphabets.'); field.focus(); return false; }
	var field = form.amount;
	if(!field.value) { error.innerHTML = errormessage('Enter the Amount.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Amount should contain only Numerals.'); field.focus(); return false; }
	var field = form.tax;
	if(!field.value) { error.innerHTML = errormessage('Enter the Tax Amount.'); field.focus(); return false; }
	if(isNaN(field.value)) { error.innerHTML = errormessage('Tax Amount should contain only Numerals.'); field.focus(); return false; }
	var field = form.tamount;
	if(!field.value) { error.innerHTML = errormessage('Enter the Total Amount.'); field.focus(); return false; }
	var field = form.billedby;
	if(!field.value) { error.innerHTML = errormessage('Enter the Billed By.'); field.focus(); return false; }
	var field = form.remarks;
	if(!field.value) { error.innerHTML = errormessage('Enter the Remarks.'); field.focus(); return false; }
	var field = form.userid;
	if(!field.value) { error.innerHTML = errormessage('Enter the User ID.'); field.focus(); return false; }
	var field = form.complaintid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Complaint ID.'); field.focus(); return false; }
	else
	{
		var passData = "";
		if(command == 'delete')
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		else
			passData = 'type=save&lastslno=' + form.lastslno.value + '&customername=' + form.customername.value + '&customerid=' + form.customerid.value + '&date=' + form.date.value + '&time=' + form.time.value + '&productname=' + form.productname.value + '&productversion=' + form.productversion.value + '&billdate=' + form.billdate.value + '&registername=' + form.registername.value + '&billno=' + form.billno.value + '&billto=' + form.billto.value + '&amount=' + form.amount.value + '&tax=' + form.tax.value + '&tamount=' + form.tamount.value + '&billedby=' + form.billedby.value + '&remarks=' + form.remarks.value + '&userid=' + form.userid.value + '&complaintid=' + form.complaintid.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		
		queryString = '../ajax/invoice-billing.php';
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
					error.html(successmessage(response[1])).fadeIn().delay(5000).fadeOut();
					newentry(); form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.html(successmessage(response[1])).fadeIn().delay(5000).fadeOut();
					newentry(); form.reset(); datagrid();
				}
				else
				error.innerHTML = errormessage('Unable to Connect...' + response);
			}
		}
		ajaxcall0.send(passData);
	}
}

//Function to calculate the total amount of invoice---------------------------------------------------------------
function invoicetotalamount()
{
	var form = document.getElementById('submitform');
	var amount;
	var tax;
	if(!form.amount.value)
		amount = 0;
	else
	 	amount = parseFloat(form.amount.value);
	if(!form.tax.value)
		tax = 0;
	else
	 	tax = parseFloat(form.tax.value);
	var totalamount = amount + tax;
	form.tamount.value = totalamount;
}

//Function to load the grid on load of the page-------------------------------------------------------------------
function datagrid()
{
	var startlimit = '';
	var passData = "type=generategrid&dummy=" + Math.floor(Math.random()*10054300000)+ "&startlimit=" + encodeURIComponent(startlimit);//alert(passData);

	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/invoice-billing.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = (ajaxcall1.responseText).split('|^^|');
			gridtab4('1','tabgroupgrid');
			
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
	queryString = "../ajax/invoice-billing.php";
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
	ajaxcall2 = createajax();
	var queryString = "../ajax/invoice-billing.php";
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
			form.customername.value = response[1];
			form.customerid.value = response[2];
			form.cusid.value = response[2];
			form.date.value = response[3];
			form.time.value = response[4];
			form.productgroup.value = response[5];
			form.productname.value = response[6];
			form.productversion.value = response[7];
			form.billdate.value = response[8];
			form.registername.value = response[9];
			form.billno.value = response[10];
			form.billto.value = response[11];
			form.amount.value = response[12];
			form.tax.value = response[13];
			form.tamount.value = response[14];
			form.billedby.value = response[15];
			form.remarks.value = response[16];
			form.userid.value = response[17];
			form.complaintid.value = response[18];	
			if(response[27] == '')
			{
				form.state.disabled = false;
				form.state.value = response[27];
			}
			else
			{
				form.state.value = response[27];
			}		
			document.getElementById('teamleaderremarks').innerHTML = response[21];		
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[25]) || (loggeduser == response[26]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
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
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_customerid=" + encodeURIComponent(form.s_customerid.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + "&s_billdate=" + encodeURIComponent(form.s_billdate.value) + "&s_registername=" + encodeURIComponent(form.s_registername.value) + "&s_billedby=" + encodeURIComponent(form.s_billedby.value) + "&s_amount=" + encodeURIComponent(form.s_amount.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_complaintid=" + encodeURIComponent(form.s_complaintid.value) + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value)  + "&s_state=" + encodeURIComponent(form.s_state.value)  + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit);
		ajaxcall3 = createajax();
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/invoice-billing.php";
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
		form.action = '../searchreport/invoicebilling.php';
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
	"&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_customerid=" + 
	encodeURIComponent(form.s_customerid.value) + "&s_billno=" + encodeURIComponent(form.s_billno.value) + 
	"&s_billdate=" + encodeURIComponent(form.s_billdate.value) +
	"&s_registername=" + encodeURIComponent(form.s_registername.value) + 
	"&s_billedby=" + encodeURIComponent(form.s_billedby.value) +
	"&s_amount=" + encodeURIComponent(form.s_amount.value) + 
	"&s_userid=" + encodeURIComponent(form.s_userid.value) + 
	"&s_complaintid=" + encodeURIComponent(form.s_complaintid.value) + 
	"&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + 
	"&s_productname=" + encodeURIComponent(form.s_productname.value) + 
	"&s_state=" + encodeURIComponent(form.s_state.value) +
	"&orderby=" + encodeURIComponent(form.orderby.value) + 
	"&s_flags=" + getradiovalue(form.flagdatabasefield) +
	"&dummy=" + Math.floor(Math.random()*10000789641000) +
	"&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) +
	"&showtype=" + showtype;//alert(passData)
	//alert(passData);
	var queryString = "../ajax/invoice-billing.php";
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
function registerloadsearch(formid)
{
	var form = document.getElementById(formid);
	var textfield = form.searchcriteria.value;
	var subselection = getradiovalue(form.databasefield);
	var orderby = form.orderby.value;
	var registerdb = getradiovalue(form.database);
	passData = "type=1&registerdb=" + registerdb + "&textfield=" + encodeURIComponent(textfield) + "&subselection=" + subselection + "&orderby=" + orderby + "&dummy=" + Math.floor(Math.random()*1000782200000);
	callajax4 = createajax();
	var queryString = "../ajax/invoiceregisterloadscript.php";
	callajax4.open("POST", queryString, true);
	callajax4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	callajax4.onreadystatechange = function()
	{
		if(callajax4.readyState == 4)
		{
			var ajaxresponse = callajax4.responseText;
			document.getElementById('hiddendbinfo').value = registerdb;
			document.getElementById('nameloadgrid1').innerHTML = ajaxresponse;
		}
	}
	callajax4.send(passData);
	return false;
}

//Function to Load the customer name and value into the hidden field----------------------------------------------
function loadregistersetselect(cusname,cusid,date,time,productgroup,productname,productversion,registername,billdate,billno,complaintid,state,email,place)
{
	document.getElementById('selectvaluehidden').value = cusid + "^" + cusname + "^" + date + "^" + time + "^" + productgroup + "^" + productname + "^" + productversion + "^" + registername + "^" + billdate + "^" + billno + "^" + complaintid + "^" + state;
}

//Function to Store the values of customer name and id into respective field from the hidden field----------------
function loadpasscuidregister(hiddenid)
{
	var temp = document.getElementById(hiddenid).value.split('^');
	document.getElementById('customername').value = temp[1];
	document.getElementById('customerid').value = temp[0];
	document.getElementById('date').value = temp[2];
	document.getElementById('time').value = temp[3];
	document.getElementById('productgroup').value = temp[4];
	document.getElementById('productname').value = temp[5];
	document.getElementById('productversion').value = temp[6];
	document.getElementById('registername').value = temp[7];
	document.getElementById('billdate').value = temp[8];
	document.getElementById('billno').value = temp[9];
	document.getElementById('complaintid').value = temp[10];
	document.getElementById('state').value = temp[11];
	
}

//Function which has been called on getinvoice link--------------------------------------------------------------
function getregisterdata()
{
	document.getElementById('registerloadform').reset();
	registerloadsearch('registerloadform');
}

//Function to display the flagged entries the records from database-----------------------------------------------
function flags()
{
		passData = "type=flags&dummy=" + Math.floor(Math.random()*10000789641000);
		ajaxcall5 = createajax();
		document.getElementById('tabgroupgridwb3').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		var queryString = "../ajax/invoice-billing.php";
		ajaxcall5.open("POST", queryString, true);
		ajaxcall5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall5.onreadystatechange = function()
		{
			if(ajaxcall5.readyState == 4)
			{
				var response = (ajaxcall5.responseText).split('|^^|');
				document.getElementById('tabgroupgridwb3').innerHTML = response[1];
				document.getElementById('tabgroupgridc3').innerHTML = response[0];
			}
		}
		clearinnerhtml();
		ajaxcall5.send(passData);
}
