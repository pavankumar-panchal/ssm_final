<?php
include('../inc/includefiles.php');
include('../inc/checktype.php');

$fetch = runmysqlqueryfetch("SELECT COUNT(DISTINCT supportunit) AS supportunitcount FROM ssm_users");
$supportunitcount = $fetch['supportunitcount'];
if($supportunitcount > 0)
{
	$query = "SELECT DISTINCT ssm_supportunits.heading AS supportunit FROM ssm_users LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit ORDER BY FIELD(ssm_users.supportunit,".$loggedsupportunit.") DESC, ssm_supportunits.heading;";
	$result = runmysqlquery($query);
	$grid .= '<ul>';
	while($fetch = mysqli_fetch_array($result))
	{
		$grid .= '<li>'.$fetch['supportunit'].'</li>';
		$fetchcount = runmysqlqueryfetch("SELECT count(DISTINCT reportingauthority) AS count FROM ssm_users LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit WHERE ssm_supportunits.heading = '".$fetch['supportunit']."' AND reportingauthority <> ''");
		if($fetchcount['count'] > 0)
		{
			$query1 = "SELECT DISTINCT reportingauthority FROM ssm_users  LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit WHERE ssm_supportunits.heading = '".$fetch['supportunit']."' AND reportingauthority <> ''";
			$result1 = runmysqlquery($query1);
			$grid .= '<ul>'; 
			while($fetch1 = mysqli_fetch_array($result1))
			{
				$fetchrep = runmysqlqueryfetch("SELECT fullname FROM ssm_users WHERE slno = '".$fetch1['reportingauthority']."'");
				$query2 = "SELECT reportingauthority FROM ssm_users WHERE slno = '".$fetch1['reportingauthority']."'";
				$result2 = runmysqlqueryfetch($query2);
				$grid .= '<li>'.$result2['fullname'].'</li>';
				/*$query2 = "SELECT fullname FROM ssm_users WHERE reportingauthority = '".$fetch1['reportingauthority']."'";
				$result2 = runmysqlquery($query2);
				$grid .= '<ul>';
				while($fetch2 = mysql_fetch_array($result2))
				{
					$grid .= '<li>'.$fetch2['fullname'].'</li>';
				}
				$grid .= '</ul>';*/
			}
			$grid .= '</ul>';
		}
	}
	$grid .= '</ul>';
}
echo($grid);

?>
