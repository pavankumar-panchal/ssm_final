<?php
function productname($prdname,$style)
{
	
	if($prdname == 'productgroup')
	{
		$onchange = "productnamefunction();";
	}else{ $onchange ="";}
	
	if($style != "color")
	{ $style ="";}else{$style="background:#FEFFE6;";}
	
	
	$query = "select distinct(productgroup) from ssm_products order by productgroup;";
	$result = runmysqlquery($query);
	if(mysqli_num_rows($result) > 1)
	{
		$option = ('<select name="'.$prdname.'" class="swiftselect" id="'.$prdname.'" onChange="'.$onchange.'" style="'.$style.'"><option value="" selected="selected">Make a Selection</option>');
	}
	while($fetch = mysqli_fetch_array($result))
	{
		$option .=('<option value="'.$fetch['productgroup'].'">'.$fetch['productgroup'].'</option>');
	}
		$option .='</select>';
	
	echo ($option);
}
?>