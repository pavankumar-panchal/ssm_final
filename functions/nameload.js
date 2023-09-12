//Function to Search the data from Inventory/Dealers/Out Station Employee------------------------------------------
function nameloadsearch(formid)
{
	//alert('test');
	var form = document.getElementById(formid);
	var textfield = form.searchcriteria.value;
	var subselection = getradiovalue(form.databasefield);
	var orderby = form.orderby.value;
	var customerdb = getradiovalue(form.database);
	passData = "type=1&customerdb=" + customerdb + "&textfield=" + encodeURIComponent(textfield) + "&subselection=" + subselection + "&orderby=" + orderby + "&dummy=" + Math.floor(Math.random()*1000782200000);
	ajaxcall0 = createajax();
	document.getElementById('wait-box').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	var queryString = "../ajax/nameloadscript1.php";
	ajaxcall0.open("POST", queryString, true);
	ajaxcall0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall0.onreadystatechange = function()
	{
		if(ajaxcall0.readyState == 4)
		{
			var ajaxresponse = ajaxcall0.responseText;
			document.getElementById('wait-box').innerHTML = '';
			document.getElementById('nameloadgrid1').innerHTML =  ajaxresponse;
			document.getElementById('nameloadgrid2').innerHTML = '';
			document.getElementById('hiddendbinfo').value = customerdb;
		}
	}
	ajaxcall0.send(passData);return false;
}

//Function to Search the registration data from Inventory/Dealers/Out Station Employee-----------------------------
function nameloadregistration(formid)
{
	//alert('test343');
	var form = document.getElementById(formid);
	var cusid = getradiovalue(form.nameloadcustomerradio);
	//alert(cusid);
	var customerdb = document.getElementById('hiddendbinfo').value;
	passData = "type=2&customerdb=" + customerdb + "&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	callajax = createajax();//alert(passData);
	var queryString = '../ajax/nameloadscript1.php';
	callajax.open('POST', queryString, true);
	callajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	callajax.onreadystatechange = function()
	{
		if(callajax.readyState == 4)
		{
			var ajaxresponse = callajax.responseText;
			document.getElementById('nameloadgrid2').innerHTML = ajaxresponse; //alert(ajaxresponse);
		}
	}
	callajax.send(passData);return false;
}

//Function to Load the customer name and value into the hidden field-----------------------------------------------
function loadnamesetselect(cusid,cusname,category,type,date,time,state)
{
	document.getElementById('selectvaluehidden').value = escapesinglequotes(cusid) + "^" + escapesinglequotes(cusname) + "^" + escapesinglequotes(category) + "^" + escapesinglequotes(type) + "^" + escapesinglequotes(date) + "^" + escapesinglequotes(time) + "^" + escapesinglequotes(state);
}

//Function to Store the values of customer name and id into respective field from the hidden field-----------------
function loadpasscuidname(hiddenid)
{
	var temp = document.getElementById(hiddenid).value.split('^');
	if(document.getElementById('customerid')) document.getElementById('customerid').value = temp[0];
	if(document.getElementById('customername')) document.getElementById('customername').value = temp[1];
	if(document.getElementById('category')) document.getElementById('category').value = temp[2];
	if(document.getElementById('callertype')) document.getElementById('callertype').value = temp[3];
	if(document.getElementById('date') && (!document.getElementById('date').value)) document.getElementById('date').value = temp[4];
	if(document.getElementById('time')) document.getElementById('time').value = temp[5];
	if(document.getElementById('state')) document.getElementById('state').value = temp[6];
	//displayamcinfo(temp[0]);
}

//Function which has been called on getcustomer link---------------------------------------------------------------
function getcustomer()
{
	document.getElementById('nameloadform').reset();
	nameloadsearch('nameloadform');
}

//Function to get the value of selected radio element---------------------------------------------------------------
function getradiovalue1(radioname)
{
	if(radioname.value)
		return radioname.value;
	else
	{
		for(var i = 0; i < radioname.length; i++) 
		{
			if(radioname[i].checked) 
				return radioname[i].value;
		}
	}
}


function registernameload(register)
{
	document.getElementById('hiddenregisterinfo').value = register;
}

//Function to filter the records from database--------------------------------------------------------------------
function customerrecords(formid)
{
	var form = document.getElementById(formid);
	var customerdb = document.getElementById('hiddenregisterinfo').value;
	cusid = document.getElementById('customerid').value;
	if(customerdb == 'call')
		passData = "type=3&customerdb=call&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'email')
		passData = "type=3&customerdb=email&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'error')
		passData = "type=3&customerdb=error&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'inhouse')
		passData = "type=3&customerdb=inhouse&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'onsite')
		passData = "type=3&customerdb=onsite&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'reference')
		passData = "type=3&customerdb=reference&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'requirement')
		passData = "type=3&customerdb=requirement&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'skype')
		passData = "type=3&customerdb=skype&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'invoice')
		passData = "type=3&customerdb=invoice&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	if(customerdb == 'receipt')
		passData = "type=3&customerdb=receipt&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*10000044400);
	ajaxcallreg = createajax();
	document.getElementById('tabgroupgridwb4').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	var queryString = "../ajax/nameloadscript1.php";
	ajaxcallreg.open("POST", queryString, true);
	ajaxcallreg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcallreg.onreadystatechange = function()
	{
		if(ajaxcallreg.readyState == 4)
		{
			var response = (ajaxcallreg.responseText).split('|^^|');
			gridtab4('4','tabgroupgrid');
			document.getElementById('tabgroupgridwb4').innerHTML = response[1];
			document.getElementById('tabgroupgridc4').innerHTML = response[0];
		}
	}
	ajaxcallreg.send(passData);
}

