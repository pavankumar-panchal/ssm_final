<?php
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
if(isset($_POST['servicecharge'])) 	$servicecharge = 'yes'; else $servicecharge = 'no';
if(isset($_POST['stremoteconnection'])) 	$stremoteconnection = 'yes'; else $stremoteconnection = 'no';
if(isset($_POST['marketingperson'])) 	$marketingperson = 'yes'; else $marketingperson = 'no';
if(isset($_POST['onsitevisit'])) 	$servicecharge = 'yes'; else $onsitevisit = 'no';
if(isset($_POST['overphone'])) 	$servicecharge = 'yes'; else $overphone = 'no';
if(isset($_POST['mail'])) 	$mail = 'yes'; else $mail = 'no';
$solvedby = $_POST['solvedby'];
$customername = $_POST['customername'];
$productname = $_POST['productname'];
$status = $_POST['status'];
$userid = $_POST['userid'];
$supportunit = $_POST['supportunit'];
$complaintid = $_POST['complaintid'];
$anonymous = $_POST['anonymous'];

 
$servicechargepiece =  ($servicecharge == "no")?(""):(" AND ssm_onsiteregister.servicecharge='".$servicecharge."'");
$stremoteconnectionpiece =  ($stremoteconnection == "no")?(""):(" OR ssm_onsiteregister.stremoteconnection='".$stremoteconnection."'");
$marketingpersonpiece =  ($marketingperson == "no")?(""):(" OR ssm_onsiteregister.marketingperson='".$marketingperson."'");
$onsitevisitpiece =  ($onsitevisit == "no")?(""):(" OR ssm_onsiteregister.onsitevisit='".$onsitevisit."'");
$overphonepiece =  ($overphone == "no")?(""):(" OR ssm_onsiteregister.overphone='".$overphone."'");
$mailpiece =  ($mail == "no")?(""):(" OR ssm_onsiteregister.mail='".$mail."'");
$anonymouspiece = ($anonymous == "")?(""):(" AND ssm_onsiteregister.anonymous='".$anonymous."'");
$useridpiece = ($userid == "")?(""):(" AND ssm_onsiteregister.userid='".$userid."'");
$solvedbypiece = ($solvedby == "")?(""):(" AND ssm_onsiteregister.solvedby='".$solvedby."'");
$customernamepiece = ($customername == "")?(""):(" AND ssm_onsiteregister.customername LIKE '%".$customername."%'");
$productnamepiece = ($productname == "")?(""):(" AND ssm_onsiteregister.productname='".$productname."'");
$statuspiece = ($status == "")?(""):(" AND ssm_onsiteregister.status='".$customername."'");
$supportunitpiece = ($supportunit == "")?(""):(" AND ssm_onsiteregister.supportunit='".$supportunit."'");
$complaintidpiece = ($complaintid == "")?(""):(" AND ssm_onsiteregister.complaintid LIKE '%".$complaintid."%'");

$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved' ".$useridpiece.$solvedbypiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$customernamepiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'noyetattended' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed' ".$useridpiece.$solvedbypiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$customernamepiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND stremoteconnection = 'yes' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND marketingperson = 'yes' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND onsitevisit = 'yes' ".$useridpiece.$solvedbypiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$customernamepiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND overphone = 'yes' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND mail = 'yes' ".$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);

$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#006600"><tr><td rowspan="13" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total Onsite Visits</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f0['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Visits</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f1['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Pending Visits</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f2['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved Visits</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f3['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Visits in process</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f4['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skipped visits</font></strong></td><td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f5['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Postponed Visits</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f6['count'].'</font></td></tr><tr>  <td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Through Remote Connection</font></strong></td>  <td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f7['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Through Marketing Department</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f8['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Through Onsite Visit</font></strong></td><td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f9['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Over Phone</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f10['count'].'</font></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved Through Mail</font></strong></td><td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f11['count'].'</font></td></tr></table>
';

$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Onsite Register</font></strong></h2></td></tr></table>';

$grid .= '<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Registered Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Registered By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product - Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge Applicable</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Remote Connection</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Marketing Person</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Onsite Visit</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Over Phone</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Mail</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint Id</font></strong></td></tr>';

$query = "SELECT ssm_onsiteregister.date AS date, ssm_users2.fullname AS userid, ssm_onsiteregister.customername AS customername,ssm_onsiteregister.contactperson AS contactperson, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, ssm_onsiteregister.remarks AS remarks, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.complaintid AS complaintid FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$servicechargepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.$useridpiece.$solvedbypiece.$customernamepiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.$anonymouspiece." ORDER BY  `date` DESC";

$result = runmysqlquery($query);
$i_n = 0;
$j = 1;
while($fetch = mysqli_fetch_row($result))
{
	$i_n++;
	$color;			
	if($i_n%2 == 0)
		$color = "#dbe5f1";
	else
		$color = "#ffffff";
	$grid .= '<tr bgcolor='.$color.'>';				
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[0]).'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[1], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[2], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[3], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[4]." - ".$fetch[5], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[6], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[7], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[8], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[9], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[10], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[11], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[12], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[13], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[14], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[15], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[16], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[17], 100, "<br />\n").'</font></td>';
		$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[18], 100, "<br />\n").'</font></td>';
	$grid .= '</tr>';
}
$grid .= '</table>';

$localdate = datetimelocal('Ymd');
$localtime = datetimelocal('His');
$filebasename = "S_ORp".$localdate."-".$localtime.".xls";
$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/filecreated/'.$filebasename;
$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/filecreated/'.$filebasename;

$fp = fopen($filepath,"wa+");
if($fp)
{
	fwrite($fp,$grid);
	downloadfile($filepath);
	fclose($fp);
}  
?>