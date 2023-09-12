<?php
include('../functions/phpfunctions.php');
$productname = $_POST['productname'];
$productversion = $_POST['productversion'];
if($productversion == '' || $productversion == 'undefined' || $productversion == 'null' || $productversion == NULL)
{
	$query = "SELECT productversion,productname FROM ssm_versions WHERE productname = '".$productname."' order by slno desc;";
}
else
{
	$query = "SELECT productversion,productname FROM ssm_versions WHERE productname = '".$productname."' and productversion ='".$productversion."';";
}
$result = runmysqlquery($query);
$count = mysqli_num_rows($result);

echo '<select name="productversion" id="productversion" class="swiftselect">';
while($fetch = mysqli_fetch_array($result))
{
	echo('<option value="'.$fetch['productversion'].'">'.$fetch['productversion'].'</option>');
}
echo '</select>';
?>
