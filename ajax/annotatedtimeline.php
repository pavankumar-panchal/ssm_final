<?php
//Master Separator = ^#*#^
//Level1 Separator = ^##^
//Level2 Separator = ^*^
//Date Separator = ^^

//Main Format = Headings and format^#*#^Values of Table
	//Headings and format = Heading^*^Format^##^Heading^*^Format^##^...n [Where n= Total Columns]
	//Values of Table = Line1^##^Line2^##^...n  [Where n= Total Rows.]
		//Values of Line = Value1^*^Value2^*^...n [Where n= Total Columns]
		//Date Field = Year^^Month^^Date [Where Month is integer of the month minus one, Eg: Jan = 0, Feb = 1..]


ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');

$output = "Date^*^date^##^Calls^*^number^##^Title1^*^string^##^Text1^*^string^##^Emails^*^number^##^Title2^*^string^##^Text2^*^string";
$output .= "^#*#^";
$loggedsupportunitpiecess = ($loggedsupportunit == "4")?(""):(" WHERE ssm_supportunits.slno = '".$loggedsupportunit."'");
#ADor	
$query = "Select dates.date1 AS date1, calldates.nos AS calldates, '' AS title1, '' AS text1, emaildates.nos AS emaildates, '' AS title2, '' AS text2 from
(
Select distinct dates.date AS date1 from 
(
(select distinct date from ssm_callregister )
 UNION 
(select distinct date from ssm_emailregister)
) 
AS dates ORDER BY dates.date
)
 AS dates
LEFT JOIN 
(select date, count(*) AS nos from ssm_callregister LEFT JOIN ssm_users on ssm_users.slno = ssm_callregister.userid LEFT JOIN ssm_supportunits on ssm_supportunits.slno = ssm_users.supportunit  ".$loggedsupportunitpiecess." GROUP BY date ORDER BY date) AS calldates ON calldates.date = dates.date1
LEFT JOIN 
(select date, count(*) AS nos from ssm_emailregister LEFT JOIN ssm_users on ssm_users.slno = ssm_emailregister.userid LEFT JOIN ssm_supportunits on ssm_supportunits.slno = ssm_users.supportunit ".$loggedsupportunitpiecess." GROUP BY date ORDER BY date) AS emaildates ON emaildates.date = dates.date1
;
";

$result = runmysqlquery($query);
$totalrows = mysqli_num_rows($result);
$count = 0;

while($fetch = mysqli_fetch_row($result))
{
	$count++;
	$totalcolumns = count($fetch);
	for($i = 0; $i < count($fetch); $i++)
	{
		if($i == 0)
		{
			$date = explode("-",$fetch[$i]);
			$output .= $date[0];
			$output .= "^^";
			$output .= $date[1] - 1;
			$output .= "^^";
			$output .= (int)$date[2];
			$output .= "^*^";
		}
		else
		{
			$temp = $fetch[$i];
			if(($i + 2) % 3 == 0)
				$temp = ($fetch[$i] == "")?"0":$fetch[$i];
			$output .= $temp;
			if($i <> ($totalcolumns - 1))
				$output .= "^*^";
		}
	}
	if($count <> $totalrows)
		$output .= "^##^";
}





echo($output);
//echo("Date^*^date^##^Calls^*^number^##^Title1^*^string^##^Text1^*^string^##^Emails^*^number^##^Title2^*^string^##^Text2^*^string^#*#^2009^^1^^1^*^8^*^^*^^*^3^*^^*^^##^2009^^1^^2^*^9^*^^*^^*^4^*^^*^^##^2009^^1^^3^*^10^*^^*^^*^8^*^^*^^##^2009^^1^^6^*^8^*^^*^^*^12^*^^*^^##^2009^^1^^7^*^2^*^^*^^*^4^*^^*^^##^2009^^1^^8^*^4^*^^*^^*^14^*^^*^");

?>




