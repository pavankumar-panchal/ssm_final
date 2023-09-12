<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');

$supportunits = $_POST['supportunit'];

if($usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT' && $usertype <> 'TEAMLEADER' && $usertype <> 'EXECUTIVE-ONSITE' ) { 
$disabled = 'disabled="disabled"';
}
else
{
$disabled='';
}
	echo('<select name="assignedto" id="assignedto" class="swiftselect"'.$disabled.'><option value = "" selected="selected">Make A Selection</option>');
	if($usertype == 'MANAGEMENT' || $usertype == 'ADMIN')
	$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' ORDER BY fullname";
elseif($usertype == 'TEAMLEADER')
	$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' AND (reportingauthority='".$user."' OR slno = '".$user."')  and supportunit = '".$supportunits."' ORDER BY fullname";
else
	$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' AND slno='".$user."' and supportunit = '".$supportunits."' ORDER BY fullname";

	//$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and type <> 'GUEST' and type <> 'MANAGEMENT' and  type <> 'EXECUTIVE-OTHERS' and supportunit = '".$supportunits."' ORDER BY fullname";
	$result = runmysqlquery($query);
	
	while($fetch = mysqli_fetch_array($result))
	{
		$grid .= '<option value="'.$fetch['slno'].'">'.$fetch['fullname'].'</option>';
	}			
	$grid .= '</select>';
echo($grid);

?>
