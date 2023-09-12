<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';

		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_anonymous = $_POST['s_anonymous']; 
		$s_customername = $_POST['s_customername']; $s_customerid = $_POST['s_customerid']; 
		$customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser']; $s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; 
		$s_content = $_POST['s_content']; $s_userid = $_POST['s_userid']; $s_forwardedto = $_POST['s_forwardedto']; 
		$s_compliantid = $_POST['s_compliantid']; $s_errorfile = $_POST['s_errorfile']; $orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];$s_emailid = $_POST['s_emailid']; $s_supportunit = $_POST['s_supportunit'];
		
				
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_emailregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_emailregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_emailregister.customerid LIKE '%".$s_customerid."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }		if(isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) { $s_callertypepiece = ""; }
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
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_emailregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_emailregister.status = '".$s_status."'");
		$s_contentpiece = ($s_content == "")?(""):(" AND ssm_emailregister.content LIKE '%".$s_content."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_emailregister.userid LIKE '%".$s_userid."%'");
		$s_forwardedtopiece = ($s_forwardedto == "")?(""):(" AND ssm_emailregister.forwardedto  LIKE '%".$s_forwardedto."%'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND ssm_emailregister.compliantid LIKE '%".$s_compliantid."%'");
		$s_errorfilepiece = ($s_errorfile == "")?(""):(" AND ssm_emailregister.errorfile LIKE '%".$s_errorfile."%'");
		$s_emailidpiece = ($s_emailid == "")?(""):(" AND ssm_emailregister.emailid LIKE '%".$s_emailid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_emailregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'callertype': $orderbyfield = 'ssm_emailregister.callertype'; break;
			case 'category': $orderbyfield = 'ssm_emailregister.category'; break;
			case 'compliantid': $orderbyfield = 'ssm_emailregister.compliantid'; break;
			case 'content': $orderbyfield = 'ssm_emailregister.content'; break;
			case 'customerid': $orderbyfield = 'ssm_emailregister.customerid'; break;
			case 'customername': $orderbyfield = 'ssm_emailregister.customername'; break;
			case 'date': $orderbyfield = 'ssm_emailregister.date'; break;
			case 'forwardedto': $orderbyfield = 'ssm_emailregister.forwardedto'; break;
			case 'userid': $orderbyfield = 'ssm_emailregister.userid'; break;
			case 'productname': $orderbyfield = 'ssm_emailregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_emailregister.status'; break;	
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'forwarded'");
$totalfrwdedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND anonymous = 'yes'");
$totalcustomeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'solved' AND anonymous = 'yes'");
$totalcustomersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'unsolved' AND anonymous = 'yes'");
$totalcustomerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'forwarded' AND anonymous = 'yes'");
$totalcustomerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND anonymous = 'no'");
$totalnoncustomeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved' AND anonymous = 'no'");
$totalnoncustomersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved' AND anonymous = 'no'");
$totalnoncustomerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'forwarded' AND anonymous = 'no'");
$totalnoncustomerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND anonymous = 'yes'");
$totaldealeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'solved' AND anonymous = 'yes'");
$totaldealersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'unsolved' AND anonymous = 'yes'");
$totaldealerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'forwarded' AND anonymous = 'yes'");
$totaldealerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND anonymous = 'yes'");
$totaloseemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'solved' AND anonymous = 'yes'");
$totalosesolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'unsolved' AND anonymous = 'yes'");
$totaloseunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'forwarded' AND anonymous = 'yes'");
$totaloseforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND thankingemail = 'yes'");
$totalthankingemail = $query['counts'];


$query = "SELECT  ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `time` DESC , ".$orderbyfield;
$fetch =  runmysqlquery($query);
$fetchcount =  mysqli_num_rows($fetch);
$checkedcount = $fetchcount ;
$quotient = $checkedcount/5000;
$totallooprun = ($checkedcount % 5000 == 0)?($checkedcount/5000):(ceil($checkedcount/5000));
$slno =0;
$limit = 5000;


$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0" >
<tr bgcolor="#B8CCE4"><td><font color="#4F81BD">From Date:</font></td><td><font color="#00823B">'.$fromdate.'</font></td><td>&nbsp;</td><td><font color="#4F81BD">To    Date:</font></td><td><font color="#00823B">'.$todate.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="6">&nbsp;</td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Total Number of Emails:</font></td><td colspan="3"><font color="#00823B">'.$totalemail.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Solved Emails:</font></td><td colspan="3"><font color="#00823B">'.$totalsolvedemail.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Un Solved Emails:</font></td><td colspan="3"><font color="#00823B">'.$totalunsolvedemail.'</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Forwarded Emails:</font></td><td colspan="3"><font color="#00823B">'.$totalfrwdedemail.'</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Emails By Customers:</font></td><td colspan="3"><font color="#00823B">['.$totalcustomeremail.' ('.$totalcustomersolvedemail.' Solved | '.$totalcustomerunsolvedemail.' Un Solved | '.$totalcustomerforwardedemail.' Forwarded)]</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Emails By Non - Customers:</font></td><td colspan="3"><font color="#00823B">['.$totalnoncustomeremail.' ('.$totalnoncustomersolvedemail.' Solved | '.$totalnoncustomerunsolvedemail.' Un Solved | '.$totalnoncustomerforwardedemail.' Forwarded)]</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Emails By Dealers:</font></td><td colspan="3"><font color="#00823B">['.$totaldealeremail.' ('.$totaldealersolvedemail.' Solved | '.$totaldealerunsolvedemail.' Un Solved | '.$totaldealerforwardedemail.' Forwarded)]</font></td></tr><tr bgcolor="#DBE5F1"><td colspan="3"><font color="#4F81BD">Number of Emails By Outstation Employees:</font></td><td  colspan="3"><font color="#00823B">['.$totaloseemail.' ('.$totalosesolvedemail.' Solved | '.$totaloseunsolvedemail.' Un Solved | '.$totaloseforwardedemail.' Forwarded)]</font></td></tr><tr bgcolor="#B8CCE4"><td colspan="3"><font color="#4F81BD">Number of Thanking Emails:</font></td><td  colspan="3"><font color="#00823B">'.$totalthankingemail.'</font></td></tr></table></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Anonymous</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Customer ID</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Caller Type</font></td><td><font color="#FFFFFF">Category</font></td><td><font color="#FFFFFF">Person Name</font></td><td><font color="#FFFFFF">Email ID</font></td><td><font color="#FFFFFF">Subject</font></td><td><font color="#FFFFFF">Content</font></td><td><font color="#FFFFFF">Error File</font></td><td><font color="#FFFFFF">Status</font></td><td><font color="#FFFFFF">Thanking Email</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User ID</font></td><td><font color="#FFFFFF">Compliant ID</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date&amp;Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';
		$query = "SELECT ssm_emailregister.slno AS slno, ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,ssm_emailregister.flag AS flag FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_anonymouspiece.$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailidpiece.$s_contentpiece.$s_useridpiece.$s_forwardedtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
				if($i == 8)
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
		$filebasename = "S_ER".$localdate."-".$localtime.".xls";
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
