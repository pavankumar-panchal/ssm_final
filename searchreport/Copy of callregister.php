<?php
set_time_limit (0);
include('../functions/phpfunctions.php');
ini_set('memory_limit', '-1');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_customerid = $_POST['s_customerid']; $customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; $s_problem = $_POST['s_problem'];
		$s_userid = $_POST['s_userid']; $s_transferredto= $_POST['s_transferredto']; $s_compliantid = $_POST['s_compliantid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];$s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_callregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_callregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_callregister.customerid LIKE '%".$s_customerid."%'");
		
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

		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_callregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_callregister.status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_callregister.userid = '".$s_userid."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_callregister.problem LIKE '%".$s_problem."%'");
		$s_transferredtopiece  = ($s_transferredto == "")?(""):(" AND ssm_callregister.transferredto LIKE '%".$s_transferredto."%'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND ssm_callregister.compliantid LIKE '%".$s_compliantid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_callregister.flag = '".$s_flags."'");
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_callregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_callregister.customerid'; break;
			case 'date': $orderbyfield = 'ssm_callregister.date'; break;
			case 'category': $orderbyfield = 'ssm_callregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_callregister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_callregister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_callregister.problem'; break;
			case 'status': $orderbyfield = 'ssm_callregister.status'; break;
			case 'userid': $orderbyfield = 'ssm_callregister.userid'; break;
			case 'transferredto': $orderbyfield = 'ssm_callregister.transferredto'; break;
			case 'compliantid': $orderbyfield = 'ssm_callregister.compliantid'; break;		
			case 'time': $orderbyfield = 'ssm_callregister.time'; break;	
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totsolvedcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totunsolvedcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'transferred'");
$tottranscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'registration given'");
$totregcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totcustomers = $query['counts'];

$query = runmysqlqueryfetch("SELECT count(*) AS counts FROM (SELECT customername FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' GROUP BY customername HAVING COUNT(customername) > 10) AS tablename");
$totcustomers1 = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer'");
$totdlrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'solved'");
$totdlrscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'unsolved'");
$totdlruscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'transferred'");
$totdlrtcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'registration given'");
$totdlrrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer'");
$totcuscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'solved'");
$totcusscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'unsolved'");
$totcususcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'transferred'");
$totcustcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'registration given'");
$totcusrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee'");
$totoscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'solved'");
$totosscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'unsolved'");
$totosuscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'transferred'");
$totostcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'registration given'");
$totosrcalls = $query['counts'];

$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0" >
<tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td colspan="3">&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="8">&nbsp;</td></tr>
<tr bgcolor="#B8CCE4"><td colspan="5"><font color="#4F81BD">Total Number of calls:</font></td><td colspan="3"><font color="#00823B">'.$totcalls.'</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="5"><font color="#4F81BD">Number of Solved Calls:</font></td><td colspan="3"><font color="#00823B">'.$totsolvedcalls.'</font></td></tr>
<tr bgcolor="#B8CCE4"><td colspan="5"><font color="#4F81BD">Number of unsolved calls:</font></td><td colspan="3"><font color="#00823B">'.$totunsolvedcalls.'</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="5"><font color="#4F81BD">Number of Transferred Calls:</font></td><td colspan="3"><font color="#00823B">'.$tottranscalls.'</font></td></tr>
<tr bgcolor="#B8CCE4"><td colspan="5"><font color="#4F81BD">Number of Registration Given:</font></td><td colspan="3"><font color="#00823B">'.$totregcalls.'</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="5"><font color="#4F81BD">Total Number of Customers    called:</font></td><td colspan="3"><font color="#00823B">'.$totcustomers.'</font></td></tr>
<tr bgcolor="#B8CCE4"><td colspan="5"><font color="#4F81BD">Number of Customer who has    called more than once:</font></td><td colspan="3"><font color="#00823B">'.$totcustomers1.'</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="5"><font color="#4F81BD">Calls by    Dealers: </font></td><td  colspan="3"><font color="#00823B">['.$totdlrcalls.' ('.$totdlrscalls.' Solved) ('.$totdlruscalls.' Un Solved) ('.$totdlrtcalls.' Transferred) ('.$totdlrrcalls.' Registration)]</font></td></tr>
<tr bgcolor="#B8CCE4"><td colspan="5"><font color="#4F81BD">Calls by    Customers:</font></td><td  colspan="3"><font color="#00823B">['.$totcuscalls.' ('.$totcusscalls.' Solved) ('.$totcususcalls.' Un Solved) ('.$totcustcalls.' Transferred) ('.$totcusrcalls.' Registration)]</font></td></tr>
<tr bgcolor="#DBE5F1"><td colspan="5"> <font color="#4F81BD">Calls by Out    Station Employees:</font></td><td  colspan="3"><font color="#00823B">['.$totoscalls.' ('.$totosscalls.' Solved) ('.$totosuscalls.' Un Solved) ('.$totostcalls.' Transferred) ('.$totosrcalls.' Registration)]</font></td></tr>
</table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Customer ID</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Start Time</font></td><td><font color="#FFFFFF">End Time</font></td><td><font color="#FFFFFF">Duration</font></td><td><font color="#FFFFFF">Person Name</font></td><td><font color="#FFFFFF">Category</font></td><td><font color="#FFFFFF">Caller Type</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Problem</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Remote Connection</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User Id</font></td><td><font color="#FFFFFF">Compliant ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date&amp;Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';
		$query = "SELECT  ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `time` DESC , ".$orderbyfield;

		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$color;
			if($i_n%2 == 0)
			$color = "#FCD5B4";
		else
			$color = "#FDE9D9";
			$grid .= '<tr nowrap="nowrap" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['anonymous']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customerid']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['time']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['endtime']."</td>";
			$starttime = $fetch['time'];
			$endtime = $fetch['endtime'];
			$diff = gettimeDifference($fetch['date'],$starttime,$fetch['date'],$endtime);
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$diff."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['personname']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['category']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['callertype']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['productversion']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['status']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['stremoteconnection']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['username']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['compliantid']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorized']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['categoryheading']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['teamleaderremarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['username1']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizeddatetime']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['flag']."</td>";	
			/*for($i = 1; $i < count($fetch); $i++)
			{
				if($i == 4)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
			}*/
			$grid .= '</tr>';
		}
		$grid .= '</table>	</td>
  </tr>
</table>';
echo($grid);
exit;
	
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_CR".$localdate."-".$localtime.".xls";
		
		$addstring = "/support";
		if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
			$addstring = "/saralimax-ssm";

		$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/uploads/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].$addstring.'/uploads/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($downloadlink);
			fclose($fp);
		} 
?>
