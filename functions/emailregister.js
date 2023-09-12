//Function to change the mandatory fields according to the radio value--------------------------------------------
function formsubmitcustomer()
{
	var form = document.getElementById('submitform');
	if(getradiovalue(form.anonymous) == 'no')
	{
		form.customername.value=''; form.customername.readOnly = true; form.customername.style.background="#FEFFE6";
		form.customerid.value=''; form.customerid.readOnly = true; form.customerid.style.background="#FEFFE6";
		form.category.value=''; form.category.readOnly = true; form.category.style.background="#FEFFE6";
		form.state.value=''; form.state.disabled = true; form.state.style.background="#FEFFE6";
		form.callertype.value=''; form.callertype.readOnly = true; form.callertype.style.background="#FEFFE6";
		document.getElementById('getcustomerlink').style.visibility = 'visible';
	}
	else
	{
		form.customername.value=''; form.customername.readOnly = false; form.customername.style.background="#FFFFFF";
		form.customerid.value=''; form.customerid.readOnly = false; form.customerid.style.background="#FFFFFF";
		form.category.value=''; form.category.readOnly = false; form.category.style.background="#FFFFFF";
		form.state.value=''; form.state.disabled = false; form.state.style.background="#FFFFFF";
		form.callertype.value=''; form.callertype.readOnly = false; form.callertype.style.background="#FFFFFF";
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
		var field = form.customerid;
		if(!field.value) { error.innerHTML = errormessage('Get the customerid from Get Customer.'); field.focus(); return false; }
		var field = form.callertype;
		if(!field.value) { error.innerHTML = errormessage('Get the callertype from Get Customer.'); field.focus(); return false; }
		var field = form.category;
		if(!field.value) { error.innerHTML = errormessage('Get the callertype from Get Customer.'); field.focus(); return false; }
	}
	var field = form.personname;
	if(field.value) { if(isAlpha(field.value) == false) { error.innerHTML = errormessage('Bill Given To should only be Alphabets.'); field.focus(); return false; } }
	var field = form.productgroup;
	if(!field.value) { error.innerHTML = errormessage('Select the Product Group.'); field.focus(); return false; }
	
	var field = form.emailid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Email ID.'); field.focus(); return false; }
	if(field.value)	{ var a = checkemail(field.value); if(a==false) { error.innerHTML = errormessage('Enter the correct Email ID.'); field.focus(); return false; } }
	var field = form.subject;
	if(!field.value) { error.innerHTML = errormessage('Enter the Subject line of the Email.'); field.focus(); return false; }
	var field = form.content;
	if(!field.value) { error.innerHTML = errormessage('Enter the Content of the Email.'); field.focus(); return false; }
	var field = form.thankingemail; 
	if(field.checked == true && form.status.value != 'solved') { error.innerHTML = errormessage('Uncheck Thanking Email as the status is not solved.'); field.focus(); return false;}
	var thankingemail;
	if(field.checked == true) thankingemail = 'yes'; else thankingemail = 'no'; 
	var field = form.status;
	if(!field.value) { error.innerHTML = errormessage('Select the status.'); field.focus(); return false; }
	var field = form.forwardedto;
	if((!field.value) && (form.status.value == 'forwarded'))
	{ error.innerHTML = errormessage("Select to whom the email has been forwareded."); field.focus(); return false;}
	if((field.value) && (form.status.value == 'solved'))
	{ error.innerHTML = errormessage("Forwarded field should be blank as Status is solved."); field.focus(); return false;}
	if((field.value) && (form.status.value == 'unsolved'))
	{ error.innerHTML = errormessage("Forwarded field should be blank as Status is unsolved."); field.focus(); return false;}
	var field = form.remarks;
	if(!field.value) { error.innerHTML = errormessage('Enter the remarks based on Status.'); field.focus(); return false; }
	var field = form.userid;
	if(!field.value) { error.innerHTML = errormessage('Enter the Userid.'); field.focus(); return false; }

	else
	{
		var passData = "";
		if(command == 'delete')
		{
			passData = 'type=delete&lastslno=' + form.lastslno.value + '&dummy=' + Math.floor(Math.random()*100000000);
		}
		else
		{
			passData = 'type=save&lastslno=' + form.lastslno.value + '&anonymous=' + getradiovalue(form.anonymous) + '&customername=' + encodeURIComponent(form.customername.value) + '&customerid=' + form.customerid.value + '&productgroup=' + form.productgroup.value +  '&productname=' + form.productname.value + '&productversion=' + form.productversion.value + '&date=' + form.date.value + '&time=' + form.time.value + '&callertype=' + encodeURIComponent(form.callertype.value) + '&category=' + encodeURIComponent(form.category.value) + '&state=' + encodeURIComponent(form.state.value)  + '&personname=' + form.personname.value + '&emailid=' + form.emailid.value + '&subject=' + encodeURIComponent(form.subject.value) + '&content=' + encodeURIComponent(form.content.value) + '&errorfile=' + encodeURIComponent(form.errorfile.value) + '&status=' + form.status.value + '&forwardedto=' + form.forwardedto.value + '&thankingemail=' + thankingemail + '&remarks=' + encodeURIComponent(form.remarks.value) + '&userid=' + form.userid.value + '&compliantid=' + form.compliantid.value + '&dummy=' + Math.floor(Math.random()*10019200000);
		}
		queryString = '../ajax/email-register.php';
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
					error.innerHTML = successmessage(response[1]);
					newentry(); formsubmitcustomer();	form.reset(); datagrid();
				}
				else if(response[0] == 2)
				{
					error.innerHTML = successmessage(response[1]);
					newentry(); formsubmitcustomer(); form.reset(); datagrid();
				}
				else
				error.innerHTML = errormessage('Unable to Connect...' + response);
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
	queryString = "../ajax/email-register.php";
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
	var queryString = "../ajax/email-register.php";
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
	var queryString = "../ajax/email-register.php";
	document.getElementById('form-error').innerHTML = '<img src="../images/processing.gif" border="0"/>';
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		document.getElementById('form-error').innerHTML = '';
		if(ajaxcall2.readyState == 4)
		{
			document.getElementById("amcdisplaydiv").style.display = "none";
			var response = (ajaxcall2.responseText).split("^");
			var form = document.getElementById('submitform');
			form.lastslno.value = response[0];
			setradiovalue(form.anonymous,response[1]);
			formsubmitcustomer();
			form.customername.value = response[2];
			form.customerid.value = response[3];
			form.cusid.value = response[3];
			form.productgroup.value = response[4];
			productnamefunction('productname',response[5],response[6]); 
		
			form.date.value = response[7];
			form.time.value = response[8];
			form.callertype.value = response[9];
			form.category.value = response[10];
			form.personname.value = response[11];
			form.emailid.value = response[12];
			form.subject.value = response[13];
			form.content.value = response[14];
			form.errorfile.value = response[15];
			
			if(response[15])
			{
			document.getElementById('downloadlinkfile').innerHTML = '&nbsp;<a href="' + response[28]+response[15] + '"><img src="../images/download.jpg"  align="absmiddle"  border="0"/></a>';
			}
			else
			{
			document.getElementById('downloadlinkfile').innerHTML = '';
			}
			form.status.value = response[16];
			form.forwardedto.value = response[17];
			autocheck(form.thankingemail,response[18]);
			form.remarks.value = response[19];
			form.userid.value = response[20];
			form.compliantid.value = response[21];
			if(response[31] == '')
			{
				form.state.disabled = false;
				form.state.value = response[31];
			}
			else
			{
				form.state.value = response[31];
			}
			document.getElementById('teamleaderremarks').innerHTML = response[24];
			var loggeduser = document.getElementById('loggeduser').value;
			var loggedreportingauthority = document.getElementById('loggedreportingauthority').value;
			if((loggeduser == response[29]) || (loggeduser == response[30]) || (document.getElementById('loggedusertype').value == 'ADMIN') || (document.getElementById('loggedusertype').value == 'MANAGEMENT'))
			{
				
				enabledelete();
				enablesave();
			}
			else
			{
				//formsubmitcustomer();
				disabledelete();
				disablesave();
			}
			
			 displayamcinfo(form.cusid.value);
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
//	if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	//if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }
	if(form.s_customer.checked == true) { customer = "true"; } else { customer = "false"; }
	if(form.s_dealer.checked == true) { dealer = "true"; } else { dealer = "false"; }
	if(form.s_employee.checked == true) { employee = "true"; } else { employee = "false"; }
	if(form.s_ssmuser.checked == true) { ssmuser = "true"; } else { ssmuser = "false"; }
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	if(command == 'view')
	{
		passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_customerid=" + encodeURIComponent(form.s_customerid.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd + "&s_state=" + encodeURIComponent(form.s_state.value)  + "&s_customer=" + customer + "&s_dealer=" + dealer + "&s_employee=" + employee + "&s_ssmuser=" + ssmuser
 + "&s_emailid=" + encodeURIComponent(form.s_emailid.value) + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_content=" + encodeURIComponent(form.s_content.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_forwardedto=" + encodeURIComponent(form.s_forwardedto.value) + "&s_thankingemail=" + getradiovalue(form.s_thankingemail) + "&s_errorfile=" + encodeURIComponent(form.s_errorfile.value) + "&s_compliantid=" + encodeURIComponent(form.s_compliantid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000) +"&startlimit=" + encodeURIComponent(startlimit);//alert(passData)
		document.getElementById('tabgroupgridwb2').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		ajaxcall3 = createajax();
		var queryString = "../ajax/email-register.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				var response = (ajaxcall3.responseText).split('|^^|');//alert(response[3])
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
		form.action = '../searchreport/emailregister.php';
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
//	if(!comapre2dates(fromdate.value,todate.value)) { error.innerHTML = errormessage('From Date should not be greater than to date'); todate.focus(); return false; }
	//if(!comapre2dates(todate.value,document.getElementById('hiddenserverdate').value)) { error.innerHTML = errormessage('To Date should not be greater than Today\'s Date'); todate.focus(); return false; }
	if(form.s_customer.checked == true) { customer = "true"; } else { customer = "false"; }
	if(form.s_dealer.checked == true) { dealer = "true"; } else { dealer = "false"; }
	if(form.s_employee.checked == true) { employee = "true"; } else { employee = "false"; }
	if(form.s_ssmuser.checked == true) { ssmuser = "true"; } else { ssmuser = "false"; }
	if(form.categorykkg.checked == true) { categorykkg = "true"; } else { categorykkg = "false"; }
	if(form.categorycsd.checked == true) { categorycsd = "true"; } else { categorycsd = "false"; }
	if(form.categoryblr.checked == true) { categoryblr = "true"; } else { categoryblr = "false"; }
	var	passData = "type=searchfilter&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&s_anonymous=" + getradiovalue(form.s_anonymous) + "&s_customername=" + encodeURIComponent(form.s_customername.value) + "&s_customerid=" + encodeURIComponent(form.s_customerid.value)
 + "&categoryblr=" + categoryblr + "&categorykkg=" + categorykkg + "&categorycsd=" + categorycsd   + "&s_state=" + encodeURIComponent(form.s_state.value) +  "&s_customer=" + customer + "&s_dealer=" + dealer + "&s_employee=" + employee + "&s_ssmuser=" + ssmuser
 + "&s_emailid=" + encodeURIComponent(form.s_emailid.value) + "&s_productgroup=" + encodeURIComponent(form.s_productgroup.value) + "&s_productname=" + encodeURIComponent(form.s_productname.value) + "&s_status=" + encodeURIComponent(form.s_status.value) + "&s_content=" + encodeURIComponent(form.s_content.value) + "&s_userid=" + encodeURIComponent(form.s_userid.value) + "&s_supportunit=" + encodeURIComponent(form.s_supportunit.value) + "&s_forwardedto=" + encodeURIComponent(form.s_forwardedto.value) + "&s_thankingemail=" + getradiovalue(form.s_thankingemail) + "&s_errorfile=" + encodeURIComponent(form.s_errorfile.value) + "&s_compliantid=" + encodeURIComponent(form.s_compliantid.value) + "&orderby=" + encodeURIComponent(form.orderby.value) + "&s_flags=" + getradiovalue(form.flagdatabasefield) + "&dummy=" + Math.floor(Math.random()*10000789641000)+ "&startlimit=" + encodeURIComponent(startlimit)+ "&slno=" + encodeURIComponent(slno) + "&showtype=" + showtype;
	//alert(passData);
	var queryString = "../ajax/email-register.php";
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
		var queryString = "../ajax/email-register.php";
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

function generateamcgrid()
{
	var passData = "type=generateamcgrid&lastslno=" + encodeURIComponent(document.getElementById('customerid').value) ;
	var ajaxcall2 = createajax();
	queryString = "../ajax/email-register.php";
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var response = ajaxcall2.responseText.split("^");
				displayDiv('1','amcdisplaydiv');//alert(response[0])
				document.getElementById('displayamcdetails').innerHTML = response[0];
				document.getElementById('customerdisplayname').innerHTML = response[1];
			}
			else
			error.innerHTML = scripterror();
		}
	}
	ajaxcall2.send(passData);
}

//Function select the tab in display
function displayDiv()
{
	var divstyle = document.getElementById("amcdisplaydiv").style.display;
	if(divstyle=="block" )
	{
		document.getElementById("amcdisplaydiv").style.display = "none";
	}
	else
	{
		document.getElementById("amcdisplaydiv").style.display = "block";
	}
}

function displayamcinfo(cusid)
{
	var passData = "type=amcinfo&lastslno=" + encodeURIComponent(cusid) ;
	var ajaxcall2 = createajax();
	queryString = "../ajax/email-register.php";
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var response = ajaxcall2.responseText;
				if(response == "Avaliable" )
				{
					document.getElementById('amcdisplayinfo').innerHTML = "Avaliable"  + '<span style="padding-left: 15px;"><img src="../images/arrow-headingdown.jpeg" width="15" height="15" align="absmiddle" style="cursor: pointer; padding-bottom:2px" onclick="generateamcgrid();" ></span> ';
				}
				else
				{
					document.getElementById('amcdisplayinfo').innerHTML ="Not Avaliable";
				}
			}
			else
			error.innerHTML = scripterror();
		}
	}
	ajaxcall2.send(passData);	
}

function clearform()
{
	document.getElementById('amcdisplayinfo').innerHTML ="Customer Not Selected";
	document.getElementById("amcdisplaydiv").style.display = "none";

}

function sendfeedbackmail()
{
	var form = document.getElementById('submitform');
	passData = 'type=savemail&lastslno=' + form.lastslno.value+ 
	'&customername=' + encodeURIComponent(form.customername.value) + '&customerid=' + encodeURIComponent(form.customerid.value) +
	'&productgroup=' + encodeURIComponent(form.productgroup.value) + '&place=' + encodeURIComponent(form.place.value)  
	'&productname=' + encodeURIComponent(form.productname.value) +'&problem=' + encodeURIComponent(form.content.value) + 
	'&status=' + encodeURIComponent(form.status.value) + '&userid=' + encodeURIComponent(form.userid.value) 
	+ '&feedbackemail=' + (form.feedbackemail.value) + '&dummy=' + Math.floor(Math.random()*10019200000);
					
	//alert(passData);
$.ajax({
			type:"POST",
			data:passData,
			url:"../ajax/email-register.php",
			cache:false,
			success: function(response,status)
			{
				$("#dispaly").html("");
			}
				});
}
