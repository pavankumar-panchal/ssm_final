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
		$calltype = $_POST['calltype'];
		$anonymous = $_POST['anonymous'];
		$customername = $_POST['customername'];
		$customerid = $_POST['customerid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$personname = $_POST['personname'];
		$category = $_POST['category'];
		$state = $_POST['state'];
		$callertype = $_POST['callertype'];
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$problem = $_POST['problem'];
		$status = $_POST['status'];
		$callcategory = $_POST['callcategory'];
		$remarks = $_POST['remarks'];
		$transferredto = $_POST['transferredto'];
		$userid = $_POST['userid'];
		$compliantid = $_POST['compliantid'];
		$stremoteconnection = $_POST['stremoteconnection'];
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_callregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$compliantid = "CR". ($temp + 10000);
			$endtime = datetimelocal('H:i:s');
			
			$query = "INSERT INTO ssm_callregister(slno,anonymous,customername,customerid,date,time,personname,category,state,
			callertype,productgroup,productname,productversion,problem,status,remarks,transferredto,userid,compliantid,endtime,
			authorized,publishrecord,stremoteconnection, flag,calltype,callcategory) values('".$temp."','".$anonymous."',
			'".$customername."','".$customerid."','".changedateformat($date)."','".$time."','".$personname."',
			'".$category."','".$state."','".$callertype."','".$productgroup."','".$productname."','".$productversion."',
			'".$problem."','".$status."','".$remarks."','".$transferredto."','".$user."','".$compliantid."','".$endtime."','no','no',
			'".$stremoteconnection."','no','".$calltype."','".$callcategory."')";
			$result = runmysqlquery($query);
		//	sendsupportcallmail($temp,$customerid);
		}
		else
		{
			$query = "UPDATE ssm_callregister SET anonymous = '".$anonymous."',stremoteconnection = '".$stremoteconnection."',
			customername = '".$customername."',customerid = '".$customerid."',personname = '".$personname."',
			category = '".$category."',state = '".$state."' ,callertype = '".$callertype."',productgroup = '".$productgroup."',
			productname = '".$productname."',productversion = '".$productversion."',problem = '".$problem."',
			status = '".$status."',remarks = '".$remarks."',transferredto = '".$transferredto."',
			calltype = '".$calltype."',callcategory = '".$callcategory."'
			WHERE slno = '".$lastslno."' ";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Call Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo ("1^Record '".$compliantid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT compliantid FROM ssm_callregister WHERE  slno = '".$lastslno."'");
		$compliantid = $result['compliantid'];
		$query = "DELETE FROM ssm_callregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^Record '".$compliantid."' Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_callregister WHERE status = 'unsolved' and
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
		
		$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous AS anonymous,
		ssm_callregister.calltype AS calltype, ssm_callregister.customername AS customername, ssm_callregister.customerid AS 
		customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.endtime AS endtime, 
		ssm_callregister.personname AS personname, ssm_callregister.category AS category,inv_mas_state.statename AS state , 
		ssm_callregister.callertype AS callertype, ssm_callregister.productgroup  AS productgroup, ssm_products.productname  AS productname, 
		ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS 
		status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, 
		ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized,
		ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime,
		ssm_callcategory.categoryname AS categoryname 
		FROM ssm_callregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
		LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		left join ssm_callcategory on  ssm_callcategory.slno = ssm_callregister.callcategory 
		left join inv_mas_state on inv_mas_state.slno = ssm_callregister.state 
		WHERE status = 'unsolved' ".$loggedsupportunitpiece." and ssm_callregister.date >= NOW() - INTERVAL 90 DAY 
		ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
		
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Call Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Start Time</td>
						<td nowrap = "nowrap" class="td-border-grid">End Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Duration</td>
						<td nowrap = "nowrap" class="td-border-grid">User Id</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Call Category</td>
					</tr>';
			}
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
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
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch['slno'].');" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['slno'], 75, "<br />\n")."</td>";
			if($fetch['flag'] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
			else
			$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['calltype'], 75, "<br />\n")."</td>";	
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['time'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['endtime'], 75, "<br />\n")."</td>";
			$starttime = $fetch['time'];
			$endtime = $fetch['endtime'];
			$diff = gettimeDifference($fetch['date'],$starttime,$fetch['date'],$endtime);
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$diff."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['anonymous'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['customerid'], 75, "<br />\n")."</td>";
			if(strlen($fetch['customername']) > 20)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['customername'],0,20)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>";	
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['personname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['category'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['state'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callertype'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productgroup'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productversion'], 75, "<br />\n")."</td>";
			if(strlen($fetch['problem']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['problem'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>";
			if(strlen($fetch['remarks']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['remarks'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['status'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['stremoteconnection'], 75, "<br />\n")."</td>";

			
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['compliantid'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorized'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['categoryheading'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['teamleaderremarks'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username1'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorizeddatetime'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['categoryname'], 75, "<br />\n")."</td>";
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
								<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister 
				WHERE ssm_callregister.date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_callregister.slno,ssm_callregister.anonymous,ssm_callregister.calltype,ssm_callregister.customername,
		ssm_callregister.customerid,ssm_callregister.date,ssm_callregister.time,ssm_callregister.personname,
		ssm_callregister.category,ssm_callregister.callertype,ssm_callregister.productgroup,
		ssm_products.slno as productname,ssm_callregister.productversion,ssm_callregister.problem, ssm_callregister.status,
		ssm_callregister.stremoteconnection,ssm_callregister.remarks,ssm_callregister.transferredto,s1.username as username,
		ssm_callregister.compliantid,ssm_callregister.authorized,
		ssm_callregister.authorizedgroup,ssm_callregister.teamleaderremarks,ssm_callregister.authorizedperson,
		ssm_callregister.authorizeddatetime, ssm_callregister.flag,ssm_callregister.endtime,ssm_callregister.callcategory,
		s1.slno as userid,s2.username as reportingauthority ,inv_mas_state.statecode as state
		FROM ssm_callregister   
		left join ssm_users as s1 on ssm_callregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join ssm_products on ssm_callregister.productname = ssm_products.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_callregister.state 
		where ssm_callregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']
		."^".changedateformat($result['date'])."^".$result['time']."^".$result['personname']."^".$result['category']
		."^".$result['callertype']."^".$result['productgroup']."^".$result['productname']."^".$result['productversion']."^".
		$result['problem']."^".$result['status']."^".$result['remarks']."^".$result['transferredto']."^".$result['username']."^"
		.$result['compliantid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^"
		.$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".$result['endtime']."^"
		.$result['userid']."^".$result['reportingauthority']."^".$result['stremoteconnection']."^".$result['calltype']."^"
		.$result['callcategory']."^".$result['state']);	
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
		$s_customerid = $_POST['s_customerid']; 
		$s_productname = $_POST['s_productname'];
		$s_productgroup = $_POST['s_productgroup'];
		$s_status = $_POST['s_status'];
		$s_callcategory = $_POST['s_callcategory'];  
		$s_state = $_POST['s_state'];        
		$s_problem = $_POST['s_problem'];
		$s_userid = $_POST['s_userid']; 
		$s_transferredto= $_POST['s_transferredto']; 
		$s_compliantid = $_POST['s_compliantid'];
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		$s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_calltype = $_POST['s_calltype'];
		$customer = $_POST['s_customer']; 
		$dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee'];
		 $ssmuser = $_POST['s_ssmuser'];
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_callregister.anonymous = '".$s_anonymous."'");
		$s_calltypepiece = ($s_calltype == "")?(""):(" AND ssm_callregister.calltype = '".$s_calltype."'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_callregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_callregister.customerid LIKE '%".$s_customerid."%'");
		//$s_categorypiece = ($s_category == "")?(""):(" AND ssm_callregister.category LIKE '%".$s_category."%'");
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

		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_callregister.productgroup = '".$s_productgroup."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_callregister.productname = '".$s_productname."'");
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_callregister.state = '".$s_state."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_callregister.status = '".$s_status."'");
		$s_callcategorypiece = ($s_callcategory == "")?(""):(" AND ssm_callcategory.slno = '".$s_callcategory."'");
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
			case 'state': $orderbyfield = 'ssm_callregister.state'; break;
			case 'callertype': $orderbyfield = 'ssm_callregister.callertype'; break;
			case 'productgroup': $orderbyfield = 'ssm_callregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_callregister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_callregister.problem'; break;
			case 'status': $orderbyfield = 'ssm_callregister.status'; break;
			case 'callcategory': $orderbyfield = 'ssm_callregister.callcategory'; break;
			case 'userid': $orderbyfield = 'ssm_callregister.userid'; break;
			case 'transferredto': $orderbyfield = 'ssm_callregister.transferredto'; break;
			case 'compliantid': $orderbyfield = 'ssm_callregister.compliantid'; break;	
			case 'time': $orderbyfield = 'ssm_callregister.time'; break;	
		}
		
		$resultcount = "SELECT  count(*) as count FROM ssm_callregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
		LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		LEFT JOIN ssm_callcategory on ssm_callregister.callcategory = ssm_callcategory.slno
 		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.
		$s_productnamepiece.$s_statuspiece.
		$s_useridpiece.$s_anonymouspiece.$s_calltypepiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.
		$s_supportunitpiece.$s_flagspiece.$s_callcategorypiece." ORDER BY  `date` DESC , ".$orderbyfield."  ";
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
						<td nowrap = "nowrap" class="td-border-grid">Call Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Start Time</td>
						<td nowrap = "nowrap" class="td-border-grid">End Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Duration</td>
						<td nowrap = "nowrap" class="td-border-grid">User Id</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Call Category</td>
					</tr>';
		}
		$query11 = "SELECT  ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous AS 
		anonymous,ssm_callregister.calltype AS calltype, ssm_callregister.customername AS customername, 
		ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, 
		ssm_callregister.personname AS personname, ssm_callregister.category AS category,inv_mas_state.statename as state ,
		ssm_callregister.callertype AS	callertype, ssm_callregister.productgroup AS productgroup,
		ssm_products.productname  AS productname, 
		ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status 
		AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, 
		ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS 
		authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS 
		teamleaderremarks, ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime, 
		ssm_callregister.endtime AS endtime, ssm_callcategory.categoryname AS callcategory FROM ssm_callregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
		LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		LEFT JOIN ssm_callcategory on ssm_callregister.callcategory = ssm_callcategory.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_callregister.state
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
		$s_useridpiece.$s_anonymouspiece.$s_calltypepiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.
		$s_supportunitpiece.$s_flagspiece.$s_callcategorypiece." ORDER BY  `date` DESC , 
		".$orderbyfield." LIMIT ".$startlimit.",".$limit.";  ";
		
		$result = runmysqlquery($query11);
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$color;
			$slno1++;
			$dot ='...';
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['slno'], 75, "<br />\n")."</td>";
			if($fetch['flag'] == 'yes')	
			{
				$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
			}
			else
			{ 
				$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";
			}
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['calltype'], 75, "<br />\n")."</td>";	
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['time'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['endtime'], 75, "<br />\n")."</td>";
			$starttime = $fetch['time'];
			$endtime = $fetch['endtime'];
			$diff = gettimeDifference($fetch['date'],$starttime,$fetch['date'],$endtime);
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$diff."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['anonymous'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['customerid'], 75, "<br />\n")."</td>";
			if(strlen($fetch['customername']) > 20)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['customername'],0,20)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['personname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['category'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['state'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callertype'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productgroup'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productversion'], 75, "<br />\n")."</td>";
			if(strlen($fetch['problem']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['problem'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>";
			if(strlen($fetch['remarks']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['remarks'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['status'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['stremoteconnection'], 75, "<br />\n")."</td>";

			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['compliantid'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorized'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['categoryheading'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['teamleaderremarks'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username1'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorizeddatetime'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callcategory'], 75, "<br />\n")."</td>";
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
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div>&nbsp;&nbsp;&nbsp;
</div></td>
						</tr>
					</table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister");
		echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
	}
	break;

	case 'flags':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Start Time</td>
					<td nowrap = "nowrap" class="td-border-grid">End Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Duration</td>
					<td nowrap = "nowrap" class="td-border-grid">User Id</td>
					<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
					<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					<td nowrap = "nowrap" class="td-border-grid">Call Category</td>
				</tr>';
		
		$query = "SELECT
		ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, 
		ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, 
		ssm_callregister.personname AS personname, ssm_callregister.category AS category,
		ssm_callregister.callertype AS callertype, ssm_callregister.state AS state,
		ssm_callregister.productgroup AS productgroup, ssm_products.productname  AS productname, 
		ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, 
		ssm_callregister.status AS status,
		ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks,
		ssm_users.username AS username, 
		ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  
		AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, 
		ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag,
		ssm_callregister.endtime AS endtime, 
		ssm_callregister.callcategory AS callcategory 
		FROM ssm_callregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname 
		LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_callregister.state 
		WHERE ssm_callregister.flag = 'yes' AND ssm_callregister.userid = '".$user."' ORDER BY   `date` DESC ";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$dot ='...';
			if($i_n%2 == 0)
			$color = "#edf4ff";
				else
			$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['slno'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['time'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['endtime'], 75, "<br />\n")."</td>";
			$starttime = $fetch['time'];
			$endtime = $fetch['endtime'];
			$diff = gettimeDifference($fetch['date'],$starttime,$fetch['date'],$endtime);
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$diff."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['anonymous'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['customerid'], 75, "<br />\n")."</td>";
			if(strlen($fetch['customername']) > 20)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['customername'],0,20)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['personname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['category'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callertype'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productgroup'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productversion'], 75, "<br />\n")."</td>";
			if(strlen($fetch['problem']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['problem'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>";
			if(strlen($fetch['remarks']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['remarks'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['status'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['stremoteconnection'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['compliantid'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorized'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['categoryheading'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['teamleaderremarks'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username1'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorizeddatetime'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callcategory'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['state'], 75, "<br />\n")."</td>";
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
	case 'gettime':
	{
		$time = datetimelocal('H:i:s');
		echo($time);
	}
	break;
	
	case 'amcinfo':
	{
			$lastslno = $_POST['lastslno'];
			$query2 = "SELECT inv_customeramc.customerreference as customerreference,ssm_callregister.slno,
			ssm_callregister.customerid
			FROM ssm_callregister left join inv_customeramc on 
			inv_customeramc.customerreference= ssm_callregister.customerid 
			where ssm_callregister.customerid = '".$lastslno."' and inv_customeramc.customerreference is not null ";
		$result3 = runmysqlquery($query2);
		if(mysqli_num_rows($result3) == 0)
		{
			echo('Not Avaliable');
		}
	   else
		{
			echo('Avaliable');
		}
		//echo($query2);
	}
	break;
	
	case 'generateamcgrid':
	{
		$lastslno = $_POST['lastslno'];
		$query1 = "SELECT inv_customeramc.slno as slno,inv_mas_product.productname as productname,inv_customeramc.startdate 
		as startdate,inv_customeramc.enddate as enddate 
		FROM inv_customeramc 
		LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_customeramc.productcode 
		LEFT JOIN inv_mas_customer ON inv_mas_customer.slno = inv_customeramc.customerreference  
		WHERE inv_customeramc.customerreference = '".$lastslno."' ORDER BY slno ;";
		
		$query2 = "SELECT inv_mas_customer.businessname FROM inv_mas_customer 
LEFT JOIN inv_customeramc ON inv_customeramc.customerreference = inv_mas_customer.slno  
WHERE inv_mas_customer.slno  = '".$lastslno."';";
		$fetch2 = runmysqlqueryfetch($query2);
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Start Date</td>
					<td nowrap = "nowrap" class="td-border-grid">End Date</td></tr>';
		$i_n = 0;$slno = 0;
		$result1 = runmysqlquery($query1);
		while($fetch = mysqli_fetch_array($result1))
		{
			$i_n++;$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr bgcolor='.$color.' >';
			$grid .= "<td nowrap='nowrap' class='td-border-grid1'>".$fetch['slno']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>";
					$startdate = $fetch['startdate']; 
					$enddate = $fetch['enddate']; 
					$todays_date = date("Y-m-d"); 
					$today = strtotime($todays_date); 
					$expiration_date1 = strtotime($startdate); 
					$expiration_date2 = strtotime($enddate); 
					if ($expiration_date1 > $today) { $msg = "Future"; } 
					elseif($expiration_date2 < $today) { $msg = "Expired"; }
					else { $msg = "Active"; }
			$grid .= "<td nowrap='nowrap' class='td-border-grid1'>".$msg."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1'>".changedateformat($fetch['startdate'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1'>".changedateformat($fetch['enddate'])."</td>";
			$grid .= "</tr>";
		}
			$grid .= "</table>";
			$customername = $fetch2['businessname'];
			
		echo ($grid.'^'.$customername);	
			
	}
	break;


}




?>
