<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_customerid = $_POST['s_customerid']; $customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; $s_problem = $_POST['s_problem'];
		$s_userid = $_POST['s_userid']; $s_attachment= $_POST['s_attachment']; $s_skypeid = $_POST['s_skypeid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags']; $s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_skyperegister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_skyperegister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_skyperegister.customerid LIKE '%".$s_customerid."%'");
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
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_skyperegister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_skyperegister.status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_skyperegister.userid = '".$s_userid."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_skyperegister.problem LIKE '%".$s_problem."%'");
		$s_attachmentpiece = ($s_attachment == "")?(""):(" AND ssm_skyperegister.attachment LIKE '%".$s_attachment."%'");
		$s_skypeidpiece = ($s_skypeid == "")?(""):(" AND ssm_skyperegister.skypeid LIKE '%".$s_skypeid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_skyperegister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_skyperegister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_skyperegister.customerid'; break;
			case 'date': $orderbyfield = 'ssm_skyperegister.date'; break;
			case 'category': $orderbyfield = 'ssm_skyperegister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_skyperegister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_skyperegister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_skyperegister.problem'; break;
			case 'status': $orderbyfield = 'ssm_skyperegister.status'; break;
			case 'attachment': $orderbyfield = 'ssm_skyperegister.attachment'; break;
			case 'userid': $orderbyfield = 'ssm_skyperegister.userid'; break;
			case 'skypeid': $orderbyfield = 'ssm_skyperegister.skypeid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='solved'");
$totalsolvedskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='unsolved'");
$totalunsolvedskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='registration given'");
$totalregistrationskype = $query['counts'];


$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0"><tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td colspan="2">&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Total Number of Skype:</font></td><td colspan="3"><font color="#00823B">'.$totalskype.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Solved Skype:</font></td><td colspan="3"><font color="#00823B">'.$totalsolvedskype.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Un Solved Skype:</font></td><td colspan="3"><font color="#00823B">'.$totalunsolvedskype.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Registration Given:</font></td><td colspan="3"><font color="#00823B">'.$totalregistrationskype.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Customer ID</font></td><td><font color="#FFFFFF">Sender</font></td><td><font color="#FFFFFF">Caller Type</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Category</font></td><td><font color="#FFFFFF">Problem</font></td><td><font color="#FFFFFF">Skype Conversation</font></td><td><font color="#FFFFFF">Attachment</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Skype ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date&amp;Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';

		$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous, ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_attachmentpiece.$s_skypepiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
		$filebasename = "S_SR".$localdate."-".$localtime.".xls";
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
