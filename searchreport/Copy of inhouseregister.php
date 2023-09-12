<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_customerid = $_POST['s_customerid']; $customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; $s_problem = $_POST['s_problem'];
		$s_solvedby= $_POST['s_solvedby']; $s_supportunit= $_POST['s_supportunit'];
		$s_billno= $_POST['s_billno']; $s_acknowledgementno= $_POST['s_acknowledgementno']; $s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid']; $orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_inhouseregister.anonymous LIKE '%".$s_anonymous."%'"); 
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_inhouseregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_inhouseregister.customerid LIKE '%".$s_customerid."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }
		
		if(isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) { $s_callertypepiece = ""; }
#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
elseif(isset($employee) && isset($customer) && isset($dealer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; }

elseif(isset($customer) && isset($dealer) &&  isset($ssmuser)) { $s_callertypepiece = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($dealer) && isset($ssmuser) && isset($employee)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')"; }

elseif(isset($ssmuser) && isset($employee) && isset($customer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($employee) && isset($customer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer')"; }
elseif(isset($employee) && isset($dealer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(isset($employee) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='ssmuser')"; }
elseif(isset($customer) && isset($dealer)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($dealer) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer)) { $s_callertypepiece = "AND callertype='customer'"; }
elseif(isset($dealer)) { $s_callertypepiece = "AND callertype='dealer'"; }
elseif(isset($employee)) { $s_callertypepiece = "AND callertype='employee'"; }
elseif(isset($ssmuser)) { $s_callertypepiece = "AND callertype='ssmuser'"; }

		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_inhouseregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_inhouseregister.status = '".$s_status."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_inhouseregister.problem LIKE '%".$s_problem."%'");
		$s_acknowledgementnopiece = ($s_acknowledgementno == "")?(""):(" AND ssm_inhouseregister.acknowledgementno LIKE '%".$s_acknowledgementno."%'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_inhouseregister.billno LIKE '%".$s_billno."%'");
		$s_solvedbypiece = ($s_solvedby == "")?(""):(" AND ssm_inhouseregister.solvedby LIKE '%".$s_solvedby."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_inhouseregister.userid = '".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND ssm_inhouseregister.complaintid LIKE '%".$s_complaintid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_inhouseregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_inhouseregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_inhouseregister.customerid'; break;
			case 'category': $orderbyfield = 'ssm_inhouseregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_inhouseregister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_inhouseregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_inhouseregister.status'; break;
			case 'problem': $orderbyfield = 'ssm_inhouseregister.problem'; break;
			case 'solvedby': $orderbyfield = 'ssm_inhouseregister.solvedby'; break;
			case 'billno': $orderbyfield = 'ssm_inhouseregister.billno'; break;
			case 'acknowledgementno': $orderbyfield = 'ssm_inhouseregister.acknowledgementno'; break;
			case 'complaintid': $orderbyfield = 'ssm_inhouseregister.complaintid'; break;
			case 'userid': $orderbyfield = 'ssm_inhouseregister.userid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'notyetattended'");
$totalnycom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped'");
$totalskipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess'");
$totalipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed'");
$totalppcom = $query['counts'];

$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0" ><tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td>&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4">  <td colspan="3"><font color="#4F81BD">Total Number Complaints Registered:</font></td>  <td colspan="3"><font color="#00823B">'.$totalcom.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Solved Complaints:</font></td><td colspan="3"><font color="#00823B">'.$totalsolvedcom.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Un Solved Complaints:</font></td>  <td colspan="3"><font color="#00823B">'.$totalunsolvedcom.'</font></td></tr><tr bgcolor="#DBE5F1">    <td colspan="3"><font color="#4F81BD">Number of Complaints Not yet attended:</font></td>    <td colspan="3"><font color="#00823B">'.$totalnycom.'</font></td>  </tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Complaints Postponed:</font></td><td colspan="3"><font color="#00823B">'.$totalppcom.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Complaints Skipped:</font></td><td colspan="3"><font color="#00823B">'.$totalskipcom.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Complaints In Process:</font></td><td colspan="3"><font color="#00823B">'.$totalipcom.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Customer ID</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Category</font></td><td><font color="#FFFFFF">Caller Type</font></td><td><font color="#FFFFFF">Service Charge</font></td><td><font color="#FFFFFF">Problem</font></td><td><font color="#FFFFFF">Contact Person</font></td><td><font color="#FFFFFF">Assigned To</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Solved By</font></td><td><font color="#FFFFFF">Bill Number</font></td><td><font color="#FFFFFF">Acknowledgement Number</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Complaint ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date &amp; Time</font></td><td><font color="#FFFFFF">Flags</font></td></tr>';
		$query = "SELECT ssm_inhouseregister.slno AS slno,ssm_inhouseregister.anonymous AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag AS flag  FROM ssm_inhouseregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
				if($i == 4)
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
		$filebasename = "S_IHR".$localdate."-".$localtime.".xls";
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