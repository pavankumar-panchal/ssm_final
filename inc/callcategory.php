<?php
$query = "select Distinct slno,categoryname from ssm_callcategory order by categoryname";
$result = runmysqlquery($query);
while($fetchresult = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetchresult['slno'].'">'.$fetchresult['categoryname'].'</option>');
}				
?>
