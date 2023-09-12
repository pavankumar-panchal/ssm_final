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
	if(checkflag != true) { error.innerHTML = errormessage('Select a Register.'); check[0].focus(); return false; }
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
		if(command == 'toexcel')
		{
			error.innerHTML = '';
			form.action = '../reports-excel/call-statistics.php';
			form.target = '';
			form.submit();
		}
		else
		{
			error.innerHTML = '';
			form.action = '../reports-view/call-statistics.php';
			form.target = '_blank';
			form.submit();
		}
	}
}
