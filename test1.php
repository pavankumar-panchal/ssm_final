<?php
$date = '23-10-2009';
function changedateformat($date)
{

	if(strpos($date, " "))
	{
		$result = preg_split(" ",$date);
	}
	else
	{
		$result =  preg_split("[:./-]",$date);
		$date = $result[2]."-".$result[1]."-".$result[0];
	}
	
}
echo $date;
	echo "hi";
?>