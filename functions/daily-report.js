//Function to diaplay the report based on the inputs given--------------------------------------------------------
function formsubmit(command)
{
	var form = document.getElementById('submitform');
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
	if(command == 'view')
	{
		passData = '&fromdate=' + form.fromdate.value + "&usertype=" + form.usertype.value + "&todate=" + form.todate.value + 
					"&userid=" + $("#userid").val() + "&username=" + $("#username").val() +
					 '&dummy=' + Math.floor(Math.random()*100000000);
		document.getElementById('form-error').innerHTML = '<img src="../images/processing.gif" border="0"/>';
		ajaxobject38 = $.ajax({
								type:"POST",
								data:passData,
								url:"../ajax/daily-report-default.php",
								cache:false,
								success: function(response,status)
								{
									document.getElementById('form-error').innerHTML = '';
									$("#dailyreport").html(response);
								}
	});
	}
	else if(command == 'toexcel')
	{	
		passData = '&fromdate=' + form.fromdate.value + "&usertype=" + form.usertype.value + "&todate=" + form.todate.value + 
					"&userid=" + $("#userid").val() + "&username=" + $("#username").val() +
					'&dummy=' + Math.floor(Math.random()*100000000);
		form.action = '../reports-excel/daily-report.php';
		form.target = '_blank';
	    form.submit();
	}
}

function calldatalist(customername,slno) 
{ 
    var passdata = "&customername=" + customername + "&slno=" + slno;
	$("#calldataitem").html('<img src="../images/loading.gif" border="0"/>').dialog({modal: true, height: 300 , width: 400 });
	ajaxobject38 = $.ajax
	({
		type:"POST",
		data:passdata,
		url:'../ajax/daily-report.php',
		cache:false,
		success:function(response,status)
		{
			$("#calldataitem").html(response);
		}
	});
}

function callingdatalist(compliantidid) 
{	
	var passdata = "type=callsdatalist&compliantidid=" + compliantidid ;
	$("#display_form").html('<img src="../images/loading.gif" border="0"/>').dialog({modal: true, height: 600 , width: 1000 });
	ajaxobject38 = $.ajax
	({
		type:"POST",
		data:passdata,
		url:'../ajax/daily-report-display.php',
		cache:false,
		success:function(response,status)
		{	
			$("#display_form").html(response);
		}
	});
}

function chatsdatalist(skypeidid) 
{		
	var passdata = "type=chatsdatalist&skypeidid=" + skypeidid ;
	$("#display_form").html('<img src="../images/loading.gif" border="0"/>').dialog({modal: true, height: 650 , width: 1000 });
	ajaxobject38 = $.ajax
	({
		type:"POST",
		data:passdata,
		url:'../ajax/daily-report-display.php',
		cache:false,
		success:function(response,status)
		{
			$("#display_form").html(response);
		}
	});
}

function emaildatalist(compliantidlist) 
{		
	var passdata = "type=emaildatalist&compliantidlist=" + compliantidlist ;
	$("#display_form").html('<img src="../images/loading.gif" border="0"/>').dialog({modal: true, height: 650 , width: 1000 });
	ajaxobject38 = $.ajax
	({
		type:"POST",
		data:passdata,
		url:'../ajax/daily-report-display.php',
		cache:false,
		success:function(response,status)
		{
			$("#display_form").html(response);	
		}
	});
}