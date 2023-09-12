<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
ini_set('memory_limit', '2048M');

$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$servicecharge = $_POST['servicecharge'];
$solvedby = $_POST['solvedby'];
$stremoteconnection = $_POST['stremoteconnection'];
$marketingperson = $_POST['marketingperson'];
$onsitevisit = $_POST['onsitevisit'];
$overphone = $_POST['overphone'];
$mail = $_POST['mail'];
$reporton = $_POST['reporton'];
$customername = $_POST['customername'];
$productgroup = $_POST['s_productgroup'];
$productname = $_POST['productname'];
$status = $_POST['status'];
$userid = $_POST['userid'];
$supportunit = $_POST['supportunit'];
$complaintid = $_POST['complaintid'];
$anonymous = $_POST['anonymous'];

$useridpiece = ($userid == "")?(""):(" AND ssm_onsiteregister.userid='".$userid."'");
$customernamepiece = ($customername == "")?(""):(" AND ssm_onsiteregister.customername LIKE '%".$customername."%'");
$productgrouppiece = ($productgroup == "")?(""):(" AND ssm_onsiteregister.productgroup='".$productgroup."'");
$productnamepiece = ($productname == "")?(""):(" AND ssm_onsiteregister.productname='".$productname."'");
$statuspiece = ($status == "")?(""):(" AND ssm_onsiteregister.status='".$customername."'");
$supportunitpiece = ($supportunit == "")?(""):(" AND ssm_onsiteregister.supportunit='".$supportunit."'");
$complaintidpiece = ($complaintid == "")?(""):(" AND ssm_onsiteregister.complaintid LIKE '%".$complaintid."%'");
$anonymouspiece = ($anonymous == "")?(""):(" AND ssm_onsiteregister.anonymous='".$anonymous."'");
$solvedbypiece = ($solvedby == "")?(""):(" AND ssm_onsiteregister.solvedby='".$solvedby."'");
$stremoteconnectionpiece = ($stremoteconnection == 'false')?(""):(" OR ssm_onsiteregister.stremoteconnection='yes'");
$marketingpersonpiece = ($marketingperson == 'false')?(""):(" OR ssm_onsiteregister.marketingperson='yes'");
$onsitevisitpiece = ($onsitevisit == 'false')?(""):(" OR ssm_onsiteregister.onsitevisit='yes'");
$overphonepiece = ($overphone == 'false')?(""):(" OR ssm_onsiteregister.overphone='yes'");
$mailpiece = ($mail == 'false')?(""):(" OR ssm_onsiteregister.mail='yes'");
$servicechargepiece = ($servicecharge == 'false')?(""):(" AND ssm_onsiteregister.servicecharge='yes'");

switch($reporton)
{
/*************************************************************************************************************************************/	
	case 'statistics':
	{
		$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$useridpiece.$solvedbypiece.
		$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.
		$productgrouppiece.$productnamepiece.$servicechargepiece.$statuspiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);
		
		$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$overphonepiece.$mailpiece.$servicechargepiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'noyetattended' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$servicechargepiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$overphonepiece.$servicechargepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$overphonepiece.$servicechargepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$overphonepiece.$servicechargepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$overphonepiece.$servicechargepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND stremoteconnection = 'yes' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$servicechargepiece.
		$onsitevisitpiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND marketingperson = 'yes' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$servicechargepiece.
		$onsitevisitpiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND onsitevisit = 'yes' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$servicechargepiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND overphone = 'yes' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$servicechargepiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		
		$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND mail = 'yes' "
		.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
		$servicechargepiece.$overphonepiece.$mailpiece.$productgrouppiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece);
		$grid ='';
		$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0">
					<tr>
						<td rowspan="13" align="center">&nbsp;</td>
						<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.$fromdate.' TO '.$todate.'</font></strong></td>
						<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total Onsite Visits</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f0['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Visits</font></strong></td>
						<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f1['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Pending Visits</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f2['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved Visits</font></strong></td>
						<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f3['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Visits in process</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri;
font-size:11px">'.$f4['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Skipped visits</font></strong></td>
						<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f5['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Postponed Visits</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f6['count'].'</font></td>
					</tr>
					<tr>  
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Through Remote Connection</font></strong></td>  
						<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f7['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Through Marketing Department</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri;
font-size:11px">'.$f8['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Through Onsite Visit</font></strong></td>
						<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f9['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Over Phone</font></strong></td>
						<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f10['count'].'</font></td>
					</tr>
					<tr>
						<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved Through Mail</font></strong></td>
						<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f11['count'].'</font></td>
					</tr>
				</table>';
		echo($grid);
	}
	break;
	
/************************************************************************************************************************/	
	case 'details':
	{
		//echo "hi";
		$grid ='<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;</td>
						<td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Onsite Register
</font></strong></h2></td>
					</tr>
				</table>';
		
		$grid .= '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">
					<tr bgcolor="#4f81bd">
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Registered Date</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Registered By</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Customer</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Service Charge Applicable</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Status</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">S. T. Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">S. T. Marketing Person</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">S. T. Onsite Visit</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">S. T. Over Phone</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">S. T. Mail</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid" style="color:#FFFFFF">Complaint Id</td>
					</tr>';
		
		$query = "SELECT ssm_onsiteregister.date AS date, ssm_users2.fullname AS userid, ssm_onsiteregister.customername AS
		customername,ssm_onsiteregister.contactperson AS contactperson, ssm_onsiteregister.productgroup AS productgroup,
		ssm_products.productname AS productname,
		ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.servicecharge AS servicecharge, 
		ssm_onsiteregister.problem AS problem, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, 
		ssm_onsiteregister.remarks AS remarks, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS 
		stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
		ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
		ssm_onsiteregister.complaintid AS complaintid 
		FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  
		LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$useridpiece.
		$servicechargepiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.
		$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.
		$complaintidpiece.$anonymouspiece." ORDER BY  `date` DESC ";
		
		$result = runmysqlquery($query);
		//exit();
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$color;			
			if($i_n%2 == 0)
				$color = "#dbe5f1";
			else
				$color = "#ffffff";
			$grid .= '<tr bgcolor='.$color.'>';	
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[0]).'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[1], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[2], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[3], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[4], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[5], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[6], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[7], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[8], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[9], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[10], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[11], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[12], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[13], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[14], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[15], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[16], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[17], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[18], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[19], 100, "<br />\n").'</td>';
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		echo($grid);
	}
	break;

/************************************************************************************************************************************	
	case 'both':
	{
		$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$useridpiece.$solvedbypiece.
$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.$overphonepiece.$mailpiece.
$productnamepiece.$servicechargepiece.$statuspiece.$supportunitpiece.$complaintidpiece.$anonymouspiece);
				
				$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$mailpiece.$servicechargepiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'noyetattended' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$servicechargepiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$servicechargepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$servicechargepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$servicechargepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$servicechargepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND stremoteconnection = 'yes' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$servicechargepiece.
$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND marketingperson = 'yes' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$servicechargepiece.
$onsitevisitpiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND onsitevisit = 'yes' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$servicechargepiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND overphone = 'yes' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$servicechargepiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND mail = 'yes' "
.$useridpiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$servicechargepiece.$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.
$anonymouspiece);
				
				$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0">
							<tr>
								<td rowspan="13" align="center">&nbsp;</td>
								<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font>
</strong></td>
								<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Total</font></strong></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Total Onsite Visits</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f0['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Visits</font></strong></td>
								<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f1['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Pending Visits</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f2['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Unsolved Visits</font></strong></td>
								<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri;
font-size:11px">'.$f3['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Visits in process</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f4['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Skipped visits</font></strong></td>
								<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f5['count'].'</font></td></tr><tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Postponed Visits</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f6['count'].'</font></td>
							</tr>
							<tr> 
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Through Remote Connection</font></strong></td>  
								<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f7['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Through Marketing Department</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f8['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Through Onsite Visit</font></strong></td>
								<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f9['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Over Phone</font></strong></td>
								<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f10['count'].'</font></td>
							</tr>
							<tr>
								<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Solved Through Mail</font></strong></td>
								<td align="right" bgcolor="#D7E4BC"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f11['count'].'</font></td>
							</tr>
						</table>';
					
					
		$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
					<tr>
						<td>&nbsp;</td>
						<td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Onsite Register
</font></strong></h2></td>
					</tr>
				</table>';
		
		$grid .= '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">
					<tr bgcolor="#4f81bd">
						<td nowrap = "nowrap" class="td-border-grid">Registered Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Registered By</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Product - Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge Applicable</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint Id</td>
					</tr>';
		
		$query = "SELECT ssm_onsiteregister.date AS date, ssm_users2.fullname AS userid, ssm_onsiteregister.customername AS 
customername,ssm_onsiteregister.contactperson AS contactperson, ssm_products.productname AS productname, 
ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.servicecharge AS servicecharge, 
ssm_onsiteregister.problem AS problem, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, 
ssm_onsiteregister.remarks AS remarks, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS 
stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
ssm_onsiteregister.complaintid AS complaintid 
FROM ssm_onsiteregister 
LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname 
LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid 
LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  
LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup
WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$useridpiece.
$servicechargepiece.$solvedbypiece.$customernamepiece.$stremoteconnectionpiece.$marketingpersonpiece.$onsitevisitpiece.
$overphonepiece.$mailpiece.$productnamepiece.$statuspiece.$supportunitpiece.$complaintidpiece.$anonymouspiece." 
ORDER BY  `date` DESC ";
		
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;			
			if($i_n%2 == 0)
				$color = "#dbe5f1";
			else
				$color = "#ffffff";
			$grid .= '<tr bgcolor='.$color.'>';	
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[0]).'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[1], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[2], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[3], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[4]." - ".$fetch[5], 100, 
"<br />\n").'></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[6], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[7], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[8], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[9], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[10], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[11], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[12], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[13], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[14], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[15], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[16], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[17], 100, "<br />\n").'</td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[18], 100, "<br />\n").'</td>';
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		echo($grid);
	}
	break;*/

/***********************************************************************************************************************/	
	case 'pendingvisits':
	{
		include('../inc/checktype.php');
		$onsite_supportunitpiece = ($loggedsupportunit == '4')?(""):
(" and ssm_onsiteregister.supportunit = '".$loggedsupportunit."'");
		$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,
		ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid,
		ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time,ssm_onsiteregister.productgroup AS productgroup, 
		ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, 
		ssm_onsiteregister.category AS category,ssm_onsiteregister.callertype AS callertype, 
		ssm_onsiteregister.servicecharge AS servicecharge,ssm_onsiteregister.problem AS problem, 
		ssm_onsiteregister.contactperson AS contactperson,ssm_users.fullname AS assignedto,
		ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
		ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,
		ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail,
		ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, 
		ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, 
		ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, 
		ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
		WHERE ssm_onsiteregister.status <> 'solved' and  ssm_onsiteregister.status <> 'skipped' ".$onsite_supportunitpiece." 
		ORDER BY `date` DESC; ";

		$result = runmysqlquery($query);
		//$r1 = runmysqlqueryfetch($query);
		$grid = "";
		$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="right"><a href="#null" onclick="javascript: printContent(\'printonsitependingvisits\');">
<font style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;">Print this page</font></a></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>';
					
		$grid .= '<div id="printonsitependingvisits"><table width="80%" cellspacing="0" cellpadding="2" align="center">
					<tr>
						<td align="center" valign="top" colspan="4"><strong>Onsite Visits - Pending Report</strong></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>';
		$grid .= '<table width="80%" border="0" bordercolor="#ffffff" cellspacing="0" cellpadding="2" align="center" 
style="border:#DBDBDB 1px solid; border-top:none; border-right:none;">';
		
		//Write the header Row of the table
		$grid .= '<tr>
					<td nowrap="nowrap"  valign="top" width="6%" style="border: #D4D4D4 1px solid;border-left:none;
border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Sl.No</strong></font></td>
					<td nowrap="nowrap"  valign="top" width="35%" style="border: #D4D4D4 1px solid;border-left:none;
border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Contact Details</font></strong></td>
					<td nowrap="nowrap"  width="35%"  valign="top" style="border: #D4D4D4 1px solid;border-left:none;
border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Problem Details</strong></font></td>
					<td nowrap="nowrap"  valign="top"  width="24%" style="border: #D4D4D4 1px solid;border-left:none;
border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Other Details</strong></font></td>
				</tr>';
		$i = 0;
		
		while($fetch = mysqli_fetch_array($result))
		{
			
			
			 $slno = $fetch['customerid'];
			$i++;
			if($slno <> '')
			{
				$query1 = "select businessname, slno,contactperson1,phone1,address,place,emailid1 from inv_mas_customer 
				WHERE slno = '".$slno."'";
				//$result1 = runmysqlquery($query1);
				$result1fetch = runmysqlqueryfetch($query1);
				$servicecharge = ($fetch['servicecharge'] == "")?(""):('<br> Service Charge : '.$fetch['servicecharge']);
				$tempquery = $i;
				
				$grid .= '<tr>';
				$grid .= '<td  valign="top" align="center" style="border: #D4D4D4 1px solid;border-left:none;
				border-bottom:none;"><font style="font-size:11px; font-family:Calibri;">'.$tempquery.'</font></td>';
				$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;">
					  <font style="font-size:11px; font-family:Calibri;">
					  Company Name : <strong>'.$result1fetch['businessname'].'</strong>
					  <br> Contact Person : '.$result1fetch['contactperson1'].'
					  <br> Email : '.$result1fetch['emailid1'].'
					  <br> Phone : '.$result1fetch['phone1'].'
					  <br> Adress : '.$result1fetch['address'].'</font>
					  </td>';
				$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;">
					  <font style="font-size:11px; font-family:Calibri;">
					   Product Group : '.$fetch['productgroup'].'
					  <br> Product Name : '.$fetch['productname'].'
					  <br> Product Version : '.$fetch['productversion'].'
					  <br> Contact Person : '.$fetch['contactperson'].'
					  <br> Date : '.changedateformat($fetch['date']).' - Time : '.$fetch['time'].'
					  <br> Registered By : '.$fetch['userid'].'<br> Problem : '.$fetch['problem'].'</font></td>';
				$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;">
					  <font style="font-size:11px; font-family:Calibri;">
					  Status : '.$fetch['status'].'
					  <br>Assigned To : '.$fetch['assignedto'].$servicecharge.'</font></td>';
				$grid .= '</tr>';
			}
		}
		$grid .= '</table></div>';
		echo($grid);
	}
	break;
/**********************************************************************************************************************/	
}
?>
