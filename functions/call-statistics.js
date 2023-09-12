//Function to diaplay the report based on the inputs given--------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var check = document.getElementsByName('check[]');
	var customer = form.customer;
	var dealer = form.dealer;
	var employee = form.employee;
	var ssmuser = form.ssmuser;
	var userid = form.userid.value;
	var error = document.getElementById('form-error');

	var checkflag = false;
	for(var i = 0; i < check.length; i++)
	{
		if(check[i].checked == true && checkflag == false)
			checkflag = true;
	}
	if(checkflag != true) 
	{ 
		error.innerHTML = errormessage('Select a Register.'); 
		check[0].focus(); 
		return false; 
	}
    if(!form.fromdate.value)
	{
		error.innerHTML = errormessage('Enter the From Date.');
		form.fromdate.focus();
		return false;
	}
	if(!form.todate.value)
	{
		error.innerHTML = errormessage('Enter the To Date.');
		form.todate.focus();
		return false;
	}
	if(customer.checked != true && dealer.checked != true && employee.checked != true && ssmuser.checked != true )
	{
		error.innerHTML = errormessage('Select the Caller Type.');
		form.customer.focus();
		return false;
	}
	else
	{
		if(command == 'view')
		{
			var reporton = getradiovalue(form.reporton);
			var anonymous = getradiovalue(form.anonymous);
			register_value = get_check_value('check[]');
			if(form.customer.checked == true) { customer = "true"; } else { customer = "false"; }
			if(form.dealer.checked == true) { dealer = "true"; } else { dealer = "false"; }
			if(form.employee.checked == true) { employee = "true"; } else { employee = "false"; }
			if(form.ssmuser.checked == true) { ssmuser = "true"; } else { ssmuser = "false"; }
			/*var customer = form.customer.checked.value;
			var dealer = form.dealer.checked.value;
			var employee = form.employee.checked.value;
			var ssmuser = form.ssmuser.checked.value;*/
			
			passData = 'type=view&register=' + register_value + "&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&userid=" + form.userid.value + "&category=" + form.category.value + "&supportunit=" + form.supportunit.value + "&anonymous=" + anonymous + "&reporton=" + reporton + "&customer=" + customer + "&dealer=" + dealer + "&employee=" + employee + "&ssmuser=" + ssmuser + '&dummy=' + Math.floor(Math.random()*100000000);//alert(passData)
			var ajaxcall = createajax();
			document.getElementById('processingbar').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
			queryString = '../ajax/call-statistics.php';
			ajaxcall.open("POST", queryString, true);
			ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxcall.onreadystatechange = function()
			{
				if(ajaxcall.readyState == 4)//alert(ajaxresponse)
				{
					error.innerHTML = '';
					document.getElementById('processingbar').innerHTML = '';
					var ajaxresponse = ajaxcall.responseText
					document.getElementById('displaystatsreport').innerHTML = ajaxresponse;
				}
			}
			ajaxcall.send(passData);
		}
		else
		{
			error.innerHTML = '';
			form.action = '../reports-excel/call-statistics.php';
			form.target = '';
			form.submit();
		}
	}
}
