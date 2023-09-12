<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
if(!isset($_POST['authorized']))
{
	$_POST['authorized'] = null;	
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
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$database = $_POST['database'];
		$date = $_POST['date'];
		$state = $_POST['state'];
		$time = $_POST['time'];
		$requirement = $_POST['requirement'];
		$reportedto = $_POST['reportedto'];
		$status = $_POST['status'];
		$solveddate = $_POST['solveddate'];
		$solutiongiven = $_POST['solutiongiven'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$requirementid = $_POST['requirementid'];
		$authorized = $_POST['authorized'];	
		if($status <> '' && $solutiongiven <> '')
			$solutionenteredtime = datetimelocal('H:i:s');
		else
			$solutionenteredtime = '';
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_requirementregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$requirementid = "RQR". ($temp + 10000);
			$query = "INSERT INTO ssm_requirementregister(anonymous,customername,productgroup,productname,productversion,
			`database`,date,time,state,requirement,reportedto,status,solveddate,solutiongiven,solutionenteredtime,remarks,userid,
			requirementid,customerid,authorized,publishrecord,flag) VALUES('".$anonymous."','".$customername."',
			'".$productgroup."','".$productname."','".$productversion."','".$database."','".changedateformat($date)."',
			'".$time."','".$state."','".$requirement."','".$reportedto."','".$status."','".changedateformat($solveddate)."',
			'".$solutiongiven."','".$solutionenteredtime."','".$remarks."','".$user."','".$requirementid."','".$customerid."',
			'no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_requirementregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',`database` = '".$database."',date = '".changedateformat($date)."',
			time = '".$time."', state = '".$state."',requirement = '".$requirement."',reportedto = '".$reportedto."',status = '".$status."',
			solveddate = '".changedateformat($solveddate)."',solutiongiven = '".$solutiongiven."',solutionenteredtime = 
			'".$solutionenteredtime."',remarks = '".$remarks."',requirementid = '".$requirementid."'
			 WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Requirement Register',
			'".$user."','".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$requirementid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT requirementid FROM ssm_requirementregister WHERE  slno = '".$lastslno."'");
		$fetchrequirementid = $result['requirementid'];
		$query = "DELETE FROM ssm_requirementregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetchrequirementid."' Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_requirementregister WHERE status = 'unsolved' and
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
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag, 
		ssm_requirementregister.anonymous AS anonymous,ssm_requirementregister.customername AS customername,
		ssm_requirementregister.productgroup AS productgroup,ssm_products.productname AS productname, 
		ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, 
		ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, inv_mas_state.statename AS state ,ssm_requirementregister.requirement AS 
		requirement, ssm_requirementregister.reportedto AS reportedto,ssm_requirementregister.status AS status,
		ssm_requirementregister.solveddate AS solveddate,ssm_requirementregister.solutiongiven AS solutiongiven, 
		ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, 
		ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS 
		authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_requirementregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_requirementregister.state 
		WHERE status = 'unsolved' ".$loggedsupportunitpiece." and
		ssm_requirementregister.date >= NOW() - INTERVAL 90 DAY  ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$slno1++;
			$color;
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
				elseif($i == 8)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
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
				elseif($i == 15)
				{
					if(strlen($fetch[$i]) > 30)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,30)."".$dot."</td>";
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
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
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
	
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister 
		WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT  ssm_requirementregister.slno,ssm_requirementregister.anonymous,ssm_requirementregister.customername, 
		ssm_requirementregister.customerid,ssm_requirementregister.productgroup, ssm_requirementregister.productname,
		ssm_requirementregister.productversion,ssm_requirementregister.database,ssm_requirementregister.date,
		ssm_requirementregister.time,ssm_requirementregister.requirement,ssm_requirementregister.reportedto, 
		ssm_requirementregister.status, ssm_requirementregister.solveddate,ssm_requirementregister.solutiongiven,
		ssm_requirementregister.solutionenteredtime,ssm_requirementregister.remarks,s2.username as username,
		ssm_requirementregister.requirementid,ssm_requirementregister.authorized,ssm_requirementregister.authorizedgroup, 
		ssm_requirementregister.teamleaderremarks, ssm_requirementregister.authorizedperson,
		ssm_requirementregister. authorizeddatetime,ssm_requirementregister.flag ,s1.slno as userid,s2.username as reportingauthority ,
		inv_mas_state.statecode AS state   
		FROM ssm_requirementregister 
		left join ssm_users as s1 on ssm_requirementregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_requirementregister.state 
		WHERE ssm_requirementregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
	
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['productgroup']."^".
		$result['productname']."^".$result['productversion']."^".$result['database']."^".changedateformat($result['date'])."^"
		.$result['time']."^".$result['requirement']."^".$result['reportedto']."^".$result['status']."^".
		changedateformat($result['solveddate'])."^".$result['solutiongiven']."^".$result['solutionenteredtime']."^".
		$result['remarks']."^".$result['username']."^".$result['requirementid']."^".$result['authorized']."^".
		$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['authorizedperson']."^".
		$result['authorizeddatetime']."^".$result['flag']."^".$result['userid']."^".$result['reportingauthority']."^".
		$result['customerid']."^".$result['state']);
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
			$limit = 10000;
		else
			$limit = 10;
		
		$fromdate = $_POST['fromdate'];
		$newfromdate = date("Y-m-d", strtotime($fromdate));
		$todate = $_POST['todate']; 
		$newtodate = date("Y-m-d", strtotime($todate));
		$s_customername = $_POST['s_customername'];
		$s_productname = $_POST['s_productname'];
		$s_requirement = $_POST['s_requirement']; 
		$s_reportedto = $_POST['s_reportedto'];
		$s_status = $_POST['s_status']; 
		$s_solveddate = $_POST['s_solveddate']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_solutiongiven = $_POST['s_solutiongiven'];
		$s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; 
		$s_requirementid = $_POST['s_requirementid']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags']; 
		$s_state = $_POST['s_state']; 
		$s_supportunit = $_POST['s_supportunit'];
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_requirementregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_requirementregister.customername LIKE '%".$s_customername."%'");
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_requirementregister.state = '".$s_state."'"); 
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_requirementregister.productgroup = '".$s_productgroup."'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_requirementregister.productname = '".$s_productname."'"); 
		$s_requirementpiece = ($s_requirement == "")?(""):(" AND ssm_requirementregister.requirement LIKE '%".$s_requirement."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_requirementregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_requirementregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_requirementregister.solveddate LIKE '%".$s_solveddate."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_requirementregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_requirementregister.remarks LIKE '%".$s_remarks."%'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_requirementregister.userid = '".$s_userid."'"); 
		$s_requirementidpiece = ($s_requirementid == "")?(""):(" AND ssm_requirementregister.requirementid  LIKE '%".$s_requirementid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_requirementregister.flag = '".$s_flags."'");
			
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_requirementregister.customername'; break;
			case 'state': $orderbyfield = 'ssm_requirementregister.state'; break;
			case 'productgroup': $orderbyfield = 'ssm_requirementregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_requirementregister.productname'; break;
			case 'requirement': $orderbyfield = 'ssm_requirementregister.requirement'; break;
			case 'reportedto': $orderbyfield = 'ssm_requirementregister.reportedto'; break;
			case 'status': $orderbyfield = 'ssm_requirementregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_requirementregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_requirementregister.solutiongiven'; break;
			case 'remarks': $orderbyfield = 'ssm_requirementregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_requirementregister.userid'; break;
			case 'requirementid': $orderbyfield = 'ssm_requirementregister.requirementid'; break;	
			case 'time': $orderbyfield = 'ssm_requirementregister.time'; break;		
		}
		$resultcount = "SELECT count(*) as count FROM ssm_requirementregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup 
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.$s_statepiece.
		$s_productgrouppiece.$s_productnamepiece.$s_requirementpiece.$s_reportedtopiece.$s_statuspiece.$s_solveddatepiece.
		$s_solutiongivenpiece.$s_remarkspiece.$s_useridpiece.$s_requirementidpiece.$s_supportunitpiece.$s_flagspiece." 
		ORDER BY `date` DESC , ".$orderbyfield."";
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
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag, 
		ssm_requirementregister.anonymous AS anonymous,ssm_requirementregister.customername AS customername,
		ssm_requirementregister.productgroup AS productgroup, ssm_products.productname AS productname,
		ssm_requirementregister.productversion AS productversion,ssm_requirementregister.database AS `database`,
		ssm_requirementregister.date AS date, ssm_requirementregister.time AS time,inv_mas_state.statename as state ,ssm_requirementregister.requirement 
		AS requirement, ssm_requirementregister.reportedto AS reportedto,ssm_requirementregister.status AS status, 
		ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, 
		ssm_requirementregister.solutionenteredtime AS solutionenteredtime,ssm_requirementregister.remarks AS remarks, 
		ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, 
		ssm_requirementregister.authorized  AS authorized, ssm_category.categoryheading AS authorizedgroup, 
		ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
		ssm_requirementregister.authorizeddatetime AS  authorizeddatetime 
		FROM ssm_requirementregister
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_requirementregister.state  
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.$s_statepiece.
		$s_productnamepiece.$s_requirementpiece.$s_reportedtopiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.
		$s_remarkspiece.$s_useridpiece.$s_requirementidpiece.$s_supportunitpiece.$s_flagspiece." 
		ORDER BY `date` DESC , ".$orderbyfield." LIMIT ".$startlimit.",".$limit.";";
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
				elseif($i == 8)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".date("Y-m-d", strtotime($fetch[$i]))."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";	
				}
				elseif($i == 16)
				{
					if(strlen($fetch[$i]) > 30)
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister ");
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
					<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Database</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Requirement</td>
					<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
					<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Requirement ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag, 
		ssm_requirementregister.anonymous AS anonymous,ssm_requirementregister.customername AS customername,
		ssm_requirementregister.productgroup AS productgroup, ssm_products.productname AS productname, 
		ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, 
		ssm_requirementregister.date AS date, ssm_requirementregister.time AS time,inv_mas_state.statename as state , ssm_requirementregister.requirement 
		AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, 
		ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, 
		ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks,
		ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, 
		ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
		ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
		ssm_requirementregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_requirementregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_requirementregister.state 
		WHERE  flag='yes' AND userid = '".$user."' ORDER BY  `date` DESC ";
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
				if($i == 8)
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
	
	case 'requirementreport':
	{
		$grid1 = '<table width="100%" cellpadding="3" cellspacing="0" border="1">
					<tr bgcolor="#4f81bd">
						<td width="9%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement ID</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td>
						<td width="5%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td>
						<td width="8%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Back End</font></strong></td>
						<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement Description</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Reference</font></strong></td>
					<tr>';

		$query = "SELECT ssm_requirementregister.requirementid AS requirementid, ssm_products.productname AS productname, 
		ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, 
		ssm_requirementregister.requirement AS requirement, ssm_requirementregister.remarks AS remarks, 
		ssm_users.fullname AS userid, ssm_requirementregister.customername AS customername 
		FROM ssm_requirementregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_requirementregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  
		WHERE ssm_requirementregister.slno = '".$lastslno."' ORDER BY  `date` DESC ";
			
		$fetch = runmysqlqueryfetch($query);
			
		$grid1 .= '<tr> 
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['requirementid'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productname'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productversion'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['database'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['requirement'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['remarks'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['userid'].'</font></td>
				<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['customername'].'</font></td>
				</tr>';
		$grid1 .= '</table>';
		echo($grid1);
	}
	break;
}
?>