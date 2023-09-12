<?php
	include('../functions/phpfunctions.php');
	$productgroup = $_POST['productgroup'];
	
	$query = "SELECT  productname,slno,productgroup FROM ssm_products where productgroup = '".$productgroup."'
	ORDER BY productname";
	$result = runmysqlquery($query);
	$count = mysqli_num_rows($result);
	
	echo '<select name="productname" id="productname" class="swiftselect" onchange="productversionFunction();">';
	echo('<option value ="">Select a Product</option>');
	while($fetch = mysqli_fetch_array($result))
	{
			echo('<option value="'.$fetch['slno'].'">'.$fetch['productname'].'</option>');
	}
	
	echo '</select>';
	
	

?>