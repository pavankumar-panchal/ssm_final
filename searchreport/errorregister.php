<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_productname = $_POST['s_productname']; $s_errorreported = $_POST['s_errorreported']; $s_reportedto = $_POST['s_reportedto'];
		$s_errorfile = $_POST['s_errorfile']; $s_status = $_POST['s_status']; $s_solveddate = $_POST['s_solveddate'];
		$s_solutiongiven = $_POST['s_solutiongiven']; $s_solutionfile = $_POST['s_solutionfile']; $s_remarks = $_POST['s_remarks'];
		$s_userid = $_POST['s_userid']; $s_errorid = $_POST['s_errorid']; $orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];
		$s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_errorregister.anonymous LIKE '%".$s_anonymous."%'"); 
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_errorregister.customername LIKE '%".$s_customername."%'"); 
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_errorregister.productname  = '".$s_productname."'"); 
		$s_errorreportedpiece = ($s_errorreported == "")?(""):(" AND ssm_errorregister.errorreported LIKE '%".$s_errorreported."%'"); 
		$s_reportedtopiece = ($s_reportedto == "")?(""):(" AND ssm_errorregister.reportedto LIKE '%".$s_reportedto."%'"); 
		$s_errorfilepiece = ($s_errorfile == "")?(""):(" AND ssm_errorregister.errorfile LIKE '%".$s_errorfile."%'"); 
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_errorregister.status = '".$s_status."'"); 
		$s_solveddatepiece = ($s_solveddate == "")?(""):(" AND ssm_errorregister.solveddate LIKE '%".$s_solveddate."%'"); 
		$s_solutiongivenpiece = ($s_solutiongiven == "")?(""):(" AND ssm_errorregister.solutiongiven LIKE '%".$s_solutiongiven."%'"); 
		$s_solutionfilepiece = ($s_solutionfile == "")?(""):(" AND ssm_errorregister.solutionfile LIKE '%".$s_solutionfile."%'"); 
		$s_remarkspiece = ($s_remarks == "")?(""):(" AND ssm_errorregister.remarks LIKE '%".$s_remarks."'"); 
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_errorregister.userid = '".$s_userid."'"); 
		$s_erroridpiece = ($s_errorid == "")?(""):(" AND ssm_errorregister.errorid LIKE '%".$s_errorid."%'"); 	
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'"); 
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_errorregister.flag = '".$s_flags."'");	
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_errorregister.customername'; break;
			case 'productname': $orderbyfield = 'ssm_errorregister.productname'; break;
			case 'errorreported': $orderbyfield = 'ssm_errorregister.errorreported'; break;
			case 'reportedto': $orderbyfield = 'ssm_errorregister.reportedto'; break;
			case 'errorfile': $orderbyfield = 'ssm_errorregister.errorfile'; break;
			case 'status': $orderbyfield = 'ssm_errorregister.status'; break;
			case 'solveddate': $orderbyfield = 'ssm_errorregister.solveddate'; break;
			case 'solutiongiven': $orderbyfield = 'ssm_errorregister.solutiongiven'; break;
			case 'solutionfile': $orderbyfield = 'ssm_errorregister.solutionfile'; break;
			case 'remarks': $orderbyfield = 'ssm_errorregister.remarks'; break;
			case 'userid': $orderbyfield = 'ssm_errorregister.userid'; break;
			case 'errorid': $orderbyfield = 'ssm_errorregister.errorid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalerror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvederror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvederror = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_errorregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND customername <> ''");
$totalcuserror = $query['counts'];

$query = "SELECT ssm_errorregister.slno AS slno,ssm_errorregister.anonymous AS anonymous, ssm_errorregister.customername AS customername,ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status, ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup, ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime  AS authorizeddatetime, ssm_errorregister.flag AS flag FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_errorreportedpiece.$s_reportedtopiece.$s_errorfilepiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_solutionfilepiece.$s_remarkspiece.$s_useridpiece.$s_erroridpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
$fetch =  runmysqlquery($query);
$fetchcount =  mysql_num_rows($fetch);
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
	
$query11 = "SELECT ssm_errorregister.slno AS slno,ssm_errorregister.anonymous AS anonymous, ssm_errorregister.customername AS customername,ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date,ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood,ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status, ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid, ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup, ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime  AS authorizeddatetime, ssm_errorregister.flag AS flag FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_productnamepiece.$s_errorreportedpiece.$s_reportedtopiece.$s_errorfilepiece.$s_statuspiece.$s_solveddatepiece.$s_solutiongivenpiece.$s_solutionfilepiece.$s_remarkspiece.$s_useridpiece.$s_erroridpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit."";
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
				->setCellValue('A2', 'Error Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A8:Z8')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D6')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of Errors')
				->setCellValue('C4', 'Number of Solved Errors')
				->setCellValue('C5', 'Number of Un Solved Errors')
				->setCellValue('C6', 'Number of Errors from Customer End');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalerror)
				->setCellValue('D4',$totalsolvederror)
				->setCellValue('D5',$totalunsolvederror)
				->setCellValue('D6',$totalcuserror);
		
			
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A8', 'Sl No')
				->setCellValue('B8', 'Anonymous')
				->setCellValue('C8', 'Reported By')
				->setCellValue('D8', 'Product Name')
				->setCellValue('E8', 'Product Version')
				->setCellValue('F8', 'Database')
				->setCellValue('G8', 'Date')
				->setCellValue('H8', 'Time')
				->setCellValue('I8', 'Error Reported')
				->setCellValue('J8', 'Error Understood')
				->setCellValue('K8', 'Reported To')
				->setCellValue('L8', 'Error File')
				->setCellValue('M8', 'Status')
				->setCellValue('N8', 'Solved Date')
				->setCellValue('O8', 'Solution Given')
				->setCellValue('P8', 'Solution Entered Time')
				->setCellValue('Q8', 'Solution File')
				->setCellValue('R8', 'Remarks')
				->setCellValue('S8', 'User ID')
				->setCellValue('T8', 'Error ID')
				->setCellValue('U8', 'Authorized')
				->setCellValue('V8', 'Authorized Group')
				->setCellValue('W8', 'Team Leader Remarks')
				->setCellValue('X8', 'Authorized Person')
				->setCellValue('Y8', 'Authorized Date&amp;Time')
				->setCellValue('Z8', 'Flag');
		
			$j =9;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:Z3')->applyFromArray($styleArray);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Anonymous')
				->setCellValue('C3', 'Reported By')
				->setCellValue('D3', 'Product Name')
				->setCellValue('E3', 'Product Version')
				->setCellValue('F3', 'Database')
				->setCellValue('G3', 'Date')
				->setCellValue('H3', 'Time')
				->setCellValue('I3', 'Error Reported')
				->setCellValue('J3', 'Error Understood')
				->setCellValue('K3', 'Reported To')
				->setCellValue('L3', 'Error File')
				->setCellValue('M3', 'Status')
				->setCellValue('N3', 'Solved Date')
				->setCellValue('O3', 'Solution Given')
				->setCellValue('P3', 'Solution Entered Time')
				->setCellValue('Q3', 'Solution File')
				->setCellValue('R3', 'Remarks')
				->setCellValue('S3', 'User ID')
				->setCellValue('T3', 'Error ID')
				->setCellValue('U3', 'Authorized')
				->setCellValue('V3', 'Authorized Group')
				->setCellValue('W3', 'Team Leader Remarks')
				->setCellValue('X3', 'Authorized Person')
				->setCellValue('Y3', 'Authorized Date&amp;Time')
				->setCellValue('Z3', 'Flag');
			$j =4;
			$slno= 0;
	}
	while($fetchres = mysql_fetch_array($fetch11))
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
				->setCellValue('I' . $j,$fetchres['errorreported'])
				->setCellValue('J' . $j,$fetchres['errorunderstood'])
				->setCellValue('K' . $j,$fetchres['reportedto'])
				->setCellValue('L' . $j,$fetchres['errorfile'])
				->setCellValue('M' . $j,$fetchres['status'])
				->setCellValue('N' . $j,changedateformat($fetchres['solveddate']))
				->setCellValue('O' . $j,$fetchres['solutiongiven'])
				->setCellValue('P' . $j,$fetchres['solutionenteredtime'])
				->setCellValue('Q' . $j,$fetchres['solutionfile'])
				->setCellValue('R' . $j,$fetchres['remarks'])
				->setCellValue('S' . $j,$fetchres['userid'])
				->setCellValue('T' . $j,$fetchres['errorid'])
				->setCellValue('U' . $j,$fetchres['authorized'])
				->setCellValue('V' . $j,$fetchres['authorizedgroup'])
				->setCellValue('W' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('X' . $j,$fetchres['authorizedperson'])
				->setCellValue('Y' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('Z' . $j,$fetchres['flag']);
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
		$myDataRange = 'A9:'.$myLastCell;
		if(mysql_num_rows($fetch11) <> 0)
		{
			//Apply style to content area range
			$mySheet->getStyle($myDataRange)->applyFromArray($styleArrayContent);
		}
	}
	else
	{
		//Deine the content range
		$myDataRange = 'A4:'.$myLastCell;
		if(mysql_num_rows($fetch11) <> 0)
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
	$mySheet->getColumnDimension('J')->setWidth(45);
	$mySheet->getColumnDimension('K')->setWidth(25);
	$mySheet->getColumnDimension('L')->setWidth(25);
	$mySheet->getColumnDimension('M')->setWidth(11);
	$mySheet->getColumnDimension('N')->setWidth(11);
	$mySheet->getColumnDimension('O')->setWidth(10);
	$mySheet->getColumnDimension('P')->setWidth(10);
	$mySheet->getColumnDimension('Q')->setWidth(18);
	$mySheet->getColumnDimension('R')->setWidth(45);
	$mySheet->getColumnDimension('S')->setWidth(13);
	$mySheet->getColumnDimension('T')->setWidth(12);
	$mySheet->getColumnDimension('U')->setWidth(11);
	$mySheet->getColumnDimension('V')->setWidth(17);
	$mySheet->getColumnDimension('W')->setWidth(17);
	$mySheet->getColumnDimension('X')->setWidth(10);
	$mySheet->getColumnDimension('Y')->setWidth(10);
	$mySheet->getColumnDimension('Z')->setWidth(10);

	/*$highestRow1  = $highestRow + 3;
	$mySheet->setCellValue('A' . $highestRow1,'test')
				->setCellValue('B' . $highestRow1,'test2');*/
				
				
	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_EER".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_EER".$localdate."-".$localtime.".zip";
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
