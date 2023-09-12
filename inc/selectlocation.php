<?php
$query = "SELECT slno,locationname FROM ssm_locationmaster ORDER BY locationname";
$result = runmysqlquery($query);
while($fetchresult = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetchresult['slno'].'">'.$fetchresult['locationname'].'</option>');
}				
?>