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
		$customername = $_POST['customername'];
		$customerid = $_POST['customerid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$productgroup = $_POST['productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$billdate = $_POST['billdate'];
		$registername = $_POST['registername'];
		$billno = $_POST['billno'];
		$billto = $_POST['billto'];
		$amount = $_POST['amount'];
		$tax = $_POST['tax'];
		$state = $_POST['state'];
		$tamount = $_POST['tamount'];
		$billedby = $_POST['billedby'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];
		$complaintid = $_POST['complaintid'];		
		if($lastslno == '')
		{
			$query = "INSERT INTO 
			ssm_invoice(customername,customerid,date,time,productgroup,productname,productversion,state,billdate,
			registername,billno,billto,amount,tax,tamount,billedby,remarks,userid,complaintid,authorized,publishrecord,flag)
			values('".$customername."','".$customerid."','".changedateformat($date)."','".$time."','".$productgroup."',
			'".$productname."','".$productversion."','".$state."','".changedateformat($billdate)."','".$registername."',
			'".$billno."','".$billto."','".$amount."','".$tax."','".$tamount."','".$billedby."','".$remarks."',
			'".$user."','".$complaintid."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_invoice SET customername = '".$customername."', customerid = '".$customerid."', 
			date = '".changedateformat($date)."', time = '".$time."', productgroup = '".$productgroup."', 
			productname = '".$productname."', productversion = '".$productversion."', state = '".$state."' , 
			billdate = '".changedateformat($billdate)."', registername = '".$registername."', billno = '".$billno."', 
			billto = '".$billto."', amount = '".$amount."', tax = '".$tax."', tamount = '".$tamount."', 
			billedby = '".$billedby."', remarks = '".$remarks."', complaintid = '".$complaintid."'
			WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Invoice','".$user."',
			'".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT slno FROM ssm_invoice WHERE  slno = '".$lastslno."'");
		$fetchcompliantid = $result['slno'];
		$query = "DELETE FROM ssm_invoice WHERE slno = '".$lastslno."'";
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
			$limit = 10000;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_invoice where date >= NOW() - INTERVAL 90 DAY ";
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
		
		
		$query = "SELECT ssm_invoice.slno AS slno,ssm_invoice.customername AS customername,ssm_invoice.customerid AS customerid,
		ssm_invoice.date AS date,ssm_invoice.time AS time,ssm_invoice.productgroup AS productgroup,
		ssm_products.productname AS productname,ssm_invoice.productversion AS productversion,inv_mas_state.statename as state,
		ssm_invoice.billdate AS billdate,ssm_invoice.registername AS registername,ssm_invoice.billno AS billno,
		ssm_invoice.billto AS billto,ssm_invoice.amount AS amount, ssm_invoice.tax AS tax,ssm_invoice.tamount AS tamount,
		ssm_users1.fullname AS billedby,ssm_invoice.remarks AS remarks,ssm_users2.fullname AS userid,
		ssm_invoice.complaintid AS complaintid,	ssm_invoice.authorized AS authorized,
		ssm_category.categoryheading AS authorizedgroup,
		ssm_invoice.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson,
		ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag 
		FROM ssm_invoice 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
		LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
		left join inv_mas_state on inv_mas_state.slno = ssm_invoice.state
		LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup 
		where ssm_invoice.date >= NOW() - INTERVAL 90 DAY ORDER BY  `date` DESC 
		LIMIT ".$startlimit.",".$limit." ";
		
		if($startlimit == 0)
		{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Register Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Given To</td>
					<td nowrap = "nowrap" class="td-border-grid">Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Tax</td>
					<td nowrap = "nowrap" class="td-border-grid">Total Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Billed By</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
				</tr>';
		}
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
				if($i == 4)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 24)
				{
					if($fetch[24] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' 
width='14' height='14' border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' 
width='14' height='14' border='0' /></td>";
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
								<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice where date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_invoice.slno,ssm_invoice.customername,ssm_invoice.customerid,ssm_invoice.date,
		ssm_invoice.time,ssm_invoice.productgroup ,ssm_products.slno as productname ,
		ssm_invoice.productversion,ssm_invoice.billdate,ssm_invoice.registername,
		ssm_invoice.billno,ssm_invoice.billto,ssm_invoice.amount, ssm_invoice.tax,tamount,
		ssm_invoice.billedby,ssm_invoice.remarks,s1.username as username,ssm_invoice.complaintid,
		ssm_invoice.authorized,ssm_invoice.authorizedgroup,ssm_invoice.teamleaderremarks, 
		ssm_invoice.authorizedperson,ssm_invoice.authorizeddatetime,ssm_invoice.flag,
		s1.slno as userid,s2.username as reportingauthority ,
		inv_mas_state.statecode as state FROM ssm_invoice 
		left join ssm_users as s1 on ssm_invoice.userid = s1.slno
		left join ssm_users as s2 on s1.reportingauthority = s2.slno
		left join ssm_products on ssm_invoice.productname = ssm_products.slno
		left join inv_mas_state on inv_mas_state.slno = ssm_invoice.state 
		WHERE ssm_invoice.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
				
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category 
		WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
		echo($result['slno']."^".$result['customername']."^".$result['customerid']."^".changedateformat($result['date'])."^".
		$result['time']."^".$result['productgroup']."^".$result['productname']."^".$result['productversion']."^".
		changedateformat($result['billdate'])."^".$result['registername']."^".$result['billno']."^".$result['billto']."^".
		$result['amount']."^".$result['tax']."^".$result['tamount']."^".$result['billedby']."^".$result['remarks']."^".
		$result['username']."^".$result['complaintid']."^".$result['authorized']."^".$result3['authorizedgroup']."^".
		$resul['teamleaderremarks']."^".$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".
		$result['userid']."^".$result['reportingauthority']."^".$result['state']);
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
		$s_productgroup = $_POST['s_productgroup']; 
		$s_productname = $_POST['s_productname']; 
		$s_billno = $_POST['s_billno'];
		$s_billdate = $_POST['s_billdate']; 
		$s_registername = $_POST['s_registername']; 
		$s_billedby = $_POST['s_billedby'];
		$s_amount = $_POST['s_amount']; 
		$s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid'];
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		$s_state = $_POST['s_state'];
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_invoice.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_invoice.customerid LIKE '%".$s_customerid."%'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_invoice.productname ='".$s_productname."'");
		$s_statepiece = ($s_state == "")?(""):(" AND ssm_invoice.state ='".$s_state."'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_invoice.billno LIKE '%".$s_billno."%'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND ssm_invoice.billdate LIKE '%".$s_billdate."%'");
		$s_registernamepiece = ($s_registername == "")?(""):(" AND ssm_invoice.registername LIKE '%".$s_registername."%'");
		$s_billedbypiece = ($s_billedby == "")?(""):(" AND ssm_invoice.billedby LIKE '%".$s_billedby."%'");
		$s_amountpiece = ($s_amount == "")?(""):(" AND ssm_invoice.amount LIKE '%".$s_amount."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_invoice.userid = '".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND ssm_invoice.complaintid LIKE '%".$s_complaintid."%'");	
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_invoice.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_invoice.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_invoice.customerid'; break;
			case 'productgroup': $orderbyfield = 'ssm_invoice.productgroup'; break;
			case 'productname': $orderbyfield = 'ssm_invoice.productname'; break;
			case 'state': $orderbyfield = 'ssm_invoice.state'; break;
			case 'billno': $orderbyfield = 'ssm_invoice.billno'; break;
			case 'billdate': $orderbyfield = 'ssm_invoice.billdate'; break;
			case 'registername': $orderbyfield = 'ssm_invoice.registername'; break;
			case 'billedby': $orderbyfield = 'ssm_invoice.billedby'; break;
			case 'amount': $orderbyfield = 'ssm_invoice.amount'; break;
			case 'userid': $orderbyfield = 'ssm_invoice.userid'; break;
			case 'complaintid': $orderbyfield = 'ssm_invoice.complaintid'; break;		
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_invoice 
						LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
						LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
						LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
						LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
						LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
						left join inv_mas_state on inv_mas_state.slno = ssm_invoice.state
						LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup  
						WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
						$s_customernamepiece.$s_customeridpiece.$s_productnamepiece.$s_statepiece.$s_billnopiece.
						$s_billdatepiece.$s_registernamepiece.$s_billedbypiece.$s_amountpiece.$s_useridpiece.
						$s_complaintidpiece.$s_flagspiece." ORDER BY  `date` DESC , ".$orderbyfield." ";
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
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Register Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Given To</td>
						<td nowrap = "nowrap" class="td-border-grid">Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Tax</td>
						<td nowrap = "nowrap" class="td-border-grid">Total Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Billed By</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					</tr>';
		}
		$query = "SELECT ssm_invoice.slno AS slno,ssm_invoice.customername AS customername,ssm_invoice.customerid AS customerid,
		ssm_invoice.date AS date,ssm_invoice.time AS time,ssm_invoice.productgroup AS productgroup,ssm_products.productname AS
		productname,ssm_invoice.productversion AS productversion,inv_mas_state.statename as  state , ssm_invoice.billdate AS billdate,ssm_invoice.registername AS 
		registername,ssm_invoice.billno AS billno,ssm_invoice.billto AS billto,ssm_invoice.amount AS amount,ssm_invoice.tax AS 
		tax,ssm_invoice.tamount AS tamount ,ssm_users1.fullname AS billedby,ssm_invoice.remarks AS remarks,ssm_users2.fullname 
		AS userid,ssm_invoice.complaintid AS complaintid,ssm_invoice.authorized AS authorized,ssm_category.categoryheading AS 
		authorizedgroup,ssm_invoice.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson,
		ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag FROM ssm_invoice 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
		LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
		left join inv_mas_state on inv_mas_state.slno = ssm_invoice.state
		LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup  
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_productnamepiece.$s_statepiece.$s_billnopiece.$s_billdatepiece.$s_registernamepiece.$s_billedbypiece.
		$s_amountpiece.$s_useridpiece.$s_complaintidpiece.$s_flagspiece." ORDER BY  `date` DESC , ".$orderbyfield." 
		LIMIT ".$startlimit.",".$limit." ";
		
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$slno1++;
			$color;
			if($i_n%2 == 0)
			$color = "#edf4ff";
			else
			$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 3)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 25)
				{
					if($fetch[25] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png'
width='14' height='14' border='0' /></td>";	
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
								<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT  count(*) as count FROM ssm_invoice ");
		echo($grid."|^^|"."Filtered ".$fetchresultcount1." records found from ".$query['count'].'|^^|'.$linkgrid);
	}
	break;
	
	case 'flags':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Register Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Given To</td>
					<td nowrap = "nowrap" class="td-border-grid">Amount</td>
					<td nowrap = "nowrap" class="td-border-grid"Tax</td>
					<td nowrap = "nowrap" class="td-border-grid">Total Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Billed By</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
				</tr>';
		
		$query = "SELECT ssm_invoice.slno AS slno,ssm_invoice.customername AS customername,ssm_invoice.customerid AS customerid,
		ssm_invoice.date AS date,ssm_invoice.time AS time,ssm_products.productgroup AS productgroup,ssm_products.productname AS 
		productname,ssm_invoice.productversion AS productversion,inv_mas_state.statename as state , ssm_invoice.billdate AS billdate,ssm_invoice.registername AS
		registername,ssm_invoice.billno AS billno,ssm_invoice.billto AS billto,ssm_invoice.amount AS amount, 
		ssm_invoice.tax AS tax,ssm_invoice.tamount AS tamount,ssm_users1.fullname AS billedby,ssm_invoice.remarks AS remarks,
		ssm_users2.fullname AS userid,ssm_invoice.complaintid AS complaintid,ssm_invoice.authorized AS authorized,
		ssm_category.categoryheading AS authorizedgroup,ssm_invoice.teamleaderremarks AS teamleaderremarks, 
		ssm_users3.fullname AS authorizedperson,ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag
		FROM ssm_invoice 
		LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
		LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
		left join inv_mas_state on inv_mas_state.slno = ssm_invoice.state
		LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup WHERE  flag='yes' AND userid = '".$user."' ORDER BY   `date` DESC ";

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
				if($i == 3)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 23)
				{
					if($fetch[23] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
				}
				else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
		$fetchcount = mysqli_num_rows($result);
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>