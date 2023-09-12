//Function to display the attendance based on the login details and according to the inputs given-----------------
function attendancedisplay()
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var field = form.month;
	if(!field.value) { error.innerHTML = errormessage('Select the Month.'); field.focus(); return false; }
	var field = form.year;
	if(!field.value) { error.innerHTML = errormessage('Select the Year'); field.focus(); return false; }
	var field = form.userid;
	if(!field.value) { error.innerHTML = errormessage('Select the User Name'); field.focus(); return false; }
	else
	{
		var passData = "type=dattendance&dummy=" + Math.floor(Math.random()*1095634563345326801780) 
		+ "&month=" + form.month.value + "&year=" + form.year.value 
		+ "&userid=" + form.userid.value
		+ "&loggeduser=" + form.loggeduser.value
		+ "&loggedusertype=" + form.loggedusertype.value;
		//alert(passData);
		var ajaxcall = createajax();
		document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
		queryString = "../ajax/attendance.php";
		ajaxcall.open("POST", queryString, true);
		ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxcall.onreadystatechange = function()
		{
			if(ajaxcall.readyState == 4)
			{
				var response = ajaxcall.responseText;
				error.innerHTML = '';
				document.getElementById('tabgroupgridwb1').innerHTML = '';
				document.getElementById('tabgroupgridc1').innerHTML = response;
			}
		}
		ajaxcall.send(passData);
	}
}

function datagrid()
{
	var passData = "type=dcalendar&dummy=" + Math.floor(Math.random()*1095634563345326801780);
	var ajaxcall1 = createajax();
	document.getElementById('tabgroupgridwb1').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	queryString = "../ajax/attendance.php";
	ajaxcall1.open("POST", queryString, true);
	ajaxcall1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall1.onreadystatechange = function()
	{
		if(ajaxcall1.readyState == 4)
		{
			var response = ajaxcall1.responseText;
			document.getElementById('tabgroupgridwb1').innerHTML = '';
			document.getElementById('tabgroupgridc1').innerHTML = response;
		}
	}
	ajaxcall1.send(passData);
}