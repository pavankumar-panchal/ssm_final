<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$type = $_POST['type'];
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
$lastslno = $_POST['lastslno'];

switch($type)
{
	case 'save':
	{
		$anonymous = $_POST['anonymous'];
		$customername = $_POST['customername'];
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$database = $_POST['database'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$state = $_POST['state'];
		$errorreported = $_POST['errorreported'];
		$reportedto = $_POST['reportedto'];
		$errorfile = $_POST['errorfile'];
		$status = $_POST['status'];
		$solveddate = $_POST['solveddate'];
		$solutiongiven = $_POST['solutiongiven'];
		$solutionfile = $_POST['solutionfile'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$errorid = $_POST['errorid'];
		$customerid = $_POST['customerid'];
		$errorunderstood = $_POST['errorunderstood'];
		if($status <> '' && $solutiongiven <> '')
			$solutionenteredtime = datetimelocal('H:i:s');
		else
			$solutionenteredtime = '';

		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_errorregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$errorid = "ERR". ($temp + 10000);
			$query = "INSERT INTO ssm_errorregister(anonymous,customername,productgroup,productname,productversion,`database`,
			date,time,state,errorreported,errorunderstood,reportedto,errorfile,status,solveddate,solutiongiven,solutionenteredtime,
			solutionfile,remarks,userid,errorid,customerid,authorized,publishrecord,flag) values('".$anonymous."',
			'".$customername."','".$productgroup."','".$productname."','".$productversion."','".$database."',
			'".changedateformat($date)."','".$time."','".$state."','".$errorreported."','".$errorunderstood."','".$reportedto."',
			'".$errorfile."','".$status."','".changedateformat($solveddate)."','".$solutiongiven."','".$solutionenteredtime."',
			'".$solutionfile."','".$remarks."','".$user."','".$errorid."','".$customerid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_errorregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',`database` = '".$database."',date = '".changedateformat($date)."',
			time = '".$time."',state = '".$state."' , errorreported = '".$errorreported."',errorunderstood = '".$errorunderstood."',
			reportedto = '".$reportedto."',errorfile = '".$errorfile."',status = '".$status."',solveddate = 
			'".changedateformat($solveddate)."',solutiongiven = '".$solutiongiven."',solutionfile = '".$solutionfile."',
			solutionenteredtime = '".$solutionenteredtime."',remarks = '".$remarks."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Error Register','".$user."','".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$errorid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT errorid FROM ssm_errorregister WHERE  slno = '".$lastslno."'");
		$fetcherrorid = $result['errorid'];
		$query = "DELETE FROM ssm_errorregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetcherrorid."' Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_errorregister  WHERE status = 'unsolved' and
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
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Reported</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Understood by You</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution File</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Error ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous AS 
		anonymous, ssm_errorregister.customername AS customername,ssm_errorregister.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database
		AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,inv_mas_state.statename AS state ,ssm_errorregister.errorreported AS errorreported,
		ssm_errorregister.errorunderstood AS errorunderstood,ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS
		errorfile,ssm_errorregister.status AS status,ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven 
		AS solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,
		ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,ssm_errorregister.errorid AS errorid,
		ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,ssm_errorregister.teamleaderremarks 
		AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime
		AS authorizeddatetime FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_errorregister.state   
		WHERE status = 'unsolved' ".$loggedsupportunitpiece." and ssm_errorregister.date >= NOW() - INTERVAL 90 DAY  
		ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
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
				if($i == 8 || $i == 16)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14'
border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";	
					}
				}
				elseif($i == 18)
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
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
							<tr>
								<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
							</tr>
						</table>';
			else
			$linkgrid .= '<table>
							<tr>
								<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> 
</a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer">
<font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
	
		
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister  
		WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_errorregister.slno,ssm_errorregister.anonymous,ssm_errorregister.customername,
		ssm_errorregister.customerid,ssm_errorregister.productgroup,ssm_errorregister.productname,ssm_errorregister.productversion,
		ssm_errorregister.database,ssm_errorregister.date,ssm_errorregister.time,ssm_errorregister.errorreported,
		ssm_errorregister.errorunderstood,ssm_errorregister.reportedto,ssm_errorregister.errorfile,ssm_errorregister.status,
		ssm_errorregister.solveddate,ssm_errorregister.solutiongiven,ssm_errorregister.solutionenteredtime,
		ssm_errorregister.solutionfile,ssm_errorregister.remarks,s1.username as userid,ssm_errorregister.errorid,
		ssm_errorregister.authorized, ssm_errorregister.authorizedgroup,ssm_errorregister.teamleaderremarks,
		ssm_errorregister.authorizedperson, ssm_errorregister.authorizeddatetime,ssm_errorregister.flag , 
		s1.slno as userid,s2.username as reportingauthority , inv_mas_state.statecode as state
		FROM ssm_errorregister 
		left join ssm_users as s1 on ssm_errorregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_errorregister.state 
		WHERE ssm_errorregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['productgroup']."^".
		$result['productname']."^".$result['productversion']."^".$result['database']."^".changedateformat($result['date'])."^".
		$result['time']."^".$result['errorreported']."^".$result['reportedto']."^".$result['errorfile']."^".
		$result['status']."^".changedateformat($result['solveddate'])."^".$result['solutiongiven']."^".
		$result['solutionenteredtime']."^".$result['solutionfile']."^".$result['remarks']."^".$result['username']."^".
		$result['errorid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".
		$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".
		"http://".$_SERVER['HTTP_HOST']."/supportsystem/uploads/"."^".$result['userid']."^".$result['reportingauthority']."^".
		$result['customerid']."^".$result['errorunderstood']."^".$result['state']);
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
		$todate = $_POST['todate']; 
		$s_customername = $_POST['s_customername']; 
		$s_anonymous = $_POST['s_anonymous'];
		$s_productgroup = $_POST['s_productgroup'];  
		$s_productname = $_POST['s_productname']; 
		$s_errorreported = $_POST['s_errorreported']; 
		$s_reportedto = $_POST['s_reportedto'];
		$s_errorfile = $_POST['s_errorfile']; 
		$s_status = $_POST['s_status']; 
		$s_solveddate = $_POST['s_solveddate'];
		$s_solutiongiven = $_POST['s_solutiongiven']; 
		$s_solutionfile = $_POST['s_solutionfile']; 
		$s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; 
		$s_errorid = $_POST['s_errorid']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		$s_state = $_POST['s_state'];
		$s_supportunit = $_POST['s_supportunit'];
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_errorregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_errorregister.customername LIKE '%".$s_customername."%'"); 
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_errorregister.state  = '".$s_state."'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_errorregister.productgroup  = '".$s_productgroup."'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_errorregister.productname  = '".$s_productname."'"); 
		$s_errorreportedpiece = ($s_errorreported == "")?(""):(" AND ssm_errorregister.errorreported LIKE '%".$s_errorreported."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_errorregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_errorfilepiece = ($s_errorfile == "")?(""):(" AND ssm_errorregister.errorfile LIKE '%".$s_errorfile."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_errorregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_errorregister.solveddate LIKE '%".changedateformat($s_solveddate)."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_errorregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_solutionfilepiece = ($s_solutionfile == "")?(""):(" AND ssm_errorregister.solutionfile LIKE '%".$s_solutionfile."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_errorregister.remarks LIKE '%".$s_remarks."'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_errorregister.userid = '".$s_userid."'"); 
		$s_erroridpiece = ($s_errorid == "")?(""):(" AND ssm_errorregister.errorid LIKE '%".$s_errorid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_errorregister.flag = '".$s_flags."'");	
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_errorregister.customername'; break;
			case 'state': $orderbyfield = 'ssm_errorregister.state'; break;
			case 'productgroup': $orderbyfield = 'ssm_errorregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_errorregister.productname'; break;
			case 'errorreported': $orderbyfield = 'ssm_errorregister.errorreported'; break;
			case 'reportedto': $orderbyfield = 'ssm_errorregister.reportedto'; break;
			case 'errorfile': $orderbyfield = 'ssm_errorregister.errorfile'; break;
			case 'status': $orderbyfield = 'ssm_errorregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_errorregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_errorregister.solutiongiven'; break;
			case 'solutionfile': $orderbyfield = 'ssm_errorregister.solutionfile'; break;
			case 'remarks': $orderbyfield = 'ssm_errorregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_errorregister.userid'; break;
			case 'errorid': $orderbyfield = 'ssm_errorregister.errorid'; break;	
			case 'time': $orderbyfield = 'ssm_errorregister.time'; break;		
		}
		$resultcount = "SELECT count(*) as count FROM ssm_errorregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_statepiece.$s_productgrouppiece.$s_productnamepiece.$s_errorreportedpiece.$s_reportedtopiece.$s_errorfilepiece.
		$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_solutionfilepiece.$s_remarkspiece.$s_useridpiece.
		$s_erroridpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY   `date` DESC , ".$orderbyfield." ";
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
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Reported</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Understood by You</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution File</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Error ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		
		$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous AS 
		anonymous, inv_mas_state.statename as state ,ssm_errorregister.customername AS customername,
		ssm_errorregister.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database 
		AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,
		ssm_errorregister.errorreported AS errorreported,
		ssm_errorregister.errorunderstood AS errorunderstood,
		ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile 
		AS errorfile,ssm_errorregister.status AS status, 
		ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven 
		AS solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,
		ssm_errorregister.solutionfile AS solutionfile,
		ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_errorregister.errorid AS errorid,
		ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup, 
		ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
		ssm_errorregister.authorizeddatetime  AS authorizeddatetime 
		FROM ssm_errorregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_errorregister.state 
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".
		$s_customernamepiece.$s_statepiece.$s_productgrouppiece.$s_productnamepiece.$s_errorreportedpiece.
		$s_reportedtopiece.$s_errorfilepiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.
		$s_solutionfilepiece.$s_remarkspiece.$s_useridpiece.$s_erroridpiece.$s_supportunitpiece.$s_flagspiece." 
		ORDER BY   `date` DESC , ".$orderbyfield." LIMIT ".$startlimit.",".$limit." ";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$slno1++;
			$dot = '...';
			if($i_n%2 == 0)
			$color = "#edf4ff";
		else
			$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 9 || $i == 16)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14'
border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";	
					}
				}	
				elseif($i == 17)
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
		$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
						<tr>
							<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
						</tr>
					</table>';
		else
		$linkgrid .= '<table>
						<tr>
							<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div>&nbsp;&nbsp;&nbsp;
</div></td>
						</tr>
					</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister ");
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
					<td nowrap = "nowrap" class="td-border-grid">Error Reported</td>
					<td nowrap = "nowrap" class="td-border-grid">Error Understood by You</td>
					<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
					<td nowrap = "nowrap" class="td-border-grid">Error File</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
					<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Solution File</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Error ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous 
		AS anonymous, ssm_errorregister.customername AS customername,ssm_errorregister.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS 
		`database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,
		inv_mas_state.statename as state,ssm_errorregister.errorreported AS errorreported,
		ssm_errorregister.errorunderstood AS errorunderstood,
		ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile
		AS errorfile,ssm_errorregister.status AS status,ssm_errorregister.solveddate AS solveddate,
		ssm_errorregister.solutiongiven AS solutiongiven,
		ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,
		ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,ssm_errorregister.errorid AS errorid,
		ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
		ssm_errorregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_errorregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup
		left join inv_mas_state on inv_mas_state.slno = ssm_errorregister.state 
		WHERE flag='yes' AND userid = '".$user."' 
		ORDER BY   `date` DESC";
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
				if($i == 7 || $i == 14)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' 
	border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
	height='14' border='0' /></td>";	
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
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
	
	case 'errorreport':
	{
		$grid1 = '<table width="100%" cellpadding="3" cellspacing="0" border="1">
					<tr bgcolor="#4f81bd">
						<td width="9%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error ID</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Group</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td>
						<td width="5%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td>
						<td width="8%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Back End</font></strong></td>
						<td width="12%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference Files</font></strong></td>
						<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bug Description</font></strong></td>
						<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bug Understood by You</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td>
						<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Reference</font></strong></td>
					<tr>';

		$query = "SELECT ssm_errorregister.errorid AS errorid,ssm_errorregister.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion, ssm_errorregister.database AS 
		`database`, ssm_errorregister.errorfile AS errorfile, ssm_errorregister.errorreported AS errorreported,
		ssm_errorregister.errorunderstood AS errorunderstood, ssm_errorregister.remarks AS remarks, ssm_users.fullname AS userid, 
		ssm_errorregister.customername AS customername 
		FROM ssm_errorregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid  
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  
		WHERE ssm_errorregister.slno = '".$lastslno."' ORDER BY  `date` DESC ";
			
		$fetch = runmysqlqueryfetch($query);
			
		$grid1 .= '<tr bgcolor='.$color.'>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorid'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productgroup'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productname'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productversion'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['database'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorfile'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorreported'].'</font></td>
					<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorunderstood'].'</font></td>
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