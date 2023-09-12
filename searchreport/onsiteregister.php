<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_customerid = $_POST['s_customerid']; $customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser'];
		$s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; $s_problem = $_POST['s_problem'];
		$s_solvedby= $_POST['s_solvedby']; $s_solveddate= $_POST['s_solveddate']; $s_billdate= $_POST['s_billdate']; 
		$s_billno= $_POST['s_billno']; $s_acknowledgementno= $_POST['s_acknowledgementno']; $s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid']; $orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];
		$s_supportunit = $_POST['s_supportunit']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_onsiteregister.anonymous LIKE '%".$s_anonymous."%'"); 
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_onsiteregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_onsiteregister.customerid LIKE '%".$s_customerid."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }
		if(isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) { $s_callertypepiece = ""; }
#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
elseif(isset($employee) && isset($customer) && isset($dealer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')"; }

elseif(isset($customer) && isset($dealer) &&  isset($ssmuser)) { $s_callertypepiece = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($dealer) && isset($ssmuser) && isset($employee)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')"; }

elseif(isset($ssmuser) && isset($employee) && isset($customer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')"; }

elseif(isset($employee) && isset($customer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='customer')"; }
elseif(isset($employee) && isset($dealer)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(isset($employee) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='employee' OR callertype='ssmuser')"; }
elseif(isset($customer) && isset($dealer)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($dealer) && isset($ssmuser)) { $s_callertypepiece = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer)) { $s_callertypepiece = "AND callertype='customer'"; }
elseif(isset($dealer)) { $s_callertypepiece = "AND callertype='dealer'"; }
elseif(isset($employee)) { $s_callertypepiece = "AND callertype='employee'"; }
elseif(isset($ssmuser)) { $s_callertypepiece = "AND callertype='ssmuser'"; }
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_onsiteregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_onsiteregister.status = '".$s_status."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_onsiteregister.problem LIKE '%".$s_problem."%'");
		$s_acknowledgementnopiece = ($s_acknowledgementno == "")?(""):(" AND ssm_onsiteregister.acknowledgementno LIKE '%".$s_acknowledgementno."%'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_onsiteregister.billno LIKE '%".$s_billno."%'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND ssm_onsiteregister.billdate LIKE '%".changedateformat($s_billdate)."%'");
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_onsiteregister.solveddate LIKE '%".changedateformat($s_solveddate)."%'");
		$s_solvedbypiece = ($s_solvedby == "")?(""):(" AND ssm_onsiteregister.solvedby LIKE '%".$s_solvedby."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_onsiteregister.userid = '".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND ssm_onsiteregister.complaintid LIKE '%".$s_complaintid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_onsiteregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_onsiteregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_onsiteregister.customerid'; break;
			case 'category': $orderbyfield = 'ssm_onsiteregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_onsiteregister.callertype'; break;
			case 'productname ': $orderbyfield = 'ssm_onsiteregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_onsiteregister.status'; break;
			case 'problem': $orderbyfield = 'ssm_onsiteregister.problem'; break;
			case 'solvedby': $orderbyfield = 'ssm_onsiteregister.solvedby'; break;
			case 'solveddate': $orderbyfield = 'ssm_onsiteregister.solveddate'; break;
			case 'billno': $orderbyfield = 'ssm_onsiteregister.billno'; break;
			case 'billdate': $orderbyfield = 'ssm_onsiteregister.billdate'; break;
			case 'acknowledgementno ': $orderbyfield = 'ssm_onsiteregister.acknowledgementno'; break;
			case 'complaintid': $orderbyfield = 'ssm_onsiteregister.complaintid'; break;
			case 'userid': $orderbyfield = 'ssm_onsiteregister.userid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'notyetattended'");
$totalnycom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped'");
$totalskipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess'");
$totalipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_onsiteregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed'");
$totalppcom = $query['counts'];


$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.anonymous AS anonymous, ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag  FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_billdatepiece.$s_solveddatepiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece.$s_anonymouspiece." ORDER BY `date` DESC , ".$orderbyfield;
$fetch =  runmysqlquery($query);
$fetchcount =  mysqli_num_rows($fetch);
$checkedcount = $fetchcount ;
$quotient = $checkedcount/5000;
$totallooprun = ($checkedcount % 5000 == 0)?($checkedcount/5000):(ceil($checkedcount/5000));
$slno =0;
$limit = 5000;


for($i = 0; $i < $totallooprun ; $i++)
{
	if($i == 0)
	{
		$startlimit = 0;
		$slno = 0;
	}
	else
	{
		$startlimit = $slno;
	}
	
$query11 = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.anonymous AS anonymous, ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag  FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_billdatepiece.$s_solveddatepiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece.$s_anonymouspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit."";
	$fetch11 = runmysqlquery($query11);
		
	$objPHPExcel = new PHPExcel();
	
	$mySheet = $objPHPExcel->getActiveSheet();
	
	//Define Style for header row
	$styleArray = array(
						'font' => array('bold' => true,),
						'fill'=> array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'color'=> array('argb' => 'FFCCFFCC')),
						'borders' => array('allborders'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))
					);
					
	$stylesheetfortotal = array(
						'font' => array('bold' => true,),
						'fill'=> array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'color'=> array('argb' => '0099CCFF')),
						'borders' => array('allborders'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))
					);

	
				
	//Merge the cell
	$mySheet->mergeCells('A1:X1');
	$mySheet->mergeCells('A2:X2');
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Relyon Softech Limited, Bangalore')
				->setCellValue('A2', 'Onsite Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A12:AI12')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D9')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number Complaints Registered')
				->setCellValue('C4', 'Number of Solved Complaints')
				->setCellValue('C5', 'Number of Un Solved Complaints')
				->setCellValue('C6', 'Number of Complaints Not yet attended')
				->setCellValue('C7', 'Number of Complaints Postponed')
				->setCellValue('C8', 'Number of Complaints Skipped')
				->setCellValue('C9', 'Number of Complaints In Process');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalcom)
				->setCellValue('D4',$totalsolvedcom)
				->setCellValue('D5',$totalunsolvedcom)
				->setCellValue('D6',$totalnycom)
				->setCellValue('D7',$totalppcom)
				->setCellValue('D8',$totalskipcom)
				->setCellValue('D9',$totalipcom);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A12', 'Sl No')
				->setCellValue('B12', 'Anonymous')
				->setCellValue('C12', 'Customer Name')
				->setCellValue('D12', 'Customer ID')
				->setCellValue('E12', 'Date')
				->setCellValue('F12', 'Time')
				->setCellValue('G12', 'Product Name')
				->setCellValue('H12', 'Product Version')
				->setCellValue('I12', 'Category')
				->setCellValue('J12', 'Caller Type')
				->setCellValue('K12', 'Service Charge')
				->setCellValue('L12', 'Problem')
				->setCellValue('M12', 'Contact Person')
				->setCellValue('N12', 'Assigned To')
				->setCellValue('O12', 'Support Unit')
				->setCellValue('P12', 'Status')
				->setCellValue('Q12', 'Solved By')
				->setCellValue('R12', 'S.T.Remote Connection')
				->setCellValue('S12', 'S.T.Marketing Person')
				->setCellValue('T12', 'S.T.Onsite Visit')
				->setCellValue('U12', 'S.T.Over Phone')
				->setCellValue('V12', 'S.T.Mail')
				->setCellValue('W12', 'Solved Date')
				->setCellValue('X12', 'Bill Number')
				->setCellValue('Y12', 'Bill Date')
				->setCellValue('Z12', 'Acknowledgement Number')
				->setCellValue('AA12', 'Remarks')
				->setCellValue('AB12', 'User ID')
				->setCellValue('AC12', 'Compliant ID')
				->setCellValue('AD12', 'Authorized')
				->setCellValue('AE12', 'Authorized Group')
				->setCellValue('AF12', 'Team Leader Remarks')
				->setCellValue('AG12', 'Authorized Person')
				->setCellValue('AH12', 'Authorized Date&amp;Time')
				->setCellValue('AI12', 'Flag');
		
			$j =13;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:AI3')->applyFromArray($styleArray);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Anonymous')
				->setCellValue('C3', 'Customer Name')
				->setCellValue('D3', 'Customer ID')
				->setCellValue('E3', 'Date')
				->setCellValue('F3', 'Time')
				->setCellValue('G3', 'Product Name')
				->setCellValue('H3', 'Product Version')
				->setCellValue('I3', 'Category')
				->setCellValue('J3', 'Caller Type')
				->setCellValue('K3', 'Service Charge')
				->setCellValue('L3', 'Problem')
				->setCellValue('M3', 'Contact Person')
				->setCellValue('N3', 'Assigned To')
				->setCellValue('O3', 'Support Unit')
				->setCellValue('P3', 'Status')
				->setCellValue('Q3', 'Solved By')
				->setCellValue('R3', 'S.T.Remote Connection')
				->setCellValue('S3', 'S.T.Marketing Person')
				->setCellValue('T3', 'S.T.Onsite Visit')
				->setCellValue('U3', 'S.T.Over Phone')
				->setCellValue('V3', 'S.T.Mail')
				->setCellValue('W3', 'Solved Date')
				->setCellValue('X3', 'Bill Number')
				->setCellValue('Y3', 'Bill Date')
				->setCellValue('Z3', 'Acknowledgement Number')
				->setCellValue('AA3', 'Remarks')
				->setCellValue('AB3', 'User ID')
				->setCellValue('AC2', 'Compliant ID')
				->setCellValue('AD3', 'Authorized')
				->setCellValue('AE3', 'Authorized Group')
				->setCellValue('AF3', 'Team Leader Remarks')
				->setCellValue('AG3', 'Authorized Person')
				->setCellValue('AH3', 'Authorized Date&amp;Time')
				->setCellValue('AI3', 'Flag');
		
			$j =4;
			$slno= 0;
	}
	while($fetchres = mysqli_fetch_array($fetch11))
	{
		$slno++;
		$mySheet->setCellValue('A' . $j,$slno)
				->setCellValue('B' . $j,$fetchres['anonymous'])
				->setCellValue('C' . $j,$fetchres['customername'])
				->setCellValue('D' . $j,$fetchres['customerid'])
				->setCellValue('E' . $j,changedateformat($fetchres['date']))
				->setCellValue('F' . $j,$fetchres['time'])
				->setCellValue('G' . $j,$fetchres['productname'])
				->setCellValue('H' . $j,$fetchres['productversion'])
				->setCellValue('I' . $j,$fetchres['category'])
				->setCellValue('J' . $j,$fetchres['callertype'])
				->setCellValue('K' . $j,$fetchres['servicecharge'])
				->setCellValue('L' . $j,$fetchres['problem'])
				->setCellValue('M' . $j,$fetchres['contactperson'])
				->setCellValue('N' . $j,$fetchres['assignedto'])
				->setCellValue('O' . $j,$fetchres['supportunit'])
				->setCellValue('P' . $j,$fetchres['status'])
				->setCellValue('Q' . $j,$fetchres['solvedby'])
				->setCellValue('R' . $j,$fetchres['stremoteconnection'])
				->setCellValue('S' . $j,$fetchres['marketingperson'])
				->setCellValue('T' . $j,$fetchres['onsitevisit'])
				->setCellValue('U' . $j,$fetchres['overphone'])
				->setCellValue('V' . $j,$fetchres['mail'])
				->setCellValue('W' . $j,changedateformat($fetchres['solveddate']))
				->setCellValue('X' . $j,$fetchres['billno'])
				->setCellValue('Y' . $j,changedateformat($fetchres['billdate']))
				->setCellValue('Z' . $j,$fetchres['acknowledgementno'])
				->setCellValue('AA' . $j,$fetchres['remarks'])
				->setCellValue('AB' . $j,$fetchres['userid'])
				->setCellValue('AC' . $j,$fetchres['complaintid'])
				->setCellValue('AD' . $j,$fetchres['authorized'])
				->setCellValue('AE' . $j,$fetchres['authorizedgroup'])
				->setCellValue('AF' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('AG' . $j,$fetchres['authorizedperson'])
				->setCellValue('AH' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('AI' . $j,$fetchres['flag']);
				$j++;
		
	}
	
	//Define Style for content area
	$styleArrayContent = array(
						'borders' => array('allborders'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))
					);
	//Get the last cell reference
	$highestRow = $mySheet->getHighestRow(); 
	$highestColumn = $mySheet->getHighestColumn(); 
	$myLastCell = $highestColumn.$highestRow;
	if($i == 0)
	{
		//Deine the content range
		$myDataRange = 'A13:'.$myLastCell;
		if(mysqli_num_rows($fetch11) <> 0)
		{
			//Apply style to content area range
			$mySheet->getStyle($myDataRange)->applyFromArray($styleArrayContent);
		}
	}
	else
	{
		//Deine the content range
		$myDataRange = 'A4:'.$myLastCell;
		if(mysqli_num_rows($fetch11) <> 0)
		{
			//Apply style to content area range
			$mySheet->getStyle($myDataRange)->applyFromArray($styleArrayContent);
		}
	}
	
	//set the default width for column
	$mySheet->getColumnDimension('A')->setWidth(6);
	$mySheet->getColumnDimension('B')->setWidth(10);
	$mySheet->getColumnDimension('C')->setWidth(35);
	$mySheet->getColumnDimension('D')->setWidth(40);
	$mySheet->getColumnDimension('E')->setWidth(20);
	$mySheet->getColumnDimension('F')->setWidth(9);
	$mySheet->getColumnDimension('G')->setWidth(20);
	$mySheet->getColumnDimension('H')->setWidth(9);
	$mySheet->getColumnDimension('I')->setWidth(12);
	$mySheet->getColumnDimension('J')->setWidth(12);
	$mySheet->getColumnDimension('K')->setWidth(25);
	$mySheet->getColumnDimension('L')->setWidth(45);
	$mySheet->getColumnDimension('M')->setWidth(30);
	$mySheet->getColumnDimension('N')->setWidth(31);
	$mySheet->getColumnDimension('O')->setWidth(12);
	$mySheet->getColumnDimension('P')->setWidth(21);
	$mySheet->getColumnDimension('Q')->setWidth(12);
	$mySheet->getColumnDimension('R')->setWidth(22);
	$mySheet->getColumnDimension('S')->setWidth(20);
	$mySheet->getColumnDimension('T')->setWidth(14);
	$mySheet->getColumnDimension('U')->setWidth(14);
	$mySheet->getColumnDimension('V')->setWidth(8);
	$mySheet->getColumnDimension('W')->setWidth(12);
	$mySheet->getColumnDimension('X')->setWidth(10);
	$mySheet->getColumnDimension('Y')->setWidth(10);
	$mySheet->getColumnDimension('Z')->setWidth(26);
	$mySheet->getColumnDimension('AA')->setWidth(45);
	$mySheet->getColumnDimension('AB')->setWidth(30);
	$mySheet->getColumnDimension('AC')->setWidth(12);
	$mySheet->getColumnDimension('AD')->setWidth(11);
	$mySheet->getColumnDimension('AE')->setWidth(17);
	$mySheet->getColumnDimension('AF')->setWidth(17);
	$mySheet->getColumnDimension('AG')->setWidth(17);
	$mySheet->getColumnDimension('AH')->setWidth(17);
	$mySheet->getColumnDimension('AI')->setWidth(9);

	/*$highestRow1  = $highestRow + 3;
	$mySheet->setCellValue('A' . $highestRow1,'test')
				->setCellValue('B' . $highestRow1,'test2');*/
				
				
	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_OR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_OR".$localdate."-".$localtime.".zip";
	$filezipnamepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filezipname;
	$zip = new ZipArchive;
	$newzip = $zip->open($filezipnamepath, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
	if ($newzip === TRUE)
	 {
			for($i = 0;$i <count($filearray);$i++)
			{
				$zip->addFile($filepatharray[$i], $filearray[$i]);
			}
			$zip->close();
	}
	for($i = 0;$i <count($filearray);$i++)
	{
		unlink($filepatharray[$i]) ;
	}
	
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].$addstring.'/filecreated/'.$filezipname;
	downloadfile($filezipnamepath);

?>