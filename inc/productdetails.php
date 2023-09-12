<?php
	$query = "SELECT productcode,productname FROM inv_mas_product order by productname;";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		 echo('<label><input type="checkbox" checked="checked"  name="productarray[]" id="'.$fetch['productname'].'" value ="'.$fetch['productcode'].'" />&nbsp;'.$fetch['productname']);
		 echo('<font color = "#999999">&nbsp;('.$fetch['productcode'].')</font></label>');
		 echo('<br/>');
	}
?>