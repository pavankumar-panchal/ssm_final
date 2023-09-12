<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_productname = $_POST['s_productname']; $s_requirement = $_POST['s_requirement']; $s_reportedto = $_POST['s_reportedto'];
		$s_status = $_POST['s_status']; $s_solveddate = $_POST['s_solveddate'];
		$s_solutiongiven = $_POST['s_solutiongiven']; $s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; $s_requirementid = $_POST['s_requirementid']; $orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags']; $s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_requirementregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_requirementregister.customername LIKE '%".$s_customername."%'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_requirementregister.productname = '".$s_productname."'"); 
		$s_requirementpiece = ($s_requirement == "")?(""):(" AND ssm_requirementregister.requirement LIKE '%".$s_requirement."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_requirementregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_requirementregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_requirementregister.solveddate LIKE '%".$s_solveddate."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_requirementregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_requirementregister.remarks LIKE '%".$s_remarks."%'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_requirementregister.userid = '".$s_userid."'"); 
		$s_requirementidpiece = ($s_requirementid == "")?(""):(" AND ssm_requirementregister.requirementid  LIKE '%".$s_requirementid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_requirementregister.flag = '".$s_flags."'");
			
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_requirementregister.customername'; break;
			case 'productname': $orderbyfield = 'ssm_requirementregister.productname'; break;
			case 'requirement': $orderbyfield = 'ssm_requirementregister.requirement'; break;
			case 'reportedto': $orderbyfield = 'ssm_requirementregister.reportedto'; break;
			case 'status': $orderbyfield = 'ssm_requirementregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_requirementregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_requirementregister.solutiongiven'; break;
			case 'remarks': $orderbyfield = 'ssm_requirementregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_requirementregister.userid'; break;
			case 'requirementid': $orderbyfield = 'ssm_requirementregister.requirementid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalrequirement = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='solved'");
$totalsolvedrequirement = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_requirementregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='unsolved'");
$totalunsolvedrequirement = $query['counts'];

$query = "SELECT  ssm_requirementregister.flag AS flag,ssm_requirementregister.anonymous AS anonymous, ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_requirementpiece.$s_reportedtopiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_remarkspiece.$s_useridpiece.$s_requirementidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield.";";
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
	
$query11 = "SELECT  ssm_requirementregister.flag AS flag,ssm_requirementregister.anonymous AS anonymous, ssm_requirementregister.customername AS customername, ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, ssm_requirementregister.time AS time, ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, ssm_requirementregister.solutiongiven AS solutiongiven, ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_requirementregister.authorizeddatetime AS authorizeddatetime FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_requirementpiece.$s_reportedtopiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_remarkspiece.$s_useridpiece.$s_requirementidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit.";";
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
				->setCellValue('A2', 'Requirement Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A7:W7')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D5')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of Requirements')
				->setCellValue('C4', 'Number of Solved Requirements')
				->setCellValue('C5', 'Number of Un Solved Requirements');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalrequirement)
				->setCellValue('D4',$totalsolvedrequirement)
				->setCellValue('D5',$totalunsolvedrequirement);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A7', 'Sl No')
				->setCellValue('B7', 'Anonymous')
				->setCellValue('C7', 'Customer Name')
				->setCellValue('D7', 'Product Name')
				->setCellValue('E7', 'Product Version')
				->setCellValue('F7', 'Database')
				->setCellValue('G7', 'Date')
				->setCellValue('H7', 'Time')
				->setCellValue('I7', 'Requirement')
				->setCellValue('J7', 'Reported To')
				->setCellValue('K7', 'Status')
				->setCellValue('L7', 'Solved Date')
				->setCellValue('M7', 'Solution Given')
				->setCellValue('N7', 'Solution Entered Time')
				->setCellValue('O7', 'Remarks')
				->setCellValue('P7', 'User ID')
				->setCellValue('Q7', 'Requirement ID')
				->setCellValue('R7', 'Authorized')
				->setCellValue('S7', 'Authorized Group')
				->setCellValue('T7', 'Team Leader Remarks')
				->setCellValue('U7', 'Authorized Person')
				->setCellValue('V7', 'Authorized Date&Time')
				->setCellValue('W7', 'Flag');
				
		
			$j =8;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:W3')->applyFromArray($styleArray);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Anonymous')
				->setCellValue('C3', 'Customer Name')
				->setCellValue('D3', 'Product Name')
				->setCellValue('E3', 'Product Version')
				->setCellValue('F3', 'Database')
				->setCellValue('G3', 'Date')
				->setCellValue('H3', 'Time')
				->setCellValue('I3', 'Requirement')
				->setCellValue('J3', 'Reported To')
				->setCellValue('K3', 'Status')
				->setCellValue('L3', 'Solved Date')
				->setCellValue('M3', 'Solution Given')
				->setCellValue('N3', 'Solution Entered Time')
				->setCellValue('O3', 'Remarks')
				->setCellValue('P3', 'User ID')
				->setCellValue('Q3', 'Requirement ID')
				->setCellValue('R3', 'Authorized')
				->setCellValue('S3', 'Authorized Group')
				->setCellValue('T3', 'Team Leader Remarks')
				->setCellValue('U3', 'Authorized Person')
				->setCellValue('V3', 'Authorized Date&Time')
				->setCellValue('W3', 'Flag');
				
			$j =4;
			$slno= 0;
	}
	while($fetchres = mysqli_fetch_array($fetch11))
	{
		$slno++;
		$mySheet->setCellValue('A' . $j,$slno)
				->setCellValue('B' . $j,$fetchres['anonymous'])
				->setCellValue('C' . $j,$fetchres['customername'])
				->setCellValue('D' . $j,$fetchres['productname'])
				->setCellValue('E' . $j,$fetchres['productversion'])
				->setCellValue('F' . $j,$fetchres['database'])
				->setCellValue('G' . $j,changedateformat($fetchres['date']))
				->setCellValue('H' . $j,$fetchres['time'])
				->setCellValue('I' . $j,$fetchres['requirement'])
				->setCellValue('J' . $j,$fetchres['reportedto'])
				->setCellValue('K' . $j,$fetchres['status'])
				->setCellValue('L' . $j,changedateformat($fetchres['solveddate']))
				->setCellValue('M' . $j,$fetchres['solutiongiven'])
				->setCellValue('N' . $j,$fetchres['solutionenteredtime'])
				->setCellValue('O' . $j,$fetchres['remarks'])
				->setCellValue('P' . $j,$fetchres['userid'])
				->setCellValue('Q' . $j,$fetchres['requirementid'])
				->setCellValue('R' . $j,$fetchres['authorized'])
				->setCellValue('S' . $j,$fetchres['authorizedgroup'])
				->setCellValue('T' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('U' . $j,$fetchres['authorizedperson'])
				->setCellValue('V' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('W' . $j,$fetchres['flag']);
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
		$myDataRange = 'A8:'.$myLastCell;
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
	$mySheet->getColumnDimension('G')->setWidth(10);
	$mySheet->getColumnDimension('H')->setWidth(9);
	$mySheet->getColumnDimension('I')->setWidth(45);
	$mySheet->getColumnDimension('J')->setWidth(23);
	$mySheet->getColumnDimension('K')->setWidth(10);
	$mySheet->getColumnDimension('L')->setWidth(11);
	$mySheet->getColumnDimension('M')->setWidth(30);
	$mySheet->getColumnDimension('N')->setWidth(21);
	$mySheet->getColumnDimension('O')->setWidth(45);
	$mySheet->getColumnDimension('P')->setWidth(13);
	$mySheet->getColumnDimension('Q')->setWidth(15);
	$mySheet->getColumnDimension('R')->setWidth(11);
	$mySheet->getColumnDimension('S')->setWidth(20);
	$mySheet->getColumnDimension('T')->setWidth(14);
	$mySheet->getColumnDimension('U')->setWidth(14);
	$mySheet->getColumnDimension('V')->setWidth(17);
	$mySheet->getColumnDimension('W')->setWidth(12);
	

	/*$highestRow1  = $highestRow + 3;
	$mySheet->setCellValue('A' . $highestRow1,'test')
				->setCellValue('B' . $highestRow1,'test2');*/
				
				
	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_RQR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_RQR".$localdate."-".$localtime.".zip";
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
