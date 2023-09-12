<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_productname = $_POST['s_productname']; $s_errorreported = $_POST['s_errorreported']; $s_reportedto = $_POST['s_reportedto'];
		$s_errorfile = $_POST['s_errorfile']; $s_status = $_POST['s_status']; $s_solveddate = $_POST['s_solveddate'];
		$s_solutiongiven = $_POST['s_solutiongiven']; $s_solutionfile = $_POST['s_solutionfile']; $s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; $s_errorid = $_POST['s_errorid']; $orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];
		$s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_errorregister.anonymous LIKE '%".$s_anonymous."%'"); 
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_errorregister.customername LIKE '%".$s_customername."%'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_errorregister.productname  = '".$s_productname."'"); 
		$s_errorreportedpiece = ($s_errorreported == "")?(""):(" AND ssm_errorregister.errorreported LIKE '%".$s_errorreported."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_errorregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_errorfilepiece = ($s_errorfile == "")?(""):(" AND ssm_errorregister.errorfile LIKE '%".$s_errorfile."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_errorregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_errorregister.solveddate LIKE '%".$s_solveddate."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_errorregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_solutionfilepiece = ($s_solutionfile == "")?(""):(" AND ssm_errorregister.solutionfile LIKE '%".$s_solutionfile."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_errorregister.remarks LIKE '%".$s_remarks."'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_errorregister.userid = '".$s_userid."'"); 
		$s_erroridpiece = ($s_errorid == "")?(""):(" AND ssm_errorregister.errorid LIKE '%".$s_errorid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_errorregister.flag = '".$s_flags."'");	
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_errorregister.customername'; break;
			case 'productname': $orderbyfield = 'ssm_errorregister.productname'; break;
			case 'errorreported': $orderbyfield = 'ssm_errorregister.errorreported'; break;
			case 'reportedto': $orderbyfield = 'ssm_errorregister.reportedto'; break;
			case 'errorfile': $orderbyfield = 'ssm_errorregister.errorfile'; break;
			case 'status': $orderbyfield = 'ssm_errorregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_errorregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_errorregister.solutiongiven'; break;
			case 'solutionfile': $orderbyfield = 'ssm_errorregister.solutionfile'; break;
			case 'remarks': $orderbyfield = 'ssm_errorregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_errorregister.userid'; break;
			case 'errorid': $orderbyfield = 'ssm_errorregister.errorid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalerror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvederror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvederror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND customername <> ''");
$totalcuserror = $query['counts'];

$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0"><tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td>&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Total Number of Errors:</font></td><td colspan="3"><font color="#00823B">'.$totalerror.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Solved Errors::</font></td><td colspan="3"><font color="#00823B">'.$totalsolvederror.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Un Solved Errors:</font></td><td colspan="3"><font color="#00823B">'.$totalunsolvederror.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Errors from Customer End:</font></td><td colspan="3"><font color="#00823B">'.$totalcuserror.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Reported By</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Database</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Error Reported</font></td><td><font color="#FFFFFF">Reported To</font></td><td><font color="#FFFFFF">Error File</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Solved Date</font></td><td><font color="#FFFFFF">Solution Given</font></td><td><font color="#FFFFFF">Solution Entered Time</font></td><td><font color="#FFFFFF">Solution File</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Error ID</font></td><td><font color="#4F81BD">Authorized</font></td><td><font color="#4F81BD">Authorized Group</font></td><td><font color="#4F81BD">Team Leader Remarks</font></td><td><font color="#4F81BD">Authorized Person</font></td><td><font color="#4F81BD">Authorized Date&amp;Time</font></td><td><font color="#4F81BD">Flag</font></td></tr>';
		$query = "SELECT ssm_errorregister.slno AS slno,ssm_errorregister.anonymous AS anonymous, ssm_errorregister.customername AS customername,ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status, ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup, ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime  AS authorizeddatetime, ssm_errorregister.flag AS flag FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_errorreportedpiece.$s_reportedtopiece.$s_errorfilepiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_solutionfilepiece.$s_remarkspiece.$s_useridpiece.$s_erroridpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
				if($i == 5 || $i == 13)
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
		$filebasename = "S_ERR".$localdate."-".$localtime.".xls";
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
