<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');

$onsite_supportunitpiece = ($loggedsupportunit == '4')?(""):(" and ssm_onsiteregister.supportunit = '".$loggedsupportunit."'");

$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag , ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE ssm_onsiteregister.status <> 'solved' and  ssm_onsiteregister.status <> 'skipped' ".$onsite_supportunitpiece." ORDER BY `date` DESC; ";
$result = runmysqlquery($query);
$r1 = runmysqlqueryfetch($query);

$grid = '<table width="80%" cellspacing="0" cellpadding="2" align="center"><tr><td align="center" valign="top" colspan="4"><strong>Onsite Visits - Pending Report</strong></td></tr><tr><td>&nbsp;</td></tr></table>';
$grid .= '<table width="80%" border="0" bordercolor="#ffffff" cellspacing="0" cellpadding="2" align="center" style="border:#DBDBDB 1px solid; border-top:none; border-right:none;">';

				//Write the header Row of the table
				$grid .= '<tr><td nowrap="nowrap"  valign="top" width="6%" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Sl.No</strong></font></td><td nowrap="nowrap"  valign="top" width="35%" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Contact Details</font></strong></td><td nowrap="nowrap"  width="35%"  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Problem Details</strong></font></td><td nowrap="nowrap"  valign="top"  width="24%" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;"><strong>Other Details</strong></font></td></tr>';
				$i = 0;
				
				while($fetch = mysqli_fetch_array($result))
				{
						$i++;
						$query1 = "SELECT DISTINCT tblCustomer.cusName AS cusName, tblCustomer.cusID as cusID , tblCustomer.cusContact1 as cusContact1 , tblCustomer.cusContact2 as cusContact2 , tblCustomer.cusPhone1 as cusPhone1 , tblCustomer.cusAddress1 as cusAddress1 , tblCustomer.cusAddress2 as cusAddress2 , tblCustomer.cusPhone2 as cusPhone2, tblCustomer.cusPlace as cusPlace , tblCustomer.cusEmail as cusEmail FROM tblCustomer WHERE cusID LIKE '".$fetch['customerid']."'";
						$result1 = runaccessqueryco($query1);
						$result1fetch = odbc_fetch_array($result1);
						$servicecharge = ($fetch['servicecharge'] == "")?(""):('<br> Service Charge : '.$fetch['servicecharge']);
						$tempquery = $i;
						
//						$grid .= $query1;
						$grid .= '<tr>';
						$grid .= '<td  valign="top" align="center" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;">'.$tempquery.'</font></td>';
						$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;">Company Name : <strong>'.$result1fetch['cusName'].'</strong><br> Contact Person : '.$result1fetch['cusContact1'].'<br> Email : '.$result1fetch['cusEmail'].'<br> Phone : '.$result1fetch['cusPhone1'].'<br> Adress : '.$result1fetch['cusAddress1'].'</font></td>';
						$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;">Product : '.$fetch['productname'].' - '.$fetch['productversion'].'<br> Contact Person : '.$fetch['contactperson'].'<br> Date : '.changedateformat($fetch['date']).' - Time : '.$fetch['time'].'<br> Registered By : '.$fetch['userid'].'<br> Problem : '.$fetch['problem'].'</font></td>';
						$grid .= '<td  valign="top" style="border: #D4D4D4 1px solid;border-left:none;border-bottom:none;"><font style="font-size:11px; font-family:Calibri;">Status : '.$fetch['status'].'<br>Assigned To : '.$fetch['assignedto'].$servicecharge.'</font></td>';
						$grid .= '</tr>';
					//End the Row
				}
				$grid .= '</table>';
				//Write the grid
				echo($grid);
?>