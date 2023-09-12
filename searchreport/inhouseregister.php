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
		$s_solvedby= $_POST['s_solvedby']; $s_supportunit= $_POST['s_supportunit'];
		$s_billno= $_POST['s_billno']; $s_acknowledgementno= $_POST['s_acknowledgementno']; $s_userid = $_POST['s_userid']; 
		$s_complaintid = $_POST['s_complaintid']; $orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_inhouseregister.anonymous LIKE '%".$s_anonymous."%'"); 
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_inhouseregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_inhouseregister.customerid LIKE '%".$s_customerid."%'");
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

		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_inhouseregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_inhouseregister.status = '".$s_status."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_inhouseregister.problem LIKE '%".$s_problem."%'");
		$s_acknowledgementnopiece = ($s_acknowledgementno == "")?(""):(" AND ssm_inhouseregister.acknowledgementno LIKE '%".$s_acknowledgementno."%'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND ssm_inhouseregister.billno LIKE '%".$s_billno."%'");
		$s_solvedbypiece = ($s_solvedby == "")?(""):(" AND ssm_inhouseregister.solvedby LIKE '%".$s_solvedby."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_inhouseregister.userid = '".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND ssm_inhouseregister.complaintid LIKE '%".$s_complaintid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_inhouseregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_inhouseregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_inhouseregister.customerid'; break;
			case 'category': $orderbyfield = 'ssm_inhouseregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_inhouseregister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_inhouseregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_inhouseregister.status'; break;
			case 'problem': $orderbyfield = 'ssm_inhouseregister.problem'; break;
			case 'solvedby': $orderbyfield = 'ssm_inhouseregister.solvedby'; break;
			case 'billno': $orderbyfield = 'ssm_inhouseregister.billno'; break;
			case 'acknowledgementno': $orderbyfield = 'ssm_inhouseregister.acknowledgementno'; break;
			case 'complaintid': $orderbyfield = 'ssm_inhouseregister.complaintid'; break;
			case 'userid': $orderbyfield = 'ssm_inhouseregister.userid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvedcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'notyetattended'");
$totalnycom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'skipped'");
$totalskipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'inprocess'");
$totalipcom = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_inhouseregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'postponed'");
$totalppcom = $query['counts'];

$query = "SELECT ssm_inhouseregister.slno AS slno,ssm_inhouseregister.anonymous AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag AS flag  FROM ssm_inhouseregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
	
$query11 = "SELECT ssm_inhouseregister.slno AS slno,ssm_inhouseregister.anonymous AS anonymous, ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag AS flag  FROM ssm_inhouseregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_problempiece.$s_acknowledgementnopiece.$s_billnopiece.$s_solvedbypiece.$s_useridpiece.$s_complaintidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit."";
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
				->setCellValue('A2', 'Inhouse Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A12:AA12')->applyFromArray($styleArray);
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
				->setCellValue('O12', 'Status')
				->setCellValue('P12', 'Solved By')
				->setCellValue('Q12', 'Bill Number')
				->setCellValue('R12', 'Acknowledgement Number')
				->setCellValue('S12', 'Remarks')
				->setCellValue('T12', 'User ID')
				->setCellValue('U12', 'Compliant ID')
				->setCellValue('V12', 'Authorized')
				->setCellValue('W12', 'Authorized Group')
				->setCellValue('X12', 'Team Leader Remarks')
				->setCellValue('Y12', 'Authorized Person')
				->setCellValue('Z12', 'Authorized Date&amp;Time')
				->setCellValue('AA12', 'Flag');
		
			$j =13;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:AA3')->applyFromArray($styleArray);
		
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
				->setCellValue('O3', 'Status')
				->setCellValue('P3', 'Solved By')
				->setCellValue('Q3', 'Bill Number')
				->setCellValue('R3', 'Acknowledgement Number')
				->setCellValue('S3', 'Remarks')
				->setCellValue('T3', 'User ID')
				->setCellValue('U3', 'Compliant ID')
				->setCellValue('V3', 'Authorized')
				->setCellValue('W3', 'Authorized Group')
				->setCellValue('X3', 'Team Leader Remarks')
				->setCellValue('Y3', 'Authorized Person')
				->setCellValue('Z3', 'Authorized Date&amp;Time')
				->setCellValue('AA3', 'Flag');
		
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
				->setCellValue('O' . $j,$fetchres['status'])
				->setCellValue('P' . $j,$fetchres['solvedby'])
				->setCellValue('Q' . $j,$fetchres['billno'])
				->setCellValue('R' . $j,$fetchres['acknowledgementno'])
				->setCellValue('S' . $j,$fetchres['remarks'])
				->setCellValue('T' . $j,$fetchres['userid'])
				->setCellValue('U' . $j,$fetchres['complaintid'])
				->setCellValue('V' . $j,$fetchres['authorized'])
				->setCellValue('W' . $j,$fetchres['authorizedgroup'])
				->setCellValue('X' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('Y' . $j,$fetchres['authorizedperson'])
				->setCellValue('Z' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('AA' . $j,$fetchres['flag']);
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
	$mySheet->getColumnDimension('N')->setWidth(45);
	$mySheet->getColumnDimension('O')->setWidth(10);
	$mySheet->getColumnDimension('P')->setWidth(21);
	$mySheet->getColumnDimension('Q')->setWidth(11);
	$mySheet->getColumnDimension('R')->setWidth(26);
	$mySheet->getColumnDimension('S')->setWidth(45);
	$mySheet->getColumnDimension('T')->setWidth(21);
	$mySheet->getColumnDimension('U')->setWidth(12);
	$mySheet->getColumnDimension('V')->setWidth(11);
	$mySheet->getColumnDimension('W')->setWidth(17);
	$mySheet->getColumnDimension('X')->setWidth(10);
	$mySheet->getColumnDimension('Y')->setWidth(10);
	$mySheet->getColumnDimension('Z')->setWidth(10);

	/*$highestRow1  = $highestRow + 3;
	$mySheet->setCellValue('A' . $highestRow1,'test')
				->setCellValue('B' . $highestRow1,'test2');*/
				
				
	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_IHR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_IHR".$localdate."-".$localtime.".zip";
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