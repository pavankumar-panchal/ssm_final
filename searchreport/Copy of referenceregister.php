<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_category = $_POST['s_category'];	$s_productname = $_POST['s_productname']; 
		$s_referencethrough = $_POST['s_referencethrough']; $s_contactperson = $_POST['s_referencethrough']; 
		$s_contactno = $_POST['s_contactno']; $s_contactaddress = $_POST['s_contactaddress']; $s_status = $_POST['s_status'];
		$s_email = $_POST['s_email']; $s_userid = $_POST['s_userid']; $s_referenceid = $_POST['s_referenceid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];  $s_supportunit = $_POST['s_supportunit']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_referenceregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_referenceregister.customername LIKE '%".$s_customername."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_referenceregister.productname = '".$s_productname."'");
		$s_referencethroughpiece = ($s_referencethrough == "")?(""):(" AND ssm_referenceregister.referencethrough LIKE '%".$s_referencethrough."%'");
		$s_contactpersonpiece = ($s_contactperson == "")?(""):(" AND ssm_referenceregister.contactperson LIKE '%".$s_contactperson."%'");
		$s_contactnopiece = ($s_contactno == "")?(""):(" AND ssm_referenceregister.contactno LIKE '%".$s_contactno."%'");
		$s_contactaddresspiece = ($s_contactaddress == "")?(""):(" AND ssm_referenceregister.contactaddress LIKE '%".$s_contactaddress."%'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_referenceregister.status = '".$s_status."'");
		$s_emailpiece = ($s_email == "")?(""):(" AND ssm_referenceregister.email LIKE '%".$s_email."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_referenceregister.userid = '".$s_userid."'");
		$s_referenceidpiece = ($s_referenceid == "")?(""):(" AND ssm_referenceregister.referenceid LIKE '%".$s_referenceid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_referenceregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_referenceregister.customername'; break;
			case 'category': $orderbyfield = 'ssm_referenceregister.category'; break;
			case 'productname': $orderbyfield = 'ssm_referenceregister.productname'; break;
			case 'referencethrough': $orderbyfield = 'ssm_referenceregister.referencethrough'; break;
			case 'contactno': $orderbyfield = 'ssm_referenceregister.contactno'; break;
			case 'contactaddress': $orderbyfield = 'ssm_referenceregister.contactaddress'; break;
			case 'status': $orderbyfield = 'ssm_referenceregister.status'; break;
			case 'email': $orderbyfield = 'ssm_referenceregister.email'; break;
			case 'userid': $orderbyfield = 'ssm_referenceregister.userid'; break;		
			case 'referenceid': $orderbyfield = 'ssm_referenceregister.referenceid'; break;
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalreference = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='freshlead'");
$totalfreshleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='fake'");
$totalfakeleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='demo given'");
$totaldemoleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='rejected'");
$totalrejectedleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='sold'");
$totalsoldleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='underprocess'");
$totalunderprocessleads = $query['counts'];

$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0"><tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td colspan="2">&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Total Number of References:</font></td><td colspan="3"><font color="#00823B">'.$totalreference.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Fresh Leads:</font></td><td colspan="3"><font color="#00823B">'.$totalfreshleads.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Fake Leads:</font></td><td colspan="3"><font color="#00823B">'.$totalfakeleads.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Demo Given:</font></td><td colspan="3"><font color="#00823B">'.$totaldemoleads.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Rejected Leads:</font></td><td colspan="3"><font color="#00823B">'.$totalrejectedleads.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Leads Sold:</font></td><td colspan="3"><font color="#00823B">'.$totalsoldleads.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Leads Under Process:</font></td><td colspan="3"><font color="#00823B">'.$totalunderprocessleads.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Reported By</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Reference Through</font></td><td><font color="#FFFFFF">Category</font></td><td><font color="#FFFFFF">Contact Person</font></td><td><font color="#FFFFFF">Contact No</font></td><td><font color="#FFFFFF">Contact Address</font></td><td><font color="#FFFFFF">Email ID</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Reference ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date&amp;Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';

		$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.anonymous AS anonymous,ssm_referenceregister.customername AS customername,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno,ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime,ssm_referenceregister.flag AS flag FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailpiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
				if($i == 5)
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
		$filebasename = "S_RR".$localdate."-".$localtime.".xls";
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
