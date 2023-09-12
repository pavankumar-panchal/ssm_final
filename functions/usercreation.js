//Function to check madatory fields in user Management
function usermandatory()
{
	var form = document.user;
	var error = document.getElementById('error-box');
	var field = form.userid;  
	if (!field.value)
	{ error.innerHTML = "Please enter an User ID."; field.focus(); field.select(); return false;}
	
	var field = form.password;  
	if (!field.value)
	{ error.innerHTML = "Please enter a Password for the user."; field.focus(); field.select(); return false;}
	
	var field = form.userpermission;  
	if (!field.value)
	{ error.innerHTML = "Please select a Persmission Level for the User."; field.focus(); return false;}

	var field = form.reportingauthority;  
	if (field.value == 'select')
	{ error.innerHTML = "Please select a Reporting Authority for the User."; field.focus(); return false;}

	var field = form.personalemail;  
	if (field.value)
	{  var a=checkemail(field.value); if(a==false) {error.innerHTML = "Please enter a valid Personal email ID."; field.focus(); field.select(); return false;} }
	
	var field = form.officialemail;  
	if (field.value)
	{  var a=checkemail(field.value); if(a==false) {error.innerHTML = "Please enter a valid Official email ID."; field.focus(); field.select(); return false;} }
	
	var field = form.dob;
	if(field.value) {if(isDate(field.value)==false) { field.focus(); return false; }}

	var field = form.doj;
	if(field.value) {if(isDate(field.value)==false) { field.focus(); return false; }}

	var field = form.dol;
	if(field.value) {if(isDate(field.value)==false) { field.focus(); return false; }}

	else
	return true;

}

// Function to check the mandatory fields while changing the password
function changepasswordmandatory()
{
	var form = document.changepassword;
	var error = document.getElementById('error-box');
		var field = form.oldpassword;  
	if (!field.value)
	{ error.innerHTML = "Please Enter the Old Password."; field.focus(); return false;}
		var field = form.newpassword;  
	if (!field.value)
	{ error.innerHTML = "Please Enter the New Password."; field.focus(); return false;}
		var field = form.confirmpassword;  
	if (!field.value)
	{ error.innerHTML = "Please Enter the Confirm Password."; field.focus(); return false;}
	if(field.value && (form.newpassword != form.confirmpassword))
	{ error.innerHTML = "New password and confirm password doesnot match."; field.focus(); return false;}
	else
	return true;
}

//Function to get the contents to the form in user management, when a Grid Item is selected
function usergridtoform(slno)
{
	clearinnerhtml();
	passData = "userloadno=" + slno;
	userRequest = createajax();
	var queryString = "../ajax/serverscript.php";
	document.getElementById('form-error').innerHTML = '<img src="../images/processing.gif" border="0"/>';
	userRequest.open("POST", queryString, true);
	userRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	userRequest.onreadystatechange = function()
	{
		document.getElementById('form-error').innerHTML = '';
		if(userRequest.readyState == 4)
		{
			var ajaxresponse = userRequest.responseText;
			var response = ajaxresponse.split("^");
			document.getElementById('lastslno').value = response[0];
			document.getElementById('userid').value = response[1];
			document.getElementById('password').value = response[2];
			autoselect('userpermission',response[3]);
			autoselect('reportingauthority',response[4]);
			document.getElementById('name').value = response[5];
			autoselect('gender',response[6]);
			document.getElementById('presentaddress').value = response[7];
			document.getElementById('permanentaddress').value = response[8];
			document.getElementById('mobile').value = response[9];
			document.getElementById('emergencyremarks').value = response[10];
			document.getElementById('emergencynumber').value = response[11];
			document.getElementById('dob').value = response[12];
			document.getElementById('doj').value = response[13];
			document.getElementById('dol').value = response[14];
			document.getElementById('designation').value = response[15];
			document.getElementById('personalemail').value = response[16];
			document.getElementById('officialemail').value = response[17];
		}
	}
	if(slno == '1')
		enabledelete();
	else
		disabledelete();
	userRequest.send(passData);
}
