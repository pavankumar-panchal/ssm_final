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
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$state = $_POST['state'];
		$callertype = $_POST['callertype'];
		$category = $_POST['category'];
		$personname = $_POST['personname'];
		$emailid = $_POST['emailid'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		$errorfile = $_POST['errorfile'];
		$status = $_POST['status'];
		$forwardedto = $_POST['forwardedto'];
		$thankingemail = $_POST['thankingemail'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$compliantid = $_POST['compliantid'];		
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_emailregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$compliantid = "ER". ($temp + 10000);
			$query = "INSERT INTO ssm_emailregister(anonymous,customername,customerid,productgroup,productname,productversion,
			date,time,callertype,category,state,personname,emailid,subject,content,errorfile,status,forwardedto,thankingemail,
			remarks,userid,compliantid,authorized,publishrecord,flag) values('".$anonymous."','".$customername."',
			'".$customerid."','".$productgroup."','".$productname."','".$productversion."','".changedateformat($date)."',
			'".$time."','".$callertype."','".$category."','".$state."','".$personname."','".$emailid."','".$subject."','".$content."',
			'".$errorfile."','".$status."','".$forwardedto."','".$thankingemail."','".$remarks."','".$user."',
			'".$compliantid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_emailregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',date = '".changedateformat($date)."',time = '".$time."',
			callertype = '".$callertype."',category = '".$category."',state = '".$state."' , personname = '".$personname."',emailid = '".$emailid."',
			subject = '".$subject."',content = '".$content."',errorfile = '".$errorfile."',status = '".$status."',
			forwardedto = '".$forwardedto."',thankingemail = '".$thankingemail."',remarks = '".$remarks."'  
			WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Email Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$compliantid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT compliantid FROM ssm_emailregister WHERE  slno = '".$lastslno."'");
		$fetchcompliantid = $result['compliantid'];
		$query = "DELETE FROM ssm_emailregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetchcompliantid."' Deleted Successfully");
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
			$limit = 500;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_emailregister WHERE status = 'unsolved' and
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
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Subject</td>
						<td nowrap = "nowrap" class="td-border-grid">Content</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Thanking Email</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						
					</tr>';
		}
		$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag,
		ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,
		ssm_emailregister.customerid AS customerid, ssm_emailregister.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_emailregister.productversion AS productversion,
		ssm_emailregister.date AS date,ssm_emailregister.time AS time,
		ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,  inv_mas_state.statename AS state, 
		ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid,
		 ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,
		ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,
		ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, 
		ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,
		ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,
		ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,
		ssm_emailregister.authorizeddatetime AS authorizeddatetime
		FROM ssm_emailregister 
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
		LEFT JOIN ssm_users on ssm_users.slno = ssm_emailregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_emailregister.state
		WHERE status = 'unsolved' ".$loggedsupportunitpiece." and  ssm_emailregister.date >= NOW() - INTERVAL 90 DAY 
		ORDER BY `date` DESC  LIMIT ".$startlimit.",".$limit.";  ";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$slno1++;
			$color;
			$dot = '...';
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 3)
				{
					if(strlen($fetch[$i]) > 20)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,20)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
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
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>
						<img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
					}
				}
				elseif($i == 29)
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
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
	
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister
		where date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_emailregister.slno,ssm_emailregister.anonymous,ssm_emailregister.customername,
		ssm_emailregister.customerid,ssm_emailregister.productgroup,ssm_emailregister.productname as productname,
		ssm_emailregister.productversion,ssm_emailregister.date,ssm_emailregister.time,ssm_emailregister.callertype,
		ssm_emailregister.category, ssm_emailregister.personname,ssm_emailregister.emailid,ssm_emailregister.subject,
		ssm_emailregister.content,ssm_emailregister.errorfile,ssm_emailregister.status,ssm_emailregister.forwardedto,
		ssm_emailregister.thankingemail,ssm_emailregister.remarks,s1.username as username,ssm_emailregister.compliantid,
		ssm_emailregister.authorized,ssm_emailregister.authorizedgroup,ssm_emailregister.teamleaderremarks,
		ssm_emailregister.authorizedperson,ssm_emailregister.authorizeddatetime,ssm_emailregister.flag, 
		s1.slno as userid,s2.username as reportingauthority , inv_mas_state.statecode AS state  FROM ssm_emailregister 
		left join ssm_users as s1 on ssm_emailregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_emailregister.state
		WHERE ssm_emailregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		
		if($result['authorizedgroup'] <> '')
				$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading 
				from  ssm_category WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
				$query2 = "SELECT inv_customeramc.customerreference as customerreference,ssm_emailregister.slno
				FROM ssm_emailregister left join inv_customeramc on 
				inv_customeramc.customerreference= ssm_emailregister.customerid 
				where ssm_emailregister.slno = '".$lastslno."'";
		$result3 = runmysqlqueryfetch($query2);
		if($result3['customerreference'] == '')
		{

			echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']
			."^".$result['productgroup']."^".$result['productname']."^".$result['productversion']
			."^".changedateformat($result['date'])."^".$result['time']."^".$result['callertype']."^".$result['category']
			."^".$result['personname']."^".$result['emailid']."^".$result['subject']."^".$result['content']
			."^".$result['errorfile']."^".$result['status']."^".$result['forwardedto']."^".$result['thankingemail']
			."^".$result['remarks']."^".$result['username']."^".$result['compliantid']."^".$result['authorized']
			."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['authorizedperson']
			."^".$result['authorizeddatetime']."^".$result['flag']."^"."http://".$_SERVER['HTTP_HOST']."/sssm/upload/"
			."^".$result['userid']."^".$result['reportingauthority']."^".$result['state']."^".'Not Avaliable');
		}
	   else
		{
			echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']
			."^".$result['productgroup']."^".$result['productname']."^".$result['productversion']
			."^".changedateformat($result['date'])."^".$result['time']."^".$result['callertype']."^".$result['category']
			."^".$result['personname']."^".$result['emailid']."^".$result['subject']."^".$result['content']
			."^".$result['errorfile']."^".$result['status']."^".$result['forwardedto']."^".$result['thankingemail']
			."^".$result['remarks']."^".$result1['username']."^".$result['compliantid']."^".$result['authorized']
			."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['authorizedperson']
			."^".$result['authorizeddatetime']."^".$result['flag']."^"."http://".$_SERVER['HTTP_HOST']."/sssm/upload/"
			."^".$result1['slno']."^".$result1['reportingauthority']."^".$result['state']."^".'Avaliable');
		}
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
		if(!isset($s_productgroup))
		{
			$s_productgroup = null;	
		}
		$fromdate = $_POST['fromdate'];
		$newfromdate = date("Y-m-d", strtotime($fromdate));
		$todate = $_POST['todate']; 
		$newtodate = date("Y-m-d", strtotime($todate));
		$s_anonymous = $_POST['s_anonymous']; 
		$s_customername = $_POST['s_customername']; 
		$s_customerid = $_POST['s_customerid'];  
		$customer = $_POST['s_customer']; 
		$dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; 
		$s_state = $_POST['s_state'];
		$ssmuser = $_POST['s_ssmuser']; 
		$s_productname = $_POST['s_productgroup']; 
		$s_productname = $_POST['s_productname']; 
		$s_status = $_POST['s_status']; 
		$s_thankingemail = $_POST['s_thankingemail'];
		$s_content = $_POST['s_content']; 
		$s_userid = $_POST['s_userid']; 
		$s_forwardedto = $_POST['s_forwardedto']; 
		$s_compliantid = $_POST['s_compliantid']; 
		$s_errorfile = $_POST['s_errorfile']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		$s_emailid = $_POST['s_emailid']; 
		$s_supportunit = $_POST['s_supportunit'];
		$s_thankingemailpiece =($s_thankingemail == "")?(""):(" AND ssm_emailregister.thankingemail LIKE '%".$s_thankingemail."%'"); 	
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_emailregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_emailregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_emailregister.customerid LIKE '%".$s_customerid."%'");
$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(($categorykkg == "true") && ($categoryblr == "true") && ($categorycsd == "true")) { $s_categorypiece = ""; }
		elseif(($categorykkg == "true") && ($categoryblr == "true")) 
		{ 
			$s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; 
		}
		elseif(($categorykkg == "true") && ($categorycsd == "true")) 
		{ 
			$s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; 
		}
		elseif(($categorycsd == "true") && ($categoryblr == "true")) 
		{ 
			$s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; 
		}
		elseif(($categorycsd == "true")) 
		{ 
			$s_categorypiece = " AND (category = 'CSD')"; 
		}
		elseif(($categoryblr == "true")) 
		{
			 $s_categorypiece = " AND (category = 'BLR')"; 
		}
		elseif(($categorykkg == "true")) 
		{ 
			$s_categorypiece = " AND (category = 'KKG')"; 
		}		
		if(($customer == "true") && ($dealer == "true") && ($employee == "true") && ($ssmuser == "true")) 
		{ 
			$s_callertypepiece = ""; 
		}
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif(($employee == "true") && ($customer == "true") && ($dealer == "true")) 
		{ 
		$s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; 
		}
		
		elseif(($customer == "true") && ($dealer == "true") &&  ($ssmuser == "true")) 
		{
			$s_callertypepiece = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; 
			}
		
		elseif(($dealer == "true") && ($ssmuser == "true") && ($employee == "true")) 
		{
			$s_callertypepiece = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
			 }
		
		elseif(($ssmuser == "true") && ($employee == "true") && ($customer == "true")) 
		{
			$s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; 
		}
		elseif(($employee == "true") && ($customer == "true")) 
		{
			$s_callertypepiece = "AND (callertype='employee' OR callertype='customer')";
		}
		elseif(($employee == "true") && ($dealer == "true")) 
		{
			$s_callertypepiece = "AND (callertype='employee' OR callertype='dealer')"; 
		}
		elseif(($employee == "true") && ($ssmuser == "true")) 
		{
			$s_callertypepiece = "AND (callertype='employee' OR callertype='ssmuser')";
		}
		elseif(($customer == "true") && ($dealer == "true")) 
		{
			$s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; 
		}
		elseif(($customer == "true") && ($ssmuser == "true")) 
		{
			$s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; 
		}
		elseif(($dealer == "true") && ($ssmuser == "true")) 
		{
			$s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; 
		}
		elseif(($customer == "true")) 
		{
			$s_callertypepiece = "AND callertype='customer'";
		}
		elseif(($dealer == "true")) { $s_callertypepiece = "AND callertype='dealer'"; }
		elseif(($employee == "true")) { $s_callertypepiece = "AND callertype='employee'"; }
		elseif(($ssmuser == "true")) { $s_callertypepiece = "AND callertype='ssmuser'"; }
		
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_emailregister.productgroup = '".$s_productgroup."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_emailregister.productname = '".$s_productname."'");
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_emailregister.state = '".$s_state."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_emailregister.status = '".$s_status."'");
		$s_contentpiece = ($s_content == "")?(""):(" AND ssm_emailregister.content LIKE '%".$s_content."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_emailregister.userid = '".$s_userid."'");
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
			case 'state' : $orderbyfield = 'ssm_emailregister.state'; break;
			case 'compliantid': $orderbyfield = 'ssm_emailregister.compliantid'; break;
			case 'content': $orderbyfield = 'ssm_emailregister.content'; break;
			case 'customerid': $orderbyfield = 'ssm_emailregister.customerid'; break;
			case 'customername': $orderbyfield = 'ssm_emailregister.customername'; break;
			case 'date': $orderbyfield = 'ssm_emailregister.date'; break;
			case 'forwardedto': $orderbyfield = 'ssm_emailregister.forwardedto'; break;
			case 'userid': $orderbyfield = 'ssm_emailregister.userid'; break;
			case 'productgroup': $orderbyfield = 'ssm_emailregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_emailregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_emailregister.status'; break;	
			case 'time': $orderbyfield = 'ssm_emailregister.time'; break;	
		}
		
		
		$resultcount = "SELECT count(*) as count FROM ssm_emailregister 
		 LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
		 LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
		 LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
		 LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		 LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
		 WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'"
		 .$s_anonymouspiece.$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece
		 .$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.$s_emailidpiece.$s_contentpiece.$s_useridpiece
		 .$s_forwardedtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_thankingemailpiece.$s_flagspiece." 
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
		$query11 = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag, ssm_emailregister.anonymous 
		AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,
		ssm_emailregister.productgroup AS productgroup,ssm_products.productname AS productname,ssm_emailregister.productversion AS
		productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS 
		callertype, ssm_emailregister.category AS category,inv_mas_state.statename as state,ssm_emailregister.personname AS personname,
		ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,
		ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail 
		AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid 
		AS compliantid,ssm_emailregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,
		ssm_emailregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_emailregister  
		LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_emailregister.state
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_anonymouspiece.
		$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece
		.$s_statuspiece.$s_emailidpiece.$s_contentpiece.$s_useridpiece.$s_forwardedtopiece.$s_compliantidpiece.
		$s_supportunitpiece.$s_thankingemailpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." LIMIT "
		.$startlimit.",".$limit.";";
		$result = runmysqlquery($query11);
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Subject</td>
						<td nowrap = "nowrap" class="td-border-grid">Content</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Thanking Email</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		
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
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')
					{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' 
height='14' border='0' /></td>";	
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
		$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
						<tr>
							<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
						</tr>
					</table>';
		else
		$linkgrid .= '<table>
						<tr>
							<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> 
</a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer">
<font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
						</tr>
					</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister");
		echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid).".";
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
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Subject</td>
					<td nowrap = "nowrap" class="td-border-grid">Content</td>
					<td nowrap = "nowrap" class="td-border-grid">Error File</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Thanking Email</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.anonymous AS anonymous,
		ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productgroup 
		AS productgroup,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,
		ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, 
		ssm_emailregister.category AS category,inv_mas_state.statename AS state,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, 
		ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, 
		ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks 
		AS remarks,ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized 
		AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS 
		teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,
		ssm_emailregister.flag AS flag 
		FROM ssm_emailregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
		LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_emailregister.state
		WHERE flag='yes' AND userid = '".$user."' ORDER BY   `date` DESC";
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
				if($i == 7)
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
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
	case 'generateamcgrid':
	{
		$query1 = "SELECT inv_customeramc.slno as slno,inv_mas_product.productname as productname,inv_customeramc.startdate 
		as startdate,inv_customeramc.enddate as enddate 
		FROM inv_customeramc 
		LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_customeramc.productcode 
		LEFT JOIN inv_mas_customer ON inv_mas_customer.slno = inv_customeramc.customerreference  
		WHERE inv_customeramc.customerreference = '".$lastslno."' ORDER BY slno ;";
		$query2 = "SELECT inv_mas_customer.businessname FROM inv_mas_customer 
		LEFT JOIN inv_customeramc ON inv_customeramc.customerreference = inv_mas_customer.slno  
		WHERE inv_mas_customer.slno  = '".$lastslno."'";
		$fetch2 = runmysqlqueryfetch($query2);
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Start Date</td>
					<td nowrap = "nowrap" class="td-border-grid">End Date</td>
				</tr>';
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

case 'gridtoform':
	{
		$query = "SELECT ssm_emailregister.slno,ssm_emailregister.anonymous,ssm_emailregister.customername,
		ssm_emailregister.customerid,ssm_emailregister.productgroup,ssm_emailregister.productname as productname,
		ssm_emailregister.productversion,ssm_emailregister.date,ssm_emailregister.time,ssm_emailregister.callertype,
		ssm_emailregister.category, ssm_emailregister.personname,ssm_emailregister.emailid,ssm_emailregister.subject,
		ssm_emailregister.content,ssm_emailregister.errorfile,ssm_emailregister.status,ssm_emailregister.forwardedto,
		ssm_emailregister.thankingemail,ssm_emailregister.remarks,s1.username as username,ssm_emailregister.compliantid,
		ssm_emailregister.authorized,ssm_emailregister.authorizedgroup,ssm_emailregister.teamleaderremarks,
		ssm_emailregister.authorizedperson,ssm_emailregister.authorizeddatetime,ssm_emailregister.flag, 
		s2.username as reportingauthority ,ssm_emailregister.state  FROM ssm_emailregister 
		left join ssm_users as s1 on ssm_emailregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		WHERE ssm_emailregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']."^".
		$result['productgroup']."^".$result['productname']."^".$result['productversion']."^".
		changedateformat($result['date'])."^".$result['time']."^".$result['callertype']."^".$result['category']."^".
		$result['personname']."^".$result['emailid']."^".$result['subject']."^".$result['content']."^".
		$result['errorfile']."^".$result['status']."^".$result['forwardedto']."^".$result['thankingemail']."^".
		$result['remarks']."^".$result1['username']."^".$result['compliantid']."^".$result['authorized']."^".
		$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['authorizedperson']."^".
		$result['authorizeddatetime']."^".$result['flag']."^"."http://".$_SERVER['HTTP_HOST']."/sssm/upload/"."^".
		$result1['slno']."^".$result1['reportingauthority']."^".$result1['state']);
	}
	
	break;
	case 'amcinfo':
	{
		
		$query2 = "SELECT inv_customeramc.customerreference as customerreference,ssm_emailregister.slno,
		ssm_emailregister.customerid FROM ssm_emailregister 
		left join inv_customeramc on inv_customeramc.customerreference= ssm_emailregister.customerid 
		where ssm_emailregister.customerid = '".$lastslno."' and inv_customeramc.customerreference is not null";
		$result3 = runmysqlquery($query2);
		if(mysqli_num_rows($result3) == 0)
		{

			echo('Not Avaliable');
		}
	   else
		{
			echo('Avaliable');
		}
	}
	case 'savemail':
	{
		$feedbackemail = $_POST['feedbackemail'];
		$customerid = $_POST['customerid'];
		$customername = $_POST['customername'];
		$productgroup = $_POST['productgroup'];
		$productid = $_POST['productname'];
		$problem = $_POST['problem'];
		$status = $_POST['status'];
		$userid = $_POST['userid'];
		$place = $_POST['place'];
		$query = "select productname from ssm_products where slno =".$productid;
		$fetchresult = runmysqlqueryfetch($query);
		
		$productname = $fetchresult['productname'];
		
			
		$sub = "Thank you for your valuable input";
		$file_htm = "../mailcontents/disablemail.htm";
		$file_txt = "../mailcontents/disablemail.txt";
		feedbackemail($sub,$file_htm,$file_txt);

	}
	break;
}
?>