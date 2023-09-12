<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');

$fetchcount0 = runmysqlqueryfetch("SELECT DISTINCT COUNT(*) AS count FROM (SELECT DISTINCT supportunit FROM ssm_users) AS supportunit 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = supportunit.supportunit  ORDER BY FIELD(supportunit.supportunit,'2') DESC;");

if($fetchcount0['count'] > 0)
{
	$query0 = "SELECT DISTINCT ssm_supportunits.heading AS supportunitheading FROM (SELECT DISTINCT supportunit FROM ssm_users) AS supportunit LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = supportunit.supportunit  ORDER BY FIELD(supportunit.supportunit,'".$loggedsupportunit."') desc , ssm_supportunits.heading;";
	$result0 = runmysqlquery($query0);
	
	$tgrid .= '<ul>';
	
	while($fetch0 = mysqli_fetch_array($result0))
	{
		$tgrid .= '<li>'.$fetch0['supportunitheading'].'</li>';
		
		$fetchcount1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM (SELECT DISTINCT reportingauthority FROM ssm_users 
WHERE reportingauthority <> '') AS reportingauthority LEFT JOIN ssm_users ON reportingauthority.reportingauthority = ssm_users.slno 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_users.reportingauthority = '' AND ssm_supportunits.heading = '".$fetch0['supportunitheading']."' ORDER BY fullname DESC;");

		if($fetchcount1['count'] > 0)
		{
			$query1 = "SELECT ssm_users.fullname, ssm_users.slno, ssm_supportunits.heading FROM (SELECT DISTINCT reportingauthority FROM ssm_users 
WHERE reportingauthority <> '') AS reportingauthority LEFT JOIN ssm_users ON reportingauthority.reportingauthority = ssm_users.slno 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_users.reportingauthority = '' AND ssm_supportunits.heading = '".$fetch0['supportunitheading']."' ORDER BY fullname DESC;";
			$result1 = runmysqlquery($query1);
			
			$tgrid .= '<ul>';
			
			while($fetch1 = mysqli_fetch_array($result1))
			{
				$tgrid .= '<li>'.$fetch1['fullname'].'</li>';
				
				$fetchcount2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch1['slno']."'");
				if($fetchcount2['count'] > 0)
				{
					$query2 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch1['slno']."' ORDER BY fullname";
					$result2 = runmysqlquery($query2);
					
					$tgrid .= '<ul>';
					while($fetch2 = mysqli_fetch_array($result2))
					{
						$tgrid .= '<li>'.$fetch2['fullname'].'</li>';
						
						$fetchcount3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch2['slno']."' ORDER BY fullname");
												
						if($fetchcount3['count'] > 0)
						{
							$query3 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch2['slno']."' ORDER BY fullname";
							$result3 = runmysqlquery($query3);
							
							$tgrid .= '<ul>';
							while($fetch3 = mysqli_fetch_array($result3))
							{
								$tgrid .= '<li>'.$fetch3['fullname'].'</li>';
								
								$fetchcount4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch3['slno']."' ORDER BY fullname");
								if($fetchcount4['count'] > 0)
								{
									$query4 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch3['slno']."' ORDER BY fullname";
									$result4 = runmysqlquery($query4);
									
									$tgrid .= '<ul>';
									while($fetch4 = mysqli_fetch_array($result4))
									{
										$tgrid .= '<li>'.$fetch4['fullname'].'</li>';
										$fetchcount5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch4['slno']."' ORDER BY fullname");
										if($fetchcount5['count'] > 0)
										{
											$query5 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch4['slno']."' ORDER BY fullname";
											$result5 = runmysqlquery($query5);
											
											$tgrid .= '<ul>';
											while($fetch5 = mysqli_fetch_array($result5))
											{
												$tgrid .= '<li>'.$fetch5['fullname'].'</li>';
												$fetchcount6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch5['slno']."' ORDER BY fullname");
												if($fetchcount6['count'] > 0)
												{
													$query6 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch5['slno']."' ORDER BY fullname";
													$result6 = runmysqlquery($query6);
													$tgrid .= '<ul>';
													while($fetch6 = mysqli_fetch_array($result6))
													{
														$tgrid .= '<li>'.$fetch6['fullname'].'</li>';
														$fetchcount7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch6['slno']."' ORDER BY fullname");
														if($fetchcount7['count'] > 0)
														{
															$query7 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch6['slno']."' ORDER BY fullname";
															$result7 = runmysqlquery($query7);
															
															$tgrid .= '<ul>';
															while($fetch7 = mysqli_fetch_array($result7))
															{
																$tgrid .= '<li>'.$fetch7['fullname'].'</li>';
																$fetchcount8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users WHERE reportingauthority = '".$fetch7['slno']."' ORDER BY fullname");
																if($fetchcount8['count'] > 0)
																{
																	$query8 = "SELECT fullname,slno FROM ssm_users WHERE reportingauthority = '".$fetch7['slno']."' ORDER BY fullname";
																	$result8 = runmysqlquery($query8);
																	$tgrid .= '<ul>';
																	while($fetch8 = mysqli_fetch_array($result8))
																	{
																		$tgrid .= '<li>'.$fetch8['fullname'].'</li>';
																	}
																	$tgrid .= '</ul>';
																}
															}
															$tgrid .= '</ul>';
														}
													}
													$tgrid .= '</ul>';
												}
											}
											$tgrid .= '</ul>';
										}
									}
									$tgrid .= '</ul>';
								}
							}
							$tgrid .= '</ul>';
						}
					}
					$tgrid .= '</ul>';
				}
			}
			$tgrid .= '</ul>';
		}
		
	}
	$tgrid .= '</ul>';
}
echo($tgrid);
?>
