<?php
	if($usertype == 'ADMIN')
	{
		$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes'  order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
	}
	elseif($usertype == 'TEAMLEADER' || $usertype == 'MANAGEMENT')
	{
		$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' AND (reportingauthority='".$user."' OR slno = '".$user."')  and supportunit = '".$loggedsupportunit."' order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
	}
	else
	{
		$query = "SELECT username,slno,fullname FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' AND slno='".$user."' and supportunit = '".$loggedsupportunit."' order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
	}
	$result = runmysqlquery($query);
	echo('<option value="">ALL</option>');
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['slno'].'">'.$fetch['fullname'].'</option>');
	}			
?>