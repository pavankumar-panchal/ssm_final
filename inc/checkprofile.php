<?php
if($_GET['a_link'] <> 'profile_completeprofile')
{
	$profilewng = runmysqlqueryfetch("SELECT COUNT(*) AS profilecount FROM ssm_users WHERE (fullname = '' OR gender = '' OR presentaddress = '' OR permanentaddress = '' OR mobile = '' OR emergencynumber = '' OR emergencyremarks = '' OR dob = '' OR doj = '' OR designation = '' OR personalemail = '' OR officialemail = '' OR dob = '0000-00-00' OR doj = '0000-00-00') AND slno = '".$user."' AND type <> 'A'");
	$profilecount = $profilewng['profilecount'];
	if($profilecount > 0)
	{
		$url = '../home/index.php?a_link=profile_completeprofile';
		header("location:".$url);
	}
}
?>
