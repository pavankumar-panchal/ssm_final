<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
$type = $_POST['type'];
$lastslno = $_POST['lastslno'];

switch($type)
{
	case 'save':
	{
		$anonymous = $_POST['anonymous'];
		$customername = $_POST['customername'];
		$customerid = $_POST['customerid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$category = $_POST['category'];
		$callertype = $_POST['callertype'];
		$servicecharge = $_POST['servicecharge'];
		$problem = $_POST['problem'];
		$contactperson = $_POST['contactperson'];
		$assignedto = $_POST['assignedto'];
		$status = $_POST['status'];
		$solvedby = $_POST['solvedby'];
		$solveddate = $_POST['solveddate'];
		$billno = $_POST['billno'];
		$billdate = $_POST['billdate'];
		$acknowledgementno = $_POST['acknowledgementno'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$complaintid = $_POST['complaintid'];
		$supportunit = $_POST['supportunit'];
		$stremoteconnection = $_POST['stremoteconnection'];
		$marketingperson = $_POST['marketingperson'];
		$onsitevisit = $_POST['onsitevisit'];
		$overphone = $_POST['overphone'];
		$mail = $_POST['mail'];
		$state = $_POST['state'];
		
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_onsiteregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$complaintid = "OR". ($temp + 10000);
			$query = "INSERT INTO ssm_onsiteregister(anonymous,customername,customerid,date,time,productgroup,productname,
			productversion,category,state,callertype,servicecharge,problem,contactperson,assignedto,supportunit,status,solvedby,
			stremoteconnection,marketingperson,onsitevisit,overphone,mail,solveddate,billno,billdate,acknowledgementno,remarks,
			userid,complaintid,authorized,publishrecord,flag) VALUES('".$anonymous."','".$customername."','".$customerid."',
			'".changedateformat($date)."','".$time."','".$productgroup."','".$productname."','".$productversion."','".$category."','".$state."',
			'".$callertype."','".$servicecharge."','".$problem."','".$contactperson."','".$assignedto."','".$supportunit."',
			'".$status."','".$solvedby."','".$stremoteconnection."','".$marketingperson."','".$onsitevisit."','".$overphone."',
			'".$mail."','".changedateformat($solveddate)."','".$billno."','".changedateformat($billdate)."','".$acknowledgementno."',
			'".$remarks."','".$user."','".$complaintid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_onsiteregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',category = '".$category."',state = '".$state."',callertype = '".$callertype."',
			servicecharge = '".$servicecharge."',problem = '".$problem."',contactperson = '".$contactperson."',
			assignedto = '".$assignedto."',supportunit = '".$supportunit."',status = '".$status."',solvedby = '".$solvedby."',
			stremoteconnection = '".$stremoteconnection."',marketingperson = '".$marketingperson."',
			onsitevisit = '".$onsitevisit."',overphone = '".$overphone."',mail = '".$mail."',solveddate = '".
			changedateformat($solveddate)."',billno = '".$billno."',billdate = '".changedateformat($billdate)."',
			acknowledgementno = '".$acknowledgementno."',remarks = '".$remarks."',complaintid = '".$complaintid."'
			WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Onsite Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$complaintid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT complaintid FROM ssm_onsiteregister WHERE  slno = '".$lastslno."'");
		$fetchcomplaintid = $result['complaintid'];
		$query = "DELETE FROM ssm_onsiteregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetchcomplaintid."' Deleted Successfully");
	break;
	
	case 'generategrid':
	{
		if(!isset($_POST['slno']))
		{
			$_POST['slno'] = null;
			
		}
		if(!isset($_POST['showtype']))
		{
			$_POST['showtype'] = null;
		}
		$startlimit = $_POST['startlimit'];
		$slno1 = $_POST['slno'];
		$showtype = $_POST['showtype'];
		if($showtype == 'all')
		{
			$limit = 10000;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_onsiteregister WHERE status = 'unsolved' and
		date >= NOW() - INTERVAL 90 DAY ";
		$fetch1 = runmysqlqueryfetch($resultcount1);
		$fetchresultcount1 = $fetch1['count'];
		if($startlimit == '')
		{
			$startlimit = 0;
			$slno1 = 0;
		}
		else
		{
			$startlimit = $slno1 ;
			$slno1 = $slno1;
		}
		
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">state</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		$onsite_supportunitpiece = ($loggedsupportunit == '4')?(""):(" and ssm_onsiteregister.supportunit = '".$loggedsupportunit."'");
		
		$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous 
		AS anonymous, ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, 
		ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_onsiteregister.productgroup AS productgroup, 
		ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, 
		ssm_onsiteregister.category AS category,inv_mas_state.statename AS state ,ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge 
		AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, 
		ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, 
		ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,
		ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
		ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
		ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno 
		AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, 
		ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, 
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
		left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state 
		WHERE ssm_onsiteregister.status = 'unsolved'  ".$onsite_supportunitpiece." 
		and ssm_onsiteregister.date >= NOW() - INTERVAL 90 DAY  
		ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$slno1++;
			$color;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 6 || $i == 25 || $i == 27)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";
					}
				}
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		if(!isset($linkgrid))
		{
			$linkgrid = null;	
		}
		if($slno1 >= $fetchresultcount1)
		{
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
							<tr>
								<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
							</tr>
						</table>';
		}
		else
		{
				$linkgrid .= '<table>
							<tr>
								<td class="resendtext"><div align ="left" style="padding-right:10px">
<div align ="left" style="padding-right:10px">
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
					WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_onsiteregister.slno,ssm_onsiteregister.anonymous,ssm_onsiteregister.customername,
		ssm_onsiteregister.customerid,ssm_onsiteregister.date,ssm_onsiteregister.time,ssm_onsiteregister.productgroup,
		ssm_onsiteregister.productname,ssm_onsiteregister.productversion,ssm_onsiteregister.category,ssm_onsiteregister.callertype, 
		ssm_onsiteregister.servicecharge,ssm_onsiteregister.problem, ssm_onsiteregister.contactperson,ssm_onsiteregister.assignedto,
		ssm_onsiteregister.status,ssm_onsiteregister.solvedby,ssm_onsiteregister.stremoteconnection,ssm_onsiteregister.marketingperson,
		ssm_onsiteregister.onsitevisit,ssm_onsiteregister.overphone,ssm_onsiteregister.mail,ssm_onsiteregister.solveddate,
		ssm_onsiteregister.billno,ssm_onsiteregister.billdate,ssm_onsiteregister.acknowledgementno,ssm_onsiteregister.remarks,
		s1.username as username,ssm_onsiteregister.complaintid, ssm_onsiteregister.authorized,ssm_onsiteregister.authorizedgroup,
		ssm_onsiteregister.teamleaderremarks,ssm_onsiteregister.authorizedperson,ssm_onsiteregister.authorizeddatetime,
		ssm_onsiteregister.flag,ssm_onsiteregister.supportunit ,s1.slno as userid, s2.username as reportingauthority , inv_mas_state.statecode AS state
		FROM ssm_onsiteregister 
		left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state 
		WHERE ssm_onsiteregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
	/*	$query1 = "Select ssm_users.slno as slno, ssm_users.username as username, ssm_users.reportingauthority as reportingauthority from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
		$result1 = runmysqlqueryfetch($query1);*/
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']."^".
		changedateformat($result['date'])."^".$result['time']."^".$result['productgroup']."^".$result['productname']."^".
		$result['productversion']."^".$result['category']."^".$result['callertype']."^".$result['servicecharge']."^".
		$result['problem']."^".$result['contactperson']."^".$result['assignedto']."^".$result['status']."^".
		$result['solvedby']."^".$result['stremoteconnection']."^".$result['marketingperson']."^".$result['onsitevisit']."^".
		$result['overphone']."^".$result['mail']."^".changedateformat($result['solveddate'])."^".$result['billno']."^".
		changedateformat($result['billdate'])."^".$result['acknowledgementno']."^".$result['remarks']."^".
		$result['username']."^".$result['complaintid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".
		$result['teamleaderremarks']."^".$result['authorizedperson']."^".$result['authorizeddatetime']."^".
		$result['flag']."^".$result['userid']."^".$result['reportingauthority']."^".$result['supportunit']."^".$result['state']);
	}
	break;
	
	case 'searchfilter':
	{
		if(!isset($_POST['slno']))
		{
			$_POST['slno'] = null;
			
		}
		if(!isset($_POST['showtype']))
		{
			$_POST['showtype'] = null;
		}
		if(!isset($s_productgroup))
		{
			$s_productgroup = null;
		}
		$startlimit = $_POST['startlimit'];
		$slno1 = $_POST['slno'];
		$showtype = $_POST['showtype'];
		if($showtype == 'all')
		{
			$limit = 10000;
		}
		else
		{
			$limit = 10;
		}
		$fromdate = $_POST['fromdate'];
		$newfromdate = date("Y-m-d", strtotime($fromdate));
		$todate = $_POST['todate']; 
		$newtodate = date("Y-m-d", strtotime($todate));
		$s_customername = $_POST['s_customername']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_customerid = $_POST['s_customerid']; 
		$customer = $_POST['s_customer']; 
		$dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; 
		$ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; 
		$s_status = $_POST['s_status']; 
		$s_problem = $_POST['s_problem'];
		$s_solvedby= $_POST['s_solvedby']; 
		$s_solveddate= $_POST['s_solveddate']; 
		$s_billdate= $_POST['s_billdate']; 
		$s_billno= $_POST['s_billno'];
		$s_acknowledgementno= $_POST['s_acknowledgementno']; 
		$s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		$s_state = $_POST['s_state'];
		$s_supportunit = $_POST['s_supportunit']; 
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_onsiteregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_onsiteregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_onsiteregister.customerid LIKE '%".$s_customerid."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(($categorykkg == "true") && ($categoryblr == "true") && ($categorycsd == "true")) { $s_categorypiece = ""; }
		elseif(($categorykkg == "true") && ($categoryblr == "true")) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(($categorykkg == "true") && ($categorycsd == "true")) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(($categorycsd == "true") && ($categoryblr == "true")) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(($categorycsd == "true")) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(($categoryblr == "true")) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(($categorykkg == "true")) { $s_categorypiece = " AND (category = 'KKG')"; }
		if(($customer == "true") && ($dealer == "true") && ($employee == "true") && ($ssmuser == "true")) { $s_callertypepiece = ""; }
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif(($employee == "true") && ($customer == "true") && ($dealer == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; }
		
		elseif(($customer == "true") && ($dealer == "true") &&  ($ssmuser == "true")) { $s_callertypepiece = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; }
		
		elseif(($dealer == "true") && ($ssmuser == "true") && ($employee == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')"; }
		
		elseif(($ssmuser == "true") && ($employee == "true") && ($customer == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; }
		
		elseif(($employee == "true") && ($customer == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer')"; }
		elseif(($employee == "true") && ($dealer == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer')"; }
		elseif(($employee == "true") && ($ssmuser == "true")) { $s_callertypepiece = "AND (callertype='employee' OR callertype='ssmuser')"; }
		elseif(($customer == "true") && ($dealer == "true")) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
		elseif(($customer == "true") && ($ssmuser == "true")) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
		elseif(($dealer == "true") && ($ssmuser == "true")) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
		elseif(($customer == "true")) { $s_callertypepiece = "AND callertype='customer'"; }
		elseif(($dealer == "true")) { $s_callertypepiece = "AND callertype='dealer'"; }
		elseif(($employee == "true")) { $s_callertypepiece = "AND callertype='outstationemployee'"; }
		elseif(($ssmuser == "true")) { $s_callertypepiece = "AND callertype='ssmuser'"; }
		
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_onsiteregister.state = '".$s_state."'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_onsiteregister.productgroup = '".$s_productgroup."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_onsiteregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_onsiteregister.status = '".$s_status."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_onsiteregister.problem LIKE '%".$s_problem."%'");
		$s_acknowledgementnopiece = ($s_acknowledgementno == "")?(""):(" AND ssm_onsiteregister.acknowledgementno LIKE '%".$s_acknowledgementno."%'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_onsiteregister.billno LIKE '%".$s_billno."%'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND ssm_onsiteregister.billdate LIKE '%".changedateformat($s_billdate)."%'");
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_onsiteregister.solveddate LIKE '%".changedateformat($s_solveddate)."%'");
		$s_solvedbypiece = ($s_solvedby == "")?(""):(" AND ssm_onsiteregister.solvedby LIKE '%".$s_solvedby."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_onsiteregister.userid = '".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND ssm_onsiteregister.complaintid LIKE '%".$s_complaintid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_onsiteregister.flag = '".$s_flags."'");
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_onsiteregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_onsiteregister.customerid'; break;
			case 'category': $orderbyfield = 'ssm_onsiteregister.category'; break;
			case 'state': $orderbyfield = 'ssm_onsiteregister.state'; break;
			case 'callertype': $orderbyfield = 'ssm_onsiteregister.callertype'; break;
			case 'productgroup ': $orderbyfield = 'ssm_onsiteregister.productgroup'; break;
			case 'productname ': $orderbyfield = 'ssm_onsiteregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_onsiteregister.status'; break;
			case 'problem': $orderbyfield = 'ssm_onsiteregister.problem'; break;
			case 'solvedby': $orderbyfield = 'ssm_onsiteregister.solvedby'; break;
			case 'solveddate': $orderbyfield = 'ssm_onsiteregister.solveddate'; break;
			case 'billno': $orderbyfield = 'ssm_onsiteregister.billno'; break;
			case 'billdate': $orderbyfield = 'ssm_onsiteregister.billdate'; break;
			case 'acknowledgementno ': $orderbyfield = 'ssm_onsiteregister.acknowledgementno'; break;
			case 'complaintid': $orderbyfield = 'ssm_onsiteregister.complaintid'; break;
			case 'userid': $orderbyfield = 'ssm_onsiteregister.userid'; break;		
		}
		
		$resultcount = "SELECT count(*) as count FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
		$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_billdatepiece.$s_solveddatepiece.$s_solvedbypiece.
		$s_useridpiece.$s_complaintidpiece.$s_anonymouspiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".
		$orderbyfield."";
		$fetch1 = runmysqlqueryfetch($resultcount);
		$fetchresultcount = $fetch1['count'];

		if($startlimit == '')
		{
			$startlimit = 0;
			$slno1 = 0;
		}
		else
		{
			$startlimit = $slno1 ;
			$slno1 = $slno1;
		}
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		
		$query11 = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous 
		AS anonymous, ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, 
		ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time,ssm_onsiteregister.productgroup AS productgroup, 
		ssm_products.productname AS productname,ssm_onsiteregister.productversion AS productversion, 
		ssm_onsiteregister.category AS category,inv_mas_state.statename as state , ssm_onsiteregister.callertype AS callertype, 
		ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, 
		ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading 
		AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
		ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,
		ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail 
		AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, 
		ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
		ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, 
		ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, 
		ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, 
		ssm_onsiteregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state
		 WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		 $s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
		 $s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_billdatepiece.$s_solveddatepiece.$s_solvedbypiece.
		 $s_useridpiece.$s_complaintidpiece.$s_anonymouspiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".
		 $orderbyfield." LIMIT ".$startlimit.",".$limit.";";
		$result = runmysqlquery($query11);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$slno1++;
			if($i_n%2 == 0)
			$color = "#edf4ff";
		else
			$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 6 || $i == 25 || $i == 27)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					}
					else 
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";	
					}
				}
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		if(!isset($linkgrid))
		{
			$linkgrid = null;	
		}
		if($slno1 >= $fetchresultcount)
		{
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
							<tr>
								<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
							</tr>
						</table>';
		}
		else
		{
			$linkgrid .= '<table>
						<tr>
							<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
						</tr>
					</table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.
		$s_productnamepiece.$s_statuspiece.
		$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_billdatepiece.$s_solveddatepiece.$s_solvedbypiece.
		$s_useridpiece.$s_complaintidpiece.$s_anonymouspiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC ");
		echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
	}
	break;
	
	case 'flags':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
					<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
					<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
					<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
					<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
					<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
					<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
					<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous 
		AS anonymous, ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, 
		ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time,ssm_onsiteregister.productgroup AS productgroup, 
		ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, 
		ssm_onsiteregister.category AS category, inv_mas_state.statecode AS state ,ssm_onsiteregister.callertype AS callertype, 
		ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, 
		ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS 
		supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
		ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,
		ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail 
		AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, 
		ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
		ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, 
		ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, 
		ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, 
		ssm_onsiteregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_onsiteregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state 
		WHERE  flag='yes' AND userid = '".$user."' ORDER BY date DESC";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			if($i_n%2 == 0)
			$color = "#edf4ff";
		else
			$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 6 || $i == 23 || $i == 25)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' 
width='14' height='14' border='0' /></td>";	
				}
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>