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
		$billdate = $_POST['billdate'];
		$billno = $_POST['billno'];
		$receiptno = $_POST['receiptno'];
		$receiptdate = $_POST['receiptdate'];
		$cheque_cash = $_POST['cheque_cash'];
		$chequeno = $_POST['chequeno'];
		$amount = $_POST['amount'];
		$remarks = $_POST['remarks'];
		$userid = $_POST['userid'];		
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_receipts(customername,customerid,date,time,billdate,billno,receiptno,receiptdate,cheque_cash,chequeno,amount,remarks,userid,authorized,publishrecord,flag) values('".$customername."','".$customerid."','".changedateformat($date)."','".$time."','".changedateformat($billdate)."','".$billno."','".$receiptno."','".changedateformat($receiptdate)."','".$cheque_cash."','".$chequeno."','".$amount."','".$remarks."','".$user."','no','no','no')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_receipts SET customername = '".$customername."',customerid = '".$customerid."',billdate = '".changedateformat($billdate)."',billno = '".$billno."',receiptno = '".$receiptno."',receiptdate = '".changedateformat($receiptdate)."',cheque_cash = '".$cheque_cash."',chequeno = '".$chequeno."',amount = '".$amount."',remarks = '".$remarks."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
			$query = "INSERT INTO ssm_logs(registername,username,recordid,date,time) values('Receipts','".$user."','".$lastslno."','".changedateformat(datetimelocal('d-m-Y'))."','".datetimelocal('H:i:s')."')";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."Record Saved Successfully.");
	break;
	
	case 'delete':
	{
		$result = runmysqlqueryfetch("SELECT slno FROM ssm_receipts WHERE  slno = '".$lastslno."'");
		$fetchcompliantid = $result['slno'];

		$query = "DELETE FROM ssm_receipts WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."Record ".$fetchcompliantid." Deleted Successfully");
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_receipts where date >= NOW() - INTERVAL 90 DAY ";
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
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Receipt Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Receipt Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Cheque / Cash</td>
						<td nowrap = "nowrap" class="td-border-grid">Cheque Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					</tr>';
		}
		$query = "SELECT ssm_receipts.slno AS slno,ssm_receipts.customername AS customername, ssm_receipts.customerid AS 
		customerid, ssm_receipts.date AS date,ssm_receipts.time AS time,ssm_receipts.billdate AS billdate,ssm_receipts.billno 
		AS billno,ssm_receipts.receiptno AS receiptno,ssm_receipts.receiptdate AS receiptdate,ssm_receipts.cheque_cash 
		AS cheque_cash,ssm_receipts.chequeno AS chequeno,ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,
		ssm_users1.fullname AS userid,ssm_receipts.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_receipts.teamleaderremarks AS teamleaderremarks,ssm_users2.fullname AS authorizedperson,
		ssm_receipts.authorizeddatetime AS authorizeddatetime,ssm_receipts.flag AS flag 
		FROM ssm_receipts LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup
		where ssm_receipts.date >= NOW() - INTERVAL 90 DAY ORDER BY  `date` DESC 
		LIMIT ".$startlimit.",".$limit." ";
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
				if($i == 3 || $i == 5 || $i == 8)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 19)
				{
					if($fetch[19] == 'yes')
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";
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
								<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts where date >= NOW() - INTERVAL 90 DAY ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT ssm_receipts.slno,ssm_receipts.customername,ssm_receipts.customerid,
					ssm_receipts.date,ssm_receipts.time,ssm_receipts.billdate,ssm_receipts.billno,
					ssm_receipts.receiptno,ssm_receipts.receiptdate,ssm_receipts.cheque_cash,
					ssm_receipts.chequeno,ssm_receipts.amount, ssm_receipts.remarks,
					s1.username as username,
					ssm_receipts.authorized,ssm_receipts.authorizedgroup,
					ssm_receipts.teamleaderremarks,ssm_receipts.authorizedperson,
					ssm_receipts.authorizeddatetime,ssm_receipts.flag ,
					s1.slno as userid,s2.username as reportingauthority 
					FROM ssm_receipts 
					left join ssm_users as s1 on ssm_receipts.userid = s1.slno
					left join ssm_users as s2 on s1.reportingauthority = s2.slno
					WHERE ssm_receipts.slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		
		if($result['authorizedgroup'] <> '')
		$result3 = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category WHERE ssm_category.slno = '".$result['authorizedgroup']."'");
echo($result['slno']."^".$result['customername']."^".$result['customerid']."^".changedateformat($result['date'])."^".$result['time']."^".changedateformat($result['billdate'])."^".$result['billno']."^".$result['receiptno']."^".changedateformat($result['receiptdate'])."^".$result['cheque_cash']."^".$result['chequeno']."^".$result['amount']."^".$result['remarks']."^".$result['username']."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['authorizedperson']."^".$result['authorizeddatetime']."^".$result['flag']."^".$result['userid']."^".$result['reportingauthority']);
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
		$s_customername = 
		$_POST['s_customername'];
		$s_customerid = $_POST['s_customerid']; 
		$s_billno = $_POST['s_billno']; 
		$s_billdate = $_POST['s_billdate'];
		$s_receiptno = $_POST['s_receiptno']; 
		$s_receiptdate = $_POST['s_receiptdate']; 
		$s_chequeno = $_POST['s_chequeno']; 
		$s_amount = $_POST['s_amount']; 
		$s_userid = $_POST['s_userid']; 
		$orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_receipts.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_receipts.customerid LIKE '%".$s_customerid."%'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND ssm_receipts.billdate LIKE '%".changedateformat($s_billdate)."%'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_receipts.billno LIKE '%".$s_billno."%'");
		$s_receiptnopiece = ($s_receiptno == "")?(""):(" AND ssm_receipts.receiptno LIKE '%".$s_receiptno."%'");
		$s_receiptdatepiece = ($s_receiptdate == "")?(""):(" AND ssm_receipts.receiptdate LIKE '%".changedateformat($s_receiptdate)."%'");
		$s_chequenopiece = ($s_chequeno == "")?(""):(" AND ssm_receipts.chequeno LIKE '%".$s_chequeno."%'");
		$s_amountpiece = ($s_amount == "")?(""):(" AND ssm_receipts.amount LIKE '%".$s_amount."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_receipts.userid ='".$s_userid."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_receipts.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_receipts.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_receipts.customerid'; break;
			case 'billno': $orderbyfield = 'ssm_receipts.billno'; break;
			case 'billdate': $orderbyfield = 'ssm_receipts.billdate'; break;
			case 'receiptno': $orderbyfield = 'ssm_receipts.receiptno'; break;
			case 'receiptdate': $orderbyfield = 'ssm_receipts.receiptdate'; break;
			case 'chequeno': $orderbyfield = 'ssm_receipts.chequeno'; break;
			case 'userid': $orderbyfield = 'ssm_receipts.userid'; break;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_receipts 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_billdatepiece.$s_billnopiece.$s_receiptnopiece.$s_receiptdatepiece.$s_chequenopiece.
		$s_amountpiece.$s_useridpiece.$s_flagspiece." ORDER BY  `date` DESC, ".$orderbyfield;
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
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Receipt Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Receipt Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Cheque / Cash</td>
					<td nowrap = "nowrap" class="td-border-grid">Cheque Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
				</tr>';
		}
		$query = "SELECT ssm_receipts.slno AS slno,ssm_receipts.customername AS customername, ssm_receipts.customerid AS 
		customerid, ssm_receipts.date AS date,ssm_receipts.time AS time,ssm_receipts.billdate AS billdate,ssm_receipts.billno 
		AS billno,ssm_receipts.receiptno AS receiptno,ssm_receipts.receiptdate AS receiptdate,ssm_receipts.cheque_cash 
		AS cheque_cash,ssm_receipts.chequeno AS chequeno,ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,
		ssm_users1.fullname AS userid,ssm_receipts.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_receipts.teamleaderremarks AS teamleaderremarks,ssm_users2.fullname AS authorizedperson,
		ssm_receipts.authorizeddatetime AS authorizeddatetime,ssm_receipts.flag AS flag 
		FROM ssm_receipts 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.
		$s_customeridpiece.$s_billdatepiece.$s_billnopiece.$s_receiptnopiece.$s_receiptdatepiece.$s_chequenopiece.
		$s_amountpiece.$s_useridpiece.$s_flagspiece." ORDER BY  `date` DESC, ".$orderbyfield."
		LIMIT ".$startlimit.",".$limit." ";
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
				if($i == 3 || $i == 5 || $i == 8)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				}
				elseif($i == 19)
				{
					if($fetch[19] == 'yes')
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts ");
		echo($grid."|^^|"."Filtered ".$fetchresultcount1." records found from ".$query['count'].'|^^|'.$linkgrid).'|^^|'.$query.".";
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
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Receipt Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Receipt Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Cheque / Cash</td>
					<td nowrap = "nowrap" class="td-border-grid">Cheque Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">User ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
				</tr>';
		
		$query = "SELECT ssm_receipts.slno AS slno,ssm_receipts.customername AS customername, ssm_receipts.customerid AS
		customerid, ssm_receipts.date AS date,ssm_receipts.time AS time,ssm_receipts.billdate AS billdate,ssm_receipts.billno 
		AS billno,ssm_receipts.receiptno AS receiptno,ssm_receipts.receiptdate AS receiptdate,ssm_receipts.cheque_cash 
		AS cheque_cash,ssm_receipts.chequeno AS chequeno,ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,
		ssm_users1.fullname AS userid,ssm_receipts.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_receipts.teamleaderremarks AS teamleaderremarks,ssm_users2.fullname AS authorizedperson,
		ssm_receipts.authorizeddatetime AS authorizeddatetime,ssm_receipts.flag AS flag FROM ssm_receipts 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup  
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
				if($i == 3 || $i == 5 || $i == 8)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				elseif($i == 19)
				{
					if($fetch[19] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'>
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts WHERE  userid = '".$user."'");
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>