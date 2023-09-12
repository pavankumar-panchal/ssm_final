<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');

$productgroup = $_POST['s_productgroup'];
$productname = $_POST['productname'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$errorreported =$_POST['errorreported'];
$status = $_POST['status'];
$userid = $_POST['userid'];
$reportedto = $_POST['reportedto'];
$customername = $_POST['customername'];


$s_customernamepiece = ($customername == "")?(""):(" AND ssm_errorregister.customername LIKE '%".$customername."%'"); 
$s_errorreportedpiece = ($errorreported == "")?(""):(" AND ssm_errorregister.errorreported LIKE '%".$errorreported."%'"); 
$s_reportedtopiece = ($reportedto == "")?(""):(" AND ssm_errorregister.reportedto LIKE '%".$reportedto."%'"); 
$s_statuspiece = ($status == "")?(""):(" AND ssm_errorregister.status LIKE '%".$status."%'"); 
$s_useridpiece = ($userid == "")?(""):(" AND ssm_errorregister.userid = '".$userid."'"); 

$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';

$grid .= '<tr class="tr-grid-header">
			<td nowrap = "nowrap" class="td-border-grid"><input type="checkbox" name="selectedcheckbox" id="selectedcheckbox" 
value="" onclick="javascript:checkAll(this)" /></td>';
$grid .= '<td nowrap = "nowrap" class="td-border-grid">Flag</td>
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

	$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag, ssm_errorregister.customername AS 
	customername,ssm_errorregister.productgroup AS productgroup,ssm_products.productname  AS productname,
	ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,
	ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood 
	AS errorunderstood, ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,
	ssm_errorregister.status AS status, ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS 
	solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,
	ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_errorregister.errorid AS errorid,
	ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup, 
	ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
	ssm_errorregister.authorizeddatetime  AS authorizeddatetime FROM ssm_errorregister 
	LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
	LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
	LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
	LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
	LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  
	WHERE ssm_errorregister.date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' 
	AND ssm_errorregister.productname = '".$productname."'".$s_customernamepiece.$s_errorreportedpiece.$s_reportedtopiece.
	$s_statuspiece.$s_useridpiece." ORDER BY `date` DESC ; ";
	
	$result = runmysqlquery($query);
	
$i_n = 0;
while($fetch = mysqli_fetch_row($result))
{
	static $count = 0;
	$count++;
	$i_n++;
	$color;
	if($i_n%2 == 0)
		$color = "#edf4ff";
	else
		$color = "#f7faff";
	$grid .= '<tr class="gridrow">';
	$grid .= "<td nowrap='nowrap' class='td-border-grid'><input type='checkbox' name='check[]' value='".$fetch[0]."'/></td>";
	for($i = 1; $i < count($fetch); $i++)
	{
			if($i == 7 || $i == 14)
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
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister");
	echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
?>
