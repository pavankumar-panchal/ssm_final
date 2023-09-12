<?php
if(imaxgetcookie('ssmuserid') == false) { $url = '../index.php'; header("Location:".$url); }
else
$user = imaxgetcookie('ssmuserid');
$fetch = runmysqlqueryfetch("SELECT slno, username, type, fullname, reportingauthority,supportunit FROM ssm_users WHERE slno = '".$user."'");
$usertype = $fetch['type'];
$userslno = $fetch['slno'];
$reportingauthoritytype = $fetch['reportingauthority'];
$loggedusername = $fetch['fullname'];

$loggedsupportunit = $fetch['supportunit'];
$loggedsupportunitpiece = ($loggedsupportunit == "4")?(""):(" AND ssm_supportunits.slno = '".$loggedsupportunit."'");
/*if($loggedsupportunit == '2')
{
	$loggedsupportunitpiece = " AND (ssm_supportunits.slno = '2' OR ssm_supportunits1.slno = '4')";
}*/
if($usertype == 'GUEST')
	$navigationtabcount = 5;
else
	$navigationtabcount = 7;
?>