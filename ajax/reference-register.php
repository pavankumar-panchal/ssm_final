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
		$date = $_POST['date'];
		$time = $_POST['time'];
		$referencethrough = $_POST['referencethrough'];
		$category = $_POST['category'];
		$state = $_POST['state'];
		$contactperson = $_POST['contactperson'];
		$contactno = $_POST['contactno'];
		$contactaddress = $_POST['contactaddress'];
		$email = $_POST['email'];
		$status = $_POST['status'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$referenceid = $_POST['referenceid'];
		$customerid = $_POST['customerid'];		
		if($lastslno == '')
		{
			$tempquery = "SELECT MAX(slno) as maxslno from ssm_referenceregister";
			$result = runmysqlqueryfetch($tempquery);
			$temp = $result['maxslno'] + 1;
			$referenceid = "RR". ($temp + 10000);
			$query = "INSERT INTO ssm_referenceregister(anonymous,customername,productgroup,productname,date,time,
			referencethrough,category,state,contactperson,contactno,contactaddress,email,status,remarks,userid,referenceid,
			customerid,authorized,publishrecord,flag) values('".$anonymous."','".$customername."','".$productgroup."',
			'".$productname."','".changedateformat($date)."','".$time."','".$referencethrough."','".$category."','".$state."',
			'".$contactperson."','".$contactno."','".$contactaddress."','".$email."','".$status."','".$remarks."','".$user."',
			'".$referenceid."','".$customerid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_referenceregister SET anonymous = '".$anonymous."',customername = '".$customername."',
			customerid = '".$customerid."',productgroup = '".$productgroup."' ,productname = '".$productname."',
			referencethrough = '".$referencethrough."',category = '".$category."', state = '".$state."' , contactperson = '".$contactperson."',
			contactno = '".$contactno."',contactaddress = '".$contactaddress."',email = '".$email."',status = '".$status."',
			remarks = '".$remarks."',referenceid = '".$referenceid."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Reference Register','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record '".$referenceid."' Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT referenceid FROM ssm_referenceregister WHERE  slno = '".$lastslno."'");
		$fetchreferenceid = $result['referenceid'];
		$query = "DELETE FROM ssm_referenceregister WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record '".$fetchreferenceid."' Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_referenceregister WHERE status <> 'sold' and
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
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Reference Through</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact No</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Address</td>
					<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Reference ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		}
		$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous
		 AS anonymous,ssm_referenceregister.customername AS customername,ssm_referenceregister.productgroup AS productgroup,
		 ssm_products.productname AS productname,ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, 
		 ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category,  inv_mas_state.statename AS state , 
		 ssm_referenceregister.contactperson AS contactperson,  ssm_referenceregister.contactno AS contactno, 
		 ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, 
		 ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, 
		 ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, 
		 ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, 
		 ssm_users1.fullname AS authorizedperson,ssm_referenceregister.authorizeddatetime AS authorizeddatetime 
		 FROM ssm_referenceregister 
		 LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
		 LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
		 LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
		 LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		 LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup 
		 left join inv_mas_state on inv_mas_state.slno = ssm_referenceregister.state 
		 WHERE ssm_referenceregister.status <> 'sold' ".$loggedsupportunitpiece." and
		 ssm_referenceregister.date >= NOW() - INTERVAL 90 DAY  ORDER BY `date` DESC LIMIT ".$startlimit.",".$limit.";  ";
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
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,20)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
				}
				elseif($i == 6)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' 
width='14' height='14' border='0' /></td>";	
				}
				elseif($i == 14)
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
								<td class="resendtext"><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" 
style="cursor:pointer" class="resendtext">Show More Records >> </a>
<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer">
<font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister
		 WHERE date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." [Not Sold] records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_referenceregister.slno,ssm_referenceregister.anonymous,ssm_referenceregister.customername,
		ssm_referenceregister.customerid,ssm_referenceregister.productgroup, ssm_referenceregister.productname,
		ssm_referenceregister.date,ssm_referenceregister.time,ssm_referenceregister.referencethrough,ssm_referenceregister.category,
		ssm_referenceregister.contactperson,ssm_referenceregister.contactno, ssm_referenceregister.contactaddress, 
		ssm_referenceregister.email,ssm_referenceregister.status,ssm_referenceregister.remarks,s1.username as username,
		ssm_referenceregister.referenceid,ssm_referenceregister.authorized,ssm_referenceregister.authorizedgroup,
		ssm_referenceregister.teamleaderremarks,ssm_referenceregister.authorizedperson, ssm_referenceregister.authorizeddatetime,
		ssm_referenceregister.flag,s1.slno as userid,s2.username as reportingauthority , inv_mas_state.statecode AS state 
		FROM ssm_referenceregister 
		left join ssm_users as s1 on ssm_referenceregister.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_referenceregister.state 
		WHERE ssm_referenceregister.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
	
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		echo($result['slno']."^".$result['anonymous']."^".$result['customername']."^".$result['productgroup']."^".
		$result['productname']."^".changedateformat($result['date'])."^".$result['time']."^".$result['referencethrough']."^".
		$result['category']."^".$result['contactperson']."^".$result['contactno']."^".$result['contactaddress']."^".
		$result['email']."^".$result['status']."^".$result['remarks']."^".$result['username']."^".$result['referenceid']."^".
		$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".
		$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".$result['userid']."^".
		$result['reportingauthority']."^".$result['customerid']."^".$result['state']);
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
		$s_productname = $_POST['s_productname']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_referencethrough = $_POST['s_referencethrough']; 
		$s_contactperson = $_POST['s_contactperson']; 
		$s_contactno = $_POST['s_contactno']; 
		$s_contactaddress = $_POST['s_contactaddress']; 
		$s_status = $_POST['s_status'];
		$s_email = $_POST['s_email']; 
		$s_userid = $_POST['s_userid']; 
		$s_state = $_POST['s_state']; 
		$s_referenceid = $_POST['s_referenceid'];
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];  
		$s_supportunit = $_POST['s_supportunit']; 
		
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_referenceregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_referenceregister.customername LIKE '%".$s_customername."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(($categorykkg == "true") && ($categoryblr == "true") && ($categorycsd == "true")) { $s_categorypiece = ""; }
		elseif(($categorykkg == "true") && ($categoryblr == "true")) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(($categorykkg == "true") && ($categorycsd == "true")) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(($categorycsd == "true") && ($categoryblr == "true")) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(($categorycsd == "true")) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(($categoryblr == "true")) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(($categorykkg == "true")) { $s_categorypiece = " AND (category = 'KKG')"; }
		
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_referenceregister.state = '".$s_state."'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_referenceregister.productgroup = '".$s_productgroup."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_referenceregister.productname = '".$s_productname."'");
		$s_referencethroughpiece = ($s_referencethrough == "")?(""):(" AND ssm_referenceregister.referencethrough = '".$s_referencethrough."'");
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
			case 'contactperson': $orderbyfield = 'ssm_referenceregister.contactperson'; break;
			case 'customername': $orderbyfield = 'ssm_referenceregister.customername'; break;
			case 'category': $orderbyfield = 'ssm_referenceregister.category'; break;
			case 'state': $orderbyfield = 'ssm_referenceregister.state'; break;
			case 'productgroup': $orderbyfield = 'ssm_referenceregister.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_referenceregister.productname'; break;
			case 'referencethrough': $orderbyfield = 'ssm_referenceregister.referencethrough'; break;
			case 'contactno': $orderbyfield = 'ssm_referenceregister.contactno'; break;
			case 'contactaddress': $orderbyfield = 'ssm_referenceregister.contactaddress'; break;
			case 'status': $orderbyfield = 'ssm_referenceregister.status'; break;
			case 'email': $orderbyfield = 'ssm_referenceregister.email'; break;
			case 'userid': $orderbyfield = 'ssm_referenceregister.userid'; break;		
			case 'referenceid': $orderbyfield = 'ssm_referenceregister.referenceid'; break;
			case 'time': $orderbyfield = 'ssm_referenceregister.time'; break;
		}
		$resultcount = "SELECT count(*) as count FROM ssm_referenceregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_categorypiece.$s_statepiece.$s_productgrouppiece.$s_productnamepiece.$s_referencethroughpiece.$s_contactpersonpiece.
		$s_contactpersonpiece. $s_contactnopiece.$s_contactaddresspiece.$s_statuspiece.$s_emailpiece.$s_useridpiece.
		$s_referenceidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield."";
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
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Reference Through</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact No</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Address</td>
						<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Reference ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
		}
		
		$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous
		 AS anonymous,ssm_referenceregister.customername AS customername, ssm_referenceregister.productgroup AS productgroup,
		ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, 
		ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, inv_mas_state.statename as state ,
		ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno,
		ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS
		status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS 
		referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
		ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
		ssm_referenceregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_referenceregister 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_referenceregister.state 
		WHERE date BETWEEN '".$newfromdate."' AND '".$newtodate."'".$s_customernamepiece.
		$s_categorypiece.$s_statepiece.$s_productgrouppiece.$s_productnamepiece.$s_referencethroughpiece.$s_contactpersonpiece.
		$s_contactpersonpiece.$s_contactnopiece.$s_contactaddresspiece.$s_statuspiece.$s_emailpiece.$s_useridpiece.
		$s_referenceidpiece. $s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." 
		LIMIT ".$startlimit.",".$limit.";";
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
				if($i == 3)
				{
					if(strlen($fetch[$i]) > 20)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch[$i],0,20)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
				}
				elseif($i == 6)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 1)
				{
					if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
<img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' 
height='14' border='0' /></td>";	
				}
				elseif($i == 14)
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
			$linkgrid .= '<table><tr><td class="resendtext">
			<div align ="left" style="padding-right:10px">
			<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">
	Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
	style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td></tr></table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister ");
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
					<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Reference Through</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact No</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Address</td>
					<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Reference ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		
		$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous 
		AS anonymous,ssm_referenceregister.customername AS customername,ssm_referenceregister.productgroup AS productgroup,
		ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, 
		ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category,inv_mas_state.statename as state
		ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno, 
		ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS
		status, ssm_referenceregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS 
		referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
		ssm_referenceregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson, 
		ssm_referenceregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup 
		left join inv_mas_state on inv_mas_state.slno = ssm_referenceregister.state  
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>