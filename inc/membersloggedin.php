<?php
$fetchcount0 = runmysqlqueryfetch("SELECT DISTINCT COUNT(*) AS count FROM (SELECT DISTINCT supportunit FROM ssm_users) AS supportunit 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = supportunit.supportunit  ORDER BY FIELD(supportunit.supportunit,'2') DESC;");
$membergrid = "";
if($fetchcount0['count'] > 0)
{
	$query0 = "SELECT DISTINCT ssm_supportunits.heading AS supportunitheading,ssm_supportunits.slno AS supportunitslno  FROM (SELECT DISTINCT supportunit FROM ssm_users) AS supportunit LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = supportunit.supportunit WHERE ssm_supportunits.slno <> '4'  ORDER BY  ssm_supportunits.heading;";
	$result0 = runmysqlquery($query0);

	while($fetch0 = mysqli_fetch_array($result0))
	{
		$membergrid .= '<p>'.$fetch0['supportunitheading'].'<p>';
		
		$fetchcount1 = runmysqlqueryfetch("SELECT count(*) AS count FROM ssm_usertime join 
(SELECT username,slno,fullname,supportunit,type from ssm_users) AS ssm_users 
ON ssm_usertime.userid=ssm_users.slno WHERE ssm_usertime.logindate = CURDATE() 
AND ssm_usertime.logintype = 'IN' AND ssm_users.type <> 'ADMIN' AND ssm_users.supportunit = '".$fetch0['supportunitslno']."' order by ssm_users.fullname;");

		if($fetchcount1['count'] > 0)
		{
			$query1 = "SELECT DISTINCT userid, ssm_users.username AS username ,ssm_users.fullname AS fullname FROM ssm_usertime join 
(SELECT username,slno,fullname,supportunit,type from ssm_users) as ssm_users 
ON ssm_usertime.userid=ssm_users.slno WHERE ssm_usertime.logindate = CURDATE() 
AND ssm_usertime.logintype = 'IN' AND ssm_users.type <> 'ADMIN' AND ssm_users.supportunit = '".$fetch0['supportunitslno']."' order by ssm_users.fullname;";
			$result1 = runmysqlquery($query1);
			
			$membergrid .= '<ul>';
			
			while($fetch1 = mysqli_fetch_array($result1))
			{
				$membergrid .= '<li>'.$fetch1['fullname'].'</li>';
			}
			$membergrid .= '</ul>';
		}
		
	}
}
?>
