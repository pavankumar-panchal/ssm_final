<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_productname = $_POST['s_productname']; $s_requirement = $_POST['s_requirement']; $s_reportedto = $_POST['s_reportedto'];
		$s_status = $_POST['s_status']; $s_solveddate = $_POST['s_solveddate'];
		$s_solutiongiven = $_POST['s_solutiongiven']; $s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; $s_requirementid = $_POST['s_requirementid']; $orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags']; $s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_requirementregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_requirementregister.customername LIKE '%".$s_customername."%'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_requirementregister.productname = '".$s_productname."'"); 
		$s_requirementpiece = ($s_requirement == "")?(""):(" AND ssm_requirementregister.requirement LIKE '%".$s_requirement."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_requirementregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_requirementregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_requirementregister.solveddate LIKE '%".$s_solveddate."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_requirementregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_requirementregister.remarks LIKE '%".$s_remarks."%'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_requirementregister.userid = '".$s_userid."'"); 
		$s_requirementidpiece = ($s_requirementid == "")?(""):(" AND ssm_requirementregister.requirementid  LIKE '%".$s_requirementid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_requirementregister.flag = '".$s_flags."'");
			
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_requirementregister.customername'; break;
			case 'productname': $orderbyfield = 'ssm_requirementregister.productname'; break;
			case 'requirement': $orderbyfield = 'ssm_requirementregister.requirement'; break;
			case 'reportedto': $orderbyfield = 'ssm_requirementregister.reportedto'; break;
			case 'status': $orderbyfield = 'ssm_requirementregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_requirementregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_requirementregister.solutiongiven'; break;
			case 'remarks': $orderbyfield = 'ssm_requirementregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_requirementregister.userid'; break;
			case 'requirementid': $orderbyfield = 'ssm_requirementregister.requirementid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalrequirement = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='solved'");
$totalsolvedrequirement = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='unsolved'");
$totalunsolvedrequirement = $query['counts'];

$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0"><tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td colspan="2">&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Total Number of Requirements:</font></td><td colspan="3"><font color="#00823B">'.$totalrequirement.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Solved Requirements:</font></td><td colspan="3"><font color="#00823B">'.$totalsolvedrequirement.'</font></td>  </tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Un Solved Requirements:</font></td><td colspan="3"><font color="#00823B">'.$totalunsolvedrequirement.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Database</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Requirement</font></td><td><font color="#FFFFFF">Reported To</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Solved Date</font></td><td><font color="#FFFFFF">Solution Given</font></td><td><font color="#FFFFFF">Solution Entered Time</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Requirement ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date&amp;Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';

		$query = "SELECT  ssm_requirementregister.flag AS flag,ssm_requirementregister.anonymous AS anonymous, ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_requirementpiece.$s_reportedtopiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_remarkspiece.$s_useridpiece.$s_requirementidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			if($i_n%2 == 0)
			$color = "#FCD5B4";
		else
			$color = "#FDE9D9";
			$grid .= '<tr nowrap="nowrap" bgcolor='.$color.'>';
			for($i = 1; $i < count($fetch); $i++)
			{
				if($i == 7)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>	</td>
  </tr>
</table>';
	
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_RQR".$localdate."-".$localtime.".xls";
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($downloadlink);
			fclose($fp);
		} 
?>
