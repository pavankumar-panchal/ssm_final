<?php
if($usertype == "ADMIN" || $usertype == "MANAGEMENT" ||  $usertype == "GUEST")
{
	
	$logintype = "OUT";
	$date = datetimelocal('Y-m-d');
	$time = datetimelocal('H:i:s');

	session_start(); session_destroy(); 
	$query = "INSERT INTO ssm_usertime(userid,logindate,logintime,logintype,type) values('".$user."','".$date."','".datetimelocal('H:i')."','".$logintype."','".$usertype."')";
	$result = runmysqlquery($query);
	setcookie('userid',''); 
	header('Location:./index.php');
}
if(isset($_POST['logout']))
{
	$logintype = "OUT";
	$date = datetimelocal('Y-m-d');
	$time = datetimelocal('H:i:s');
	$remarks = $_POST['remarks'];
	$message = '';
	if($remarks <> "")
	{
		session_start();
		session_destroy();
		$query = "INSERT INTO ssm_usertime(userid,type,logindate,logintime,logintype,remarks) values('".$user."','".$usertype."','".$date."','".datetimelocal('H:i')."','".$logintype."','".$remarks."')";
		$result = runmysqlquery($query);
		setcookie('userid','');
		
		header('Location:./index.php');
	}
	else
	{
		$message = '<div class="errorbox"> Your Login requires Remarks field to be entered. </div>';
	}
}
?>