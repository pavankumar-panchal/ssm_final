<?php
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

// PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';

		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_anonymous = $_POST['s_anonymous']; 
		$s_customername = $_POST['s_customername']; $s_customerid = $_POST['s_customerid']; 
		$customer = $_POST['s_customer']; $dealer = $_POST['s_dealer']; 
		$employee = $_POST['s_employee']; $ssmuser = $_POST['s_ssmuser']; $s_productname = $_POST['s_productname']; $s_status = $_POST['s_status']; 
		$s_content = $_POST['s_content']; $s_userid = $_POST['s_userid']; $s_forwardedto = $_POST['s_forwardedto']; 
		$s_compliantid = $_POST['s_compliantid']; $s_errorfile = $_POST['s_errorfile']; $orderby = $_POST['orderby']; 
		$s_flags = $_POST['s_flags'];$s_emailid = $_POST['s_emailid']; $s_supportunit = $_POST['s_supportunit'];
		
				
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_emailregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_emailregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_emailregister.customerid LIKE '%".$s_customerid."%'");
		$categorykkg = $_POST['categorykkg']; $categorycsd = $_POST['categorycsd']; $categoryblr = $_POST['categoryblr'];
if(isset($categorykkg) && isset($categoryblr) && isset($categorycsd)) { $s_categorypiece = ""; }
		elseif(isset($categorykkg) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'KKG' OR category 'BLR')"; }
		elseif(isset($categorykkg) && isset($categorycsd)) { $s_categorypiece = " AND (category = 'KKG' OR category 'CSD')"; }
		elseif(isset($categorycsd) && isset($categoryblr)) { $s_categorypiece = " AND (category = 'CSD' OR category 'BLR')"; }
		elseif(isset($categorycsd)) { $s_categorypiece = " AND (category = 'CSD')"; }
		elseif(isset($categoryblr)) { $s_categorypiece = " AND (category = 'BLR')"; }
		elseif(isset($categorykkg)) { $s_categorypiece = " AND (category = 'KKG')"; }		if(isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) { $s_callertypepiece = ""; }
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
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_emailregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_emailregister.status = '".$s_status."'");
		$s_contentpiece = ($s_content == "")?(""):(" AND ssm_emailregister.content LIKE '%".$s_content."%'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_emailregister.userid LIKE '%".$s_userid."%'");
		$s_forwardedtopiece = ($s_forwardedto == "")?(""):(" AND ssm_emailregister.forwardedto  LIKE '%".$s_forwardedto."%'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND ssm_emailregister.compliantid LIKE '%".$s_compliantid."%'");
		$s_errorfilepiece = ($s_errorfile == "")?(""):(" AND ssm_emailregister.errorfile LIKE '%".$s_errorfile."%'");
		$s_emailidpiece = ($s_emailid == "")?(""):(" AND ssm_emailregister.emailid LIKE '%".$s_emailid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_emailregister.flag = '".$s_flags."'");
		
		switch($orderby)
		{
			case 'callertype': $orderbyfield = 'ssm_emailregister.callertype'; break;
			case 'category': $orderbyfield = 'ssm_emailregister.category'; break;
			case 'compliantid': $orderbyfield = 'ssm_emailregister.compliantid'; break;
			case 'content': $orderbyfield = 'ssm_emailregister.content'; break;
			case 'customerid': $orderbyfield = 'ssm_emailregister.customerid'; break;
			case 'customername': $orderbyfield = 'ssm_emailregister.customername'; break;
			case 'date': $orderbyfield = 'ssm_emailregister.date'; break;
			case 'forwardedto': $orderbyfield = 'ssm_emailregister.forwardedto'; break;
			case 'userid': $orderbyfield = 'ssm_emailregister.userid'; break;
			case 'productname': $orderbyfield = 'ssm_emailregister.productname'; break;
			case 'status': $orderbyfield = 'ssm_emailregister.status'; break;	
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totalemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totalsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totalunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'forwarded'");
$totalfrwdedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND anonymous = 'yes'");
$totalcustomeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'solved' AND anonymous = 'yes'");
$totalcustomersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'unsolved' AND anonymous = 'yes'");
$totalcustomerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' and status = 'forwarded' AND anonymous = 'yes'");
$totalcustomerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND anonymous = 'no'");
$totalnoncustomeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved' AND anonymous = 'no'");
$totalnoncustomersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved' AND anonymous = 'no'");
$totalnoncustomerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'forwarded' AND anonymous = 'no'");
$totalnoncustomerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND anonymous = 'yes'");
$totaldealeremail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'solved' AND anonymous = 'yes'");
$totaldealersolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'unsolved' AND anonymous = 'yes'");
$totaldealerunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'forwarded' AND anonymous = 'yes'");
$totaldealerforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND anonymous = 'yes'");
$totaloseemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'solved' AND anonymous = 'yes'");
$totalosesolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'unsolved' AND anonymous = 'yes'");
$totaloseunsolvedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'forwarded' AND anonymous = 'yes'");
$totaloseforwardedemail = $query['counts'];
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_emailregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND thankingemail = 'yes'");
$totalthankingemail = $query['counts'];


$query = "SELECT ssm_emailregister.slno AS slno, ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,ssm_emailregister.flag AS flag FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_anonymouspiece.$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailidpiece.$s_contentpiece.$s_useridpiece.$s_forwardedtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield;
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
	
$query11 = "SELECT ssm_emailregister.slno AS slno, ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,ssm_emailregister.flag AS flag FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_anonymouspiece.$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_emailidpiece.$s_contentpiece.$s_useridpiece.$s_forwardedtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `date` DESC , ".$orderbyfield." limit ".$startlimit.",".$limit."";
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
				->setCellValue('A2', 'Email Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A15:Z15')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D11')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of Emails')
				->setCellValue('C4', 'Number of Solved Emails')
				->setCellValue('C5', 'Number of Un Solved Emails')
				->setCellValue('C6', 'Number of Forwarded Emails')
				->setCellValue('C7', 'Number of Emails By Customers')
				->setCellValue('C8', 'Number of Emails By Non - Customers')
				->setCellValue('C9', 'Number of Emails By Dealers')
				->setCellValue('C10', 'Number of Emails By Outstation Employees')
				->setCellValue('C11', 'Number of Thanking Emails');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totalemail)
				->setCellValue('D4',$totalsolvedemail)
				->setCellValue('D5',$totalunsolvedemail)
				->setCellValue('D6',$totalfrwdedemail)
				->setCellValue('D7',$totalcustomeremail .' '.'('.$totalcustomersolvedemail .'Solved'.')'.' '.'('.$totalcustomerunsolvedemail .'Un Solved'.')'.' '.'('.$totalcustomerforwardedemail .'Forwarded'.')'.']')
				->setCellValue('D8',$totalnoncustomeremail .' '.'('.$totalnoncustomersolvedemail .'Solved'.')'.' '.'('.$totalnoncustomerunsolvedemail .'Un Solved'.')'.' '.'('.$totalnoncustomerforwardedemail .'Forwarded'.')'.']')
				->setCellValue('D9',$totaldealeremail .' '.'('.$totaldealersolvedemail .'Solved'.')'.' '.'('.$totaldealerunsolvedemail .'Un Solved'.')'.' '.'('.$totaldealerforwardedemail .'Forwarded'.')'.']')
				->setCellValue('D10',$totaloseemail .' '.'('.$totalosesolvedemail .'Solved'.')'.' '.'('.$totaloseunsolvedemail .'Un Solved'.')'.' '.'('.$totaloseforwardedemail .'Forwarded'.')'.']')
				->setCellValue('D11',$totalthankingemail);
		
		
			
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A15', 'Sl No')
				->setCellValue('B15', 'Anonymous')
				->setCellValue('C15', 'Customer Name')
				->setCellValue('D15', 'Customer ID')
				->setCellValue('E15', 'Product Name')
				->setCellValue('F15', 'Product Version')
				->setCellValue('G15', 'Date')
				->setCellValue('H15', 'Time')
				->setCellValue('I15', 'Caller Type')
				->setCellValue('J15', 'Category')
				->setCellValue('K15', 'Person Name')
				->setCellValue('L15', 'Email ID')
				->setCellValue('M15', 'Subject')
				->setCellValue('N15', 'Content')
				->setCellValue('O15', 'Error File')
				->setCellValue('P15', 'Status')
				->setCellValue('Q15', 'Thanking Email')
				->setCellValue('R15', 'Remarks')
				->setCellValue('S15', 'User ID')
				->setCellValue('T15', 'Compliant ID')
				->setCellValue('U15', 'Authorized')
				->setCellValue('V15', 'Authorized Group')
				->setCellValue('W15', 'Team Leader Remarks')
				->setCellValue('X15', 'Authorized Person')
				->setCellValue('Y15', 'Authorized Date&amp;Time')
				->setCellValue('Z15', 'Flag');
		
			$j =16;
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
				->setCellValue('C3', 'Customer Name')
				->setCellValue('D3', 'Customer ID')
				->setCellValue('E3', 'Product Name')
				->setCellValue('F3', 'Product Version')
				->setCellValue('G3', 'Date')
				->setCellValue('H3', 'Time')
				->setCellValue('I3', 'Caller Type')
				->setCellValue('J3', 'Category')
				->setCellValue('K3', 'Person Name')
				->setCellValue('L3', 'Email ID')
				->setCellValue('M3', 'Subject')
				->setCellValue('N3', 'Content')
				->setCellValue('O3', 'Error File')
				->setCellValue('P3', 'Status')
				->setCellValue('Q3', 'Thanking Email')
				->setCellValue('R3', 'Remarks')
				->setCellValue('S3', 'User ID')
				->setCellValue('T3', 'Compliant ID')
				->setCellValue('U3', 'Authorized')
				->setCellValue('V3', 'Authorized Group')
				->setCellValue('W3', 'Team Leader Remarks')
				->setCellValue('X3', 'Authorized Person')
				->setCellValue('Y3', 'Authorized Date&amp;Time')
				->setCellValue('Z3', 'Flag');
		
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
				->setCellValue('E' . $j,$fetchres['productname'])
				->setCellValue('F' . $j,$fetchres['productversion'])
				->setCellValue('G' . $j,changedateformat($fetchres['date']))
				->setCellValue('H' . $j,$fetchres['time'])
				->setCellValue('I' . $j,$fetchres['callertype'])
				->setCellValue('J' . $j,$fetchres['category'])
				->setCellValue('K' . $j,$fetchres['personname'])
				->setCellValue('L' . $j,$fetchres['emailid'])
				->setCellValue('M' . $j,$fetchres['subject'])
				->setCellValue('N' . $j,$fetchres['content'])
				->setCellValue('O' . $j,$fetchres['errorfile'])
				->setCellValue('P' . $j,$fetchres['status'])
				->setCellValue('Q' . $j,$fetchres['thankingemail'])
				->setCellValue('R' . $j,$fetchres['remarks'])
				->setCellValue('S' . $j,$fetchres['userid'])
				->setCellValue('T' . $j,$fetchres['compliantid'])
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
		$myDataRange = 'A16:'.$myLastCell;
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
	$mySheet->getColumnDimension('G')->setWidth(9);
	$mySheet->getColumnDimension('H')->setWidth(9);
	$mySheet->getColumnDimension('I')->setWidth(12);
	$mySheet->getColumnDimension('J')->setWidth(9);
	$mySheet->getColumnDimension('K')->setWidth(25);
	$mySheet->getColumnDimension('L')->setWidth(25);
	$mySheet->getColumnDimension('M')->setWidth(30);
	$mySheet->getColumnDimension('N')->setWidth(45);
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
	$filebasename = "S_ER".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_ER".$localdate."-".$localtime.".zip";
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
