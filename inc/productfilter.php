<?php
	$query = "SELECT DISTINCT productname,slno FROM ssm_products ORDER BY productname";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['slno'].'">'.$fetch['productname'].'</option>');
	}
	

?>