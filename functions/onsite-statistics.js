// Function to display the datas in onsite report based on the inputs given and also to set the form action
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var fromdate = form.fromdate;
	var todate = form.todate;
	
	var field = form.fromdate;
	if(!field.value) 
	{ 
		error.innerHTML = errormessage('Enter the Solved Date From on which the problem has been solved.'); 
		field.focus(); 
		return false; 
	}
	var field = form.todate;
	if(!field.value) 
	{ 
		error.innerHTML = errormessage('Enter the Solved Date To on which the problem has been solved.'); 
		field.focus(); 
		return false; 
	}

	if(command == 'toexcel')
	{
		form.action = '../reports-excel/onsite-statistics.php';
		form.target = '';
	    form.submit();
	}
	else
	{
		var reporton = getradiovalue(form.reporton);
		var anonymous = getradiovalue(form.anonymous);
		if(form.stremoteconnection.checked == true) { stremoteconnection = "true"; } else { stremoteconnection = "false"; }
		if(form.marketingperson.checked == true) { marketingperson = "true"; } else { marketingperson = "false"; }
		if(form.onsitevisit.checked == true) { onsitevisit = "true"; } else { onsitevisit = "false"; }
		if(form.overphone.checked == true) { overphone = "true"; } else { overphone = "false"; }
		if(form.mail.checked == true) { mail = "true"; } else { mail = "false"; }
		if(form.servicecharge.checked == true) { servicecharge = "true"; } else { servicecharge = "false"; }
		
		passData = "type=view" + "&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + 
"&servicecharge=" + form.servicecharge.value + "&solvedby=" + form.solvedby.value + "&stremoteconnection=" + 
stremoteconnection + "&anonymous=" + anonymous + "&reporton=" + reporton + "&marketingperson=" + marketingperson + 
"&onsitevisit=" + onsitevisit + "&overphone=" + overphone + "&mail=" + mail + "&customername=" + form.customername.value 
+ "&s_productgroup=" + form.s_productgroup.value + "&productname=" + form.productname.value + "&status=" + form.status.value + "&userid=" + form.userid.value + 
"&supportunit=" + form.supportunit.value + "&complaintid=" + form.complaintid.value + '&dummy=' + 
Math.floor(Math.random()*100000000);
		
		var ajaxcall = createajax();
		document.getElementById('processingbar').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		queryString = '../ajax/onsite-statistics.php';
		ajaxcall.open("POST", queryString, true);
		ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall.onreadystatechange = function()
		{
			if(ajaxcall.readyState == 4)
			{
				error.innerHTML = '';
				document.getElementById('processingbar').innerHTML = '';
				var ajaxresponse = ajaxcall.responseText;
				document.getElementById('displaystatsreport').innerHTML = ajaxresponse;
			}
		}
		ajaxcall.send(passData);
	}
}

//Function to print an htm page on pending onsite reports
/*function onsitependingvisitreport()
{
	passData = "dummy=" + Math.floor(Math.random()*109900563456334532680100);
	ajaxcall0 = createajax();
	var queryString = "../ajax/onsite-pendingvisit.php";
	ajaxcall0.open("POST", queryString, true);
	ajaxcall0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall0.onreadystatechange = function()
	{
		if(ajaxcall0.readyState == 4)
		{
			var ajaxresponse = ajaxcall0.responseText;
			var response = document.getElementById('printonsitependingvisits');
			response.innerHTML=ajaxresponse;
		}
	}
	ajaxcall0.send(passData);
}
*/