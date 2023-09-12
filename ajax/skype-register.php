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
		$sender = $_POST['sender'];
		$category = $_POST['category'];
		$state = $_POST['state'];
		$callertype = $_POST['callertype'];
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$problem = $_POST['problem'];
		$status = $_POST['status'];
		$remarks = $_POST['remarks'];
		$attachment = $_POST['attachment'];
		$userid = $_POST['userid'];
		$skypeid = $_POST['skypeid'];
		$conversation = $_POST['conversation'];
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_skyperegister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$skypeid = "SR". ($temp + 10000);
			$query = "INSERT INTO ssm_skyperegister(anonymous,customername,customerid,sender,callertype,date,time,productgroup,
			productname,productversion,category,state,problem,conversation,attachment,status,remarks,userid,skypeid,authorized,
			publishrecord,flag) values('".$anonymous."','".$customername."','".$customerid."','".$sender."','".$callertype."',
			'".changedateformat($date)."','".$time."','".$productgroup."','".$productname."','".$productversion."',
			'".$category."','".$state."','".$problem."','".$conversation."','".$attachment."','".$status."','".$remarks."','".$user."',
			'".$skypeid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_skyperegister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',sender = '".$sender."',callertype = '".$callertype."',date = 
			'".changedateformat($date)."',time = '".$time."',productgroup = '".$productgroup."',productname = '".$productname."',
			productversion = '".$productversion."',category = '".$category."',state = '".$state."' ,problem = '".$problem."',
			conversation = '".$conversation."',	attachment = '".$attachment."',status = '".$status."',remarks = '".$remarks."',
			userid = '".$user."',skypeid = '".$skypeid."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Skype Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$skypeid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT skypeid FROM ssm_skyperegister WHERE  slno = '".$lastslno."'");
		$fetchskypeid = $result['skypeid'];
		$query = "DELETE FROM ssm_skyperegister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetchskypeid."' Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_skyperegister WHERE status = 'unsolved' and
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
						<td nowrap = "nowrap" class="td-border-grid">Sender</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype Conversation</td>
						<td nowrap = "nowrap" class="td-border-grid">Attachment</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous, 
		ssm_skyperegister.customername AS customername,ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, 
		ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date,ssm_skyperegister.time AS time, 
		ssm_skyperegister.productgroup AS productgroup,ssm_products.productname AS productname, ssm_skyperegister.productversion
		AS productversion,ssm_skyperegister.category AS category,inv_mas_state.statename AS state ,ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation 
		AS conversation, ssm_skyperegister.attachment AS attachment,ssm_skyperegister.status AS status, ssm_skyperegister.remarks 
		AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid,ssm_skyperegister.authorized AS authorized,
		ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, 
		ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_skyperegister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_skyperegister.state 
		WHERE ssm_skyperegister.status = 'unsolved' ".$loggedsupportunitpiece." and
		ssm_skyperegister.date >= NOW() - INTERVAL 90 DAY ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
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
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister 
		WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Un Solved] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_skyperegister.slno,ssm_skyperegister.anonymous,ssm_skyperegister.customername,ssm_skyperegister.customerid,
		ssm_skyperegister.sender,callertype,ssm_skyperegister.date,ssm_skyperegister.time,ssm_skyperegister.productgroup,
		ssm_skyperegister.productname,ssm_skyperegister.productversion,ssm_skyperegister.category,ssm_skyperegister.problem,
		ssm_skyperegister.conversation,ssm_skyperegister.attachment,ssm_skyperegister.status,ssm_skyperegister.remarks,s1.username 
		as username,ssm_skyperegister.skypeid,ssm_skyperegister.authorized,ssm_skyperegister.authorizedgroup,
		ssm_skyperegister.teamleaderremarks,ssm_skyperegister.authorizedperson,ssm_skyperegister.authorizeddatetime,
		ssm_skyperegister.flag,s1.slno as userid,s2.username as reportingauthority ,inv_mas_state.statecode AS state
		FROM ssm_skyperegister 
		left join ssm_users as s1 on ssm_skyperegister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_skyperegister.state 
		WHERE ssm_skyperegister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
	
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		$query3 = "SELECT inv_customeramc.customerreference as customerreference,ssm_skyperegister.slno
		FROM ssm_skyperegister left join inv_customeramc on 
		inv_customeramc.customerreference= ssm_skyperegister.customerid where ssm_skyperegister.slno = '".$lastslno."'";
		$result3 = runmysqlqueryfetch($query3);
		if($result3['customerreference'] == '')
		{
				echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']."^".
				$result['sender']."^".$result['callertype']."^".date("d-m-Y", ($result['date']))."^".$result['time']."^".
				$result['productgroup']."^".$result['productname']."^".$result['productversion']."^".$result['category']."^".
				$result['problem']."^".$result['attachment']."^".$result['status']."^".$result['remarks']."^".
				$result['username']."^".$result['skypeid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['authorizedperson']."^".$result['authorizeddatetime']."^".
				$result['flag']."^"."http://".$_SERVER['HTTP_HOST']."/supportsystem/uploads/"."^".$result['userid']."^".
				$result['reportingauthority']."^".$result['conversation']."^".$result['state']."^".'Not Avaliable');
		}
		else
		{
			echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['customerid']."^".
			$result['sender']."^".$result['callertype']."^".changedateformat($result['date'])."^".$result['time']."^".
			$result['productgroup']."^".$result['productname']."^".$result['productversion']."^".$result['category']."^".
			$result['problem']."^".$result['attachment']."^".$result['status']."^".$result['remarks']."^".$result1['username'].
			"^".$result['skypeid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".
			$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^"."http://".
			$_SERVER['HTTP_HOST']."/supportsystem/uploads/"."^".$result['slno']."^".$result['reportingauthority']."^".
			$result['conversation']."^".$result['state']."^".'Avaliable');
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
		$s_customerid = $_POST['s_customerid']; 
		$customer = $_POST['s_customer'];
		$dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; 
		$ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; 
		$s_productgroup = $_POST['s_productgroup']; 
		$s_status = $_POST['s_status']; 
		$s_problem = $_POST['s_problem'];
		$s_userid = $_POST['s_userid']; 
		$s_attachment= $_POST['s_attachment']; 
		$s_skypeid = $_POST['s_skypeid'];
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags']; 
		$s_state = $_POST['s_state'];
		$s_supportunit = $_POST['s_supportunit']; 
		$s_anonymous = $_POST['s_anonymous']; 
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_skyperegister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_skyperegister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_skyperegister.customerid LIKE '%".$s_customerid."%'");
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
		
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_skyperegister.state = '".$s_state."'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_skyperegister.productgroup = '".$s_productgroup."'");
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
			case 'state': $orderbyfield = 'ssm_skyperegister.state'; break;
			case 'callertype': $orderbyfield = 'ssm_skyperegister.callertype'; break;
			case 'productgroup': $orderbyfield = 'ssm_skyperegister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_skyperegister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_skyperegister.problem'; break;
			case 'status': $orderbyfield = 'ssm_skyperegister.status'; break;
			case 'attachment': $orderbyfield = 'ssm_skyperegister.attachment'; break;
			case 'userid': $orderbyfield = 'ssm_skyperegister.userid'; break;
			case 'skypeid': $orderbyfield = 'ssm_skyperegister.skypeid'; break;		
			case 'time': $orderbyfield = 'ssm_skyperegister.time'; break;		
		}
		
		$resultcount = "SELECT count(*) as count FROM ssm_skyperegister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup  
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece
		.$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
		$s_useridpiece.$s_problempiece.$s_attachmentpiece.$s_skypeidpiece.$s_flagspiece.$s_anonymouspiece."
		ORDER BY `date` DESC , ".$orderbyfield.";";
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
						<td nowrap = "nowrap" class="td-border-grid">Sender</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype Conversation</td>
						<td nowrap = "nowrap" class="td-border-grid">Attachment</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		
		$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS 
		anonymous, ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, 
		ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, 
		ssm_skyperegister.time AS time, ssm_skyperegister.productgroup  AS productgroup, ssm_products.productname AS 
		productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category,		
		inv_mas_state.statename as state , ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation, 		
		ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks,		
		ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized,
		ssm_category.categoryheading  AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, 		     	
		ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup  
		left join inv_mas_state on inv_mas_state.slno = ssm_skyperegister.state
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_customeridpiece.$s_categorypiece.$s_statepiece.$s_callertypepiece.$s_productgrouppiece.$s_productnamepiece.
		$s_statuspiece.$s_useridpiece.$s_problempiece.$s_attachmentpiece.$s_skypeidpiece.$s_flagspiece.$s_anonymouspiece." 
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
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
					}
				}
				elseif($i == 12)
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
							<td class="resendtext"><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
						</tr>
					</table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister ");
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
					<td nowrap = "nowrap" class="td-border-grid">Sender</td>
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Skype Conversation</td>
					<td nowrap = "nowrap" class="td-border-grid">Attachment</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS 
		anonymous, ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, 
		ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, 
		ssm_skyperegister.time AS time, ssm_skyperegister.productgroup AS productgroup,ssm_products.productname AS productname, 
		ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category,inv_mas_state.statename AS state , ssm_skyperegister.problem 
		AS problem, ssm_skyperegister.conversation AS conversation, ssm_skyperegister.attachment AS attachment, 
		ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, 
		ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS 
		authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
		ssm_skyperegister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_skyperegister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_skyperegister.state 
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
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
	
	case 'generateamcgrid':
	{
		$lastslno = $_POST['lastslno'];
		$query1 = "SELECT inv_customeramc.slno as slno,inv_mas_product.productname as productname,inv_customeramc.startdate as 
		startdate,inv_customeramc.enddate as enddate FROM inv_customeramc 
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
	case 'amcinfo':
	{
		$lastslno = $_POST['lastslno'];
		$query2 = "SELECT inv_customeramc.customerreference as customerreference,ssm_skyperegister.slno,
		ssm_skyperegister.customerid FROM ssm_skyperegister 
		left join inv_customeramc on inv_customeramc.customerreference= ssm_skyperegister.customerid 
		where ssm_skyperegister.customerid = '".$lastslno."' inv_customeramc.customerreference is not null ";
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
	break;
	
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