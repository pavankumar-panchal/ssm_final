<?php 

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$user = imaxgetcookie('ssmuserid');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$category = $_POST['category'];
$customer = $_POST['customer'];
$dealer = $_POST['dealer'];
$employee = $_POST['employee'];
$userid = $_POST['userid'];
$userpiece = ($userid == "")?(""):(" AND userid='".$userid."'");
$userpiece1 = ($userid == "")?(""):("( AND userid='".$userid."' OR solvedby = '".$userid."')");

if(isset($customer) && isset($dealer) && isset($employee)) { $callertype = ""; }
elseif(isset($employee) && isset($customer)) { $callertype = "AND (callertype='employee' OR callertype='customer')"; }
elseif(isset($employee) && isset($dealer)) { $callertype = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(isset($customer) && isset($dealer)) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer)) { $callertype = "AND callertype='customer'"; }
elseif(isset($dealer)) { $callertype = "AND callertype='dealer'"; }
elseif(isset($employee)) { $callertype = "AND callertype='employee'"; }

$categorypiece = ($category == "")?(""):(" AND category='".$category."'");
$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");

for($i = 0; $i<count($_POST["check"]); $i++)
{
	$register = $_POST['check'][$i];
	switch($register)
	{
		case 'Call':
		{
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Call Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remote Connection</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User Id</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">End Time</font></strong></td></tr>
';
			$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				$grid .= '<tr bgcolor='.$color.'>';				if($i_n%2 == 0)
				$color = "#dbe5f1";
			else
				$color = "#ffffff";

				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 4)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Email':
		{
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Email Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Subject</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Content</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Thanking Email</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag,ssm_emailregister.anonymous AS anonymous,  ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 7)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Error':
		{
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Error Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Reported</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Understood by You</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous AS anonymous,  ssm_errorregister.customername AS customername,ssm_products.productname
 AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,
ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,
ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status,
ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS 
solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,
ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime
 AS authorizeddatetime FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 5 || $i == 13)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Inhouse':
		{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Inhouse Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous AS anonymous,  ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime FROM ssm_inhouseregister
LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 3)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Onsite':
		{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Onsite Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Remote Connection</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Marketing Person</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Onsite Visit</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Over Phone</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Mail</font></strong></td>
			<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous AS anonymous,  ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 4 || $i == 17 || $i == 19)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Reference':
		{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Reference Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference Through</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Address</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&mp;Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous AS anonymous, ssm_referenceregister.customername AS customername,ssm_referenceregister.customerid AS customerid,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno, ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 5)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Requirement':
		{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Requirement Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag, ssm_requirementregister.anonymous AS anonymous, ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 6)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
		
		case 'Skype':
		{
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td bgcolor="#ccc0da" style="padding-left:15px;"><h3><strong><font color="#FFFF00" face="Calibri">Skype Register</font></strong></h3></td></tr></table>';
			
			$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sender</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype Conversation</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Attachment</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
			
			$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem,ssm_skyperegister.conversation AS conversation, ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype;

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
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 6)
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
					else
					$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
		}
		break;
	}
}

?>
