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

		
		passData =  "switchtype=save&businessname=" + encodeURIComponent(form.businessname.value) + "&customerid=" + encodeURIComponent(document.getElementById('customerid').value) + "&contactperson=" + encodeURIComponent(form.contactperson.value) + "&address=" + encodeURIComponent(form.address.value) + "&place=" + encodeURIComponent(form.place.value) + "&pincode=" + encodeURIComponent(form.pincode.value) + "&district=" + encodeURIComponent(form.district.value)  + "&category=" + encodeURIComponent(form.category.value) + "&type=" + encodeURIComponent(form.type.value) + "&stdcode=" + encodeURIComponent(form.stdcode.value) + "&phone=" + encodeURIComponent(form.phone.value) + "&fax=" + encodeURIComponent(form.fax.value) + "&cell=" + encodeURIComponent(form.cell.value) + "&emailid=" + encodeURIComponent(form.emailid.value) + "&website=" + encodeURIComponent(form.website.value) + "&remarks=" + encodeURIComponent(form.remarks.value)  + "&lastslno=" + encodeURIComponent(form.lastslno.value) + "&dummy=" + Math.floor(Math.random()*100000000);
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
						error.innerHTML = successmessage(response[1]);alert(response)
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
	var form = document.getElementById('searchfilterform');
	var error = document.getElementById('filter-form-error');
	var values = validateproductcheckboxes();
	if(values == false)	{error.innerHTML = errormessage("Select A Product"); field.focus(); return false;	}
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
	
	//alert(productslist);
	//return false;
	//var passData = "switchtype=generatecustomerlist&dummy=" + Math.floor(Math.random()*10054300000);
	var passData = "switchtype=generatecustomerlist&databasefield=" + encodeURIComponent(subselection) + "&state=" + encodeURIComponent(form.state2.value)  + "&region=" +encodeURIComponent(form.region2.value)+ "&district=" +encodeURIComponent(form.district2.value) + "&textfield=" +encodeURIComponent(textfield) +  "&productscode=" +encodeURIComponent(productslist) +"&dummy=" + Math.floor(Math.random()*10054300000);
	alert(passData)
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
				document.getElementById('filterdiv').style.display='none';
				//alert(response); return false;
				if(response == '')
				{
					customerarray = new Array();
					for( var i=0; i<response.length; i++)
					{
						customerarray[i] = response[i];
					}
					
					getcustomerlist1();
					document.getElementById('customerselectionprocess').innerHTML = '';
					document.getElementById('totalcount').innerHTML = '0';
				}
				else
				{
					customerarray = new Array();
					for( var i=0; i<response.length; i++)
					{
						customerarray[i] = response[i];
					}
					
					getcustomerlist1();
					document.getElementById('customerselectionprocess').innerHTML = '';
					document.getElementById('totalcount').innerHTML = customerarray.length;
				}
			}
			else
				document.getElementById('customerselectionprocess').innerHTML = scripterror();
		}
	}
	ajaxcall2.send(passData);
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
	
	for( var i=0; i < customerarray.length; i++)
	{
		selectbox.options[selectbox.length - 1] = null;
	}
	
	for( var i=0; i<limitlist; i++)
	{
		var splits = customerarray[i].split("^");
		selectbox.options[selectbox.length] = new Option(splits[0], splits[1]);
	}
	
}

/*function disableformelemnts()
{
	var count = document.submitform.elements.length;
	for (i=0; i<count; i++) 
	{
		var element = document.submitform.elements[i]; 
		element.disabled=true; 
	}
}

function enableformelemnts()
{
	var count = document.submitform.elements.length;
	for (i=0; i<count; i++) 
	{
		var element = document.submitform.elements[i]; 
		element.disabled=false; 
	}
}*/

/*function newentry()
{
	var form = document.submitform;
	form.reset();
	document.getElementById('displaypassworddfield').style.display ='none';
	form.password.readOnly = true;	
	form.lastslno.value = '';
	enablesave();
	disabledelete();
	disableregistration();
	document.getElementById('form-error').innerHTML = '';
	document.getElementById('activecustomer').innerHTML = '';
	document.getElementById('createddate').innerHTML = 'Not Available';
	document.getElementById('districtcodedisplay').innerHTML = '<select name="district" class="swiftselect-mandatory" id="district" style="width:230px;"><option value="">Select A State First</option></select>';	
	//document.getElementById('tabgroupgridc1_1').innerHTML = 'No datas found to be displayed.';
	//gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
	//document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
	
	clearregistrationform();
	clearcarddetails();
}*/

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
				gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
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

//Function for "show more records" link - to get registration records
function getmorecustomerregistration(id,startlimit,slno)
{
	var form = document.submitform;
	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=customerregistration&lastslno="+ encodeURIComponent(form.lastslno.value) + "&startlimit=" + startlimit+ "&slno=" + slno;
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
				document.getElementById('tabgroupgridc1_1').innerHTML =   document.getElementById('regresultgrid').innerHTML.replace('</table>','')+ response[0] ;
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
		document.getElementById('customerselectionprocess').innerHTML = getprocessingimage();
		var queryString = "../ajax/customer.php";
		ajaxcall3.open("POST", queryString, true);
		ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall3.onreadystatechange = function()
		{
			if(ajaxcall3.readyState == 4)
			{
				if(ajaxcall3.status == 200)
				{
				document.getElementById('customerselectionprocess').innerHTML = '';
				document.getElementById('searchcustomerid').value = '';
				var response = (ajaxcall3.responseText).split("^");
				//enableformelemnts();
				if(response[0] == '')
				{
					
					alert('Customer Not Available.');
					document.getElementById('districtcodedisplay').innerHTML = '<select name="district" class="swiftselect-mandatory" id="district"><option value="">Select A State First</option></select>';	
					document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					//gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
					document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					//clearregistrationform();
				} 
				
				generatecustomerregistration(response[0],''); 
				generatecustomerattachcards(response[0]);
				/*enableregistration();//*/
				document.getElementById('customerid').value = response[1];//alert(response)
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
				form.remarks.readOnly = true;
				document.getElementById('currentdealer').value = response[17];//alert(response[17])
				document.getElementById('disablelogin').innerHTML = response[18];
				document.getElementById('createddate').innerHTML = response[19];
				document.getElementById('corporateorder').innerHTML = response[20];
				form.fax.value = response[21];
				document.getElementById('activecustomer').innerHTML = response[24];
				document.getElementById('region').value = response[25];//alert(response[25])
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
	cusnamesearch.value = selectbox.options[selectbox.selectedIndex].text;
	cusnamesearch.select();
	//enableformelemnts();
	document.getElementById('tabgroupgridwb1').innerHTML = '';
	customerdetailstoform(selectbox.value);	
	document.getElementById('hiddenregistrationtype').value = 'newlicence'; clearregistrationform(); validatemakearegistration(); 		    document.getElementById('delaerrep').disabled = true;
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
		for( var i=0; i<customerarray.length; i++)
		{
			selectbox.options[selectbox.length - 1] = null;
		}
	
		var addedcount = 0;
		for( var i=0; i < customerarray.length; i++)
		{
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
	var websiteExpression = /^(www\.)?[a-zA-Z0-9-\.,]+\.(com|org|net|mil|edu|ca|co.uk|com.au|gov|co.in|in)$/i;
	if(website.match(websiteExpression)) return true;
	else return false;
}

<!--//Function to Search the data from Inventory/Dealers/Out Station Employee------------------------------------------
function searchfilter(startlimit)
{
	var form = document.getElementById('searchfilterform');
	var textfield = document.getElementById('searchcriteria').value;
	var subselection = getradiovalue(form.databasefield);
	var orderby = form.orderby.value;
	var region = form.region.value;
	var error = document.getElementById('filter-form-error');
	//if(!textfield) { error.innerHTML = errormessage("Enter the Search Text."); form.searchcriteria.focus(); return false; }
	passData = "switchtype=customersearch&textfield=" + encodeURIComponent(textfield) + "&subselection=" + encodeURIComponent(subselection) + "&orderby=" + encodeURIComponent(orderby) + "&region=" + encodeURIComponent(region) + "&dummy=" + Math.floor(Math.random()*1000782200000) + "&startlimit=" + encodeURIComponent(startlimit);//alert(passData)
	ajaxcall2 = createajax();
	var queryString = "../ajax/customer.php";
	error.innerHTML = getprocessingimage();
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var ajaxresponse = ajaxcall2.responseText.split('^');
				document.getElementById('tabgroupgridwb2').innerHTML = "Total Count :  " + ajaxresponse[1];;
				error.innerHTML = '';
				gridtabcus4(2,'tabgroupgrid','&nbsp; &nbsp;Search Results');
				document.getElementById('tabgroupgridc2_1').innerHTML =  ajaxresponse[0];
				document.getElementById('tabgroupgridc2linksearch').innerHTML =  ajaxresponse[2];
			}
			else
				error.innerHTML =  scripterror();
		}
	}
	ajaxcall2.send(passData);
	return false;
}


//Function For "Show more records link" - to get search result------------------------------------------
function getmoresearchfilter(startlimit,slnocount)
{
	var form = document.getElementById('searchfilterform');
	var textfield = document.getElementById('searchcriteria').value;
	var subselection = getradiovalue(form.databasefield);
	var orderby = form.orderby.value;
	var region = form.region.value;
	var error = document.getElementById('filter-form-error');
	//if(!textfield) { error.innerHTML = errormessage("Enter the Search Text."); form.searchcriteria.focus(); return false; }
	passData = "switchtype=customersearch&textfield=" + encodeURIComponent(textfield) + "&subselection=" + encodeURIComponent(subselection) + "&orderby=" + encodeURIComponent(orderby) + "&region=" + encodeURIComponent(region) + "&dummy=" + Math.floor(Math.random()*1000782200000) + "&startlimit=" + encodeURIComponent(startlimit)+ "&slnocount=" + encodeURIComponent(slnocount);
	ajaxcall11 = createajax();
	var queryString = "../ajax/customer.php";
	error.innerHTML = getprocessingimage();
	ajaxcall11.open("POST", queryString, true);
	ajaxcall11.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall11.onreadystatechange = function()
	{
		if(ajaxcall11.readyState == 4)
		{
			if(ajaxcall11.status == 200)
			{
				var ajaxresponse = ajaxcall11.responseText.split('^');
				document.getElementById('tabgroupgridwb3').innerHTML = "Total Count :  " + ajaxresponse[1];;
				error.innerHTML = '';
				//gridtabcus4(2,'tabgroupgrid','&nbsp; &nbsp;Search Results');
				document.getElementById('searchresultgrid').innerHTML =  document.getElementById('tabgroupgridc2_1').innerHTML;
				document.getElementById('tabgroupgridc2_1').innerHTML =   document.getElementById('searchresultgrid').innerHTML.replace('</table>','')+ ajaxresponse[0] ;
				document.getElementById('tabgroupgridc2linksearch').innerHTML = ajaxresponse[2];
				
			}
			else
				error.innerHTML =  scripterror();
		}
	}
	ajaxcall11.send(passData);
	return false;
}-->


function searchbycustomerid(cusid)
{
	document.getElementById('form-error').innerHTML = '';
	var form = document.submitform;
	form.reset();
	var passData = "switchtype=searchbycustomerid&customerid=" + encodeURIComponent(cusid) + "&dummy=" + Math.floor(Math.random()*100032680100);
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
				var ajaxresponse = ajaxcall5.responseText;
				var response = (ajaxresponse).split("^"); 
				//enableformelemnts();
				if(response[1] == '')
				{
					alert('Customer Not Available.');
					document.getElementById('districtcodedisplay').innerHTML = '<select name="district" class="swiftselect-mandatory" id="district"><option value="">Select A State First</option></select>';	
					document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');
					document.getElementById('tabgroupgridc1').innerHTML = 'No datas found to be displayed.';
					selectfromlist();
					customerdetailstoform();
					//clearregistrationform();
				}else
				//document.getElementById('customerselectionprocess').innerHTML = '';
				//	document.getElementById('searchcustomerid').value = '';
				//	var response = (ajaxcall3.responseText).split("^");
				generatecustomerregistration(response[0],''); 
				generatecustomerattachcards(response[0]);
				/*enableregistration();//alert(response)*/
				document.getElementById('customerid').value = response[1];//alert(response)
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
				form.remarks.readOnly = true;
				document.getElementById('currentdealer').value = response[17];//alert(response[17])
				document.getElementById('disablelogin').innerHTML = response[18];
				document.getElementById('createddate').innerHTML = response[19];
				document.getElementById('corporateorder').innerHTML = response[20];
				form.fax.value = response[21];
				document.getElementById('activecustomer').innerHTML = response[24]; 
				document.getElementById('region').value = response[25];
			}
			else
				document.getElementById('form-error').innerHTML = scripterror();;
		}
	}
	ajaxcall5.send(passData);
}

function searchbycustomeridevent(e)
{ 
	var KeyID = (window.event) ? event.keyCode : e.keyCode;
	if(KeyID == 13)
	{
		var input = document.getElementById('searchcustomerid').value;
		searchbycustomerid(input);
	}
}





/*function clearregistrationform()
{
	//alert('1');
	document.getElementById('detailsonscratch').style.display = 'none';
	document.getElementById('reg-form-error').innerHTML = '';
	document.getElementById('searchscratchnumber').value = '';
	document.getElementById('scratchnumber').value = '';
	document.getElementById('delaerrep').value = '';
	//document.getElementById('searchdelaerrep').value = '';
	document.getElementById('productname').value = '';
	//alert('2');
	document.getElementById('productcode').value = '';
	document.getElementById('computerid').value = '';
	document.getElementById('billno').value = '';
	document.getElementById('billamount').value = '';
	document.getElementById('regremarks').value = '';
	document.getElementById('cardnumberdisplay').innerHTML = '';
	//alert('3');
	document.getElementById('scratchnodisplay').innerHTML = '';
	document.getElementById('purchasetypedisplay').innerHTML = '';
	document.getElementById('usagetypedisplay').innerHTML = '';
	document.getElementById('attachedtodisplay').innerHTML = '';
	//alert('4');
	document.getElementById('registeredtodisplay').innerHTML = '';
	document.getElementById('attachdatedisplay').innerHTML = '';
	document.getElementById('registerdatedisplay').innerHTML = '';
}*/



function cardsearchfilter()
{
	var form = document.getElementById('cardsearchfilterform');
	var textfield = document.getElementById('cardsearchcriteria').value;
	var error = document.getElementById('filter-form-error');
	if(!textfield) { error.innerHTML = errormessage("Enter the Search Text."); form.searchcriteria.focus(); return false; }
	var passData = "switchtype=cardsearch&textfield=" + textfield + "&dummy=" + Math.floor(Math.random()*1000782200000);
	ajaxcall2 = createajax();
	var queryString = "../ajax/customer.php";
	error.innerHTML = getprocessingimage();
	ajaxcall2.open("POST", queryString, true);
	ajaxcall2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall2.onreadystatechange = function()
	{
		if(ajaxcall2.readyState == 4)
		{
			if(ajaxcall2.status == 200)
			{
				var ajaxresponse = ajaxcall2.responseText;
				error.innerHTML = '';
				//gridtabcus4(2,'tabgroupgrid','&nbsp; &nbsp;Search Results');
				//document.getElementById('displaysearchresult').style.display = 'block';
				document.getElementById('displaysearchresult').innerHTML =  ajaxresponse;
			}
			else
				error.innerHTML = 'Connection Failed';
		}
	}
	ajaxcall2.send(passData);
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
	//document.getElementById('tabgroupgridc5').innerHTML = getprocessingimage();
	//document.getElementById('tabgroupgridc1link').innerHTML ='';
	ajaxcall9.open("POST", queryString, true);
	ajaxcall9.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall9.onreadystatechange = function()
	{//alert(passData);
		if(ajaxcall9.readyState == 4)
		{
			if(ajaxcall9.status == 200)
			{
				var ajaxresponse = ajaxcall9.responseText;//alert(ajaxresponse)
				//var response = ajaxresponse.split('^');
				//gridtabcus4(3,'tabgroupgrid','&nbsp; &nbsp;Card Details');
				document.getElementById('tabgroupgridc2').innerHTML =  ajaxresponse;
				//gridtabcus4(3,'tabgroupgrid','&nbsp; &nbsp;Card Details');
			}
			else
				document.getElementById('tabgroupgridc2').innerHTML = scripterror();
		}
	}
	ajaxcall9.send(passData);
}

function cleargrid()
{
	document.getElementById('tabgroupgridc1_1').innerHTML = 'No datas found to be displayed.';
	document.getElementById('tabgroupgridc1link').innerHTML = '';
	document.getElementById('regresultgrid').innerHTML = '';
	document.getElementById('tabgroupgridwb1').innerHTML = '';
}


function resetregdetails()
{
	document.getElementById('scratchdisplay').style.display = 'block';
	document.getElementById('registrationfieldradio0').checked = true;
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