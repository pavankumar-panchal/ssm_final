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
		$s_userid = $_POST['s_userid']; $s_attachment= $_POST['s_attachment']; $s_skypeid = $_POST['s_skypeid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags']; $s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_skyperegister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_skyperegister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_skyperegister.customerid LIKE '%".$s_customerid."%'");
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
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_skyperegister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_skyperegister.status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_skyperegister.userid = '".$s_userid."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_skyperegister.problem LIKE '%".$s_problem."%'");
		$s_attachmentpiece = ($s_attachment == "")?(""):(" AND ssm_skyperegister.attachment LIKE '%".$s_attachment."%'");
		$s_skypeidpiece = ($s_skypeid == "")?(""):(" AND ssm_skyperegister.skypeid LIKE '%".$s_skypeid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_skyperegister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_skyperegister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_skyperegister.customerid'; break;
			case 'date': $orderbyfield = 'ssm_skyperegister.date'; break;
			case 'category': $orderbyfield = 'ssm_skyperegister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_skyperegister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_skyperegister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_skyperegister.problem'; break;
			case 'status': $orderbyfield = 'ssm_skyperegister.status'; break;
			case 'attachment': $orderbyfield = 'ssm_skyperegister.attachment'; break;
			case 'userid': $orderbyfield = 'ssm_skyperegister.userid'; break;
			case 'skypeid': $orderbyfield = 'ssm_skyperegister.skypeid'; break;		
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='solved'");
$totalsolvedskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='unsolved'");
$totalunsolvedskype = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_skyperegister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='registration given'");
$totalregistrationskype = $query['counts'];

$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous, ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_attachmentpiece.$s_skypepiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield.";";
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
	
$query11 = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,ssm_skyperegister.anonymous AS anonymous, ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation,ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_attachmentpiece.$s_skypepiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit.";";
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
		$mySheet->getStyle('A9:X9')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D6')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of Skype')
				->setCellValue('C4', 'Number of Solved Skype')
				->setCellValue('C5', 'Number of Un Solved Skype')
				->setCellValue('C6', 'Number of Registration Given');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalskype)
				->setCellValue('D4',$totalsolvedskype)
				->setCellValue('D5',$totalunsolvedskype)
				->setCellValue('D6',$totalregistrationskype);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A9', 'Sl No')
				->setCellValue('B9', 'Anonymous')
				->setCellValue('C9', 'Customer Name')
				->setCellValue('D9', 'Customer ID')
				->setCellValue('E9', 'Sender')
				->setCellValue('F9', 'Caller Type')
				->setCellValue('G9', 'Date')
				->setCellValue('H9', 'Time')
				->setCellValue('I9', 'Product Name')
				->setCellValue('J9', 'Product Version')
				->setCellValue('K9', 'Category')
				->setCellValue('L9', 'Problem')
				->setCellValue('M9', 'Skype Conversation')
				->setCellValue('N9', 'Attachment')
				->setCellValue('O9', 'Status')
				->setCellValue('P9', 'Remarks')
				->setCellValue('Q9', 'User ID')
				->setCellValue('R9', 'Skype ID')
				->setCellValue('S9', 'Authorized')
				->setCellValue('T9', 'Authorized Group')
				->setCellValue('U9', 'Team Leader Remarks')
				->setCellValue('V9', 'Authorized Person')
				->setCellValue('W9', 'Authorized Date&Time')
				->setCellValue('X9', 'Flag');
				
		
			$j =10;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:X3')->applyFromArray($styleArray);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Anonymous')
				->setCellValue('C3', 'Customer Name')
				->setCellValue('D3', 'Customer ID')
				->setCellValue('E3', 'Sender')
				->setCellValue('F3', 'Caller Type')
				->setCellValue('G3', 'Date')
				->setCellValue('H3', 'Time')
				->setCellValue('I3', 'Product Name')
				->setCellValue('J3', 'Product Version')
				->setCellValue('K3', 'Category')
				->setCellValue('L3', 'Problem')
				->setCellValue('M3', 'Skype Conversation')
				->setCellValue('N3', 'Attachment')
				->setCellValue('O3', 'Status')
				->setCellValue('P3', 'Remarks')
				->setCellValue('Q3', 'User ID')
				->setCellValue('R3', 'Skype ID')
				->setCellValue('S3', 'Authorized')
				->setCellValue('T3', 'Authorized Group')
				->setCellValue('U3', 'Team Leader Remarks')
				->setCellValue('V3', 'Authorized Person')
				->setCellValue('W3', 'Authorized Date&Time')
				->setCellValue('X3', 'Flag');
				
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
				->setCellValue('E' . $j,$fetchres['sender'])
				->setCellValue('F' . $j,$fetchres['callertype'])
				->setCellValue('G' . $j,changedateformat($fetchres['date']))
				->setCellValue('H' . $j,$fetchres['time'])
				->setCellValue('I' . $j,$fetchres['productname'])
				->setCellValue('J' . $j,$fetchres['productversion'])
				->setCellValue('K' . $j,$fetchres['category'])
				->setCellValue('L' . $j,$fetchres['problem'])
				->setCellValue('M' . $j,$fetchres['conversation'])
				->setCellValue('N' . $j,$fetchres['attachment'])
				->setCellValue('O' . $j,$fetchres['status'])
				->setCellValue('P' . $j,$fetchres['remarks'])
				->setCellValue('Q' . $j,$fetchres['userid'])
				->setCellValue('R' . $j,$fetchres['skypeid'])
				->setCellValue('S' . $j,$fetchres['authorized'])
				->setCellValue('T' . $j,$fetchres['authorizedgroup'])
				->setCellValue('U' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('V' . $j,$fetchres['authorizedperson'])
				->setCellValue('W' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('X' . $j,$fetchres['flag']);
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
		$myDataRange = 'A10:'.$myLastCell;
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
	$filebasename = "S_SR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_SR".$localdate."-".$localtime.".zip";
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
