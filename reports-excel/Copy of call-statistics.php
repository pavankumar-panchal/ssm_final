<?php 
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
ini_set('memory_limit', '2048M');

$user = imaxgetcookie('ssmuserid');
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
$reporton = $_POST['reporton'];
$supportunitpiece = ($supportunit == "")?(""):(" AND ssm_supportunits.slno='".$supportunit."'");
$anonymouspiece = ($anonymous == "")?(""):(" AND ssm_callregister.anonymous='".$anonymous."'");

$userpiece = ($userid == "")?(""):(" AND userid='".$userid."'");
$userpiece1 = ($userid == "")?(""):("( AND userid='".$userid."' OR solvedby = '".$userid."')");

if(isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) { $callertype = ""; }
#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
elseif(isset($employee) && isset($customer) && isset($dealer)) { $callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; }

elseif(isset($customer) && isset($dealer) &&  isset($ssmuser)) { $callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($dealer) && isset($ssmuser) && isset($employee)) { $callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')"; }

elseif(isset($ssmuser) && isset($employee) && isset($customer)) { $callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($employee) && isset($customer)) { $callertype = "AND (callertype='employee' OR callertype='customer')"; }
elseif(isset($employee) && isset($dealer)) { $callertype = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(isset($employee) && isset($ssmuser)) { $callertype = "AND (callertype='employee' OR callertype='ssmuser')"; }
elseif(isset($customer) && isset($dealer)) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer) && isset($ssmuser)) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($dealer) && isset($ssmuser)) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer)) { $callertype = "AND callertype='customer'"; }
elseif(isset($dealer)) { $callertype = "AND callertype='dealer'"; }
elseif(isset($employee)) { $callertype = "AND callertype='employee'"; }
elseif(isset($ssmuser)) { $callertype = "AND callertype='ssmuser'"; }

$categorypiece = ($category == "")?(""):(" AND category='".$category."'");
$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");

switch($reporton)
{
	case 'statistics':
	{
		$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount FROM ssm_callregister   WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount FROM ssm_emailregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount FROM ssm_errorregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount FROM ssm_inhouseregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount FROM ssm_onsiteregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount FROM ssm_referenceregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount FROM ssm_requirementregister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount FROM ssm_skyperegister  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount1 FROM ssm_callregister  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount1 FROM ssm_emailregister   
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece. $categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount1 FROM ssm_errorregister  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount1 FROM ssm_inhouseregister    
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f12 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount1 FROM ssm_onsiteregister   
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f13 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount1 FROM ssm_referenceregister 
		WHERE status = 'sold' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f14 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount1 FROM ssm_requirementregister    
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f15 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount1 FROM ssm_skyperegister   
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f16 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount2 FROM ssm_callregister   
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f17 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount2 FROM ssm_emailregister  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f18 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount2 FROM ssm_errorregister    
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f19 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount2 FROM ssm_inhouseregister 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f20 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount2 FROM ssm_onsiteregister 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f21 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount2 FROM ssm_referenceregister   
		WHERE status = 'demogiven' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f22 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount2 FROM ssm_requirementregister 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f23 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount2 FROM ssm_skyperegister 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f24 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount3 FROM ssm_callregister   
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f25 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount3 FROM ssm_emailregister    
		WHERE status = 'registration' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f26 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount3 FROM ssm_inhouseregister   
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f27 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount3 FROM ssm_onsiteregister 
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f28 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount3 FROM ssm_referenceregister  
		WHERE status = 'rejected' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f29 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount3 FROM ssm_skyperegister  
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f30 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount4 FROM ssm_callregister   
		WHERE status = 'transferred' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f31 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount4 FROM ssm_emailregister     
		WHERE status = 'forwarded' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f32 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount4 FROM ssm_inhouseregister   
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f33 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount4 FROM ssm_onsiteregister   
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f34 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount4 FROM ssm_referenceregister   
		WHERE status = 'freshlead' or status = 'fake' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f35 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount5 FROM ssm_inhouseregister   
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f36 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount5 FROM ssm_onsiteregister    
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f37 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount5 FROM ssm_referenceregister  
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#006600">';
		
		for($k = 0; $k<count($_POST["check"]); $k++)
		{
			if($_POST['check'][$k] == 'Call')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Calls</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f0['totalcallcount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f8['totalcallcount1'] .'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f16['totalcallcount2'] .'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f24['totalcallcount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f30['totalcallcount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Email')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Emails</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f1['totalemailcount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f9['totalemailcount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f17['totalemailcount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f25['totalemailcount3'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f31['totalemailcount4'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Error')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Errors</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f2['totalerrorcount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f10['totalerrorcount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f18['totalerrorcount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Inhouse')
			{
				$grid .= '<tr><td rowspan="3" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Un Attended</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skipped</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Inhouses</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f3['totalinhousecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f11['totalinhousecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f19['totalinhousecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f26['totalinhousecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f32['totalinhousecount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f35['totalinhousecount5'].'</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Onsite')
			{
				$grid .= '<tr><td rowspan="3" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Un Attended</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skipped</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Onsites</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f4['totalonsitecount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f12['totalonsitecount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f20['totalonsitecount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f27['totalonsitecount3'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f33['totalonsitecount4'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f36['totalonsitecount5'].'</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Reference')
			{
				$grid .= '<tr><td colspan="8">&nbsp;</td></tr><tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Sold</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Demo Given</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Rejected</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Fresh Lead/Fake</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">References</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f5['totalreferencecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f13['totalreferencecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f21['totalreferencecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f28['totalreferencecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f34['totalreferencecount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f37['totalreferencecount5'].'</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Requirement')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Requirements</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f6['totalrequirementcount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f14['totalrequirementcount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f22['totalrequirementcount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Skype')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skypes</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f7['totalskypecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f15['totalskypecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f23['totalskypecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f29['totalskypecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr><tr><td colspan="8">&nbsp;</td></tr>
';
			}			
		}
		
		$grid .= '</table>';
		
	}
	break;
/**************************************************************************************************************************************/	
	
	case 'details':
	{
		for($k = 0; $k<count($_POST["check"]); $k++)
		{
				if($_POST['check'][$k] == 'Call')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Call Register</font></strong></h2></td></tr></table>';
					
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid"><tr bgcolor="#4f81bd"><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remote Connection</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User Id</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">End Time</font></strong></td></tr>
		';
				$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status, ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				if($_POST['check'][$k] == 'Email')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Email Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Subject</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Content</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Thanking Email</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag, ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 7)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				if($_POST['check'][$k] == 'Error')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Error Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Reported</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Understood by You</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous AS anonymous,  ssm_errorregister.customername AS customername,ssm_products.productname
		 AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,
		ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,
		ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status,
		ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS 
		solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,
		ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime
		 AS authorizeddatetime FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 5 || $i == 13)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Inhouse')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Inhouse Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous AS anonymous,  ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime FROM ssm_inhouseregister
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 3)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Onsite')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Onsite Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Remote Connection</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Marketing Person</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Onsite Visit</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Over Phone</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Mail</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous AS anonymous,  ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$supportunitpiece.$anonymouspiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4 || $i == 17 || $i == 19)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Reference')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Reference Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference Through</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Address</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&mp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous AS anonymous, ssm_referenceregister.customername AS customername,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno, ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Requirement')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Requirement Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag,ssm_requirementregister.anonymous AS anonymous,  ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 6)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Skype')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Skype Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sender</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype Conversation</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Attachment</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$supportunitpiece.$anonymouspiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 6)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
		}
	}
	break;
/**************************************************************************************************************************************/	
	
	
	case 'both':
	{
		$f0 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount FROM ssm_callregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f1 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount FROM ssm_emailregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f2 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount FROM ssm_errorregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f3 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f4 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount FROM ssm_onsiteregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f5 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount FROM ssm_referenceregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f6 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount FROM ssm_requirementregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f7 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount FROM ssm_skyperegister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f8 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount1 FROM ssm_callregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f9 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount1 FROM ssm_emailregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece. $categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f10 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount1 FROM ssm_errorregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f11 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount1 FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f12 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount1 FROM ssm_onsiteregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f13 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount1 FROM ssm_referenceregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'sold' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f14 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount1 FROM ssm_requirementregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f15 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount1 FROM ssm_skyperegister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno   
		WHERE status = 'solved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f16 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount2 FROM ssm_callregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f17 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount2 FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f18 = runmysqlqueryfetch("SELECT COUNT(*) AS totalerrorcount2 FROM ssm_errorregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f19 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount2 FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f20 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount2 FROM ssm_onsiteregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f21 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount2 FROM ssm_referenceregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'demogiven' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f22 = runmysqlqueryfetch("SELECT COUNT(*) AS totalrequirementcount2 FROM ssm_requirementregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece);
		
		$f23 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount2 FROM ssm_skyperegister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'unsolved' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f24 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount3 FROM ssm_callregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f25 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount3 FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'registration' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f26 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount3 FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f27 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount3 FROM ssm_onsiteregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'notyetattended' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f28 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount3 FROM ssm_referenceregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'rejected' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f29 = runmysqlqueryfetch("SELECT COUNT(*) AS totalskypecount3 FROM ssm_skyperegister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'registration given' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f30 = runmysqlqueryfetch("SELECT COUNT(*) AS totalcallcount4 FROM ssm_callregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'transferred' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f31 = runmysqlqueryfetch("SELECT COUNT(*) AS totalemailcount4 FROM ssm_emailregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'forwarded' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f32 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount4 FROM ssm_inhouseregister   LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f33 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount4 FROM ssm_onsiteregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f34 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount4 FROM ssm_referenceregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'freshlead' or status = 'fake' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$f35 = runmysqlqueryfetch("SELECT COUNT(*) AS totalinhousecount5 FROM ssm_inhouseregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f36 = runmysqlqueryfetch("SELECT COUNT(*) AS totalonsitecount5 FROM ssm_onsiteregister  LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno  
		WHERE status = 'skipped' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece);
		
		$f37 = runmysqlqueryfetch("SELECT COUNT(*) AS totalreferencecount5 FROM ssm_referenceregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_supportunits ON ssm_users.supportunit = ssm_supportunits.slno 
		WHERE status = 'inprocess' AND date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece1.$supportunitpiece.$anonymouspiece);
		
		$grid .= '<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#006600">';
		
		for($k = 0; $k<count($_POST["check"]); $k++)
		{
			if($_POST['check'][$k] == 'Call')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Calls</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f0['totalcallcount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f8['totalcallcount1'] .'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f16['totalcallcount2'] .'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f24['totalcallcount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f30['totalcallcount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Email')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Emails</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f1['totalemailcount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f9['totalemailcount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f17['totalemailcount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f25['totalemailcount3'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f31['totalemailcount4'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Error')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Errors</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f2['totalerrorcount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f10['totalerrorcount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f18['totalerrorcount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Inhouse')
			{
				$grid .= '<tr><td rowspan="3" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Un Attended</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skipped</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Inhouses</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f3['totalinhousecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f11['totalinhousecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f19['totalinhousecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f26['totalinhousecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f32['totalinhousecount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f35['totalinhousecount5'].'</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Onsite')
			{
				$grid .= '<tr><td rowspan="3" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Un Attended</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skipped</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Onsites</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f4['totalonsitecount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f12['totalonsitecount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f20['totalonsitecount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f27['totalonsitecount3'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f33['totalonsitecount4'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f36['totalonsitecount5'].'</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Reference')
			{
				$grid .= '<tr><td colspan="8">&nbsp;</td></tr><tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Sold</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Demo Given</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Rejected</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Fresh Lead/Fake</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">In Process</font></strong></td></tr><tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">References</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f5['totalreferencecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f13['totalreferencecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f21['totalreferencecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f28['totalreferencecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f34['totalreferencecount4'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f37['totalreferencecount5'].'</font></td></tr>';
			}
			
			if($_POST['check'][$k] == 'Requirement')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Requirements</font></strong></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f6['totalrequirementcount'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f14['totalrequirementcount1'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f22['totalrequirementcount2'].'</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#d7e4bc"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr>
';
			}
			
			if($_POST['check'][$k] == 'Skype')
			{
				$grid .= '<tr><td rowspan="2" align="center">&nbsp;</td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">'.changedateformat($fromdate).' TO '.changedateformat($todate).'</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Total</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Solved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Unsolved</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Registration</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Forwared/Transferred</font></strong></td><td align="center" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Others</font></strong></td></tr>';
				
				$grid .= '<tr><td align="left" bgcolor="#9bbb59"><strong><font color="#FFFFFF" style="font-family:Calibri; font-size:11px">Skypes</font></strong></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f7['totalskypecount'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f15['totalskypecount1'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f23['totalskypecount2'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">'.$f29['totalskypecount3'].'</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td><td align="right" bgcolor="#eaf1dd"><font color="#333333" style="font-family:Calibri; font-size:11px">NA</font></td></tr><tr><td colspan="8">&nbsp;</td></tr>
';
			}			
		}
		
		$grid .= '</table>';
		
		for($k = 0; $k<count($_POST["check"]); $k++)
		{
				if($_POST['check'][$k] == 'Call')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Call Register</font></strong></h2></td></tr></table>';
					
				$grid .='<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid"><tr bgcolor="#4f81bd"><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remote Connection</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User Id</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">End Time</font></strong></td></tr>
		';
				$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status, ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$callertype.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				if($_POST['check'][$k] == 'Email')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Email Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Person Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Subject</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Content</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Thanking Email</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Compliant ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.flag AS flag, ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 7)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				if($_POST['check'][$k] == 'Error')
				{
					$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Error Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Reported</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error Understood by You</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution File</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,ssm_errorregister.anonymous AS anonymous,  ssm_errorregister.customername AS customername,ssm_products.productname
		 AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,
		ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,
		ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status,
		ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS 
		solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,
		ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
		ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime
		 AS authorizeddatetime FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 5 || $i == 13)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Inhouse')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Inhouse Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,ssm_inhouseregister.anonymous AS anonymous,  ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime FROM ssm_inhouseregister
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
		LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
		LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 3)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Onsite')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Onsite Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Service Charge</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Assigned To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Remote Connection</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Marketing Person</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Onsite Visit</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Over Phone</font></strong></td>
					<td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">S. T. Mail</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bill Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Acknowledgement Number</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Complaint ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,ssm_onsiteregister.anonymous AS anonymous,  ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_onsiteregister.productname  LEFT JOIN ssm_users AS ssm_users  on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$supportunitpiece.$anonymouspiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4 || $i == 17 || $i == 19)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Reference')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Reference Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference Through</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Contact Address</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Email ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&mp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,ssm_referenceregister.anonymous AS anonymous, ssm_referenceregister.customername AS customername,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno, ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece.$categorypiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 4)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Requirement')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Requirement Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Database</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported To</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solved Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Given</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Solution Entered Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag,ssm_requirementregister.anonymous AS anonymous,  ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$supportunitpiece.$anonymouspiece." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 6)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
				
				if($_POST['check'][$k] == 'Skype')
				{
							$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td>&nbsp;</td><td  style="padding-left:15px;"><h2><strong><font color="#000000" face="Calibri">Skype Register</font></strong></h2></td></tr></table>';
					
					$grid .='<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd"><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sl No</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Flag</font></strong></td><td nowrap = "nowrap" class="td-border-grid"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Anonymous</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Sender</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Caller Type</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Date</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Time</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Category</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Problem</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype Conversation</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Attachment</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Status</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">User ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Skype ID</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Group</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Team Leader Remarks</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Person</font></strong></td><td><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Authorized Date&amp;Time</font></strong></td></tr>';
					
					$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$userpiece.$categorypiece.$supportunitpiece.$anonymouspiece.$callertype." ORDER BY  `date` DESC ";
		
					$result = runmysqlquery($query);
					$i_n = 0;
					$j = 1;
					while($fetch = mysqli_fetch_row($result))
					{
						$i_n++;
						
						$color;
						$grid .= '<tr bgcolor='.$color.'>';				
						if($i_n%2 == 0)
						$color = "#dbe5f1";
					else
						$color = "#ffffff";
						$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$j.'</font></td>';
						for($i = 1; $i < count($fetch); $i++)
						{
							if($i == 6)
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.changedateformat($fetch[$i]).'</font></td>';
							else
							$grid .= '<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
						}
						$grid .= '</tr>';
						$j++;
					}
					$grid .= '</table>';
				}
				
		}
	}
	break;
	
}

$localdate = datetimelocal('Ymd');
$localtime = datetimelocal('His');
$filebasename = "S_DRp".$localdate."-".$localtime.".xls";
$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;

$fp = fopen($filepath,"wa+");
if($fp)
{
	fwrite($fp,$grid);
	downloadfile($downloadlink);
	fclose($fp);
}  

?>
