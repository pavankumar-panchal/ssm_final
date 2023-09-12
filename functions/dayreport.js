//Function to diaplay the report based on the inputs given--------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var check=document.getElementsByName('check[]');
	var customer = document.getElementById('customer');
	var dealer = document.getElementById('dealer');
	var osemployee = document.getElementById('osemployee');
	var userid = document.getElementById('userid').value;
	var error = document.getElementById('form-error');

	var checkflag = false;
	for(var i = 0; i < check.length; i++)
	{
		if(check[i].checked == true && checkflag == false)
			checkflag = true;
	}
	if(checkflag == false)
	{
		error.innerHTML = errormessage('Select a Register.');
		form.check[0].focus();
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
	if (osemployee.checked == false && customer.checked == false && dealer.checked == false)
	{
		error.innerHTML = errormessage('Select a Caller Type.');
		customer.focus();
		return false;
	}
	if(command == 'toexcel')
	{
		form.action = '../reports-excel/dailyreport.php';
		form.target = '';
	    form.submit();
	}
	else
	{
		form.action = '../reports-view/dailyreport.php';
		form.target = '_blank';
	    form.submit();
	}
}
