<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
	include_once('./functions/phpfunctions.php'); 
	include_once('./inc/checktype.php');

	session_start(); 
	$usertype = $usertype;
	$logintype = "OUT";
	$date = datetimelocal('Y-m-d');
	$time = datetimelocal('H:i:s');
	$user = imaxgetcookie('ssmuserid');
	// $query = "INSERT INTO ssm_usertime(userid,logindate,logintime,logintype,type) values('".$user."','".$date."','".$time."',
	// '".$logintype."','".$usertype."')";
	// $result = runmysqlquery($query);

	$query = "INSERT INTO ssm_usertime(userid, logindate, logintime, logintype, type, locationname) 
          VALUES ('".$user."', '".$date."', '".$time."', '".$logintype."', '".$usertype."', '".$locationname."')";
$result = runmysqlquery($query);

	
	session_destroy();
	imaxdeletecookie('ssmuserid');
	header('Location:./index.php');
?>
