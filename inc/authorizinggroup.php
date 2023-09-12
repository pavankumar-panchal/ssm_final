<?php
$query = "SELECT  categoryheading,slno FROM ssm_category ORDER BY categoryheading";
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetch['slno'].'">'.$fetch['categoryheading'].'</option>');
}			
?>