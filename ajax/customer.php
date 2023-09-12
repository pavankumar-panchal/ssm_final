<?php
//include('../inc/ajax-referer-security.php');
include('../functions/phpfunctions.php');
//include('../inc/checkpermission.php');
//include('../softkey/regfunction.bin');

ob_start("ob_gzhandler");
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;
}
$lastslno = $_POST['lastslno'];
$switchtype = $_POST['switchtype'];
//$userid = $_COOKIE['userid'];
$userid = imaxgetcookie('ssmuserid');

// Current Year 
$currentyear = "2019-20";

switch($switchtype)
{
	case 'save':
	{
		$customerid = $_POST['customerid'];
		$businessname = $_POST['businessname'];
		$address = $_POST['address'];
		$place = $_POST['place'];
		$pincode = $_POST['pincode'];
		$district = $_POST['district'];
		$region = $_POST['region'];
		$category = $_POST['category'];
		$type = $_POST['type'];
		$fax = $_POST['fax'];
		$stdcode = $_POST['stdcode'];
		
		$gst_no = $_POST['gst_no'];
		
		$website = $_POST['website'];
		$remarks = $_POST['remarks'];
		$disablelogin = $_POST['disablelogin'];
		$corporateorder = $_POST['corporateorder'];
		$currentdealer = $_POST['currentdealer'];
		$companyclosed = $_POST['companyclosed'];
		$promotionalsms = $_POST['promotionalsms'];
		$promotionalemail = $_POST['promotionalemail'];
		$createddate = datetimelocal('d-m-Y').' '.datetimelocal('H:i:s');
		$date = datetimelocal('d-m-Y');
		
		$contactarray = $_POST['contactarray'];
		$totalarray = $_POST['totalarray'];
		$totalsplit = explode(',',$totalarray);
		$contactsplit = explode('****',$contactarray);
		$contactcount = count($contactsplit);
		if($contactcount > 1)
		{
			for($i=0;$i<$contactcount;$i++)
			{
				$contactressplit[] = explode('#',$contactsplit[$i]);
			}
		}
		else
		{
			for($i=0;$i<$contactcount;$i++)
			{
				$contactressplit[] = explode('#',$contactsplit[$i]);
			}
		}

		$query1 = "Select * from inv_customerproduct where customerreference = '".$lastslno."'";
		$result1 = runmysqlquery($query1);
		if(mysqli_num_rows($result1) == 0)
		{
			$query = "update inv_mas_customer set businessname = '".$businessname."',address = '".$address."',
			place = '".$place."',district = '".$district."',pincode = '".$pincode."',stdcode = '".$stdcode."',
			fax = '".$fax."',website = '".$website."',type = '".$type."',companyclosed = '".$companyclosed."',
			category = '".$category."' ,lastmodifieddate = '".date('Y-m-d').' '.date('H:i:s')."',
			lastmodifiedby = '".$userid."',lastmodifiedip = '".$_SERVER['REMOTE_ADDR']."'
			where slno = '".$lastslno."';";
			$result = runmysqlquery($query);
			
			for($i=0;$i<count($totalsplit);$i++)
				{
					$deleteslno = $totalsplit[$i];
					$query22 = "DELETE FROM inv_contactdetails WHERE slno = '".$deleteslno."'";
					$result = runmysqlquery($query22);
				}
				for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone = $contactressplit[$j][2];
					$cell = $contactressplit[$j][3];
					$emailid = $contactressplit[$j][4];
					$slno = $contactressplit[$j][5];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					if($slno <> '')
					{
						$query21 = "UPDATE inv_contactdetails SET contactperson = '".$contactperson."',
						phone = '".$phonevalue."',cell = '".$cellvalue."',emailid = '".$emailidvalue."',
						selectiontype = '".$selectiontype."' WHERE slno = '".$lastslno."'";
						$result = runmysqlquery($query21);
					}
					else
					{
						$query21 = "Insert into inv_contactdetails(customerid,selectiontype,contactperson,phone,cell,emailid)
						 values  ('".$lastslno."','".$selectiontype."','".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."');";
						$result = runmysqlquery($query21);
					}
				}
					
			echo("2^"."Customer Record Saved Successfully");
		}
		else
		{
			$countquery = "SELECT COUNT(*) as count FROM inv_customerreqpending WHERE customerid = '".$lastslno."' 
			AND requestfrom = 'support_module' AND customerstatus = 'pending';";
			$countfetch = runmysqlqueryfetch($countquery);
			if($countfetch['count'] <> 0)
			{
			
				$countquery2 = "SELECT COUNT(*) as count FROM inv_contactreqpending WHERE customerid = '".$lastslno."' 
				AND requestfrom = 'support_module' AND customerstatus = 'pending';";
				$countfetch2 = runmysqlqueryfetch($countquery2);
				if($countfetch2['count'] <> 0)
				{
					$query1 = "UPDATE inv_contactreqpending SET customerstatus = 'oldrequest'
					 WHERE customerid = '".$lastslno."' AND requestfrom = 'support_module' AND customerstatus = 'pending';";
					$result = runmysqlquery($query1);
				}
				$query = "UPDATE inv_customerreqpending SET customerstatus = 'oldrequest' WHERE customerid = '".$lastslno."' 				AND requestfrom = 'support_module' AND customerstatus = 'pending';";
				$result = runmysqlquery($query);
				
				$query = runmysqlqueryfetch("SELECT (MAX(slno) + 1) AS slno FROM inv_customerreqpending");
				$slno = $query['slno'];

		$query1 = "Insert into inv_customerreqpending(slno,customerid,businessname,address,place,district,pincode,
		stdcode,website,type,category,createddate,customerstatus,requestfrom,requestby,fax,companyclosed,remarks,
		promotionalsms,promotionalemail,gst_no) values('".$slno."','".$lastslno."','".trim($businessname)."','".$address."',
				'".$place."','".$district."','".$pincode."','".$stdcode."','".$website."','".$type."','".$category."',
				'".changedateformatwithtime($createddate)."','pending','support_module','".$userid."','".$fax."',
				'".$companyclosed."','".$remarks."','".$promotionalsms."','".$promotionalemail."','".$gst_no."')";
				$result1 = runmysqlquery($query1);
				if($totalarray <> '')
				{
					$query22 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid from inv_contactdetails where slno IN (".$totalarray.")";
					$result29 = runmysqlquery($query22);
					while($fetchres = mysqli_fetch_array($result29))
					{
							$selectiontype1 = $fetchres['selectiontype'];
							$contactperson1 = $fetchres['contactperson'];
							$phone1 = $fetchres['phone'];
							$cell1 = $fetchres['cell'];
							$emailid1= $fetchres['emailid'];
							
							$query4 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,
							cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$lastslno."',
							'".$selectiontype1."','".$contactperson1."','".$phone1."','".$cell1."','".$emailid1."','pending',
							'support_module','delete_type');";
							$result = runmysqlquery($query4);
					}
				}
				
				for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone = $contactressplit[$j][2];
					$cell = $contactressplit[$j][3];
					$emailid = $contactressplit[$j][4];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					
					$query2 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,
					emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$lastslno."','".$selectiontype."',
					'".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."','pending','support_module',
					'edit_type');";
					$result = runmysqlquery($query2);
				}
				
				$updateddata = $lastslno."|^|".$businessname."|^|".$address."|^|".$place."|^|".$district."|^|".$pincode."|^|".
				$stdcode."|^|".$website."|^|".$type."|^|".$category."|^|".$createddate."|^|".$fax."|^|".$userid."|^|".
				$companyclosed."|^|".$contactarray;
				$query2 = "Insert into inv_logs_pendingrequest(userid,type,updateddata,updateddate,updatedtime,system) 
				values('".$userid."','support_module','".$updateddata."','".datetimelocal('Y-m-d')."',
				'".datetimelocal('H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
				$result2 = runmysqlquery($query2);
	
			}
			else
			{
			
				$query = runmysqlqueryfetch("SELECT (MAX(slno) + 1) AS slno FROM inv_customerreqpending");
				$slno = $query['slno'];

				$query = "Insert into inv_customerreqpending(slno,customerid,businessname,address,place,district,pincode,
				stdcode,website,type,category,createddate,customerstatus,requestfrom,requestby,fax,companyclosed,remarks,
				promotionalsms,promotionalemail,gst_no) values('".$slno."','".$lastslno."','".trim($businessname)."','".$address."',
				'".$place."','".$district."','".$pincode."','".$stdcode."','".$website."','".$type."','".$category."',
				'".changedateformatwithtime($createddate)."','pending','support_module','".$userid."','".$fax."',
				'".$companyclosed."','".$remarks."','".$promotionalsms."','".$promotionalemail."','".$gst_no."')";
				$result = runmysqlquery($query);
				if($totalarray <> '')
				{
					$query22 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid 
					from inv_contactdetails where slno IN (".$totalarray.")";
					$result29 = runmysqlquery($query22);
					while($fetchres = mysqli_fetch_array($result29))
					{
							$selectiontype1 = $fetchres['selectiontype'];
							$contactperson1 = $fetchres['contactperson'];
							$phone1 = $fetchres['phone'];
							$cell1 = $fetchres['cell'];
							$emailid1= $fetchres['emailid'];
							
							$query4 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,
							cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$lastslno."',
							'".$selectiontype1."','".$contactperson1."','".$phone1."','".$cell1."','".$emailid1."','pending',
							'support_module','delete_type');";
							$result = runmysqlquery($query4);
					}
				}
				for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone = $contactressplit[$j][2];
					$cell = $contactressplit[$j][3];
					$emailid = $contactressplit[$j][4];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					
					$query2 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,
					emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$lastslno."','".$selectiontype."',
					'".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."','pending','support_module',
					'edit_type');";
					$result = runmysqlquery($query2);
				}
				
				$updateddata = $lastslno."|^|".$businessname."|^|".$address."|^|".$place."|^|".$district."|^|".$pincode."|^|".
				$stdcode."|^|".$website."|^|".$type."|^|".$category."|^|".$createddate."|^|".$fax."|^|".$userid."|^|".
				$contactarray;
				$query2 = "Insert into inv_logs_pendingrequest(userid,type,updateddata,updateddate,updatedtime,system) 
				values('".$userid."','support_module','".$updateddata."','".datetimelocal('Y-m-d')."',
				'".datetimelocal('H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
				$result2 = runmysqlquery($query2);			
			}
			echo("2^"."Customer Record  Saved Successfully");
		}

	}
	break;
	case 'generatecustomerlist':
	{
		$query = "SELECT slno,businessname,customerid FROM inv_mas_customer ORDER BY businessname";
		$result = runmysqlquery($query);
		$grid = '';
		$count = 1;
		while($fetch = mysqli_fetch_array($result))
		{
			if($count > 1)
				$grid .='^*^';
			$grid .= $fetch['businessname'].'^'.$fetch['slno'];
			$count++;
		}
		echo($grid);
	}
	break;
	
	case 'searchcustomerlist':
	{
		$databasefield = $_POST['databasefield'];
		$textfield = $_POST['textfield'];
		$state = $_POST['state'];
		$region = $_POST['region'];
		$dealer = $_POST['dealer2'];
		$district = $_POST['district'];
		$type2 = $_POST['type2'];
		$category2= $_POST['category2'];
		$productslist = str_replace('\\','',$_POST['productscode']);
		$branch2 = $_POST['branch2'];
		$regionpiece = ($region == "")?(""):(" AND inv_mas_customer.region = '".$region."' ");
		$state_typepiece = ($state == "")?(""):(" AND inv_mas_district.statecode = '".$state."' ");
		$district_typepiece = ($district == "")?(""):(" AND inv_mas_customer.district = '".$district."' ");
		$dealer_typepiece = ($dealer == "")?(""):(" AND inv_mas_customer.currentdealer = '".$dealer."' ");
		$branchpiece = ($branch2 == "")?(""):(" AND inv_mas_customer.branch = '".$branch2."' ");
		if($type2 == 'Not Selected')
		{
			$typepiece = ($type2 == "")?(""):(" AND inv_mas_customer.type = ''");
		}
		else
		{
			$typepiece = ($type2 == "")?(""):(" AND inv_mas_customer.type = '".$type2."'");
		}
		if($category2 == 'Not Selected')
		{
			$categorypiece = ($category2 == "")?(""):(" AND inv_mas_customer.category = ''");
		}
		else
		{
			$categorypiece = ($category2 == "")?(""):(" AND inv_mas_customer.category = '".$category2."'");
		}	
		switch($databasefield)
		{
			case "slno":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> '' 
				and (inv_mas_customer.slno LIKE '%".$textfield."%' OR inv_mas_customer.customerid LIKE '%".$textfield."%') 
				".$regionpiece.$district_typepiece.$state_typepiece.$branchpiece.$typepiece.$categorypiece."  
				ORDER BY businessname ";
				break;
			case "region":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and inv_mas_customer.customerid <> ''
				and inv_mas_region.category LIKE '".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname";
				break;
			case "contactperson": 
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer 
				left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				left join inv_contactdetails on inv_contactdetails.customerid = inv_mas_customer.slno
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> '' 
				and inv_contactdetails.contactperson LIKE '%".$textfield."%'   ".$regionpiece.$district_typepiece.
				$state_typepiece.$branchpiece.$typepiece.$categorypiece.$typepiece.$categorypiece."  
				ORDER BY businessname";
				break;
			case "phone":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				left join inv_contactdetails on inv_contactdetails.customerid = inv_mas_customer.slno
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL
				and  inv_mas_customer.customerid <> '' and inv_contactdetails.phone LIKE '%".$textfield."%' 
				OR inv_contactdetails.cell LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname ";
				break;
			case "place":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist."))	as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> '' 
				and inv_mas_customer.place LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname";
				break;
			case "emailid":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname from 
				inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district left 
				join inv_contactdetails on inv_contactdetails.customerid = inv_mas_customer.slno
                LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
               LEFT JOIN (select distinct customerreference from inv_customerproduct 
			   where left(computerid,3)  IN (".$productslist.")) 
               as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
               where inv_customerproduct.customerreference IS NOT NULL and inv_contactdetails.emailid LIKE '%".$textfield."%' 
			   ".$regionpiece.$district_typepiece.$state_typepiece.$dealer_typepiece.$branchpiece.$typepiece.$categorypiece."  
			   ORDER BY businessname";
				break;
				case "cardid":
					$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, 
					inv_mas_customer.businessname AS businessname  
					FROM inv_mas_customer LEFT JOIN (inv_customerproduct 
					LEFT JOIN inv_mas_scratchcard ON inv_customerproduct.cardid = inv_mas_scratchcard.cardid) 
					ON  inv_mas_customer.slno = inv_customerproduct.customerreference 
					left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
					left join inv_mas_product on left(inv_customerproduct.computerid,3) IN (".$productslist.")
					left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
					left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
					WHERE inv_mas_customer.customerid <> '' and inv_mas_scratchcard.cardid LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname";
					break;
			case "scratchnumber":
				$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname  
				FROM inv_mas_customer LEFT JOIN (inv_customerproduct LEFT JOIN inv_mas_scratchcard 
				ON inv_customerproduct.cardid = inv_mas_scratchcard.cardid) 
				ON  inv_mas_customer.slno = inv_customerproduct.customerreference 
				left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				left join inv_mas_product on left(inv_customerproduct.computerid,3) IN (".$productslist.")
				left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
				WHERE inv_mas_customer.customerid <> '' and inv_mas_scratchcard.scratchnumber LIKE '%".$textfield."%' ".
				$regionpiece.$district_typepiece.$state_typepiece.$branchpiece.$typepiece.$categorypiece."  
				ORDER BY businessname ";
				break;
			case "computerid":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference,computerid from inv_customerproduct  
				where left(computerid,3) not IN ('')) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> '' 
				and inv_customerproduct.computerid LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname";
				break;
			case "softkey":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference,softkey from inv_customerproduct  where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> ''
				and inv_customerproduct.softkey LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$grouppiece.
				$state_typepiece.$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname ";
				break;
			case "billno":
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
				LEFT JOIN (select distinct customerreference,billnumber from inv_customerproduct  where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and  inv_mas_customer.customerid <> ''
				and inv_customerproduct.billnumber LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname ";
				break;
			
			case 'businessname':
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL  and 
				inv_mas_customer.businessname LIKE '%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.
				$branchpiece.$typepiece.$categorypiece."  ORDER BY businessname ";
				break;
			default:
				$query = "select DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.businessname AS businessname 
				from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
				LEFT JOIN (select distinct customerreference from inv_customerproduct where left(computerid,3)  
				IN (".$productslist.")) as inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
				where inv_customerproduct.customerreference IS NOT NULL and inv_mas_customer.businessname LIKE 
				'%".$textfield."%' ".$regionpiece.$district_typepiece.$state_typepiece.$branchpiece.$typepiece.$categorypiece."  
				ORDER BY businessname";
				break;
		}
			$result = runmysqlquery($query);
			$grid = '';
			$count = 0;
			while($fetch = mysqli_fetch_array($result))
			{
				if($count > 0)
					$grid .='^*^';
				$grid .= $fetch['businessname'].'^'.$fetch['slno'];
				$count++;
				
			}
		echo($grid);
		//echo($query);
	}
	break;
	
	case 'customerdetailstoform':
	{
		$countquery = "SELECT * FROM inv_customerreqpending WHERE customerid = '".$lastslno."'
		AND requestfrom = 'support_module' and inv_customerreqpending.customerstatus ='pending';";
		$countresult = runmysqlquery($countquery);
		if(mysqli_num_rows($countresult) == 0)
		{
			$query1 = "SELECT count(*) as count from inv_mas_customer where slno = '".$lastslno."'";
			$fetch1 = runmysqlqueryfetch($query1);
			if($fetch1['count'] > 0)
			{			
				$query = "SELECT inv_mas_customer.slno, inv_mas_customer.customerid, inv_mas_customer.businessname, inv_mas_customer.gst_no,
				inv_mas_customer.address, inv_mas_customer.place, inv_mas_customer.district,inv_mas_district.statecode as state,
				inv_mas_customer.pincode, inv_mas_customer.fax, inv_mas_region.category as region, inv_mas_customer.stdcode,
			inv_mas_customer.website, inv_mas_customer.companyclosed, inv_mas_branch.branchname as branch,
				inv_mas_customer.category,inv_mas_customer.type, inv_mas_customer.remarks, inv_mas_dealer.businessname 
				as dealerbusinessname,inv_mas_customer.password, inv_mas_customer.passwordchanged, 
				inv_mas_customer.disablelogin,inv_mas_customer.promotionalsms,inv_mas_customer.promotionalemail, 
				inv_mas_customer.corporateorder,inv_mas_customer.createddate,inv_mas_customer.activecustomer, 
				inv_mas_users.fullname, inv_mas_product.productname,inv_mas_customer.initialpassword as password 
				FROM inv_mas_customer 
				LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_mas_customer.firstproduct 
				LEFT JOIN inv_mas_users ON inv_mas_customer.createdby = inv_mas_users.slno 
				left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
				left join inv_mas_dealer on inv_mas_dealer.slno= inv_mas_customer.currentdealer
				left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region
				left join inv_mas_branch on inv_mas_branch.slno = inv_mas_district.branchid
				where inv_mas_customer.slno = '".$lastslno."' ";
				
				$query1 = "select ssm_callregister.status,ssm_callregister.callcategory ,ssm_callregister.customerid 
				from ssm_callregister  where  ssm_callregister.callcategory = '2' and ssm_callregister.status = 'solved'  
				and  ssm_callregister.customerid = '".$lastslno."' ";
				$result = runmysqlquery($query1);
				if(mysqli_num_rows($result) <> 0)
				{
					$status = 'Complete';
				}
				else
				{
					$query1 = "select ssm_callregister.status,ssm_callregister.callcategory,ssm_callregister.customerid  
					from ssm_callregister  where ssm_callregister.callcategory = '2' and ssm_callregister.status = 'unsolved' 
					and ssm_callregister.customerid = '".$lastslno."' ";
					$result = runmysqlquery($query1);
					if(mysqli_num_rows($result) <> 0)
					{
						$status = 'Under Process';
					}
					else
					{
						$status = 'Not Done';
					}
				}
				$fetch = runmysqlqueryfetch($query);
				$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno 
				from inv_contactdetails where customerid = '".$lastslno."'; ";
				$resultfetch = runmysqlquery($query1);
				$valuecount = 0;
				while($fetchres = mysqli_fetch_array($resultfetch))
				{
					if(!isset($contactarray))
					{
						$contactarray = null;	
					}
					if($valuecount > 0)
						$contactarray .= '****';
					$selectiontype = $fetchres['selectiontype'];
					$contactperson = $fetchres['contactperson'];
					$phone = $fetchres['phone'];
					$cell = $fetchres['cell'];
					$emailid = $fetchres['emailid'];
					$slno = $fetchres['slno'];
					
					$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
					$valuecount++;
					
				}
				$grid = '';
				if($fetch['customerid'] == '')
				
					$customerid = '';
				
				else
				
				$customerid = cusidcombine($fetch['customerid']);
				
				// 2013- 14 Summary
				$query2 = "select * from 
				(select distinct inv_mas_product.group from inv_mas_product where inv_mas_product.group in ('TDS','SPP','STO',
				'SAC','XBRL','GST') and inv_mas_product.year = '".$currentyear."') as groups
				left join
				(select distinct inv_mas_product.group as bills from inv_invoicenumbers join inv_dealercard 
				on inv_dealercard.invoiceid = inv_invoicenumbers.slno left join inv_mas_product 
				on inv_dealercard.productcode = inv_mas_product.productcode 
				where  right(inv_invoicenumbers.customerid,5) = '".$lastslno."' and inv_mas_product.year = '".$currentyear."') 
				as bills on bills.bills = groups.group
				left join
				(select distinct inv_mas_product.group as pins from inv_dealercard join inv_mas_product 
				on inv_dealercard.productcode = inv_mas_product.productcode 
				where  inv_dealercard.customerreference = '".$lastslno."' and inv_mas_product.year = '".$currentyear."') 
				as pins	on pins.pins = groups.group
				left join
				(select distinct inv_mas_product.group as registrations from inv_customerproduct 
				join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode 
				where  inv_customerproduct.customerreference = '".$lastslno."' and inv_mas_product.year = '".$currentyear."')
				as registrations on registrations.registrations = groups.group order by groups.group desc"; //echo($query2);exit;

			$result2 = runmysqlquery($query2);
			
			$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="4" class="table-border-grid">';
			$grid .= '<tr bgcolor = "#E2F1F1">';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center" ></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>Bill</strong></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>PIN</strong></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>Regn</strong>
			</td>';
  			$grid .= '</tr>';
			$i_n = 0;
			while($fetch2 = mysqli_fetch_array($result2))
			{
				$i_n++;
				$slno++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				
				$bills = ($fetch2['bills'] == '')?'NO':'YES';
				$pins = ($fetch2['pins'] == '')?'NO':'YES';
				$registrations = ($fetch2['registrations'] == '')?'NO':'YES';
				
				$billbgcolor = ($bills == 'YES')?'#c1ddb9':'#FFD9D9';
				$pinsbgcolor = ($pins == 'YES')?'#c1ddb9':'#FFD9D9';
				$registrationsbgcolor = ($registrations == 'YES')?'#c1ddb9':'#FFD9D9';
				
				
				$grid .= '<tr>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor = "#E2F1F1"><strong>'.$fetch2['group'].'</strong></td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center" bgcolor='.$billbgcolor.'>'.$bills.'</td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor='.$pinsbgcolor.'>'.$pins.'</td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor='.$registrationsbgcolor.'>'.$registrations.'</td>';
				$grid .= '</tr>';
			}
			$grid .= '</table>';

			$query_gst = "select gst_no as new_gst_no from customer_gstin_logs where customer_slno=". $lastslno." order by gstin_id desc limit 1";
			$result_gst = runmysqlquery($query_gst);
			$count_gst= mysqli_num_rows($result_gst);

			if($count_gst > 0)
			{
				$fetch_gst = runmysqlqueryfetch($query_gst);
				$new_gst_no = $fetch_gst['new_gst_no'];
			}
			else
			{
				$new_gst_no = $fetch['gst_no'];
			}
				
				echo($fetch['slno'].'^'.$customerid.'^'.$fetch['businessname'].'^'.$fetch['address'].'^'.$fetch['place'].'^'.$fetch['district'].'^'.$fetch['state'].'^'.$fetch['pincode'].'^'.$fetch['stdcode'].'^'.$fetch['website'].'^'.$fetch['category'].'^'.$fetch['type'].'^'.$fetch['remarks'].'^'.$fetch['dealerbusinessname'].'^'.$fetch['disablelogin'].'^'.changedateformatwithtime($fetch['createddate']).'^'.strtolower($fetch['corporateorder']).'^'.$fetch['fax'].'^'.$userid.'^'.''.'^'.$fetch['activecustomer'].'^'.$fetch['region'].'^'.$fetch['branch'].'^'.$fetch['companyclosed'].'^'.$status.'^'.$fetch['password'].'^'.$fetch['passwordchanged'].'^'.$contactarray.'^'.$fetch['promotionalsms'].'^'.$fetch['promotionalemail'].'^'.$new_gst_no.'^'.$grid);
			}
			else
			{
				echo($lastslno.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.'');
			}
		}
		else
		{
			$query = "SELECT inv_customerreqpending.slno as refslno,inv_customerreqpending.customerid as tempid,inv_customerreqpending.gst_no as gst_no,
			inv_mas_customer.customerid, inv_customerreqpending.businessname, inv_customerreqpending.address, 
			inv_customerreqpending.place,inv_mas_district.statecode as state, inv_customerreqpending.district, 
			inv_customerreqpending.pincode, inv_customerreqpending.fax, inv_customerreqpending.stdcode, 
			inv_customerreqpending.website, inv_customerreqpending.type,
			inv_customerreqpending.companyclosed,inv_mas_branch.branchname as branch,inv_customerreqpending.promotionalsms,
			inv_customerreqpending.promotionalemail,inv_customerreqpending.remarks, inv_mas_customer.currentdealer, 
			inv_mas_customer.password, inv_mas_customer.category, inv_mas_customer.passwordchanged, inv_mas_customer.disablelogin, 
			inv_mas_customer.corporateorder,inv_mas_customer.activecustomer,inv_customerreqpending.createddate, 
			inv_mas_users.fullname,inv_mas_product.productname ,inv_mas_region.category as region,
			inv_mas_dealer.businessname as dealerbusinessname,inv_mas_customer.initialpassword as password 
			FROM inv_customerreqpending 
			LEFT JOIN inv_mas_customer on inv_mas_customer.slno = inv_customerreqpending.customerid
			LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_mas_customer.firstproduct 
			LEFT JOIN inv_mas_users ON inv_mas_customer.createdby = inv_mas_users.slno 
			left join inv_mas_district on inv_customerreqpending.district = inv_mas_district.districtcode 
			left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region
			left join inv_mas_dealer on inv_mas_dealer.slno = inv_mas_customer.currentdealer
			left join inv_mas_branch on inv_mas_branch.slno = inv_mas_district.branchid
			where inv_customerreqpending.customerid = '".$lastslno."'AND requestfrom = 'support_module' 
			and inv_customerreqpending.customerstatus ='pending';";
				$query1 = "select ssm_callregister.status,ssm_callregister.callcategory ,ssm_callregister.customerid from ssm_callregister  where  ssm_callregister.callcategory = '2' and ssm_callregister.status = 'solved'  and  ssm_callregister.customerid = '".$lastslno."' ";
				$result = runmysqlquery($query1);
				if(mysqli_num_rows($result) <> 0)
				{
					$status = 'Complete';
				}
				else
				{
					$query1 = "select ssm_callregister.status,ssm_callregister.callcategory,ssm_callregister.customerid  
					from ssm_callregister  where ssm_callregister.callcategory = '2' and ssm_callregister.status = 'unsolved' 
					and ssm_callregister.customerid = '".$lastslno."' ";
					$result = runmysqlquery($query1);
					if(mysqli_num_rows($result) <> 0)
					{
						$status = 'Under Process';
					}
					else
					{
						$status = 'Not Done';
					}
				}
				$fetch = runmysqlqueryfetch($query);
				$query1 ="SELECT refslno,customerid,contactperson,selectiontype,phone,cell,emailid,slno 
				from inv_contactreqpending where refslno = '".$fetch['refslno']."' and editedtype = 'edit_type'; ";
				$resultfetch = runmysqlquery($query1);
				$valuecount = 0;
				while($fetchres = mysqli_fetch_array($resultfetch))
				{
					if($valuecount > 0)
						$contactarray .= '****';
					$selectiontype = $fetchres['selectiontype'];
					$contactperson = $fetchres['contactperson'];
					$phone = $fetchres['phone'];
					$cell = $fetchres['cell'];
					$emailid = $fetchres['emailid'];
					$slno = $fetchres['slno'];
					
					$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
					$valuecount++;
					
				}
				if($fetch['customerid'] == '')
					$customerid = '';
					else
					$customerid = cusidcombine($fetch['customerid']);
					
				// 2011-12 Summary
				
				$query2 = "select * from 
				(select distinct inv_mas_product.group from inv_mas_product where inv_mas_product.group in ('TDS','SPP','STO',
				'SAC','GST') and inv_mas_product.year = '".$currentyear."') as groups
				left join
				(select distinct inv_mas_product.group as bills from inv_invoicenumbers join inv_dealercard 
				on inv_dealercard.invoiceid = inv_invoicenumbers.slno left join inv_mas_product 
				on inv_dealercard.productcode = inv_mas_product.productcode 
				where  right(inv_invoicenumbers.customerid,5) = '".$lastslno."' and inv_mas_product.year = '".$currentyear."')
				as bills on bills.bills = groups.group
				left join
				(select distinct inv_mas_product.group as pins from inv_dealercard join inv_mas_product 
				on inv_dealercard.productcode = inv_mas_product.productcode 
				where  inv_dealercard.customerreference = '".$lastslno."' and inv_mas_product.year = '".$currentyear."') 
				as pins on pins.pins = groups.group
				left join
				(select distinct inv_mas_product.group as registrations from inv_customerproduct join inv_mas_product 
				on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode 
				where  inv_customerproduct.customerreference = '".$lastslno."' and inv_mas_product.year = '".$currentyear."') 
				as registrations on registrations.registrations = groups.group order by groups.group desc"; //echo($query2);exit;

			$result2 = runmysqlquery($query2);
			$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="4" class="table-border-grid">';
			$grid .= '<tr bgcolor = "#E2F1F1">';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center" ></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>Bill</strong></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>PIN</strong></td>';
			$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"><strong>Regn</strong>
			</td>';
  			$grid .= '</tr>';
			$i_n = 0;
			while($fetch2 = mysqli_fetch_array($result2))
			{
				$i_n++;
				$slno++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				
				$bills = ($fetch2['bills'] == '')?'NO':'YES';
				$pins = ($fetch2['pins'] == '')?'NO':'YES';
				$registrations = ($fetch2['registrations'] == '')?'NO':'YES';
				
				$billbgcolor = ($bills == 'YES')?'#c1ddb9':'#FFD9D9';
				$pinsbgcolor = ($pins == 'YES')?'#c1ddb9':'#FFD9D9';
				$registrationsbgcolor = ($registrations == 'YES')?'#c1ddb9':'#FFD9D9';
				
				
				$grid .= '<tr>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor = "#E2F1F1"><strong>'.$fetch2['group'].'</strong></td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center" bgcolor='.$billbgcolor.'>'.$bills.'</td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor='.$pinsbgcolor.'>'.$pins.'</td>';
				$grid .= '<td nowrap = "nowrap" class="td-border-grid" align="center"  bgcolor='.$registrationsbgcolor.'>'.$registrations.'</td>';
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			
			echo($fetch['tempid'].'^'.$customerid.'^'.$fetch['businessname'].'^'.$fetch['address'].'^'.$fetch['place'].'^'.$fetch['district'].'^'.$fetch['state'].'^'.$fetch['pincode'].'^'.$fetch['stdcode'].'^'.$fetch['website'].'^'.$fetch['category'].'^'.$fetch['type'].'^'.$fetch['remarks'].'^'.$fetch['dealerbusinessname'].'^'.$fetch['disablelogin'].'^'.changedateformatwithtime($fetch['createddate']).'^'.strtolower($fetch['corporateorder']).'^'.$fetch['fax'].'^'.$userid.'^'.'Your Profile request for update is Pending for Approval'.'^'.$fetch['activecustomer'].'^'.$fetch['region'].'^'.$fetch['branch'].'^'.$fetch['companyclosed'].'^'.$status.'^'.$fetch['password'].'^'.$fetch['passwordchanged'].'^'.$contactarray.'^'.$fetch['promotionalsms'].'^'.$fetch['promotionalemail'].'^'.$fetch['gst_no'].'^'.$grid);
	//echo($query);
		}
	}
	break;
	
	case 'searchbycustomerid':
	{
		$customerid = $_POST['customerid'];
		$customeridlen = strlen($customerid);
		$lastcustomerid = substr($customerid, $customeridlen - 5);
			
		if($customeridlen == 5)
			$lastslno = $customerid;
		elseif($customeridlen > 5)
			$lastslno = substr($customerid, $customeridlen - 5);

		$countquery = "SELECT * FROM inv_customerreqpending WHERE customerid = '".$lastslno."'
		AND requestfrom = 'support_module' and inv_customerreqpending.customerstatus ='pending';";
		$countresult = runmysqlquery($countquery);
		if(mysqli_num_rows($countresult) == 0)
		{
			$query1 = "SELECT count(*) as count from inv_mas_customer where slno = '".$lastslno."'";
			$fetch1 = runmysqlqueryfetch($query1);
			if($fetch1['count'] > 0)
			{			
				$query = "SELECT inv_mas_customer.slno, inv_mas_customer.customerid, inv_mas_customer.businessname, 
				inv_mas_customer.address, inv_mas_customer.place, 
				inv_mas_customer.district,inv_mas_district.statecode as state, inv_mas_customer.pincode, 
				inv_mas_customer.fax, inv_mas_region.category as region, inv_mas_customer.stdcode, inv_mas_customer.website, 
				inv_mas_customer.companyclosed, inv_mas_branch.branchname as branch,inv_mas_customer.category,
				inv_mas_customer.type, inv_mas_customer.remarks, inv_mas_dealer.businessname as dealerbusinessname,
				inv_mas_customer.password, inv_mas_customer.passwordchanged, inv_mas_customer.disablelogin, 
				inv_mas_customer.promotionalsms,inv_mas_customer.promotionalemail,inv_mas_customer.corporateorder,
				inv_mas_customer.createddate,inv_mas_customer.activecustomer, inv_mas_users.fullname, 
				inv_mas_product.productname,inv_mas_customer.initialpassword as password FROM inv_mas_customer 
				LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_mas_customer.firstproduct 
				LEFT JOIN inv_mas_users ON inv_mas_customer.createdby = inv_mas_users.slno 
				left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
				left join inv_mas_dealer on inv_mas_dealer.slno= inv_mas_customer.currentdealer
				left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region
				left join inv_mas_branch on inv_mas_branch.slno = inv_mas_district.branchid
				where inv_mas_customer.slno = '".$lastslno."' ";
				$query1 = "select ssm_callregister.status,ssm_callregister.callcategory ,ssm_callregister.customerid 
				from ssm_callregister  where  ssm_callregister.callcategory = '2' and ssm_callregister.status = 'solved'  
				and  ssm_callregister.customerid = '".$lastslno."' ";
				$result = runmysqlquery($query1);
				if(mysqli_num_rows($result) <> 0)
				{
					$status = 'Complete';
				}
				else
				{
					$query1 = "select ssm_callregister.status,ssm_callregister.callcategory,ssm_callregister.customerid  
					from ssm_callregister  where ssm_callregister.callcategory = '2' and ssm_callregister.status = 'unsolved' 
					and ssm_callregister.customerid = '".$lastslno."' ";
					$result = runmysqlquery($query1);
					if(mysqli_num_rows($result) <> 0)
					{
						$status = 'Under Process';
					}
					else
					{
						$status = 'Not Done';
					}
				}
				$fetch = runmysqlqueryfetch($query);
				
				$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails 
				where customerid = '".$lastslno."'; ";
				$resultfetch = runmysqlquery($query1);
				$valuecount = 0;
				while($fetchres = mysqli_fetch_array($resultfetch))
				{
					if($valuecount > 0)
						$contactarray .= '****';
					$selectiontype = $fetchres['selectiontype'];
					$contactperson = $fetchres['contactperson'];
					$phone = $fetchres['phone'];
					$cell = $fetchres['cell'];
					$emailid = $fetchres['emailid'];
					$slno = $fetchres['slno'];
					
					$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
					$valuecount++;
					
				}
				if($fetch['customerid'] == '')
				$customerid = '';
				else
				$customerid = cusidcombine($fetch['customerid']);
					echo($fetch['slno'].'^'.$customerid.'^'.$fetch['businessname'].'^'.$fetch['address'].'^'.
					$fetch['place'].'^'.$fetch['district'].'^'.$fetch['state'].'^'.$fetch['pincode'].'^'.$fetch['stdcode'].'^'.
					$fetch['website'].'^'.$fetch['category'].'^'.$fetch['type'].'^'.$fetch['remarks'].'^'.
					$fetch['dealerbusinessname'].'^'.$fetch['disablelogin'].'^'.
					changedateformatwithtime($fetch['createddate']).'^'.strtolower($fetch['corporateorder']).'^'.
					$fetch['fax'].'^'.$userid.'^'.''.'^'.$fetch['activecustomer'].'^'.$fetch['region'].'^'.$fetch['branch'].'^'.
					$fetch['companyclosed'].'^'.$status.'^'.$fetch['password'].'^'.$fetch['passwordchanged'].'^'.
					$contactarray.'^'.$fetch['promotionalsms'].'^'.$fetch['promotionalemail']);
			}
			else
			{
				echo(''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.''.'^'.'');
			}
		}
		else
		{
			$query = "SELECT inv_customerreqpending.slno as refslno,inv_customerreqpending.customerid as tempid,
			inv_mas_customer.customerid, inv_customerreqpending.businessname, inv_customerreqpending.address, 
			inv_customerreqpending.place,inv_mas_district.statecode as state, inv_customerreqpending.district, 
			inv_customerreqpending.pincode, inv_customerreqpending.fax, inv_customerreqpending.stdcode, 
			inv_customerreqpending.website, inv_customerreqpending.category, inv_customerreqpending.type,
			inv_customerreqpending.companyclosed,inv_mas_branch.branchname as branch,inv_customerreqpending.promotionalsms,
			inv_customerreqpending.promotionalemail,inv_customerreqpending.remarks, inv_mas_customer.currentdealer, 
			inv_mas_customer.password, inv_mas_customer.passwordchanged, inv_mas_customer.disablelogin, 
			inv_mas_customer.corporateorder,inv_mas_customer.activecustomer,inv_customerreqpending.createddate, 
			inv_mas_users.fullname,inv_mas_product.productname ,inv_mas_region.category as region,
			inv_mas_dealer.businessname as dealerbusinessname,inv_mas_customer.initialpassword as password 
			FROM inv_customerreqpending 
			LEFT JOIN inv_mas_customer on inv_mas_customer.slno = inv_customerreqpending.customerid
			LEFT JOIN inv_mas_product ON inv_mas_product.productcode = inv_mas_customer.firstproduct 
			LEFT JOIN inv_mas_users ON inv_mas_customer.createdby = inv_mas_users.slno 
			left join inv_mas_district on inv_customerreqpending.district = inv_mas_district.districtcode 
			left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region
			left join inv_mas_dealer on inv_mas_dealer.slno = inv_mas_customer.currentdealer
			left join inv_mas_branch on inv_mas_branch.slno = inv_mas_district.branchid
			where inv_customerreqpending.customerid = '".$lastslno."'AND requestfrom = 'support_module' 
			and inv_customerreqpending.customerstatus ='pending';";
				$query1 = "select ssm_callregister.status,ssm_callregister.callcategory ,ssm_callregister.customerid 
				from ssm_callregister  where  ssm_callregister.callcategory = '2' and ssm_callregister.status = 'solved'  
				and  ssm_callregister.customerid = '".$lastslno."' ";
				$result = runmysqlquery($query1);
				if(mysqli_num_rows($result) <> 0)
				{
					$status = 'Complete';
				}
				else
				{
					$query1 = "select ssm_callregister.status,ssm_callregister.callcategory,ssm_callregister.customerid  
					from ssm_callregister  where ssm_callregister.callcategory = '2' and 
					ssm_callregister.status = 'unsolved' and ssm_callregister.customerid = '".$lastslno."' ";
					$result = runmysqlquery($query1);
					if(mysqli_num_rows($result) <> 0)
					{
						$status = 'Under Process';
					}
					else
					{
						$status = 'Not Done';
					}
				}
				$fetch = runmysqlqueryfetch($query);
				$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno 
				from inv_contactreqpending where refslno = '".$fetch['refslno']."' and editedtype = 'edit_type'; ";
				$resultfetch = runmysqlquery($query1);
				$valuecount = 0;
				while($fetchres = mysqli_fetch_array($resultfetch))
				{
					if($valuecount > 0)
						$contactarray .= '****';
					$selectiontype = $fetchres['selectiontype'];
					$contactperson = $fetchres['contactperson'];
					$phone = $fetchres['phone'];
					$cell = $fetchres['cell'];
					$emailid = $fetchres['emailid'];
					$slno = $fetchres['slno'];
					
					$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
					$valuecount++;
					
				}
				if($fetch['customerid'] == '')
					$customerid = '';
					else
					$customerid = cusidcombine($fetch['customerid']);
						echo($fetch['tempid'].'^'.$customerid.'^'.$fetch['businessname'].'^'.$fetch['address'].'^'.
						$fetch['place'].'^'.$fetch['district'].'^'.$fetch['state'].'^'.$fetch['pincode'].'^'.
						$fetch['stdcode'].'^'.$fetch['website'].'^'.$fetch['category'].'^'.$fetch['type'].'^'.
						$fetch['remarks'].'^'.$fetch['dealerbusinessname'].'^'.$fetch['disablelogin'].'^'
						.changedateformatwithtime($fetch['createddate']).'^'.strtolower($fetch['corporateorder']).'^'.
						$fetch['fax'].'^'.$userid.'^'.'Your Profile request for update is Pending for Approval'.'^'.
						$fetch['activecustomer'].'^'.$fetch['region'].'^'.$fetch['branch'].'^'.$fetch['companyclosed'].'^'.
						$status.'^'.$fetch['password'].'^'.$fetch['passwordchanged'].'^'.$contactarray.'^'.
						$fetch['promotionalsms'].'^'.$fetch['promotionalemail']);
	//echo($query);
		}
	}
	break;
	
	case 'customerregistration':
	{
		$more = "";
		
		if(!isset($_POST['slno']))
		{
			$_POST['slno'] = null;
		}
		if(!isset($_POST['showtype']))
		{
			$_POST['showtype'] = null;
		}

		$startlimit = $_POST['startlimit'];
		$slno = $_POST['slno'];
		$showtype = $_POST['showtype'];
		$resultcount = "SELECT inv_mas_product.productname as productname FROM inv_customerproduct
		left join inv_mas_scratchcard on  inv_customerproduct.cardid = inv_mas_scratchcard.cardid 
		left join inv_mas_product on left(inv_customerproduct.computerid, 3) = inv_mas_product.productcode
		left join inv_mas_users on inv_customerproduct.generatedby = inv_mas_users.slno 
		left join inv_mas_dealer on inv_customerproduct.dealerid = inv_mas_dealer.slno  
		where customerreference = '".$lastslno."' order by `date`  desc,`time` desc ; ";
		$resultfetch = runmysqlquery($resultcount);
		$fetchresultcount = mysqli_num_rows($resultfetch);
		if($showtype == 'all')
		$limit = 100000;
		else
		$limit = 10;
		if($startlimit == '')
		{
			$startlimit = 0;
			$slno = 0;
		}
		else
		{
			$startlimit = $slno;
			$slno = $slno;
		}
			$query = "SELECT inv_mas_product.productname as productname,inv_mas_scratchcard.scratchnumber AS cardid, 
			inv_customerproduct.computerid AS computerid,inv_customerproduct.softkey AS softkey,inv_customerproduct.date AS 
			regdate, inv_customerproduct.time AS regtime, inv_mas_users.fullname AS generatedby, 
			inv_mas_dealer.businessname AS businessname,inv_customerproduct.billnumber as Billnum,
			inv_customerproduct.billamount as billamount,inv_customerproduct.remarks as remarks 
			FROM inv_customerproduct 
			left join inv_mas_scratchcard on  inv_customerproduct.cardid = inv_mas_scratchcard.cardid
			left join inv_mas_product on left(inv_customerproduct.computerid, 3) = inv_mas_product.productcode 
			left join inv_mas_users on inv_customerproduct.generatedby = inv_mas_users.slno 
			left join inv_mas_dealer on inv_customerproduct.dealerid = inv_mas_dealer.slno  
			where customerreference = '".$lastslno."' order by `date`  desc,`time` desc LIMIT ".$startlimit.",".$limit."; ";
		$result = runmysqlquery($query);
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			//$grid = '<tr><td><table width="100%" cellpadding="3" cellspacing="0">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Pin No</td>
						<td nowrap = "nowrap" class="td-border-grid">Computer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Surrender</td>
						<td nowrap = "nowrap" class="td-border-grid">Soft Key</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Generatd By</td>
						<td nowrap = "nowrap" class="td-border-grid">Dealer</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill No</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					</tr>';
		}
		
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			//echo "pin" . $fetch['cardid'] . "<br>";
			$PIN = $fetch['cardid'];
			
			if($fetch['cardid']!= "")
			{
				$query0 = "select inv_customerproduct.AUTOREGISTRATIONYN
				from inv_customerproduct 
				left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid
				where inv_mas_scratchcard.scratchnumber = '".$fetch['cardid']."'";
				$fetch0 = runmysqlqueryfetch($query0);
				$autoregistration = $fetch0['AUTOREGISTRATIONYN'];
			}
				
			if($autoregistration == 'Y')
			{
				## Calling Function surrender($PIN,$lastslno)##
				$result07 = surrender($PIN,$lastslno);
				##total count for active and surrender list##
				$totalcount = $result07[0] + $result07[1];
				
				$more= "<a href'#' class='resendtext' Onclick = 'displaysurrender(\"$PIN\",\"$lastslno\");' 
				style='cursor:pointer;'>more (".$totalcount.")</a>";
			}
			if($autoregistration == 'N')
				$more="";
			
			$i_n++;
			$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['cardid']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['computerid']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$more."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['softkey']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['regdate'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changetimeformat($fetch['regtime'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['generatedby']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['businessname']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['Billnum']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['billamount']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "</tr>";
			
		}
		$grid .= "</table>";
		$fetchcount = mysqli_num_rows($result);
		
		if(!isset($linkgrid))
		{
			$linkgrid = null;	
		}
		if($slno >= $fetchresultcount)
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
							<tr>
								<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
							</tr>
						</table>';
		else
			$linkgrid .= '<table>
							<tr>
								<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmorecustomerregistration(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'more\');">Show More Records >>
</a><span class="text1"><a onclick ="getmorecustomerregistration(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'all\');" >(Show All Records)</a></span></div></td></tr></table>';
	
		echo $grid.'^'.$fetchresultcount.'^'.$linkgrid;
	}
	break;
	
	case 'surrenderhistory':
	{
		$lastslno = $_POST['lastslno'];
		$PIN = $_POST['pin'];
		
		$query1 = "select * from inv_customerproduct where customerreference = '".$lastslno."' 
					and getPINNo(inv_customerproduct.cardid)= '".$PIN."' and AUTOREGISTRATIONYN = 'Y'";
		$fetchresult = runmysqlqueryfetch($query1);
		$refslno = $fetchresult['slno'];
		$HDDID = $fetchresult['HDDID'];
		$ETHID = $fetchresult['ETHID'];
		$REGDATE = $fetchresult['REGDATE'];
		$datetime = $fetchresult['date']." ".$fetchresult['time'];
		
		
		$query2 = "select * from inv_surrenderproduct where refslno = '".$refslno."'";
		$resultfetch = runmysqlquery($query2);
		$fetchresultcount = mysqli_num_rows($resultfetch);

		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
		<td nowrap = "nowrap" class="td-border-grid" align="left">Sl No</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Status</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Computer Name</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Computer IP</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Created By</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Date</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">REGDATE</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">HDDID</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">ETHID</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Remarks</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">Network IP</td>
		<td nowrap = "nowrap" class="td-border-grid" align="left">System IP</td>
		</tr>';
		$i_n = 0;$slno = 0;
		if($HDDID <> "")
		{
			$i_n++;
			$slno++;
			$status = "Active";	
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1" bgcolor='.$color.' style="font-weight:bold;">';
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$slno."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$status."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['COMPUTERNAME']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['COMPUTERIP']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['CREATEDBY']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".changedateformatwithtime($datetime)."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".changedateformatwithtime($REGDATE)."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['HDDID']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['ETHID']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetchresult['forceremarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>&nbsp;</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>&nbsp;</td>";
			$grid .= "</tr>";
		}
		if($fetchresultcount > 0)
		{
			//inv_customerproduct.customerreference, inv_customerproduct.slno,
			$query = "select inv_surrenderproduct.COMPUTERNAME,inv_surrenderproduct.COMPUTERIP,
			inv_surrenderproduct.CREATEDBY,inv_surrenderproduct.surrendertime,inv_surrenderproduct.REGDATE,
			inv_surrenderproduct.HDDID,inv_surrenderproduct.ETHID,inv_surrenderproduct.forceremarks,
			inv_surrenderproduct.networkip, inv_surrenderproduct.systemip 
			from inv_customerproduct 
			INNER JOIN inv_surrenderproduct ON inv_surrenderproduct.refslno=inv_customerproduct.slno where 
			inv_customerproduct.customerreference='".$lastslno."' 
			and getPINNo(inv_customerproduct.cardid)= '".$PIN."' order by inv_surrenderproduct.slno desc";	
			$result = runmysqlquery($query);
		
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$slno."</td>";
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 0)
				$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>Surrender</td>";
				
				if($i == 3 || $i == 4)
				$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".changedateformatwithtime($fetch[$i])."</td>";
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetch[$i]."</td>";
				
			}
			$grid .= "</tr>";
		}
	}
		$grid .= "</table>";
		echo('1^'.$grid);
	}
	break;

	case 'generatecustomerattachcards':
	{
		$lastslno = $_POST['lastslno'];
		$query = "select inv_mas_scratchcard.cardid,inv_mas_scratchcard.scratchnumber,inv_mas_dealer.businessname,
		inv_mas_product.productname,inv_dealercard.purchasetype,inv_dealercard.usagetype,inv_dealercard.free,
		inv_mas_scheme.schemename,inv_dealercard.cuscardattacheddate,inv_dealercard.remarks from inv_dealercard 
		left join inv_mas_scratchcard on inv_dealercard.cardid =inv_mas_scratchcard.cardid 
		left join inv_mas_dealer on inv_dealercard.dealerid = inv_mas_dealer.slno 
		left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode 
		left join inv_mas_scheme on inv_mas_scheme.slno = inv_dealercard.scheme where customerreference ='".$lastslno."' 
		and inv_mas_scratchcard.registered = 'no' order by inv_dealercard.cuscardattacheddate;";
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Card No</td>
					<td nowrap = "nowrap" class="td-border-grid">Pin No</td>
					<td nowrap = "nowrap" class="td-border-grid">Dealer</td>
					<td nowrap = "nowrap" class="td-border-grid">product</td>
					<td nowrap = "nowrap" class="td-border-grid">Usage Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Purchase Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Free</td>
					<td nowrap = "nowrap" class="td-border-grid">Scheme</td>
					<td nowrap = "nowrap" class="td-border-grid">Attached Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
				</tr>';
		$i_n = 0;$slno = 0;
		$result = runmysqlquery($query);
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno."</td>";
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 8)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformatwithtime($fetch[$i])."</td>";
				else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch[$i])."</td>";
				
			}
			$grid .= "</tr>";
		}
		$grid .= "</table>";
		echo($grid);
	}
	break;
	case 'generateoutgoingcalls':
	{
		$lastslno = $_POST['lastslno'];
		$query = "SELECT ssm_callregister.slno AS slno, ssm_callregister.flag AS flag,ssm_callregister.anonymous AS anonymous,
		ssm_callregister.calltype AS calltype, ssm_callregister.customername AS customername, ssm_callregister.customerid AS 
		customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.endtime AS endtime, 
		ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype 
		AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, 
		ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS 
		stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid 
		AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, 
		ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username1, 
		ssm_callregister.authorizeddatetime AS authorizeddatetime FROM ssm_callregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname 
		LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		where ssm_callregister.calltype = 'outgoing' and ssm_callregister.customerid ='".$lastslno."' ''";
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					<td nowrap = "nowrap" class="td-border-grid">Call Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Start Time</td>
					<td nowrap = "nowrap" class="td-border-grid">End Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Duration</td>
					<td nowrap = "nowrap" class="td-border-grid">User Id</td>
					<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
					<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
				</tr>';
		$i_n = 0;$slno = 0;
		$result = runmysqlquery($query);
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$color;
			$dot = '...';
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1"  bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['slno'], 75, "<br />\n")."</td>";
			if($fetch['flag'] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
			else
			$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['calltype'], 75, "<br />\n")."</td>";	
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['time'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['endtime'], 75, "<br />\n")."</td>";
			$starttime = $fetch['time'];
			$endtime = $fetch['endtime'];
			$diff = gettimeDifference($fetch['date'],$starttime,$fetch['date'],$endtime);
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$diff."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['anonymous'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['customerid'], 75, "<br />\n")."</td>";
			if(strlen($fetch['customername']) > 20)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['customername'],0,20)."".$dot."</td>";
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>";	
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['personname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['category'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['callertype'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productname'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['productversion'], 75, "<br />\n")."</td>";
			if(strlen($fetch['problem']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['problem'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>";
			if(strlen($fetch['remarks']) > 30)
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".substr($fetch['remarks'],0,30)."".$dot."</td>";
			else
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['status'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['stremoteconnection'], 75, "<br />\n")."</td>";

			
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['compliantid'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorized'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['categoryheading'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['teamleaderremarks'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['username1'], 75, "<br />\n")."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch['authorizeddatetime'], 75, "<br />\n")."</td>";
			
			$grid .= '</tr>';
		}
		$grid .= '</table>';
	}
		echo($grid);
	break;
	case 'rcidetailsgrid':
	{
		$startlimit = $_POST['startlimit'];
		$slno = $_POST['slno'];
		$showtype = $_POST['showtype'];
		$lastslno = $_POST['lastslno'];
		$resultcount = "select customerid,registeredname,inv_mas_product.productname,pinnumber,computerid,productversion,
		operatingsystem,processor,`date`,servicename from inv_logs_webservices 
		left join inv_mas_product on inv_mas_product.productcode = left(inv_logs_webservices.computerid,3) 
		where right(customerid,5) = '".$lastslno."' order by `date`  desc; ";
		$resultfetch = runmysqlquery_old($resultcount);
		$fetchresultcount = mysqli_num_rows($resultfetch);
		if($showtype == 'all')
		$limit = 100000;
		else
		$limit = 10;
		if($startlimit == '')
		{
			$startlimit = 0;
			$slno = 0;
		}
		else
		{
			$startlimit = $slno ;
			$slno = $slno;
		}
		$query = "select `date`,inv_mas_product.productname,productversion,operatingsystem,processor,registeredname,pinnumber,
		computerid,servicename from inv_logs_webservices 
		left join inv_mas_product on inv_mas_product.productcode = left(inv_logs_webservices.computerid,3) 
		where right(customerid,5) = '".$lastslno."' order by `date`  desc LIMIT ".$startlimit.",".$limit."; ";
		$result = runmysqlquery_old($query);
		if($startlimit == 0)
		{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid" align="left">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Date</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Product Name</td
					><td nowrap = "nowrap" class="td-border-grid" align="left">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Operating System</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Processor</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Registered Name</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">PIN Number</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Computer ID</td>
					<td nowrap = "nowrap" class="td-border-grid" align="left">Service Name</td>
				</tr>';
		}
		
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$slno."</td>";
			for($i = 0; $i < count($fetch); $i++)
			{
				
				if($i == 0)
					$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".changedateformatwithtime($fetch[$i])."</td>";
				else
					$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetch[$i]."</td>";
			}
			$grid .= "</tr>";
		}
		$grid .= "</table>";

		$fetchcount = mysqli_num_rows($result);
		if($slno >= $fetchresultcount)
		$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
						<tr>
							<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
						</tr>
					</table>';
		else
		$linkgrid .= '<table>
						<tr>
							<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmorercidetails(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'more\');" style="cursor:pointer">
Show More Records >></a>&nbsp;&nbsp;&nbsp;
<a onclick ="getmorercidetails(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'all\');" class ="resendtext1"
 style="cursor:pointer"><font color= "#000000">(Show All Records)</font></a></div></td></tr></table>';
		
	
		echo '1^'.$grid.'^'.$fetchresultcount.'^'.$linkgrid;
	}
	break;
	case 'invoicedetailsgrid':
	{
		$startlimit = $_POST['startlimit'];
		$slno = $_POST['slno'];
		$showtype = $_POST['showtype'];
		$lastslno = $_POST['lastslno'];
		$query = "select customerid from inv_mas_customer where slno = '".$lastslno."';";
		$resultfetch= runmysqlqueryfetch($query);
		$customerref = cusidcombine($resultfetch['customerid']);
		$resultcount = "select customerid,businessname,contactperson,description,invoiceno,dealername,createddate,amount,
		servicetax,netamount,purchasetype
		from inv_invoicenumbers 
		where customerid = '".$customerref."'order by createddate  desc; ";
		$resultfetch = runmysqlquery($resultcount);
		$fetchresultcount = mysqli_num_rows($resultfetch);
		if($showtype == 'all')
		$limit = 100000;
		else
		$limit = 10;
		if($startlimit == '')
		{
			$startlimit = 0;
			$slno = 0;
		}
		else
		{
			$startlimit = $slno ;
			$slno = $slno;
		}
		$query = "select slno,createddate,invoiceno,netamount,createdby
from inv_invoicenumbers where customerid = '".$customerref."' order by createddate  desc LIMIT ".$startlimit.",".$limit."; ";
		$result = runmysqlquery($query);
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid" align="left">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid" align="left">Date</td>
						<td nowrap = "nowrap" class="td-border-grid" align="left">Invoice No</td>
						<td nowrap = "nowrap" class="td-border-grid" align="left">Invoice Amount</td>
						<td nowrap = "nowrap" class="td-border-grid" align="left">Received Amount</td>
                        <td nowrap = "nowrap" class="td-border-grid" align="left">Outstanding Amount</td>
						<td nowrap = "nowrap" class="td-border-grid" align="left">Generated By
<input type="hidden" name="invoicelastslno" id="invoicelastslno" /></td>
					</tr>';
		}
		
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				
			$query3 = "select sum(receiptamount) as receivedamount from inv_mas_receipt where 
			invoiceno = '".$fetch['slno']."' and status != 'CANCELLED';";
			$resultfetch = runmysqlqueryfetch($query3);
			if($resultfetch['receivedamount'] == '')
			{
				$receivedamount = 0;
			}
			else
			{
				$receivedamount = $resultfetch['receivedamount'];
			}
			
			$balanceamount = $fetch['netamount'] - $receivedamount;
					
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$slno."</td> ";
			
			
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".changedateformatwithtime($fetch['createddate'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetch['invoiceno']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetch['netamount']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$receivedamount."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$balanceamount."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid' align='left'>".$fetch['createdby']."</td>";
			
			$grid .= "</tr>";
		}
		$grid .= "</table>";

		$fetchcount = mysqli_num_rows($result);
		if($slno >= $fetchresultcount)
		$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
						<tr>
							<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
						</tr>
					</table>';
		else
		$linkgrid .= '<table>
						<tr>
							<td class="resendtext"><div align ="left" style="padding-right:10px">
<a onclick ="getmoreinvoicedetails(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'more\');" style="cursor:pointer">
Show More Records >></a>&nbsp;&nbsp;&nbsp;
<a onclick ="getmoreinvoicedetails(\''.$lastslno.'\',\''.$startlimit.'\',\''.$slno.'\',\'all\');" class ="resendtext1" 
style="cursor:pointer"><font color= "#000000">(Show All Records)</font></a></div></td></tr></table>';
		
	
		echo '1^'.$grid.'^'.$fetchresultcount.'^'.$linkgrid.'^'.$invoicenosplit[2];
	}
	break;
	
}

function surrender($PIN,$lastslno)
{
	$fetchresult07 = "";
	$query07 ="select inv_customerproduct.customerreference, inv_customerproduct.slno as slno ,getPINNo(inv_customerproduct.cardid) as pin,inv_surrenderproduct.surrendertime,inv_surrenderproduct.networkip, inv_surrenderproduct.systemip 
	from inv_customerproduct 
	INNER JOIN inv_surrenderproduct ON inv_surrenderproduct.refslno=inv_customerproduct.slno where inv_customerproduct.customerreference='".$lastslno."' 
	and getPINNo(inv_customerproduct.cardid)= '".$PIN."'"; 
		$result = runmysqlquery($query07);
		$surrendercount = mysqli_num_rows($result);
		$fetchresult07[0] = $surrendercount;
		
	/*$query08 = "select getPINNo(inv_dealercard.cardid) as Pin,inv_dealercard.usagetype as usagetype 
	,getPINNo(inv_customerproduct.cardid) AS cardid from inv_dealercard 
	left join inv_customerproduct on inv_customerproduct.cardid = inv_dealercard.cardid
	where inv_dealercard.customerreference = '".$lastslno."' and getPINNo(inv_dealercard.cardid) = '".$PIN."'";
	$fetch = runmysqlqueryfetch($query08);
	$fetchresult07[1] = $fetch['usagetype'];*/
	
	$query1 = "select * from inv_customerproduct where customerreference = '".$lastslno."' and getPINNo(inv_customerproduct.cardid)= '".$PIN."' and AUTOREGISTRATIONYN = 'Y' and HDDID <> ''";
	$result1 = runmysqlquery($query1);
	$registeredcount = mysqli_num_rows($result1);
	$fetchresult07[1] = $registeredcount;
	
	return $fetchresult07;
	
}




?>