<?php
include_once('../functions/phpfunctions.php');
include('../inc/checktype.php');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$userid =  $_POST['userid'];
$usertype = $_POST['usertype'];
$useridpiece = ($userid == "")?(""):(" AND ssm_users.slno='".$userid."' ");

?>

<table border="0" cellpadding="3" width="80%" cellspacing="0" style="border:1px solid #6393df;">
                    <tr class="tr-grid-header">
                        <th nowrap ="nowrap" class="td-border-grid" width="35%">Companies</th>
                        <th nowrap ="nowrap" class="td-border-grid" width="15%">No. Of Calls</th>
                        <th nowrap ="nowrap" class="td-border-grid" width="15%">No. Of Chats</th>
                        <th nowrap ="nowrap" class="td-border-grid" width="15%">No. Of Mails</th>
                    </tr>

<?php
	if($usertype == 'ADMIN')
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece ;
	}
elseif($usertype == 'TEAMLEADER' || $usertype == 'MANAGEMENT')
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
		AND (reportingauthority='".$user."' OR slno = '".$user."') ";
	}
else
	{
		$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
		AND slno='".$user."'";
	}
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	$calls_count=0;
	$mails_count=0;
	$chats_count=0;
	$username = $fetch['username'];
	$slno = $fetch['slno'];
	$data = displaydata($slno,$fromdate,$todate);
	echo '<tr>
			<td colspan="6" style="padding:0">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
					<tr style="cursor:pointer" onClick="showhide(\''.$slno.'\',\'toggleimg'.$slno.'\');">
						<td class="reportheader" style="padding:0">'.$username.'</td>
						<td align="right" class="reportheader" style="padding-right:7px">
							<div align="right"><img src="../images/plus.jpg" border="0" id="toggleimg'.$slno.'"
name="toggleimg'.$slno.'"  align="absmiddle" /></div>
						</td>
					</tr>
					<tr>
						<td colspan="2" valign="top"><div id="'.$slno.'" style="display:none">
							<div id="displayrecord'.$slno.'">'. $data .'</div>
						</div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="padding:0">&nbsp;</td>
		</tr>
		<tr>
			<td id="processingbar"></td>
		</tr>';
}
?>
</table>
<div id="popup-error" align="center"></div>
