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
		$s_userid = $_POST['s_userid']; $s_transferredto= $_POST['s_transferredto']; $s_compliantid = $_POST['s_compliantid'];
		$orderby = $_POST['orderby']; $s_flags = $_POST['s_flags'];$s_supportunit = $_POST['s_supportunit'];
		$s_anonymous = $_POST['s_anonymous']; 
		$s_anonymouspiece = ($s_anonymous == "")?(""):(" AND ssm_callregister.anonymous LIKE '%".$s_anonymous."%'"); 
		$s_customernamepiece = ($s_customername == "")?(""):(" AND ssm_callregister.customername LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND ssm_callregister.customerid LIKE '%".$s_customerid."%'");
		
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

		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_callregister.productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND ssm_callregister.status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND ssm_callregister.userid = '".$s_userid."'");
		$s_problempiece = ($s_problem == "")?(""):(" AND ssm_callregister.problem LIKE '%".$s_problem."%'");
		$s_transferredtopiece  = ($s_transferredto == "")?(""):(" AND ssm_callregister.transferredto LIKE '%".$s_transferredto."%'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND ssm_callregister.compliantid LIKE '%".$s_compliantid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		$s_flagspiece = ($s_flags == "")?(""):(" AND ssm_callregister.flag = '".$s_flags."'");
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_callregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_callregister.customerid'; break;
			case 'date': $orderbyfield = 'ssm_callregister.date'; break;
			case 'category': $orderbyfield = 'ssm_callregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_callregister.calltype'; break;
			case 'productname': $orderbyfield = 'ssm_callregister.productname'; break;
			case 'problem': $orderbyfield = 'ssm_callregister.problem'; break;
			case 'status': $orderbyfield = 'ssm_callregister.status'; break;
			case 'userid': $orderbyfield = 'ssm_callregister.userid'; break;
			case 'transferredto': $orderbyfield = 'ssm_callregister.transferredto'; break;
			case 'compliantid': $orderbyfield = 'ssm_callregister.compliantid'; break;		
			case 'time': $orderbyfield = 'ssm_callregister.time'; break;	
		}
$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'solved'");
$totsolvedcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'unsolved'");
$totunsolvedcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'transferred'");
$tottranscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(*) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND status = 'registration given'");
$totregcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'");
$totcustomers = $query['counts'];

$query = runmysqlqueryfetch("SELECT count(*) AS counts FROM (SELECT customername FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' GROUP BY customername HAVING COUNT(customername) > 10) AS tablename");
$totcustomers1 = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer'");
$totdlrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'solved'");
$totdlrscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'unsolved'");
$totdlruscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'transferred'");
$totdlrtcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'dealer' AND status = 'registration given'");
$totdlrrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer'");
$totcuscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'solved'");
$totcusscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'unsolved'");
$totcususcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'transferred'");
$totcustcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'customer' AND status = 'registration given'");
$totcusrcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee'");
$totoscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'solved'");
$totosscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'unsolved'");
$totosuscalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'transferred'");
$totostcalls = $query['counts'];

$query = runmysqlqueryfetch("SELECT COUNT(DISTINCT customerid) AS counts FROM ssm_callregister WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."' AND callertype = 'employee' AND status = 'registration given'");
$totosrcalls = $query['counts'];


$query = "SELECT  ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece." ORDER BY `time` DESC , ".$orderbyfield;
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
	
		$query11 = "SELECT  ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_categorypiece.$s_callertypepiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_problempiece.$s_transferredtopiece.$s_compliantidpiece.$s_supportunitpiece.$s_flagspiece."  ORDER BY `time` DESC , ".$orderbyfield."
limit ".$startlimit.",".$limit."" ;

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
				->setCellValue('A2', 'Call Register Details Report');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	if($i == 0)
	{
		//Apply style for header Row
		$mySheet->getStyle('A15:X15')->applyFromArray($styleArray);
		$mySheet->getStyle('C3:D12')->applyFromArray($stylesheetfortotal);
		
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Total Number of calls')
				->setCellValue('C4', 'Number of Solved Calls')
				->setCellValue('C5', 'Number of unsolved calls')
				->setCellValue('C6', 'Number of Transferred Calls')
				->setCellValue('C7', 'Number of Registration Given')
				->setCellValue('C8', 'Total Number of Customers called')
				->setCellValue('C9', 'Number of Customer who has called more than once')
				->setCellValue('C10', 'Calls by Dealers')
				->setCellValue('C11', 'Calls by Customers')
				->setCellValue('C12', 'Calls by Out Station Employees');
				
				
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D3',$totcalls)
				->setCellValue('D4',$totsolvedcalls)
				->setCellValue('D5',$totunsolvedcalls)
				->setCellValue('D6',$tottranscalls)
				->setCellValue('D7',$totregcalls)
				->setCellValue('D8',$totcustomers)
				->setCellValue('D9',$totcustomers1)
				->setCellValue('D10',$totdlrcalls .' '.'('.$totdlrscalls .'Solved'.')'.' '.'('.$totdlruscalls .'Un Solved'.')'.' '.'('.$totdlrtcalls .'Transferred'.')'.' '.'('.$totdlrrcalls .'Registration'.')'.']')
				->setCellValue('D11',$totcuscalls .' '.'('.$totcusscalls .'Solved'.')'.' '.'('.$totcususcalls .'Un Solved'.')'.' '.'('.$totcustcalls .'Transferred'.')'.' '.'('.$totcusrcalls .'Registration'.')'.']')
				->setCellValue('D12', $totdlrcalls .' '.'('.$totdlrscalls .'Solved'.')'.' '.'('.$totdlruscalls .'Un Solved'.')'.' '.'('.$totdlrtcalls .'Transferred'.')'.' '.'('.$totdlrrcalls .'Registration'.')'.']');
		
		
			
		//Fille contents for Header Row
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A15', 'Sl No')
				->setCellValue('B15', 'Anonymous')
				->setCellValue('C15', 'Customer Name')
				->setCellValue('D15', 'Customer ID')
				->setCellValue('E15', 'Date')
				->setCellValue('F15', 'Start Time')
				->setCellValue('G15', 'End Time')
				->setCellValue('H15', 'Duration')
				->setCellValue('I15', 'Person Name')
				->setCellValue('J15', 'Category')
				->setCellValue('K15', 'Caller Type')
				->setCellValue('L15', 'Product Name')
				->setCellValue('M15', 'Product Version')
				->setCellValue('N15', 'Problem')
				->setCellValue('O15', 'Status')
				->setCellValue('P15', 'Remote Connection')
				->setCellValue('Q15', 'Remarks')
				->setCellValue('R15', 'User Id')
				->setCellValue('S15', 'Compliant ID')
				->setCellValue('T15', 'Authorized')
				->setCellValue('U15', 'Authorized Group')
				->setCellValue('V15', 'Team Leader Remarks')
				->setCellValue('W15', 'Authorized Person')
				->setCellValue('X15', 'Authorized Date&amp;Time');
		
			$j =16;
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
				->setCellValue('E3', 'Date')
				->setCellValue('F3', 'Start Time')
				->setCellValue('G3', 'End Time')
				->setCellValue('H3', 'Duration')
				->setCellValue('I3', 'Person Name')
				->setCellValue('J3', 'Category')
				->setCellValue('K3', 'Caller Type')
				->setCellValue('L3', 'Product Name')
				->setCellValue('M3', 'Product Version')
				->setCellValue('N3', 'Problem')
				->setCellValue('O3', 'Status')
				->setCellValue('P3', 'Remote Connection')
				->setCellValue('Q3', 'Remarks')
				->setCellValue('R3', 'User Id')
				->setCellValue('S3', 'Compliant ID')
				->setCellValue('T3', 'Authorized')
				->setCellValue('U3', 'Authorized Group')
				->setCellValue('V3', 'Team Leader Remarks')
				->setCellValue('W3', 'Authorized Person')
				->setCellValue('X3', 'Authorized Date&amp;Time');
		
			$j =4;
			$slno= 0;
	}
	while($fetchres = mysqli_fetch_array($fetch11))
	{
		$slno++;
		$starttime = $fetchres['time'];
		$endtime = $fetchres['endtime'];
		$diff = gettimeDifference($fetchres['date'],$starttime,$fetchres['date'],$endtime);
		$mySheet->setCellValue('A' . $j,$slno)
				->setCellValue('B' . $j,$fetchres['anonymous'])
				->setCellValue('C' . $j,$fetchres['customername'])
				->setCellValue('D' . $j,$fetchres['customerid'])
				->setCellValue('E' . $j,changedateformat($fetchres['date'], 75, "<br />\n"))
				->setCellValue('F' . $j,$fetchres['time'])
				->setCellValue('G' . $j,$fetchres['endtime'])
				->setCellValue('H' . $j,$diff)
				->setCellValue('I' . $j,$fetchres['personname'])
				->setCellValue('J' . $j,$fetchres['category'])
				->setCellValue('K' . $j,$fetchres['callertype'])
				->setCellValue('L' . $j,$fetchres['productname'])
				->setCellValue('M' . $j,$fetchres['productversion'])
				->setCellValue('N' . $j,$fetchres['problem'])
				->setCellValue('O' . $j,$fetchres['status'])
				->setCellValue('P' . $j,$fetchres['stremoteconnection'])
				->setCellValue('Q' . $j,$fetchres['remarks'])
				->setCellValue('R' . $j,$fetchres['username'])
				->setCellValue('S' . $j,$fetchres['compliantid'])
				->setCellValue('T' . $j,$fetchres['authorized'])
				->setCellValue('U' . $j,$fetchres['categoryheading'])
				->setCellValue('V' . $j,$fetchres['teamleaderremarks'])
				->setCellValue('W' . $j,$fetchres['authorizedperson'])
				->setCellValue('X' . $j,$fetchres['authorizeddatetime']);
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
	$mySheet->getColumnDimension('E')->setWidth(9);
	$mySheet->getColumnDimension('F')->setWidth(9);
	$mySheet->getColumnDimension('G')->setWidth(9);
	$mySheet->getColumnDimension('H')->setWidth(9);
	$mySheet->getColumnDimension('I')->setWidth(25);
	$mySheet->getColumnDimension('J')->setWidth(9);
	$mySheet->getColumnDimension('K')->setWidth(12);
	$mySheet->getColumnDimension('L')->setWidth(25);
	$mySheet->getColumnDimension('M')->setWidth(9);
	$mySheet->getColumnDimension('N')->setWidth(35);
	$mySheet->getColumnDimension('O')->setWidth(10);
	$mySheet->getColumnDimension('P')->setWidth(35);
	$mySheet->getColumnDimension('Q')->setWidth(18);
	$mySheet->getColumnDimension('R')->setWidth(10);
	$mySheet->getColumnDimension('S')->setWidth(10);
	$mySheet->getColumnDimension('T')->setWidth(30);
	$mySheet->getColumnDimension('U')->setWidth(30);
	$mySheet->getColumnDimension('V')->setWidth(30);
	$mySheet->getColumnDimension('W')->setWidth(18);
	$mySheet->getColumnDimension('X')->setWidth(25);

	/*$highestRow1  = $highestRow + 3;
	$mySheet->setCellValue('A' . $highestRow1,'test')
				->setCellValue('B' . $highestRow1,'test2');*/
				
				
	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_CR".$localdate."-".$localtime.$i.".xls";

	$addstring = "/support";
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "vijaykumar"))
		$addstring = "/saralimax-ssm";

	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

	$filezipname = "S_CR".$localdate."-".$localtime.".zip";
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
