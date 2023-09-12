//Function to search and display the datas from error register in the bug report---------------------------------
function formsubmit()
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.fromdate;
	if(!field.value) { error.innerHTML = errormessage('Enter the From Date.'); field.focus(); return false; }
	var field = form.todate;
	if(!field.value) { error.innerHTML = errormessage('Enter the To Date.'); field.focus(); return false; }
	
	var field = form.s_productgroup;
	if(!field.value) { error.innerHTML = errormessage('Enter the Product Group'); field.focus(); return false; }
	

	var field = form.productname;
	if(!field.value) { error.innerHTML = errormessage('Enter the Product Name.'); field.focus(); return false; }

	passData = "s_productgroup=" + form.s_productgroup.value + "&productname=" + form.productname.value +  "&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&status=" + form.status.value + "&errorreported=" + form.errorreported .value + "&reportedto=" + form.reportedto.value  + "&userid=" + form.userid.value + "&customername=" + form.customername.value  + "&dummy=" + Math.floor(Math.random()*1090077100000);
	
	ajaxcall = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	var queryString = "../ajax/bug-statistics.php";
	ajaxcall.open("POST", queryString, true);
	ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall.onreadystatechange = function()
	{
		if(ajaxcall.readyState == 4)
		{
			var ajaxresponse = ajaxcall.responseText;
			var response = ajaxresponse.split('|^^|');
			document.getElementById('tabgroupgridwb1').innerHTML = response[1];
			document.getElementById('tabgroupgridc1').innerHTML = response[0];
		}
	}
	ajaxcall.send(passData);
	return false;
}

//Function to select all the check boxes in a group-----------------------------------------------------------------
function checkAll()
{
	var field = document.getElementsByTagName('input');
	var selection = (document.getElementById('selectedcheckbox').checked == true)?true:false;
	for(i=0; i<field.length; i++)
	{
		if(field[i].type == 'checkbox' && field[i].name == 'check[]')
		field[i].checked = selection;
	}
}
