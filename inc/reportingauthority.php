<?php
$query = "SELECT username,slno FROM ssm_users WHERE type = 'TEAMLEADER' or  type = 'MANAGEMENT' ORDER BY username";
$result = runmysqlquery($query);
while($fetchresult = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetchresult['slno'].'">'.$fetchresult['username'].'</option>');
}			
?>