<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_category = $_POST['s_category'];	$s_productname = $_POST['s_productname']; 
		$s_referencethrough = $_POST['s_referencethrough']; $s_contactperson = $_POST['s_referencethrough']; 
		$s_contactno = $_POST['s_contactno']; $s_contactaddress = $_POST['s_contactaddress']; $s_status = $_POST['s_status'];
		$s_email = $_POST['s_email']; $s_userid = $_POST['s_userid']; $s_referenceid = $_POST['s_referenceid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];  $s_supportunit = $_POST['s_supportunit']; 
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_referenceregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_referenceregister.customername LIKE '%".$s_customername."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
		if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_referenceregister.productname = '".$s_productname."'");
		$s_referencethroughpiece = ($s_referencethrough == "")?(""):(" AND ssm_referenceregister.referencethrough LIKE '%".$s_referencethrough."%'");
		$s_contactpersonpiece = ($s_contactperson == "")?(""):(" AND ssm_referenceregister.contactperson LIKE '%".$s_contactperson."%'");
		$s_contactnopiece = ($s_contactno == "")?(""):(" AND ssm_referenceregister.contactno LIKE '%".$s_contactno."%'");
		$s_contactaddresspiece = ($s_contactaddress == "")?(""):(" AND ssm_referenceregister.contactaddress LIKE '%".$s_contactaddress."%'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_referenceregister.status = '".$s_status."'");
		$s_emailpiece = ($s_email == "")?(""):(" AND ssm_referenceregister.email LIKE '%".$s_email."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_referenceregister.userid = '".$s_userid."'");
		$s_referenceidpiece = ($s_referenceid == "")?(""):(" AND ssm_referenceregister.referenceid LIKE '%".$s_referenceid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_referenceregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_referenceregister.customername'; break;
			case 'category': $orderbyfield = 'ssm_referenceregister.category'; break;
			case 'productname': $orderbyfield = 'ssm_referenceregister.productname'; break;
			case 'referencethrough': $orderbyfield = 'ssm_referenceregister.referencethrough'; break;
			case 'contactno': $orderbyfield = 'ssm_referenceregister.contactno'; break;
			case 'contactaddress': $orderbyfield = 'ssm_referenceregister.contactaddress'; break;
			case 'status': $orderbyfield = 'ssm_referenceregister.status'; break;
			case 'email': $orderbyfield = 'ssm_referenceregister.email'; break;
			case 'userid': $orderbyfield = 'ssm_referenceregister.userid'; break;		
			case 'referenceid': $orderbyfield = 'ssm_referenceregister.referenceid'; break;
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalreference = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='freshlead'");
$totalfreshleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='fake'");
$totalfakeleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='demo given'");
$totaldemoleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='rejected'");
$totalrejectedleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='sold'");
$totalsoldleads = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_referenceregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status ='underprocess'");
$totalunderprocessleads = $query['counts'];

$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.anonymous AS anonymous,ssm_referenceregister.customername AS customername,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno,ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime,ssm_referenceregister.flag AS flag FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailpiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield.";";
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
	
$query11 = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.anonymous AS anonymous,ssm_referenceregister.customername AS customername,ssm_products.productname AS productname, ssm_referenceregister.date AS date, ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, ssm_referenceregister.category AS category, ssm_referenceregister.contactperson AS contactperson, ssm_referenceregister.contactno AS contactno,ssm_referenceregister.contactaddress AS contactaddress, ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_referenceregister.authorizeddatetime AS authorizeddatetime,ssm_referenceregister.flag AS flag FROM ssm_referenceregister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailpiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit.";";
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
				->setCellValue('A2', 'Reference Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A12:V12')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D9')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of References')
				->setCellValue('C4', 'Number of Fresh Leads')
				->setCellValue('C5', 'Number of Fake Leads')
				->setCellValue('C6', 'Number of Demo Given')
				->setCellValue('C7', 'Number of Rejected Leads')
				->setCellValue('C8', 'Number of Leads Sold')
				->setCellValue('C9', 'Number of Leads Under Process');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalreference)
				->setCellValue('D4',$totalfreshleads)
				->setCellValue('D5',$totalfakeleads)
				->setCellValue('D6',$totaldemoleads)
				->setCellValue('D7',$totalrejectedleads)
				->setCellValue('D8',$totalsoldleads)
				->setCellValue('D9',$totalunderprocessleads);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A12', 'Sl No')
				->setCellValue('B12', 'Anonymous')
				->setCellValue('C12', 'Reported By')
				->setCellValue('D12', 'Product Name')
				->setCellValue('E12', 'Date')
				->setCellValue('F12', 'Time')
				->setCellValue('G12', 'Reference Through')
				->setCellValue('H12', 'Category')
				->setCellValue('I12', 'Contact Person')
				->setCellValue('J12', 'Contact No')
				->setCellValue('K12', 'Contact Address')
				->setCellValue('L12', 'Email ID')
				->setCellValue('M12', 'Status')
				->setCellValue('N12', 'Remarks')
				->setCellValue('O12', 'User ID')
				->setCellValue('P12', 'Reference ID')
				->setCellValue('Q12', 'Authorized')
				->setCellValue('R12', 'Authorized Group')
				->setCellValue('S12', 'Team Leader Remarks')
				->setCellValue('T12', 'Authorized Person')
				->setCellValue('U12', 'Authorized Date&amp;Tim')
				->setCellValue('V12', 'Flag');
				
		
			$j =13;
			$slno= 0;
	}
	else
	{
		//Apply style for header Row
		$mySheet->getStyle('A3:V3')->applyFromArray($styleArray);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Anonymous')
				->setCellValue('C3', 'Reported By')
				->setCellValue('D3', 'Product Name')
				->setCellValue('E3', 'Date')
				->setCellValue('F3', 'Time')
				->setCellValue('G3', 'Reference Through')
				->setCellValue('H3', 'Category')
				->setCellValue('I3', 'Contact Person')
				->setCellValue('J3', 'Contact No')
				->setCellValue('K3', 'Contact Address')
				->setCellValue('L3', 'Email ID')
				->setCellValue('M3', 'Status')
				->setCellValue('N3', 'Remarks')
				->setCellValue('O3', 'User ID')
				->setCellValue('P3', 'Reference ID')
				->setCellValue('Q3', 'Authorized')
				->setCellValue('R3', 'Authorized Group')
				->setCellValue('S3', 'Team Leader Remarks')
				->setCellValue('T3', 'Authorized Person')
				->setCellValue('U3', 'Authorized Date&amp;Tim')
				->setCellValue('V3', 'Flag');
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
				->setCellValue('E' . $j,changedateformat($fetchres['date']))
				->setCellValue('F' . $j,$fetchres['time'])
				->setCellValue('G' . $j,$fetchres['referencethrough'])
				->setCellValue('H' . $j,$fetchres['category'])
				->setCellValue('I' . $j,$fetchres['contactperson'])
				->setCellValue('J' . $j,$fetchres['contactno'])
				->setCellValue('K' . $j,$fetchres['contactaddress'])
				->setCellValue('L' . $j,$fetchres['email'])
				->setCellValue('M' . $j,$fetchres['status'])
				->setCellValue('N' . $j,$fetchres['remarks'])
				->setCellValue('O' . $j,$fetchres['userid'])
				->setCellValue('P' . $j,$fetchres['referenceid'])
				->setCellValue('Q' . $j,$fetchres['authorized'])
				->setCellValue('R' . $j,$fetchres['authorizedgroup'])
				->setCellValue('S' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('T' . $j,$fetchres['authorizedperson'])
				->setCellValue('U' . $j,$fetchres['authorizeddatetime'])
				->setCellValue('V' . $j,$fetchres['flag']);
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
	$filebasename = "S_RR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_RR".$localdate."-".$localtime.".zip";
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
