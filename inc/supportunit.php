<?php
$query = "SELECT  heading,slno FROM ssm_supportunits ORDER BY heading";
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetch['slno'].'">'.$fetch['heading'].'</option>');
}			
?>