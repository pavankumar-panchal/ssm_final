<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$type = $_POST['type'];
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
if(!isset($_POST['billdate']))
{
	$_POST['billdate'] = null;	
}
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
		$state = $_POST['state'];
		$contactperson = $_POST['contactperson'];
		$assignedto = $_POST['assignedto'];
		$status = $_POST['status'];
		$solvedby = $_POST['solvedby'];
		$billno = $_POST['billno'];
		$billdate = $_POST['billdate'];
		$acknowledgementno = $_POST['acknowledgementno'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$complaintid = $_POST['complaintid'];
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_inhouseregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$complaintid = "IHR". ($temp + 10000);
			$query = "INSERT INTO ssm_inhouseregister(anonymous,customername,customerid,date,time,productgroup,productname,
			productversion,category,state,callertype,servicecharge,problem,contactperson,assignedto,status,solvedby,billno,
			acknowledgementno,remarks,userid,complaintid,authorized,publishrecord,flag) VALUES('".$anonymous."',
			'".$customername."','".$customerid."','".changedateformat($date)."','".$time."','".$productgroup."',
			'".$productname."','".$productversion."','".$category."','".$state."','".$callertype."','".$servicecharge."','".$problem."',
			'".$contactperson."','".$assignedto."','".$status."','".$solvedby."','".$billno."','".$acknowledgementno."',
			'".$remarks."','".$user."','".$complaintid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_inhouseregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',category = '".$category."',state = '".$state."',callertype = '".$callertype."',
			servicecharge = '".$servicecharge."',problem = '".$problem."',contactperson = '".$contactperson."',
			assignedto = '".$assignedto."',status = '".$status."',solvedby = '".$solvedby."',billno = '".$billno."',
			acknowledgementno = '".$acknowledgementno."',remarks = '".$remarks."',complaintid = '".$complaintid."' 
			WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Inhouse Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$complaintid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT complaintid FROM ssm_inhouseregister WHERE  slno = '".$lastslno."'");
		$fetchcomplaintid = $result['complaintid'];
		$query = "DELETE FROM ssm_inhouseregister WHERE slno = '".$lastslno."'";
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
			$limit = 2000;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_inhouseregister WHERE status = 'notyetattended' and
		date >= NOW() - INTERVAL 90 DAY ";
		$fetch1 = runmysqlqueryfetch($resultcount1);
		$fetchresultcount1 = $fetch1['count'];
		//echo $fetchresultcount1;
		
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
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
					</tr>';
		}
		$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous 
		AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, 
		ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_inhouseregister.productgroup AS productgroup,
		ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, 
		ssm_inhouseregister.category 
		AS category,inv_mas_state.statename AS state ,ssm_inhouseregister.callertype AS callertype, 
		ssm_inhouseregister.servicecharge AS servicecharge, 
		ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, 
		ssm_users2.fullname AS assignedto,
		ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, 
		ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS 
		userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, 
		ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime  
		FROM ssm_inhouseregister
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_inhouseregister.state 
		WHERE status = 'notyetattended' ".$loggedsupportunitpiece." and ssm_inhouseregister.date >= NOW() - INTERVAL 90 DAY 
		ORDER BY `date` DESC  LIMIT ".$startlimit.",".$limit.";  ";

		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$slno1++;
			$dot = '...';
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
				if($i == 3)
				{
					if(strlen($fetch[$i]) > 20)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,20)."".$dot."</td>";
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
					}
				}
				elseif($i == 6)
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
				elseif($i == 12)
				{
					if(strlen($fetch[$i]) > 20)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,30)."".$dot."</td>";
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
					}
				}
				else
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				}
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
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div>&nbsp;&nbsp;&nbsp;</div>
</td>
							</tr>
						</table>';
		}
		
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Notyetattended] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_inhouseregister.slno,ssm_inhouseregister.anonymous,
		ssm_inhouseregister.customername,ssm_inhouseregister.customerid,
		ssm_inhouseregister.date,ssm_inhouseregister.time,ssm_inhouseregister.productgroup,ssm_inhouseregister.productname,
		ssm_inhouseregister.productversion,ssm_inhouseregister.category,ssm_inhouseregister.callertype, 
		ssm_inhouseregister.servicecharge,ssm_inhouseregister.problem ,ssm_inhouseregister.contactperson,
		ssm_inhouseregister.assignedto,ssm_inhouseregister.status,ssm_inhouseregister.solvedby,ssm_inhouseregister.billno,
		ssm_inhouseregister.acknowledgementno,ssm_inhouseregister.remarks,s1.username as username,ssm_inhouseregister.complaintid,
		ssm_inhouseregister.authorized,ssm_inhouseregister.authorizedgroup,ssm_inhouseregister.teamleaderremarks, 
		ssm_inhouseregister.authorizedperson,ssm_inhouseregister.authorizeddatetime,ssm_inhouseregister.flag , 
		s1.slno as userid,s2.username as reportingauthority  , inv_mas_state.statecode AS state  FROM ssm_inhouseregister 
		left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_inhouseregister.state 
		WHERE ssm_inhouseregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
			
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']."^".
		changedateformat($result['date'])."^".$result['time']."^".$result['productgroup']."^".$result['productname']."^".
		$result['productversion']."^".$result['category']."^".$result['callertype']."^".$result['servicecharge']."^".
		$result['problem']."^".$result['contactperson']."^".$result['assignedto']."^".$result['status']."^".$result['solvedby']."^".
		$result['billno']."^".$result['acknowledgementno']."^".$result['remarks']."^".$result['username']."^".
		$result['complaintid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".
		$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".$result['userid']."^".
		$result['reportingauthority']."^".$result['state']);
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
			$limit = 2000;
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
		$s_state = $_POST['s_state'];
		$s_problem = $_POST['s_problem'];
		$s_solvedby= $_POST['s_solvedby']; 
		$s_supportunit= $_POST['s_supportunit'];
		$s_billno= $_POST['s_billno']; 
		$s_acknowledgementno= $_POST['s_acknowledgementno']; 
		$s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_inhouseregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_inhouseregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_inhouseregister.customerid LIKE '%".$s_customerid."%'");
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
		elseif(($employee == "true")) { $s_callertypepiece = "AND callertype='employee'"; }
		elseif(($ssmuser == "true")) { $s_callertypepiece = "AND callertype='ssmuser'"; }
		
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_inhouseregister.state = '".$s_state."'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_inhouseregister.productgroup = '".$s_productgroup."'");
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
			case 'state': $orderbyfield = 'ssm_inhouseregister.state'; break;
			case 'callertype': $orderbyfield = 'ssm_inhouseregister.callertype'; break;
			case 'productgroup': $orderbyfield = 'ssm_inhouseregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_inhouseregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_inhouseregister.status'; break;
			case 'problem': $orderbyfield = 'ssm_inhouseregister.problem'; break;
			case 'solvedby': $orderbyfield = 'ssm_inhouseregister.solvedby'; break;
			case 'billno': $orderbyfield = 'ssm_inhouseregister.billno'; break;
			case 'acknowledgementno': $orderbyfield = 'ssm_inhouseregister.acknowledgementno'; break;
			case 'complaintid': $orderbyfield = 'ssm_inhouseregister.complaintid'; break;
			case 'userid': $orderbyfield = 'ssm_inhouseregister.userid'; break;		
		}
		$resultcount = "SELECT count(*) as count FROM ssm_inhouseregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup  
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.
		$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_solvedbypiece.$s_useridpiece.
		$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY   `date` DESC , ".$orderbyfield."";
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
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
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
		
		$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous 
				AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, 
				ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time,
				ssm_inhouseregister.productgroup AS productgroup, 
				ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, 
				ssm_inhouseregister.category AS category, inv_mas_state.statename as state ,
				ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, 
				ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, 
				ssm_users2.fullname AS assignedto,
				ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, 
				ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, 
				ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, 
				ssm_inhouseregister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime 
				FROM ssm_inhouseregister 
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
				LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
				LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup
				left join inv_mas_state on inv_mas_state.slno = ssm_inhouseregister.state  
				WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
				$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.
				$s_productnamepiece.$s_statuspiece.
				$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.
				$s_supportunitpiece.$s_flagspiece." 
				ORDER BY   `date` DESC , ".$orderbyfield." LIMIT ".$startlimit.",".$limit.";";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$slno1++;
			$dot = '...';
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
				if($i == 3)
				{
					if(strlen($fetch[$i]) > 20)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,20)."".$dot."</td>";
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
					}
				}
				elseif($i == 6)
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
				elseif($i == 12)
				{
					if(strlen($fetch[$i]) > 30)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,30)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
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
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister ");
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
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">State/td>
				</tr>';
		
		$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous 
		AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, 
		ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time,ssm_inhouseregister.productgroup AS productgroup, 
		ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS
		category,inv_mas_state.statename AS state ,ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, 
		ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto,
		ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, 
		ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS
		userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, 
		ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime 		 
		FROM ssm_inhouseregister
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_inhouseregister.state  
		WHERE flag='yes' AND userid = '".$user."' ORDER BY   `date` DESC ";
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
				if($i == 6)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14'
height='14' border='0' /></td>";	
				}
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>