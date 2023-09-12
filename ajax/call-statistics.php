<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
ini_set('memory_limit', '2048M');

$register = $_POST['register'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$category = $_POST['category'];
$customer = $_POST['customer'];
$dealer = $_POST['dealer'];
$employee = $_POST['employee'];
$ssmuser = $_POST['ssmuser'];
$userid = $_POST['userid'];
$supportunit = $_POST['supportunit'];
$anonymous = $_POST['anonymous'];
$supportunitpiece = ($supportunit == "")?(""):(" AND ssm_supportunits.slno='".$supportunit."'");
$anonymouspiece = ($anonymous == "")?(""):(" AND anonymous='".$anonymous."'");
$reporton = $_POST['reporton'];

$userpiece = ($userid == "")?(""):(" AND userid='".$userid."'");
$userpiece1 = ($userid == "")?(""):("( AND userid='".$userid."' OR solvedby = '".$userid."')");
if(($customer == "true") && ($dealer == "true") && ($employee == "true") && ($ssmuser == "true")) { $callertype = ""; }
#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
elseif(($employee == "true") && ($customer == "true") && ($dealer == "true")) { $callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; }

elseif(($customer == "true") && ($dealer == "true") &&  ($ssmuser == "true")) { $callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(($dealer == "true") && ($ssmuser == "true") && ($employee == "true")) { $callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')"; }

elseif(($ssmuser == "true") && ($employee == "true") && ($customer == "true")) { $callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(($employee == "true") && ($customer == "true")) { $callertype = "AND (callertype='employee' OR callertype='customer')"; }
elseif(($employee == "true") && ($dealer == "true")) { $callertype = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(($employee == "true") && ($ssmuser == "true")) { $callertype = "AND (callertype='employee' OR callertype='ssmuser')"; }
elseif(($customer == "true") && ($dealer == "true")) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(($customer == "true") && ($ssmuser == "true")) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(($dealer == "true") && ($ssmuser == "true")) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(($customer == "true")) { $callertype = "AND callertype='customer'"; }
elseif(($dealer == "true")) { $callertype = "AND callertype='dealer'"; }
elseif(($employee == "true")) { $callertype = "AND callertype='employee'"; }
elseif(($ssmuser == "true")) { $callertype = "AND callertype='ssmuser'"; }
$registers = explode("^^^",$register);

$categorypiece = ($category == "")?(""):(" AND category='".$category."'");
$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");


switch($reporton)
{
	case 'statistics':
	{
		$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount FROM ssm_callregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount FROM ssm_emailregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount FROM ssm_errorregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount FROM ssm_inhouseregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount FROM ssm_onsiteregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount FROM ssm_referenceregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."'
		 AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount FROM ssm_requirementregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount 
		FROM ssm_skyperegister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE date BETWEEN '".changedateformat($fromdate)."'
		 AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount1 FROM ssm_callregister   
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount1 FROM ssm_emailregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece. $categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount1 FROM ssm_errorregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."'
		 AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount1 FROM ssm_inhouseregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f12 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount1 FROM ssm_onsiteregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f13 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount1 FROM ssm_referenceregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'sold' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f14 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount1 FROM ssm_requirementregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f15 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount1 FROM ssm_skyperegister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."'
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f16 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount2 FROM ssm_callregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."'
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f17 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount2 FROM ssm_emailregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."'
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f18 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount2 FROM ssm_errorregister 
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f19 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount2 FROM ssm_inhouseregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f20 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount2 FROM ssm_onsiteregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."'
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f21 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount2 FROM ssm_referenceregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'demogiven' AND date BETWEEN '".changedateformat($fromdate)."'
		 AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f22 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount2 FROM ssm_requirementregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f23 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount2 FROM ssm_skyperegister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f24 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount3 FROM ssm_callregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f25 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount3 FROM ssm_emailregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'registration' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f26 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount3 FROM ssm_inhouseregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f27 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount3 FROM ssm_onsiteregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f28 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount3 FROM ssm_referenceregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'rejected' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f29 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount3 FROM ssm_skyperegister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f30 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount4 FROM ssm_callregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'transferred' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f31 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount4 FROM ssm_emailregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'forwarded' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f32 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount4 FROM ssm_inhouseregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f33 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount4 FROM ssm_onsiteregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f34 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount4 FROM ssm_referenceregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'freshlead' or status = 'fake' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f35 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount5 FROM ssm_inhouseregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f36 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount5 FROM ssm_onsiteregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f37 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount5 FROM ssm_referenceregister  
		LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
		LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' 
		AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		$grid = '';
	
		$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#006600">';
		
		for($k = 0; $k < count($registers); $k++)
		{
			if($registers[$k] == 'Call')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Registration</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Forwared/Transferred</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Others</font></strong></td>
					</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Calls</font></strong></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f0['totalcallcount'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f8['totalcallcount1'] .'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f16['totalcallcount2'] .'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f24['totalcallcount3'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f30['totalcallcount4'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
						</tr>';
			}
			
			if($registers[$k] == 'Email')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Registration</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Forwared/Transferred</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Others</font></strong></td>
						</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Emails</font></strong></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f1['totalemailcount'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f9['totalemailcount1'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f17['totalemailcount2'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f25['totalemailcount3'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f31['totalemailcount4'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
						</tr>';
			}
			
			if($registers[$k] == 'Error')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" 
bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" 
style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Registration</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Forwared/Transferred</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri;
font-size:11px">Others</font></strong></td>
							</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Errors</font></strong></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f2['totalerrorcount'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri;
font-size:11px">'.$f10['totalerrorcount1'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f18['totalerrorcount2'].'</font></td>
						 	<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
						</tr>';
			}
			
			if($registers[$k] == 'Inhouse')
			{
				$grid .= '<tr>
					
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri;
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Un Attended</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri;
font-size:11px">In Process</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Skipped</font></strong></td>
						</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Inhouses</font></strong></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f3['totalinhousecount'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f11['totalinhousecount1'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f19['totalinhousecount2'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f26['totalinhousecount3'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f32['totalinhousecount4'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f35['totalinhousecount5'].'</font></td>
						</tr>';
			}
			
			if($registers[$k] == 'Onsite')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri;
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Un Attended</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">In Process</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Skipped</font></strong></td>
						</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Onsites</font></strong></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f4['totalonsitecount'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f12['totalonsitecount1'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f20['totalonsitecount2'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri;
font-size:11px">'.$f27['totalonsitecount3'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f33['totalonsitecount4'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f36['totalonsitecount5'].'</font></td>
						</tr>';
			}
			
			if($registers[$k] == 'Reference')
			{
				$grid .= '<tr><td colspan="8">&nbsp;</td></tr>
						  <tr>
						  	
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Sold</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Demo Given</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Rejected</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Fresh Lead/Fake</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">In Process</font></strong></td>
						</tr>
						<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">References</font></strong></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f5['totalreferencecount'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f13['totalreferencecount1'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f21['totalreferencecount2'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f28['totalreferencecount3'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f34['totalreferencecount4'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f37['totalreferencecount5'].'</font></td>
					</tr>';
			}
			
			if($registers[$k] == 'Requirement')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Registration</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Forwared/Transferred</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Others</font></strong></td>
						</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Requirements</font></strong></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f6['totalrequirementcount'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f14['totalrequirementcount1'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f22['totalrequirementcount2'].'</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
							<td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
						</tr>
';
			}
			
			if($registers[$k] == 'Skype')
			{
				$grid .= '<tr>
							
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Total</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Solved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Unsolved</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Registration</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri;
font-size:11px">Forwared/Transferred</font></strong></td>
							<td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Others</font></strong></td>
						</tr>';
				
				$grid .= '<tr>
							<td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; 
font-size:11px">Skypes</font></strong></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f7['totalskypecount'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f15['totalskypecount1'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f23['totalskypecount2'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">'.$f29['totalskypecount3'].'</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td>
							<td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; 
font-size:11px">NA</font></td></tr><tr><td colspan="8">&nbsp;</td>
						</tr>';
			}			
		}
		
		$grid .= '</table>';		
		echo($grid);
	}
	break;
	
	case 'details':
	{
		for($k = 0; $k < count($registers)-1; $k++)
		{
			if($registers[$k] == 'Call')
			{
				$grid = '';
				$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td>&nbsp;</td><td  style="padding-left:15px;"><h2>Call Register</h2></td>
							</tr>
						</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">
				 <tr style="color:#FFFFFF;" bgcolor="#4f81bd">
				<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
				<td nowrap = "nowrap" class="td-border-grid">Flag</td>
				<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
				<td nowrap = "nowrap" class="td-border-grid">Call Type</td>
				<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
				<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
				<td nowrap = "nowrap" class="td-border-grid">Date</td>
				<td nowrap = "nowrap" class="td-border-grid">Time</td>
				<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
				<td nowrap = "nowrap" class="td-border-grid">Category</td>
				<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
				<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
				<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
				<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
				<td nowrap = "nowrap" class="td-border-grid">Problem</td>
				<td nowrap = "nowrap" class="td-border-grid">Status</td>
				<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
				<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
				<td nowrap = "nowrap" class="td-border-grid">User Id</td>
				<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
				<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
				<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
				<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
				<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
				<td nowrap = "nowrap" class="td-border-grid">Authorized Date&amp;Time</td>
				<td nowrap = "nowrap" class="td-border-grid">End Time</td>
			</tr>';
			$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous 
			AS anonymous,ssm_callregister.calltype, ssm_callregister.customername AS customername, 
			ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, 
			ssm_callregister.personname AS personname, ssm_callregister.category AS category, 
			ssm_callregister.callertype AS callertype, ssm_callregister.productgroup  AS productgroup,
			ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, 
			ssm_callregister.problem AS problem, ssm_callregister.status AS status, 
			ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks,
			ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,
			ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, 
			ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, 
			ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.endtime AS endtime
			FROM ssm_callregister  
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname 
			LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
			WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
			$categorypiece.$callertype.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 6)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			if($registers[$k] == 'Email')
			{
				$grid = '';
				$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
								<td  style="padding-left:15px;"><h2>Email Register</h2></td>
							</tr>
						</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
						<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
							<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td  nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td  nowrap = "nowrap" class="td-border-grid">Date</td>
							<td  nowrap = "nowrap" class="td-border-grid">Time</td>
							<td  nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td  nowrap = "nowrap" class="td-border-grid">Category</td>
							<td  nowrap = "nowrap" class="td-border-grid">Person Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Email ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Subject</td>
							<td  nowrap = "nowrap" class="td-border-grid">Content</td>
							<td  nowrap = "nowrap" class="td-border-grid">Error File</td>
							<td  nowrap = "nowrap" class="td-border-grid">Status</td>
							<td  nowrap = "nowrap" class="td-border-grid">Thanking Email</td>
							<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						</tr>';
				
				$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag, 
				ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,
				ssm_emailregister.customerid AS customerid,
				ssm_emailregister.productgroup AS productgroup,ssm_products.productname AS productname,
				ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,
				ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, 
				ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,
				ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,
				ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, 
				ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,
				ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,
				ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime 
				FROM ssm_emailregister  
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
				LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup  
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
	
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					
					$grid .= '<tr bgcolor='.$color.'>';				
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 8)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			if($registers[$k] == 'Error')
			{
				$grid = '';
				$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
								<td  style="padding-left:15px;"><h2>Error Register</h2></td>
							</tr>
						</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
							<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
								<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
								<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
								<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
								<td  nowrap = "nowrap" class="td-border-grid">Reported By</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Version</td>
								<td  nowrap = "nowrap" class="td-border-grid">Database</td>
								<td  nowrap = "nowrap" class="td-border-grid">Date</td>
								<td  nowrap = "nowrap" class="td-border-grid">Time</td>
								<td  nowrap = "nowrap" class="td-border-grid">Error Reported</td>
								<td  nowrap = "nowrap" class="td-border-grid">Error Understood by You</td>
								<td  nowrap = "nowrap" class="td-border-grid">Reported To</td>
								<td  nowrap = "nowrap" class="td-border-grid">Error File</td>
								<td  nowrap = "nowrap" class="td-border-grid">Status</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solved Date</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solution Given</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solution File</td>
								<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Error ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&amp;Time</td>
							</tr>';
				
				$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous 
				AS anonymous,  ssm_errorregister.customername AS customername,ssm_errorregister.productgroup AS productgroup,
				ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,
				ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,
				ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,
				ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status 
				AS status,ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,
				ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,
				ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,ssm_errorregister.errorid AS errorid,
				ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
				ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
				ssm_errorregister.authorizeddatetime AS authorizeddatetime 
				FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
	
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 8 || $i == 15)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			
			if($registers[$k] == 'Inhouse')
			{
				$grid = '';
						$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
										<td  style="padding-left:15px;"><h2>Inhouse Register</h2></td>
									</tr>
								</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
						<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
							<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td  nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Date</td>
							<td  nowrap = "nowrap" class="td-border-grid">Time</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td  nowrap = "nowrap" class="td-border-grid">Category</td>
							<td  nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td  nowrap = "nowrap" class="td-border-grid">Service Charge</td>
							<td  nowrap = "nowrap" class="td-border-grid">Problem</td>
							<td  nowrap = "nowrap" class="td-border-grid">Contact Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">Assigned To</td>
							<td  nowrap = "nowrap" class="td-border-grid">Status</td>
							<td  nowrap = "nowrap" class="td-border-grid">Solved By</td>
							<td  nowrap = "nowrap" class="td-border-grid">Bill Number</td>
							<td  nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
							<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						</tr>';
				
				$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,
				ssm_inhouseregister.anonymous AS anonymous,  ssm_inhouseregister.customername AS customername, 
				ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, 
				ssm_inhouseregister.productgroup AS productgroup,ssm_products.productname AS productname, 
				ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, 
				ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, 
				ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, 
				ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, 
				ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
				ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS 
				complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
				ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
				ssm_inhouseregister.authorizeddatetime AS authorizeddatetime FROM ssm_inhouseregister
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
				LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
				LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
				
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 5)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			
			if($registers[$k] == 'Onsite')
			{
				$grid = '';
				$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
								<td  style="padding-left:15px;"><h2>Onsite Register</h2></td>
							</tr>
						</table>';
					
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">
						<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
							<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
							<td nowrap = "nowrap" class="td-border-grid">Problem</td>
							<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
							<td nowrap = "nowrap" class="td-border-grid">Status</td>
							<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
							<td  nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
							<td  nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
							<td  nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
							<td  nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
							<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
							<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
							<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">User ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						</tr>';
		
		$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,
		ssm_onsiteregister.anonymous AS anonymous, ssm_onsiteregister.customername AS customername, 
		ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, 
		ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
		ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, 
		ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, 
		ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, 
		ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
		ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,
		ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,
		ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
		ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno 
		AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, 
		ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, 
		ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, 
		ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime 
		FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  
		LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
		LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid 
		LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.
		$callertype.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";

		$result = runmysqlquery($query);
		$i_n = 0;
		$j = 1;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			
			$color;			
			if($i_n%2 == 0)
			{
				$color = "#dbe5f1";
			}
			else
			{
				$color = "#ffffff";
			}
			$grid .= '<tr bgcolor='.$color.'>';				
$grid .= '<td nowrap = "nowrap" class="td-border-grid"><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</td>';
			for($i = 1; $i < count($fetch); $i++)
			{
				if($i == 5 || $i == 23 || $i == 25)
				{
					$grid .= '<td nowrap = "nowrap" class="td-border-grid"><font color="#333333" style="font-size:11px; 
font-family:Calibri;">'.changedateformat($fetch[$i]).'</td>';
				}
				else
				{
					$grid .= '<td nowrap = "nowrap" class="td-border-grid"><font color="#333333" style="font-size:11px; 
font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
				}
			}
			$grid .= '</tr>';
			$j++;
		}
		$grid .= '</table>';
			}
			
			
			if($registers[$k] == 'Reference')
			{
				$grid = '';
				$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
								<td  style="padding-left:15px;"><h2>Reference Register</h2></td>
							</tr>
						</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
						<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
							<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td  nowrap = "nowrap" class="td-border-grid">Reported By</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td  nowrap = "nowrap" class="td-border-grid">Date</td>
							<td  nowrap = "nowrap" class="td-border-grid">Time</td>
							<td  nowrap = "nowrap" class="td-border-grid">Reference Through</td>
							<td  nowrap = "nowrap" class="td-border-grid">Category</td>
							<td  nowrap = "nowrap" class="td-border-grid">Contact Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">Contact No</td>
							<td  nowrap = "nowrap" class="td-border-grid">Contact Address</td>
							<td  nowrap = "nowrap" class="td-border-grid">Email ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Status</td>
							<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Reference ID</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&mp;Time</td>
						</tr>';
				
				$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,
				ssm_referenceregister.anonymous AS anonymous, ssm_referenceregister.customername AS customername,
				ssm_referenceregister.productgroup AS productgroup,ssm_products.productname AS productname, 
				ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, 
				ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, 
				ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno, 
				ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, 
				ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, 
				ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, 
				ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
				ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
				ssm_referenceregister.authorizeddatetime AS authorizeddatetime 
				FROM ssm_referenceregister 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$supportunitpiece.$anonymouspiece.$categorypiece." ORDER BY  `date` DESC ";
	
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 5)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			
			if($registers[$k] == 'Requirement')
			{
				$grid = '';
						$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
										<td  style="padding-left:15px;"><h2>Requirement Register</h2></td>
									</tr>
								</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
							<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
								<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
								<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
								<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
								<td  nowrap = "nowrap" class="td-border-grid">Reported By</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Version</td>
								<td  nowrap = "nowrap" class="td-border-grid">Database</td>
								<td  nowrap = "nowrap" class="td-border-grid">Date</td>
								<td  nowrap = "nowrap" class="td-border-grid">Time</td>
								<td  nowrap = "nowrap" class="td-border-grid">Requirement</td>
								<td  nowrap = "nowrap" class="td-border-grid">Reported To</td>
								<td  nowrap = "nowrap" class="td-border-grid">Status</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solved Date</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solution Given</td>
								<td  nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
								<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Requirement ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&amp;Time</td>
							</tr>';
				
				$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag,
				ssm_requirementregister.anonymous AS anonymous,  ssm_requirementregister.customername AS customername, 
				ssm_requirementregister.productgroup AS productgroup,ssm_products.productname AS productname, 
				ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, 
				ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, 
				ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, 
				ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, 
				ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS 
				solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, 
				ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS 
				teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS 
				authorizeddatetime 
				FROM ssm_requirementregister 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
	
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 8 || $i == 13)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
			
			
			if($registers[$k] == 'Skype')
			{
						$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td  nowrap = "nowrap" class="td-border-grid">&nbsp;</td>
										<td  style="padding-left:15px;"><h2>Skype Register</h2></td>
									</tr>
								</table>';
				
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1">
							<tr style="color:#FFFFFF;" bgcolor="#4f81bd">
								<td  nowrap = "nowrap" class="td-border-grid">Sl No</td>
								<td  nowrap = "nowrap" class="td-border-grid">Flag</td>
								<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
								<td  nowrap = "nowrap" class="td-border-grid">Customer Name</td>
								<td  nowrap = "nowrap" class="td-border-grid">Customer ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Sender</td>
								<td  nowrap = "nowrap" class="td-border-grid">Caller Type</td>
								<td  nowrap = "nowrap" class="td-border-grid">Date</td>
								<td  nowrap = "nowrap" class="td-border-grid">Time</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Name</td>
								<td  nowrap = "nowrap" class="td-border-grid">Product Version</td>
								<td  nowrap = "nowrap" class="td-border-grid">Category</td>
								<td  nowrap = "nowrap" class="td-border-grid">Problem</td>
								<td  nowrap = "nowrap" class="td-border-grid">Skype Conversation</td>
								<td  nowrap = "nowrap" class="td-border-grid">Attachment</td>
								<td  nowrap = "nowrap" class="td-border-grid">Status</td>
								<td  nowrap = "nowrap" class="td-border-grid">Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">User ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Skype ID</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
								<td  nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
								<td  nowrap = "nowrap" class="td-border-grid">Authorized Date&amp;Time</td>
							</tr>';
				
				$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,
				ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, 
				ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, 
				ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date,
				ssm_skyperegister.time AS time, ssm_skyperegister.productgroup AS productgroup,
				ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, 
				ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, 
				ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, 
				ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, 
				ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime 
				FROM ssm_skyperegister 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.
				$categorypiece.$supportunitpiece.$anonymouspiece.$callertype." ORDER BY  `date` DESC ";
	
				$result = runmysqlquery($query);
				$i_n = 0;
				$j = 1;
				while($fetch = mysqli_fetch_row($result))
				{
					$i_n++;
					
					$color;
					if($i_n%2 == 0)
					{
						$color = "#dbe5f1";
					}
					else
					{
						$color = "#ffffff";
					}
					$grid .= '<tr bgcolor='.$color.'>';				
					
					$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.$j.'</td>';
					for($i = 1; $i < count($fetch); $i++)
					{
						if($i == 7)
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.changedateformat($fetch[$i]).'</td>';
						else
						$grid .= '<td  nowrap = "nowrap" class="td-border-grid">'.wordwrap($fetch[$i], 100, "<br />\n").'</td>';
					}
					$grid .= '</tr>';
					$j++;
				}
				$grid .= '</table>';
			}
		}
	}
	echo($grid);
	break;

}

?>