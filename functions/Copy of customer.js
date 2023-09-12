//Function to make the display as block as well as none-------------------------------------------------------------
//Function to save the new customer or update the existing customer-------------------------------------------------


var customerarray = new Array();



function formsubmit(command)
{
	var passData = "";
	var form = document.submitform;
	var error = document.getElementById('form-error');
	var lastslno = form.lastslno.value;
	if(command == 'save')
	{
		
		var form = document.submitform;
		var error = document.getElementById('form-error');
		if(lastslno == '')
		{
			var field = document.getElementById('customerlist');
			if(!field.value) { error.innerHTML = errormessage("Select the Customer from the list. "); field.focus(); return false; }
		}
		else
	var field = form.businessname;
	if(!field.value) { error.innerHTML = errormessage("Enter the Business Name [Company]. "); field.focus(); return false; }
	if(field.value) { if(!validatebusinessname(field.value)) { error.innerHTML = errormessage('Business name contains special characters. Please use only Alpha / Numeric / space / hyphen / small brackets. '); field.focus(); return false; } }
	var field = form.contactperson;
	if(!field.value) { error.innerHTML = errormessage("Enter the Name of the Contact Person. "); field.focus(); return false; }
	if(field.value) { if(!validatecontactperson(field.value)) { error.innerHTML = errormessage('Contact person name contains special characters. Please use only Alpha / Numeric / space / comma.'); field.focus(); return false; } }
	var field = form.place;
	if(!field.value) { error.innerHTML = errormessage("Enter the Place. "); field.focus(); return false; }
	var field = form.state;
	if(!field.value) { error.innerHTML = errormessage("Select the State. "); field.focus(); return false; }
	var field = form.district;
	if(!field.value) { error.innerHTML = errormessage("Select the District. "); field.focus(); return false; }
	var field = form.pincode;
	if(!field.value) { error.innerHTML = errormessage("Enter the PinCode. "); field.focus(); return false; }
	if(field.value) { if(!validatepincode(field.value)) { error.innerHTML = errormessage('Enter the valid PIN Code.'); field.focus(); return false; } }
	var field = form.stdcode;
	if(field.value) { if(!validatestdcode(field.value)) { error.innerHTML = errormessage('Enter the valid STD Code.'); field.focus(); return false; } }
	var field = form.phone;
	if(!field.value) { error.innerHTML = errormessage("Enter the Phone Number. "); field.focus(); return false; }
	if(field.value) { if(!validatephone(field.value)) { error.innerHTML = errormessage('Enter the valid Phone Number.'); field.focus(); return false; } }
	var field = form.cell;
	if(!field.value) { error.innerHTML = errormessage("Enter the Mobile Number. "); field.focus(); return false; }
	if(field.value) { if(!validatecell(field.value)) { error.innerHTML = errormessage('Enter the valid Cell Number.'); field.focus(); return false; } }
	var field = form.fax;
	if(field.value) { if(!validatephone(field.value)) { error.innerHTML = errormessage('Enter the valid Fax Number.'); field.focus(); return false; } }
	var field = form.emailid;
	if(!field.value) { error.innerHTML = errormessage("Enter the Email ID. "); field.focus(); return false; }
	if(field.value)	{ if(!emailvalidation(field.value)) { error.innerHTML = errormessage('Enter the valid Email ID.'); field.focus(); return false; } }
	var field = form.website;
	if(field.value)	{ if(!validatewebsite(field.value)) { error.innerHTML = errormessage('Enter the valid Website.'); field.focus(); return false; } }
	var field = form.companyclosed;
	if(field.checked == true) var companyclosed = 'yes'; else companyclosed = 'no';
		
		passData =  "switchtype=save&businessname=" + encodeURIComponent(form.businessname.value) + "&customerid=" + encodeURIComponent(document.getElementById('customerid').value) + "&contactperson=" + encodeURIComponent(form.contactperson.value) + "&address=" + encodeURIComponent(form.address.value) + "&place=" + encodeURIComponent(form.place.value) + "&pincode=" + encodeURIComponent(form.pincode.value) + "&district=" + encodeURIComponent(form.district.value)  + "&category=" + encodeURIComponent(form.category.value) + "&type=" + encodeURIComponent(form.type.value) + "&stdcode=" + encodeURIComponent(form.stdcode.value) + "&phone=" + encodeURIComponent(form.phone.value) + "&fax=" + encodeURIComponent(form.fax.value)+ "&companyclosed=" + encodeURIComponent(companyclosed) + "&cell=" + encodeURIComponent(form.cell.value) + "&emailid=" + encodeURIComponent(form.emailid.value) + "&website=" + encodeURIComponent(form.website.value) + "&remarks=" + encodeURIComponent(form.remarks.value)  + "&lastslno=" + encodeURIComponent(form.lastslno.value) + "&dummy=" + Math.floor(Math.random()*100000000);
		//alert(passData)
		}
		else
		{
			var confirmation = confirm("Are you sure you want to delete the selected customer?");
			if(confirmation)
			{
				passData =  "switchtype=delete&lastslno=" + form.lastslno.value + "&dummy=" + Math.floor(Math.random()*10000000000);
			
			}
			else
			return false;
		}
		queryString = '../ajax/customer.php';
		var ajaxcall0 = createajax();
		error.innerHTML = '<img src="../images/imax-loading-image.gif" border="0" />';
		ajaxcall0.open('POST', queryString, true);
		ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxcall0.onreadystatechange = function()
		{
			if(ajaxcall0.readyState == 4)
			{
				if(ajaxcall0.status == 200)
				{
					var ajaxresponse = ajaxcall0.responseText;
					var response = ajaxresponse.split('^');
					if(response[0] == '1')
					{
						error.innerHTML = successmessage(response[1]);
						refreshcustomerarray();
						
						//newentry();
					}
					else if(response[0] == '2')
					{
						error.innerHTML = successmessage(response[1]);
						//newentry();
					}
					
					else
					{
						error.innerHTML = errormessage('Unable to Connect...' + ajaxcall0.responseText);
					}
				}
				else
					error.innerHTML = scripterror();
		   }
		}
		ajaxcall0.send(passData);	
}

function refreshcustomerarray()
{
	var passData = "switchtype=generatecustomerlist&dummy=" + Math.floor(Math.random()*10054300000);
	var ajaxcall2 = createajax();
	document.getElementById('customerselectionprocess').innerHTML = getprocessingimage();
	queryString = "../ajax/customer.php";
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var response = ajaxcall2.responseText.split('^*^');
				customerarray = new Array();
				for( var i=0; i<response.length; i++)
				{
					customerarray[i] = response[i];
				}
				getcustomerlist1();
				document.getElementById('customerselectionprocess').innerHTML = successsearchmessage('All Customer...');
				document.getElementById('totalcount').innerHTML = customerarray.length;
			}
			else
				document.getElementById('customerselectionprocess').innerHTML = scripterror();
		}
	}
	ajaxcall2.send(passData);
}


function searchcustomerarray()
{
	var form = document.getElementById('searchfilterform');
	var error = document.getElementById('filter-form-error');
	var values = validateproductcheckboxes();
	if(values == false)	{error.innerHTML = errormessage("Select A Product"); return false;	}
	var textfield = document.getElementById('searchcriteria').value;
	var subselection = getradiovalue(form.databasefield);
	var c_value = '';
	var newvalue = new Array();
	var chks = document.getElementsByName('productarray[]');
	for (var i = 0; i < chks.length; i++)
	{
		if (chks[i].checked == true)
		{
			c_value += "'" + chks[i].value + "'" + ',';
		}
	}
	
	var productslist = c_value.substring(0,(c_value.length-1));
	
	var passData = "switchtype=searchcustomerlist&databasefield=" + encodeURIComponent(subselection) + "&state=" + encodeURIComponent(form.state2.value)  + "&region=" +encodeURIComponent(form.region2.value)+ "&district=" +encodeURIComponent(form.district2.value) + "&textfield=" +encodeURIComponent(textfield) +  "&productscode=" +encodeURIComponent(productslist) +"&dealer2=" +encodeURIComponent(form.currentdealer2.value) + "&branch2=" + encodeURIComponent(form.branch2.value)+"&type2=" +encodeURIComponent(form.type2.value) + "&category2=" + encodeURIComponent(form.category2.value)+ "&dummy=" + Math.floor(Math.random()*10054300000);
	//alert(passData)
	var ajaxcall2 = createajax();
	document.getElementById('customerselectionprocess').innerHTML = getprocessingimage();
	queryString = "../ajax/customer.php";
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var response = ajaxcall2.responseText.split('^*^');//alert(response)
				//alert(response); return false;
				if(response == '')
				{
					document.getElementById('filterdiv').style.display='block';
					customersearcharray = new Array();
					for( var i=0; i<response.length; i++)
					{
						customersearcharray[i] = response[i];
					}
					
					getcustomerlistonsearch();
						document.getElementById('customerselectionprocess').innerHTML = errormessage('<span style="padding-bottom:0px">Search Result </span>   '  + '<span style="padding-left: 15px;"><img src="../images/close-button.jpg" width="15" height="15" align="absmiddle" style="cursor: pointer; padding-bottom:2px" onclick="displayalcustomer()"></span> ');
					document.getElementById('totalcount').innerHTML = '0';
					error.innerHTML = errormessage('No datas found to be displayed.'); 
				}
				else
				{
				    document.getElementById('filterdiv').style.display='none';
					customersearcharray = new Array();
					for( var i=0; i<response.length; i++)
					{
						customersearcharray[i] = response[i];
					}
					
					getcustomerlistonsearch();
					document.getElementById('customerselectionprocess').innerHTML = successmessage('<span style="padding-bottom:0px">Search Result </span>' + '<span style="padding-left: 15px;"><img src="../images/close-button.jpg" width="15" height="15" align="absmiddle" style="cursor: pointer; padding-bottom:2px" onclick="displayalcustomer()"></span> ');
					document.getElementById('totalcount').innerHTML = customersearcharray.length;
					document.getElementById('filter-form-error').innerHTML ='';
				}
			}
			else
				document.getElementById('customerselectionprocess').innerHTML = scripterror();
		}
	}
	ajaxcall2.send(passData);
}

function getcustomerlistonsearch()
{	
	//disableformelemnts();
	var form = document.submitform;
	var selectbox = document.getElementById('customerlist');
	var numberofcustomers = customersearcharray.length;
	document.filterform.detailsearchtext.focus();
	var actuallimit = 500;
	var limitlist = (numberofcustomers > actuallimit)?actuallimit:numberofcustomers;
	
	selectbox.options.length = 0;
	
	for( var i=0; i<limitlist; i++)
	{
		var splits = customersearcharray[i].split("^");
		selectbox.options[selectbox.length] = new Option(splits[0], splits[1]);
	}
	
} 

function getcustomerlist1()
{	
	//disableformelemnts();
	var form = document.submitform;
	var selectbox = document.getElementById('customerlist');
	var numberofcustomers = customerarray.length;
	document.filterform.detailsearchtext.focus();
	var actuallimit = 500;
	var limitlist = (numberofcustomers > actuallimit)?actuallimit:numberofcustomers;
	
	selectbox.options.length = 0;
	
	for( var i=0; i<limitlist; i++)
	{
		var splits = customerarray[i].split("^");
		selectbox.options[selectbox.length] = new Option(splits[0], splits[1]);
	}
	
}

function displayalcustomer()
{	
	//disableformelemnts();
	var form = document.submitform;
	var selectbox = document.getElementById('customerlist');
	document.getElementById('customerselectionprocess').innerHTML = successsearchmessage('All Customer...');
	var numberofcustomers = customerarray.length;
	document.filterform.detailsearchtext.focus();
	var actuallimit = 500;
	var limitlist = (numberofcustomers > actuallimit)?actuallimit:numberofcustomers;
	
	selectbox.options.length = 0;
	
	for( var i=0; i<limitlist; i++)
	{
		var splits = customerarray[i].split("^");
		selectbox.options[selectbox.length] = new Option(splits[0], splits[1]);
	}
	
}




function generatecustomerregistration(id,startlimit)
{
	
	var form = document.submitform;
	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=customerregistration&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + encodeURIComponent(startlimit);//alert(passData)
	var queryString = "../ajax/customer.php";
	ajaxcall4 = createajax();
	document.getElementById('tabgroupgridc1_1').innerHTML = getprocessingimage();
	document.getElementById('tabgroupgridc1link').innerHTML ='';
	ajaxcall4.open("POST", queryString, true);
	ajaxcall4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall4.onreadystatechange = function()
	{
		if(ajaxcall4.readyState == 4)
		{
			if(ajaxcall4.status == 200)
			{
				var ajaxresponse = ajaxcall4.responseText;//alert(ajaxresponse)
				var response = ajaxresponse.split('^');
				//gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
				document.getElementById('tabgroupgridwb1').innerHTML = "Total Count :  " + response[1];
				document.getElementById('tabgroupgridc1_1').innerHTML =  response[0];
				document.getElementById('tabgroupgridc1link').innerHTML =  response[2];
				
			}
			else
				document.getElementById('tabgroupgridc1_1').innerHTML =scripterror();
		}
	}
	ajaxcall4.send(passData);
}

//Function for "show more records" or "show all records" link - to get registration records
function getmorecustomerregistration(id,startlimit,slno,showtype)
{
	var form = document.submitform;
	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=customerregistration&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + startlimit+ "&slno=" + slno+ "&showtype=" + encodeURIComponent(showtype)  + "&dummy=" + Math.floor(Math.random()*1000782200000);//alert(passData);
//	alert(passData);
	var queryString = "../ajax/customer.php";
	ajaxcall10 = createajax();
	document.getElementById('tabgroupgridc1link').innerHTML = '<img src="../images/inventory-processing.gif" border= "0">'
	ajaxcall10.open("POST", queryString, true);
	ajaxcall10.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall10.onreadystatechange = function()
	{
		if(ajaxcall10.readyState == 4)
		{
			if(ajaxcall10.status == 200)
			{
				var ajaxresponse = ajaxcall10.responseText;//alert(ajaxresponse);
				var response = ajaxresponse.split('^');
				document.getElementById('tabgroupgridwb1').innerHTML = "Total Count :  " + response[1];
				document.getElementById('regresultgrid').innerHTML =  document.getElementById('tabgroupgridc1_1').innerHTML;
				document.getElementById('tabgroupgridc1_1').innerHTML =   document.getElementById('regresultgrid').innerHTML.replace(/\<\/table\>/gi,'')+ response[0] ;
				document.getElementById('tabgroupgridc1link').innerHTML =  response[2];
				//gridtabcus4(1,'tabgroupgrid','&nbsp; &nbsp;Current Registrations');
			}
			else
				document.getElementById('tabgroupgridc1_1').innerHTML = scripterror();
		}
	}
	ajaxcall10.send(passData);
}


function customerdetailstoform(cusid)
{
	if(cusid != '')
	{
		document.getElementById('form-error').innerHTML = '';
		var form = document.submitform;
		form.reset();
		var passData = "switchtype=customerdetailstoform&lastslno=" + encodeURIComponent(cusid) + "&dummy=" + Math.floor(Math.random()*100032680100);//alert(passData)
		ajaxcall3 = createajax();
		document.getElementById('form-error').innerHTML = getprocessingimage();
		var queryString = "../ajax/customer.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				if(ajaxcall3.status == 200)
				{
					document.getElementById('form-error').innerHTML = '';
					document.getElementById('searchcustomerid').value = '';
					var response = (ajaxcall3.responseText).split("^");//alert(response)
					//enableformelemnts();
					if(response[0] == '')
					{
						
						alert('Customer Not Available.');
						document.getElementById('districtcodedisplay').innerHTML = '<select name="district" class="swiftselect-mandatory" id="district"><option value="">Select A State First</option></select>';	
						document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
						document.getElementById('tabgroupgridc2').innerHTML = 'No datas found to be displayed.';
						document.getElementById('tabgroupgridc3').innerHTML = 'No datas found to be displayed.';
						//document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
						//clearregistrationform();
					} 
					closedetailsdiv();
					generatecustomerregistration(response[0],''); 
					generatecustomerattachcards(response[0]);
					generateoutgoingcalls(response[0]);
					document.getElementById('customerid').value = response[1];//alert(response[30])
					form.businessname.value = response[2];
					form.contactperson.value = response[3];
					form.address.value = response[4];
					form.place.value = response[5];
					form.state.value = response[7];
					getdistrict('districtcodedisplay', response[7])
				//	districtcodeFunction('district', response[6]);
					form.district.value = response[6];
					form.pincode.value = response[8];
					form.stdcode.value = response[9];
					form.phone.value = response[10];
					form.cell.value = response[11];
					form.emailid.value = response[12];
					form.website.value = response[13];
					form.category.value = response[14];
					form.type.value = response[15];
					form.remarks.value = response[16];
					//form.remarks.readOnly = true;
					document.getElementById('currentdealer').value = response[17];//alert(response[17])
					document.getElementById('disablelogin').innerHTML = response[18];
					document.getElementById('createddate').innerHTML = response[19];
					document.getElementById('corporateorder').innerHTML = response[20];
					form.fax.value = response[21];
					document.getElementById('activecustomer').innerHTML = response[24];
					document.getElementById('region').value = response[25];//alert(response[26])
					document.getElementById('branch').value = response[26];
					autocheck(form.companyclosed,response[27]);
					if(response[30] == 'Y')
					{
						document.getElementById('initialpassworddfield').style.display = "none";
						document.getElementById('displayresetpwd').style.display = "block";
						form.initialpassword.value = response[29];
					}
					else
					{
						document.getElementById('initialpassworddfield').style.display = "block";
						document.getElementById('displayresetpwd').style.display = "none";
						form.lastpassword.value = response[29];
					}
					if(response[28] == 'Under Process')
					{
						document.getElementById('satisfactorycall').innerHTML = '<strong ><font color="#CC0000">' + response[28] + '</font></strong>';
					}
					else if(response[28] == 'Complete')
					{
						document.getElementById('satisfactorycall').innerHTML ='<strong ><font color="#008000">' + response[28] + '</font></strong>';
					}
					else
					{
						document.getElementById('satisfactorycall').innerHTML = '<strong ><font color="#454545">' + response[28] + '</font></strong>';
					}
					if(response[23] == '')
					{
						document.getElementById('profilepending').innerHTML = '';
					}
					else
					document.getElementById('profilepending').innerHTML = '<div class ="displaysuccessbox">' + response[23]+ '</div>';

				}
			else
				document.getElementById('customerselectionprocess').innerHTML = scripterror();
			}
		}
		ajaxcall3.send(passData);
	}
}

function selectfromlist()
{
	
	//enableregbuttons();
	var selectbox = document.getElementById('customerlist');
	var cusnamesearch = document.getElementById('detailsearchtext');
	document.getElementById('filterdiv').style.display='none';
	cusnamesearch.value = selectbox.options[selectbox.selectedIndex].text;
	cusnamesearch.select();
	//enableformelemnts();
	document.getElementById('tabgroupgridwb1').innerHTML = '';
	customerdetailstoform(selectbox.value);	
			 
}

function selectacustomer(input)
{
	var selectbox = document.getElementById('customerlist');
	var pattern = new RegExp("^" + input.toLowerCase());
	
	if(input == "")
	{
		getcustomerlist1();
	}
	else
	{
		selectbox.options.length = 0;
		var addedcount = 0;
		for( var i=0; i < customerarray.length; i++)
		{
				if(input.charAt(0) == "%")
				{
					withoutspace = input.substring(1,input.length);
					pattern = new RegExp(withoutspace.toLowerCase());
					comparestringsplit = customerarray[i].split("^");
					comparestring = comparestringsplit[1];
				}
				else
				{
					pattern = new RegExp("^" + input.toLowerCase());
					comparestring = customerarray[i];
				}
			if(pattern.test(customerarray[i].toLowerCase()))
			{
				var splits = customerarray[i].split("^");
				selectbox.options[selectbox.length] = new Option(splits[0], splits[1]);
				addedcount++;
				if(addedcount == 100)
					break;
				//selectbox.options[0].selected= true;
				//customerdetailstoform(selectbox.options[0].value); //document.getElementById('delaerrep').disabled = true;
				//document.getElementById('hiddenregistrationtype').value = 'newlicence'; clearregistrationform(); validatemakearegistration(); 
			}
		}
	}
}

function customersearch(e)
{ 
	var KeyID = (window.event) ? event.keyCode : e.keyCode;
	if(KeyID == 38)
		scrollcustomer('up');
	else if(KeyID == 40)
		scrollcustomer('down');
	else
	{
		var form = document.submitform;
		var input = document.getElementById('detailsearchtext').value;
		selectacustomer(input);
	}
}

function scrollcustomer(type)
{
	var selectbox = document.getElementById('customerlist');
	var totalcus = selectbox.options.length;
	var selectedcus = selectbox.selectedIndex;
	if(type == 'up' && selectedcus != 0)
		selectbox.selectedIndex = selectedcus - 1;
	else if(type == 'down' && selectedcus != totalcus)
		selectbox.selectedIndex = selectedcus + 1;
	selectfromlist();
}

function validatestdcode(stdcodenumber)
{
	var numericExpression = /^[0]+[0-9]{2,4}$/i;
	if(stdcodenumber.match(numericExpression)) return true;
	else return false;
}

function validatepincode(pincodenumber)
{
	var numericExpression = /^(^\d{6})$/i;
	if(pincodenumber.match(numericExpression)) return true;
	else return false;
}

function validatecell(cellnumber)
{
	var numericExpression = /^[8-9]+[0-9]{9,9}(?:(?:[,;][9]+[0-9]{9,9}))*$/i;
	if(cellnumber.match(numericExpression)) return true;
	else return false;
}

function validatephone(phonenumber)
{
	var numericExpression = /^([^9]\d{5,9})(?:(?:[,;]([^9]\d{5,9})))*$/i;
	if(phonenumber.match(numericExpression)) return true;
	else return false;
}

function validatecontactperson(contactname)
{
	var numericExpression = /^([A-Z\s\-]+[a-zA-Z\s-()])(?:(?:[,;]([A-Z\s-()]+[a-zA-Z\s-()])))*$/i;
	if(contactname.match(numericExpression)) return true;
	else return false;
}

function validatebusinessname(contactname)
{
	var numericExpression = /^([A-Z0-9\s\-()]+[a-zA-Z0-9\s-()])(?:(?:[,;]([A-Z0-9\s-()]+[a-zA-Z0-9\s-()])))*$/i;
	if(contactname.match(numericExpression)) return true;
	else return false;
}

function emailvalidation(emailid)
{
	var emailExp = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:(?:[,][A-Z0-9\._%-]+@[A-Z0-9\.-]+))*$/i;
	if(emailid.match(emailExp)) { return true; }
	else { return false; }
}
//Validation of website - 
function validatewebsite(website)
{
	var websiteExpression = /^(www\.)?[a-zA-Z0-9-\.,]+\.[a-zA-Z]{2,4}$/i;
	if(website.match(websiteExpression)) return true;
	else return false;
}



function searchbycustomerid(cusid)
{
	document.getElementById('form-error').innerHTML = '';
	var form = document.submitform;
	form.reset();
	var passData = "switchtype=searchbycustomerid&customerid=" + encodeURIComponent(cusid) + "&dummy=" + Math.floor(Math.random()*100032680100);//alert(passData)
	ajaxcall5 = createajax();
	var queryString = "../ajax/customer.php";
	ajaxcall5.open("POST", queryString, true);
	ajaxcall5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall5.onreadystatechange = function()
	{
		if(ajaxcall5.readyState == 4)
		{
			if(ajaxcall5.status == 200)
			{
				document.getElementById('form-error').innerHTML = '';
				var response = (ajaxcall5.responseText).split("^");
				//enableformelemnts();
				if(response[1] == '')
				{
					
					alert('Customer Not Available.');
					document.getElementById('districtcodedisplay').innerHTML = '<select name="district" class="swiftselect-mandatory" id="district"><option value="">Select A State First</option></select>';	
					document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					document.getElementById('tabgroupgridc2').innerHTML = 'No datas found to be displayed.';
					document.getElementById('tabgroupgridc3').innerHTML = 'No datas found to be displayed.';
					//gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
					//document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					//clearregistrationform();
				} 
				closedetailsdiv();
				generatecustomerregistration(response[0],''); 
				generatecustomerattachcards(response[0]);
				generateoutgoingcalls(response[0]);
				document.getElementById('customerid').value = response[1];//alert(response[30])
				form.businessname.value = response[2];
				form.contactperson.value = response[3];
				form.address.value = response[4];
				form.place.value = response[5];
				form.state.value = response[7];
				getdistrict('districtcodedisplay', response[7])
			//	districtcodeFunction('district', response[6]);
				form.district.value = response[6];
				form.pincode.value = response[8];
				form.stdcode.value = response[9];
				form.phone.value = response[10];
				form.cell.value = response[11];
				form.emailid.value = response[12];
				form.website.value = response[13];
				form.category.value = response[14];
				form.type.value = response[15];
				form.remarks.value = response[16];
				//form.remarks.readOnly = true;
				document.getElementById('currentdealer').value = response[17];//alert(response[17])
				document.getElementById('disablelogin').innerHTML = response[18];
				document.getElementById('createddate').innerHTML = response[19];
				document.getElementById('corporateorder').innerHTML = response[20];
				form.fax.value = response[21];
				document.getElementById('activecustomer').innerHTML = response[24];
				document.getElementById('region').value = response[25];//alert(response[26])
				document.getElementById('branch').value = response[26];
				autocheck(form.companyclosed,response[27]);
				if(response[30] == 'Y')
				{
					document.getElementById('initialpassworddfield').style.display = "none";
					document.getElementById('displayresetpwd').style.display = "block";
					form.initialpassword.value = response[29];
				}
				else
				{
					document.getElementById('initialpassworddfield').style.display = "block";
					document.getElementById('displayresetpwd').style.display = "none";
					form.lastpassword.value = response[29];
				}
				if(response[28] == 'Under Process')
					document.getElementById('satisfactorycall').innerHTML = '<strong ><font color="#CC0000">' + response[28] + '</font></strong>';
				else if(response[28] == 'Complete')
					document.getElementById('satisfactorycall').innerHTML ='<strong ><font color="#008000">' + response[28] + '</font></strong>';
				else
					document.getElementById('satisfactorycall').innerHTML = '<strong ><font color="#454545">' + response[28] + '</font></strong>';
				if(response[23] == '')
					document.getElementById('profilepending').innerHTML = '';
				else
					document.getElementById('profilepending').innerHTML = '<div class ="displaysuccessbox">' + response[23]+ '</div>';

			}
			else
			{
				document.getElementById('customerselectionprocess').innerHTML = scripterror();	
			}
		}
	}
	ajaxcall5.send(passData);
}

function searchbycustomeridevent(e)
{     
	if(window.event)
		var KeyID = window.event.keyCode;
	else
		var KeyID = e.keyCode;
	if(KeyID == 13)
	{
		var input = document.getElementById('searchcustomerid').value;
		searchbycustomerid(input);
		
	}
}


function enableregbuttons()
{
	//alert('reg');
	if(document.getElementById('registrationform'))
	{
		var form = document.getElementById('registrationform');
		form.registrationfieldradio0.disabled = false;
		form.registrationfieldradio1.disabled = false;
		form.registrationfieldradio2.disabled = false;
		form.registrationfieldradio3.disabled = false;
	}

}


function computeridvalidate(compid)
{
	var numericExpresion = /^[0-9]{3}0[0|9]-[0-9]{9}$/;
	if(compid.match(numericExpresion)) return true;
	return false;
}


function generatecustomerattachcards(customerid)
{
	
	var form = document.submitform;
	document.getElementById('lastslno').value = customerid;	
	var passData = "switchtype=generatecustomerattachcards&lastslno="+ encodeURIComponent(form.lastslno.value);
	//alert(passData);
	var queryString = "../ajax/customer.php";
	ajaxcall9 = createajax();
	ajaxcall9.open("POST", queryString, true);
	ajaxcall9.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall9.onreadystatechange = function()
	{//alert(passData);
		if(ajaxcall9.readyState == 4)
		{
			if(ajaxcall9.status == 200)
			{
				var ajaxresponse = ajaxcall9.responseText;//alert(ajaxresponse)
				document.getElementById('tabgroupgridc2').innerHTML =  ajaxresponse;
				document.getElementById('tabgroupgridwb1').innerHTML =  '';
				//gridtabcus4(3,'tabgroupgrid','&nbsp; &nbsp;Card Details');
			}
			else
				document.getElementById('tabgroupgridc2').innerHTML = scripterror();
		}
	}
	ajaxcall9.send(passData);
}

function generateoutgoingcalls(customerid)
{
	
	var form = document.submitform;
	document.getElementById('lastslno').value = customerid;	
	var passData = "switchtype=generateoutgoingcalls&lastslno="+ encodeURIComponent(form.lastslno.value);
//alert(passData);
	var queryString = "../ajax/customer.php";
	ajaxcall33 = createajax();
	ajaxcall33.open("POST", queryString, true);
	ajaxcall33.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall33.onreadystatechange = function()
	{//alert(passData);
		if(ajaxcall33.readyState == 4)
		{
			if(ajaxcall33.status == 200)
			{
				var ajaxresponse = ajaxcall33.responseText;//alert(ajaxresponse)
				document.getElementById('tabgroupgridc3').innerHTML =  ajaxresponse;
				document.getElementById('tabgroupgridwb1').innerHTML =  '';
				//gridtabcus4(3,'tabgroupgrid','&nbsp; &nbsp;Card Details');
			}
			else
				document.getElementById('tabgroupgridc3').innerHTML = scripterror();
		}
	}
	ajaxcall33.send(passData);
}

function cleargrid()
{
	document.getElementById('tabgroupgridc1_1').innerHTML = 'No datas found to be displayed.';
	document.getElementById('tabgroupgridc1link').innerHTML = '';
	document.getElementById('regresultgrid').innerHTML = '';
	document.getElementById('tabgroupgridwb1').innerHTML = '';
}



//Function select the tab in display-Meghana[18/12/2009]
function displayDiv()
{
	var divstyle = document.getElementById("filterdiv").style.display;
	if(divstyle=="block" )
	{
		document.getElementById("filterdiv").style.display = "none";
	}
	else
	{
		document.getElementById("filterdiv").style.display = "block";
	}
}
function validateproductcheckboxes()
{
var chksvalue = document.getElementsByName('productarray[]');
var hasChecked = false;
for (var i = 0; i < chksvalue.length; i++)
{
	if (chksvalue[i].checked)
	{
		hasChecked = true;
		return true
	}
}
	if (!hasChecked)
	{
		return false
	}
}
function selectdeselectall()
{
	var selectall = document.getElementById('selectall');
	var chkvalues = document.getElementsByName('productarray[]');
	var changestatus = (selectall.checked == false)?false:true;
	for (var i=0; i < chkvalues.length; i++)
	{
		chkvalues[i].checked = changestatus;
	}
}
//Function to reset the from to the default value-Meghana[21/12/2009]
function resetDefaultValues(oForm)
{
    var elements = oForm.elements; 
 	oForm.reset();
	document.getElementById('filter-form-error').innerHTML = ''
	for (i=0; i<elements.length; i++) 
	{
		field_type = elements[i].type.toLowerCase();
	}
	switch(field_type)
	{
	
		case "text": 
			elements[i].value = ""; 
			break;
		case "radio":
			if(elements[i].checked == 'databasefield1')
			{
				elements[i].checked = true;
			}
			else
			{
				elements[i].checked = false; 
			}
			break;
		case "checkbox":
  			if (elements[i].checked) 
			{
   				elements[i].checked = true; 
			}
			break;
		case "select-one":
		{
  			 for (var k=0, l=oForm.elements[i].options.length; k<l; k++)
			 {
             oForm.elements[i].options[k].selected = oForm.elements[i].options[k].defaultSelected;
			 }
		}
			break;

		default: document.getElementById('districtcodedisplaysearch').innerHTML = '<select name="district2" class="swiftselect" id="district2" style="width:180px;"><option value="">ALL</option></select>';
			break;
	}
}

function generatercidetails(startlimit)
{
	
	var form = document.submitform;
	document.getElementById('rcidetailsgridc1').style.display = 'block';
	document.getElementById('detailsdiv').style.display = 'none';
	var passData = "switchtype=rcidetailsgrid&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + encodeURIComponent(startlimit);
	var queryString = "../ajax/customer.php";
	ajaxcall14 = createajax();
	document.getElementById('rcidetailsgridc1_1').innerHTML = getprocessingimage();
	document.getElementById('rcidetailsgridc1link').innerHTML ='';
	ajaxcall14.open("POST", queryString, true);
	ajaxcall14.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall14.onreadystatechange = function()
	{
		if(ajaxcall14.status == 200)
			{
				var ajaxresponse = ajaxcall14.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('^');
					if(response[0] == '1')
					{
						document.getElementById('rcidetailsgridwb1').innerHTML = "Total Count :  " + response[2];
						document.getElementById('rcidetailsgridc1_1').innerHTML =  response[1];
						document.getElementById('rcidetailsgridc1link').innerHTML =  response[3];
					}
					else
					{
						document.getElementById('rcidetailsgridc1_1').innerHTML = "No datas found to be displayed";
					}
				}
				
			}
		else
			document.getElementById('rcidetailsgridc1_1').innerHTML =scripterror();
	}
	ajaxcall14.send(passData);
}

//Function for "show more records" link - to get registration records
function getmorercidetails(id,startlimit,slno,showtype)
{
	var form = document.submitform;
	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=rcidetailsgrid&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + startlimit+ "&slno=" + slno + "&showtype=" + encodeURIComponent(showtype)  + "&dummy=" + Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/customer.php";
	ajaxcall15 = createajax();
	document.getElementById('rcidetailsgridc1link').innerHTML = getprocessingimage();
	ajaxcall15.open("POST", queryString, true);
	ajaxcall15.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall15.onreadystatechange = function()
	{
		if(ajaxcall15.readyState == 4)
		{
			if(ajaxcall15.status == 200)
			{
				var ajaxresponse = ajaxcall15.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('^');
					if(response[0] == '1')
					{
						document.getElementById('rcidetailsgridwb1').innerHTML = "Total Count :  " + response[2];
						document.getElementById('rcidetailsresultgrid').innerHTML =  document.getElementById('rcidetailsgridc1_1').innerHTML;
						document.getElementById('rcidetailsgridc1_1').innerHTML =   document.getElementById('rcidetailsresultgrid').innerHTML.replace(/\<\/table\>/gi,'')+ response[1] ;
						document.getElementById('rcidetailsgridc1link').innerHTML =  response[3];
					}
					else
					{
						document.getElementById('rcidetailsgridc1_1').innerHTML = "No datas found to be displayed";
					}
				}
			}
			else
				document.getElementById('rcidetailsgridc1_1').innerHTML = scripterror();
		}
	}
	ajaxcall15.send(passData);
}


function closedetailsdiv()
{
	if(document.getElementById('rcidetailsgridc1').style.display == 'block')
	{
		document.getElementById('detailsdiv').style.display = 'block';
		document.getElementById('rcidetailsgridc1').style.display = 'none';
	}
	else
	{
		document.getElementById('detailsdiv').style.display = 'block';
		document.getElementById('invoicedetailsgridc1').style.display = 'none';
	}
}

function generateinvoicedetails(startlimit)
{
	
	var form = document.submitform;
	document.getElementById('invoicedetailsgridc1').style.display = 'block';
	document.getElementById('detailsdiv').style.display = 'none';
	var passData = "switchtype=invoicedetailsgrid&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + encodeURIComponent(startlimit);
	var queryString = "../ajax/customer.php";
	ajaxcall41 = createajax();
	document.getElementById('invoicedetailsgridc1_1').innerHTML = getprocessingimage();
	document.getElementById('invoicedetailsgridc1link').innerHTML ='';
	ajaxcall41.open("POST", queryString, true);
	ajaxcall41.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall41.onreadystatechange = function()
	{
		if(ajaxcall41.status == 200)
			{
				var ajaxresponse = ajaxcall41.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('^');
					if(response[0] == '1')
					{
						document.getElementById('invoicedetailsgridwb1').innerHTML = "Total Count :  " + response[2];
						document.getElementById('invoicedetailsgridc1_1').innerHTML =  response[1];
						document.getElementById('invoicedetailsgridc1link').innerHTML =  response[3];
						document.getElementById('invoicelastslno').value =  response[4];
					}
					else
					{
						document.getElementById('invoicedetailsgridc1_1').innerHTML = "No datas found to be displayed";
					}
				}
				
			}
		else
			document.getElementById('invoicedetailsgridc1_1').innerHTML =scripterror();
	}
	ajaxcall41.send(passData);
}

//Function for "show more records" link - to get registration records
function getmoreinvoicedetails(id,startlimit,slno,showtype)
{
	var form = document.submitform;
	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=invoicedetailsgrid&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + startlimit+ "&slno=" + slno + "&showtype=" + encodeURIComponent(showtype)  + "&dummy=" + Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/customer.php";
	ajaxcall51 = createajax();
	document.getElementById('invoicedetailsgridc1link').innerHTML = getprocessingimage();
	ajaxcall51.open("POST", queryString, true);
	ajaxcall51.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall51.onreadystatechange = function()
	{
		if(ajaxcall51.readyState == 4)
		{
			if(ajaxcall51.status == 200)
			{
				var ajaxresponse = ajaxcall51.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('^');
					if(response[0] == '1')
					{
						document.getElementById('invoicedetailsgridwb1').innerHTML = "Total Count :  " + response[2];
						document.getElementById('invoicedetailsresultgrid').innerHTML =  document.getElementById('productdetailsgridc1_1').innerHTML;
						document.getElementById('invoicedetailsgridc1_1').innerHTML =   document.getElementById('productdetailsresultgrid').innerHTML.replace(/\<\/table\>/gi,'')+ response[1] ;
						document.getElementById('invoicedetailsgridc1link').innerHTML =  response[3];
						document.getElementById('invoicelastslno').value =  response[4];
					}
					else
					{
						document.getElementById('invoicedetailsgridc1_1').innerHTML = "No datas found to be displayed";
					}
				}
			}
			else
				document.getElementById('invoicedetailsgridc1_1').innerHTML = scripterror();
		}
	}
	ajaxcall51.send(passData);
}