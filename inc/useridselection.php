<?php
if($usertype == 'MANAGEMENT' || $usertype == 'ADMIN')
	$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes'  order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
else
	$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and supportunit = '".$loggedsupportunit."' and existinguser = 'yes'  order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetch['slno'].'">'.$fetch['fullname'].'</option>');
}			
?>