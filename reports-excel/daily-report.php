<?php
include_once('../functions/phpfunctions.php');
include('../inc/checktype.php');
ini_set('memory_limit', '2048M');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$userid =  $_POST['userid'];
$usertype = $_POST['usertype'];
$useridpiece = ($userid == "")?(""):(" AND ssm_users.slno='".$userid."' ");
$grid = '';
$grid .= '<table  border="0" cellpadding="3" cellspacing="0" style="border:1px solid #6393df;">
		<tr class="tr-grid-header" >
			<th nowrap ="nowrap" style="color:#FFFFFF;" bgcolor="#4f81bd" class="td-border-grid">Companies</th>
			<th nowrap ="nowrap" style="color:#FFFFFF;" bgcolor="#4f81bd" class="td-border-grid">No. Of Calls</th>
			<th nowrap ="nowrap" style="color:#FFFFFF;" bgcolor="#4f81bd" class="td-border-grid">No. Of Chats</th>
			<th nowrap ="nowrap" style="color:#FFFFFF;" bgcolor="#4f81bd" class="td-border-grid">No. Of Mails</th>
		</tr>';

if($usertype == 'ADMIN')
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece ;
	}
elseif($usertype == 'TEAMLEADER' || $usertype == 'MANAGEMENT')
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
		AND (reportingauthority='".$user."' OR slno = '".$user."') ";
	}
else
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
		AND slno='".$user."'";
	}
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	$username = $fetch['username'] . "</br>";
	$slno = $fetch['slno'];
	$calls_count=0;
	$mails_count=0;
	$chats_count=0;

	$grid .= '<tr><td colspan="4" style="background-color:#6393df;color:#fff">'.$username.'</td>';
	$grid .= '</tr>';
	$displaydatareport = displaydatareport($slno,$fromdate,$todate);
	$grid .= $displaydatareport;
}       
$grid .= '</table>';

$localdate = datetimelocal('Ymd');
$localtime = datetimelocal('His');
$filebasename = "S_DARp".$localdate."-".$localtime.".xls";
//$addstring = "/support";
if($_SERVER['HTTP_HOST'] == "hejal" || $_SERVER['HTTP_HOST'] == "192.168.2.78" || $_SERVER['HTTP_HOST'] == "bhavesh" || $_SERVER['HTTP_HOST'] == "192.168.2.132")
{
	$addstring = "/testing/SSM";
}
else
{
	$addstring = "/support";
}

$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].$addstring.'/filecreated/'.$filebasename;

$fp = fopen($filepath,"wa+");
if($fp)
{
	fwrite($fp,$grid);
	downloadfile($downloadlink);
	fclose($fp);
} 
?>