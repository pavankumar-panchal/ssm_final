<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
$date = datetimelocal('d-m-Y');
$time = datetimelocal('H:i:s');
if($_POST['type'] == 1)
{
	$customerdb = $_POST['customerdb'];
	$textfield = $_POST['textfield'];
	$subselection = $_POST['subselection'];
	$orderby = $_POST['orderby'];
	
	if($customerdb <> "" && strlen($textfield) > 2)
	{
		switch($customerdb)
		{
			case "invcustomer":
			{
				switch($orderby)
				{
					case "id":
						$orderbyfield = "slno";
						break;
					case "name":
						$orderbyfield = "businessname";
						break;
					case "category":
						$orderbyfield = "region";
						break;
					case "email":
						$orderbyfield = "emailid";
						break;
					case "contact1":
						$orderbyfield = "contactperson";
						break;
					case "phone1":
						$orderbyfield = "phone";
						break;
					case "place":
						$orderbyfield = "place";
						break;		
					case "scratchnumber":
						$orderbyfield = "scratchnumber";
						break;
					case "computerid":
						$orderbyfield = "computerid";
						break;
					default:
						$orderbyfield = "businessname";
						break;
				}
				
				switch($subselection)
				{
					case "id":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 	
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , inv_mas_region.category as 
						region 
						FROM (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, GROUP_CONCAT(phone) as 
						phone, GROUP_CONCAT(contactperson) as contactperson ,customerid from inv_contactdetails group by 
						customerid) as inv_contactdetails left join inv_mas_customer on inv_contactdetails.customerid = 
						inv_mas_customer.slno left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region  
						WHERE  inv_mas_customer.slno LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "name":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state
						FROM (select GROUP_CONCAT(emailid) as emailid, GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,
						customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
						WHERE  inv_mas_customer.businessname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "category":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state
						FROM (select GROUP_CONCAT(emailid) as emailid, GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
						WHERE  inv_mas_region.category LIKE '".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "contactperson":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state
						FROM (select GROUP_CONCAT(emailid) as emailid, GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
						WHERE  inv_contactdetails.contactperson LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "phone":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state
						FROM (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region  
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
						WHERE  inv_contactdetails.phone LIKE '%".$textfield."%' OR inv_contactdetails.cell 
						LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "place":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region  
						, inv_mas_district.districtname as district, inv_mas_state.statecode as state 
						FROM (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, 
						GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region  
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
						WHERE  inv_mas_customer.place LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "email":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district,
						inv_mas_state.statecode as state 
						FROM (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, 
						GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district  
						WHERE inv_contactdetails.emailid LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "scratchnumber":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid ,
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state  FROM inv_mas_customer 
						LEFT JOIN inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
						left join inv_mas_scratchcard on inv_mas_scratchcard.cardid = inv_customerproduct.cardid 
						left join (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, 
						GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails on 
						inv_contactdetails.customerid = inv_mas_customer.slno  
						WHERE inv_mas_scratchcard.scratchnumber LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "computerid":
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region , inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state FROM inv_mas_customer 
						LEFT JOIN inv_customerproduct ON inv_mas_customer.slno = inv_customerproduct.customerreference 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district
						left join (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell,
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						on inv_contactdetails.customerid = inv_mas_customer.slno  
						WHERE inv_customerproduct.computerid LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					default:
						$query = "SELECT DISTINCT inv_mas_customer.slno AS slno, inv_mas_customer.customerid AS customerid, 
						inv_mas_customer.businessname AS businessname, inv_mas_customer.customerid as customerid , 
						inv_contactdetails.contactperson as contactperson , inv_contactdetails.phone as phone , 
						inv_mas_customer.place as place , inv_contactdetails.emailid as emailid , 
						inv_mas_region.category as region, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state  
						FROM (select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, 
						GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson ,customerid 
						from inv_contactdetails group by customerid) as inv_contactdetails 
						left join inv_mas_customer on inv_contactdetails.customerid = inv_mas_customer.slno 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.region 
						left join inv_mas_state on inv_mas_state.statename = inv_mas_customer.state
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
						WHERE  inv_mas_customer.businessname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
						<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Select</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Phone</td>
							<td nowrap = "nowrap" class="td-border-grid">Place</td>
							<td nowrap = "nowrap" class="td-border-grid">Email</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
						</tr>';
				$i_n = '';
				$result = runmysqlquery($query);
				while($fetch = mysqli_fetch_array($result))
				{
					$i_n++;
					$color;
					if($i_n%2 == 0)
						$color = "#edf4ff";
					else
						$color = "#f7faff";
					static $count = 0;
					$count++;
					$radioid = 'nameloadcustomerradio'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true;
nameloadregistration(\'gridformcustomer\'); loadnamesetselect(\''.$fetch['slno'].'\',\''.addslashes($fetch['businessname']).'\',\''.$fetch['region'].'\',\'customer\',\''.$date.'\',\''.$time.'\',\''.$fetch['state'].'\',\''.$fetch['emailid'].'\',\''.$fetch['place'].'\'); " bgcolor='.$color.'>';
					

					$grid .= "<td nowrap='nowrap' class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['slno']." id=".$radioid." 
onclick=\"nameloadregistration('gridformcustomer'); loadnamesetselect('".$fetch['slno']."','".addslashes($fetch['businessname'])."','".$fetch['region']."','customer','".$date."','".$time."','".$fetch['state']."','".$fetch['emailid']."','".$fetch['place']."');\" /></td>
							<td nowrap='nowrap' class='td-border-grid'>".cusidcombine($fetch['customerid'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".addslashes($fetch['businessname'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['contactperson'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['phone'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['place'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['emailid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['region']."</td>";
				
					$grid .= '</tr>';
				}
				$grid .= '</table></form>';
				echo($grid);
				break;
			}
			case "dealer":
			{
				switch($orderby)
				{
					case "id":
						$orderbyfield = "slno";
						break;
					case "name":
						$orderbyfield = "businessname";
						break;
					case "category":
						$orderbyfield = "region";
						break;
					case "contactperson":
						$orderbyfield = "contactperson";
						break;
					case "place":
						$orderbyfield = "place";
						break;	
					case "email":
						$orderbyfield = "emailid";
						break;
					case "phone":
						$orderbyfield = "phone";
						break;
					case "place":
						$orderbyfield = "place";
						break;
					default:
						$orderbyfield = "businessname";
						break;
				}
				
				switch($subselection)
				{
					case "id":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone,
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, 
						inv_mas_dealer.website, inv_mas_dealer.relyonexecutive,inv_mas_dealer.disablelogin, 
						inv_mas_dealer.remarks, inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount,
						inv_mas_dealer.taxname , inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , 
						inv_mas_dealer.hoemailid , inv_mas_dealer.createddate, inv_mas_users.fullname 
						FROM inv_mas_dealer left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
						WHERE inv_mas_dealer.slno LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "name":
						 $query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						 inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						 inv_mas_dealer.pincode, inv_mas_dealer.stdcode,
						 inv_mas_dealer.phone, inv_mas_dealer.cell, inv_mas_region.category as region, 
						 inv_mas_dealer.emailid, inv_mas_dealer.website, inv_mas_dealer.relyonexecutive,
						 inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, inv_mas_dealer.passwordchanged, 
						 inv_mas_dealer.taxamount,inv_mas_dealer.taxname , inv_mas_dealer.tlemailid , 
						 inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , inv_mas_dealer.createddate, 
						 inv_mas_users.fullname 
						 FROM inv_mas_dealer 
						 left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						 left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						 left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region
						 WHERE inv_mas_dealer.businessname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
					break;
					case "phone":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 	
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, inv_mas_dealer.website, 
						inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, 
						inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount, inv_mas_dealer.taxname , 
						inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , 
						inv_mas_dealer.createddate,inv_mas_users.fullname 
						FROM inv_mas_dealer 
						left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
						WHERE inv_mas_dealer.phone LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "contactperson":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, inv_mas_dealer.website, 
						inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, 
						inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount, inv_mas_dealer.taxname , 
						inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , 
						inv_mas_dealer.createddate, inv_mas_users.fullname 
						FROM inv_mas_dealer 
						left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
						WHERE inv_mas_dealer.contactperson LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "place":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, 
						inv_mas_dealer.website, inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, 
						inv_mas_dealer.remarks, inv_mas_dealer.passwordchanged,inv_mas_dealer.taxamount, inv_mas_dealer.taxname ,						
						inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , 
						inv_mas_dealer.createddate, inv_mas_users.fullname 
						FROM inv_mas_dealer 
						left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
						WHERE inv_mas_dealer.place LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "category":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, inv_mas_dealer.website, 
						inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, 		
						inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount, inv_mas_dealer.taxname , 
						inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , 
						inv_mas_dealer.createddate, inv_mas_users.fullname 
						FROM inv_mas_dealer 
						left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region  
						WHERE inv_mas_region.category LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "email":
						$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
						inv_mas_dealer.address, inv_mas_dealer.place, inv_mas_district.districtname as district, 
						inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
						inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, inv_mas_dealer.website, 
						inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, 
						inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount, inv_mas_dealer.taxname , 
						inv_mas_dealer.tlemailid , inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , 
						inv_mas_dealer.createddate, inv_mas_users.fullname 
						FROM inv_mas_dealer 
						left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
						left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
						left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
						left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
						WHERE inv_mas_dealer.emailid LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					default:
					$query = "SELECT inv_mas_dealer.slno,inv_mas_dealer.businessname, inv_mas_dealer.contactperson, 
					inv_mas_dealer.address, inv_mas_dealer.place,inv_mas_district.districtname as district, 
					inv_mas_state.statecode as state, inv_mas_dealer.pincode, inv_mas_dealer.stdcode,inv_mas_dealer.phone, 
					inv_mas_dealer.cell, inv_mas_region.category as region, inv_mas_dealer.emailid, inv_mas_dealer.website, 
					inv_mas_dealer.relyonexecutive, inv_mas_dealer.disablelogin, inv_mas_dealer.remarks, 
					inv_mas_dealer.passwordchanged, inv_mas_dealer.taxamount, inv_mas_dealer.taxname , inv_mas_dealer.tlemailid ,					
					inv_mas_dealer.mgremailid , inv_mas_dealer.hoemailid , inv_mas_dealer.createddate, 
					inv_mas_users.fullname 
					FROM inv_mas_dealer 
					left join inv_mas_users ON inv_mas_users.slno = inv_mas_dealer.userid 
					left join inv_mas_district on inv_mas_district.districtcode = inv_mas_dealer.district 
					left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
					left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region 
					WHERE inv_mas_dealer.businessname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;						
					break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
					<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap="nowrap" class="td-border-grid">Select</td>
							<td nowrap="nowrap" class="td-border-grid">Sl No</td>
							<td nowrap="nowrap" class="td-border-grid">Dealer Company Name</td>
							<td nowrap="nowrap" class="td-border-grid">Dealer Name</td>
							<td nowrap="nowrap" class="td-border-grid">Contact Number</td>
							<td nowrap="nowrap" class="td-border-grid">Email ID</td>
							<td nowrap="nowrap" class="td-border-grid">Category</td>
							<td nowrap="nowrap" class="td-border-grid">TL Emailid</td>
							<td nowrap="nowrap" class="td-border-grid">Manager EmailID</td>
							<td nowrap="nowrap" class="td-border-grid">HO Emailid</td>
							<td nowrap="nowrap" class="td-border-grid">Place</td>
							<td nowrap="nowrap" class="td-border-grid">District</td>
							<td nowrap="nowrap" class="td-border-grid">Skype ID</td>
						</tr>';
				
				$result = runmysqlquery($query);
				$i_n = 0;
				while($fetch = mysqli_fetch_array($result))
				{
					$color;
					if($i_n%2 == 0)
						$color = "#edf4ff";
					else
						$color = "#f7faff";

					static $count = 0;
					$count++;
					$radioid = 'nameloadcustomerradio'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true;  nameloadregistration(\'gridformcustomer\'); loadnamesetselect(\''.$fetch['slno'].'\',\''.$fetch['businessname'].'\',\''.$fetch['region'].'\',\'dealer\',\''.$date.'\',\''.$time.'\',\'\',\''.$fetch['emailid'].'\',\''.$fetch['place'].'\');" bgcolor='.$color.'>';
					
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['slno']." id=".$radioid."
 onclick=\"nameloadregistration('gridformcustomer'); loadnamesetselect('".$fetch['slno']."','".$fetch['dealercompanyname']."',
 '".$fetch['category']."','dealer','".$date."','".$time."' ,'','".$fetch['emailid']."','".$fetch['place']."' );\" /></td>
 							<td nowrap='nowrap' class='td-border-grid'>".$fetch['slno']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['businessname']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['contactperson'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['phone'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['emailid'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['tlemailid'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['mgremailid'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['hoemailid'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['region'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['place'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['district'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['skypeid']."</td>";
				
					$grid .= '</tr>';
				}
				$grid .= '</table></form>';
				echo($grid);
				break;
			}
			case "ssmuser":
			{
				switch($orderby)
				{
					case "id":
						$orderbyfield = "ssm_users.slno";
						break;
					case "name":
						$orderbyfield = "ssm_users.fullname";
						break;
					case "category":
						$orderbyfield = "ssm_users.locationname";
						break;
					case "phone":
						$orderbyfield = "ssm_users.mobile";
						break;
					case "email":
						$orderbyfield = "ssm_users.officialemail";
						break;
					default:
						$orderbyfield = "ssm_users.fullname";
						break;
				}
				
				switch($subselection)
				{
					case "id":
						
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' AND ssm_users.slno 
						LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "name":
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' 
						AND ssm_users.fullname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "category":
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' 
						AND ssm_users.locationname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "email":
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' 
						AND ssm_users.officialemail LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "phone":
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' AND ssm_users.mobile 
						LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					default:
						$query = "SELECT ssm_users.slno as slno,ssm_users.fullname as fullname,
						ssm_supportunits.heading as supportunit,ssm_users.officialemail as officialemail,
						ssm_users.mobile as mobile,ssm_locationmaster.locationname as locationname 
						FROM ssm_users 
						LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
						LEFT JOIN ssm_locationmaster ON ssm_locationmaster.slno = ssm_users.locationname 
						WHERE ssm_users.type <> 'ADMIN' AND ssm_users.existinguser <> 'no' 
						AND ssm_users.fullname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
							<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap="nowrap" class="td-border-grid">Select</td>
							<td nowrap="nowrap" class="td-border-grid">User ID</td>
							<td nowrap="nowrap" class="td-border-grid">User Name</td>
							<td nowrap="nowrap" class="td-border-grid">Support Unit</td>
							<td nowrap="nowrap" class="td-border-grid">Email ID</td>
							<td nowrap="nowrap" class="td-border-grid">Contact Number</td>
							<td nowrap="nowrap" class="td-border-grid">Location Name</td>
						</tr>';
				
				$result = runmysqlquery($query);
				$i_n = 0;
				while($fetch = mysqli_fetch_array($result))
				{
					$color;
					if($i_n%2 == 0)
					{
						$color = "#edf4ff";
					}
					else
					{
						$color = "#f7faff";
					}
					static $count = 0;
					$count++;
					$radioid = 'nameloadcustomerradio'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true;					nameloadregistration(\'gridformcustomer\'); loadnamesetselect(\''.$fetch['slno'].'\',\''.$fetch['fullname'].'\',\''.$fetch['locationname'].'\',\'ssmuser\',\''.$date.'\',\''.$time.'\',\'\',\''.$fetch['emailid'].'\',\''.$fetch['place'].'\');" bgcolor='.$color.'>';
					
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['slno']." id=".$radioid." 
onclick = \"loadnamesetselect('".$fetch['slno']."','".$fetch['fullname']."','".$fetch['locationname']."','ssmuser','".$date."','".$time."','','".$fetch['emailid']."','".$fetch['place']."');\" /></td>
								<td nowrap='nowrap' class='td-border-grid'>".$fetch['slno']."</td>
								<td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['supportunit'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['officialemail'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['mobile'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['locationname'])."</td>";
				
					$grid .= '</tr>';
				}
				$grid .= '</table></form>';
				echo($grid);
				break;
			}
			
			case "employee":
			{
				switch($orderby)
				{
					case "email":
						$orderbyfield = "emailid";
						break;
					case "phone":
						$orderbyfield = "contactnumber";
						break;
					case "place":
						$orderbyfield = "place";
						break;
					default:
						$orderbyfield = "oscompanyname";
						break;
				}
				
				switch($subselection)
				{
					case "phone":
						$query = "SELECT ssm_osmaster.slno , ssm_osmaster.oscompanyname ,  ssm_osmaster.osname , 
						ssm_osmaster.contactnumber ,ssm_osmaster.emailid , ssm_osmaster.category , ssm_osmaster.place ,
						ssm_osmaster.district ,inv_mas_state.statecode as state
						FROM ssm_osmaster
						left join inv_mas_state on inv_mas_state.statename = ssm_osmaster.state
						WHERE contactnumber LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "place":
						$query = "SELECT ssm_osmaster.slno , ssm_osmaster.oscompanyname ,  ssm_osmaster.osname , 
						ssm_osmaster.contactnumber ,ssm_osmaster.emailid , ssm_osmaster.category , ssm_osmaster.place ,
						ssm_osmaster.district ,inv_mas_state.statecode as state
						FROM ssm_osmaster
						left join inv_mas_state on inv_mas_state.statename = ssm_osmaster.state
						WHERE place LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "category":
						$query = "SELECT ssm_osmaster.slno , ssm_osmaster.oscompanyname ,  ssm_osmaster.osname , 
						ssm_osmaster.contactnumber ,ssm_osmaster.emailid , ssm_osmaster.category , ssm_osmaster.place ,
						ssm_osmaster.district ,inv_mas_state.statecode as state
						FROM ssm_osmaster
						left join inv_mas_state on inv_mas_state.statename = ssm_osmaster.state
						WHERE category LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					case "email":
						$query = "SELECT ssm_osmaster.slno , ssm_osmaster.oscompanyname ,  ssm_osmaster.osname , 
						ssm_osmaster.contactnumber ,ssm_osmaster.emailid , ssm_osmaster.category , ssm_osmaster.place ,
						ssm_osmaster.district ,inv_mas_state.statecode as state
						FROM ssm_osmaster
						left join inv_mas_state on inv_mas_state.statename = ssm_osmaster.state
						WHERE emailid LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
					default:
						$query = "SELECT ssm_osmaster.slno , ssm_osmaster.oscompanyname ,  ssm_osmaster.osname , 
						ssm_osmaster.contactnumber ,ssm_osmaster.emailid , ssm_osmaster.category , ssm_osmaster.place ,
						ssm_osmaster.district ,inv_mas_state.statecode as state
						FROM ssm_osmaster
						left join inv_mas_state on inv_mas_state.statename = ssm_osmaster.state
						WHERE oscompanyname LIKE '%".$textfield."%' ORDER BY ".$orderbyfield;
						break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
							<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap="nowrap" class="td-border-grid">Select</td>
							<td nowrap="nowrap" class="td-border-grid">Sl No</td>
							<td nowrap="nowrap" class="td-border-grid">OSE Company Name</td>
							<td nowrap="nowrap" class="td-border-grid">OSE Name</td>
							<td nowrap="nowrap" class="td-border-grid">Contact Number</td>
							<td nowrap="nowrap" class="td-border-grid">Email ID</td>
							<td nowrap="nowrap" class="td-border-grid">Category</td>
							<td nowrap="nowrap" class="td-border-grid">Place</td>
							<td nowrap="nowrap" class="td-border-grid">District</td>
							<td nowrap="nowrap" class="td-border-grid">Skype ID</td>
						</tr>';
				
				$result = runmysqlquery($query);
				$i_n = 0;
				while($fetch = mysqli_fetch_array($result))
				{
					$color;
					if($i_n%2 == 0)
					{
						$color = "#edf4ff";
					}
					else
					{
						$color = "#f7faff";
					}
					static $count = 0;
					$count++;
					$radioid = 'nameloadcustomerradio'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true;  nameloadregistration(\'gridformcustomer\'); loadnamesetselect(\''.$fetch['slno'].'\',\''.$fetch['oscompanyname'].'\',\''.$fetch['category'].'\',\'employee\',\''.$date.'\',\''.$time.'\',\''.$fetch['state'].'\',\''.$fetch['emailid'].'\',\''.$fetch['place'].'\');" bgcolor='.$color.'>';
					
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['slno']." id=".$radioid." onclick=\"nameloadregistration('gridformcustomer'); loadnamesetselect('".$fetch['slno']."','".$fetch['oscompanyname']."','".$fetch['category']."','employee','".$date."','".$time."','".$fetch['state']."','".$fetch['emailid']."','".$fetch['place']."');\" /></td>
								<td nowrap='nowrap' class='td-border-grid'>".$fetch['slno']."</td>
								<td nowrap='nowrap' class='td-border-grid'>".$fetch['oscompanyname']."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['osname'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['contactnumber'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['emailid'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['category'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['place'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['district'])."</td>
								<td nowrap='nowrap' class='td-border-grid'>".$fetch['skypeid']."</td>";
					$grid .= '</tr>';
				}
				$grid .= '</table></form>';
				echo($grid);
				break;
			}
			default:
				echo("Nameload Script Server Page Failed.");
				break;
		}	
	}
}

elseif($_POST['type'] == 2)
{
	$customerdb = $_POST['customerdb'];
	$cusid = $_POST['cusid'];
	switch($customerdb)
	{
		case "invcustomer":
			//Blocked code for ineffecient query, by manjunath 04/06/14
			/*$query = "SELECT inv_mas_product.productname as productname, 
			inv_mas_scratchcard.scratchnumber AS scratchnumber, 
			inv_customerproduct.computerid AS computerid,inv_customerproduct.softkey AS softkey,
			inv_customerproduct.date AS regdate, inv_customerproduct.time AS regtime, inv_mas_users.fullname AS generatedby, 
			inv_mas_dealer.businessname AS businessname 
			FROM inv_mas_dealer 
			JOIN (inv_customerproduct  
			JOIN inv_mas_scratchcard ON inv_customerproduct.cardid = inv_mas_scratchcard.cardid) 
			ON inv_mas_dealer.slno = inv_customerproduct.dealerid left 
			JOIN inv_mas_product ON inv_mas_product.productcode = left(inv_customerproduct.computerid,3)  
			JOIN inv_mas_users ON inv_mas_users.slno = inv_customerproduct.generatedby 
			where inv_customerproduct.customerreference = '".$cusid."' ORDER BY regdate desc , regtime desc; "; 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap="nowrap" class="td-border-grid">Scratch No</td>
						<td nowrap="nowrap" class="td-border-grid">Computer ID</td>
						<td nowrap="nowrap" class="td-border-grid">Soft Key</td>
						<td nowrap="nowrap" class="td-border-grid">Generated By</td>
						<td nowrap="nowrap" class="td-border-grid">Dealer</td>
						<td nowrap="nowrap" class="td-border-grid">Date</td>
						<td nowrap="nowrap" class="td-border-grid">Time</td>
					</tr>';
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
			{
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				$grid .= '<tr class="gridrow" bgcolor='.$color.'>';
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['scratchnumber']."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".$fetch['computerid']."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".$fetch['softkey']."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['generatedby'])."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".$fetch['businessname']."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".$fetch['regdate']."</td>
						 <td nowrap='nowrap' class='td-border-grid'>".$fetch['regtime']."</td>";
				$grid .= '</tr>';
			}*/
			
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap="nowrap" class="td-border-grid" colspan=7>Oops! Problem in retriving data, we will be back soon.</td>
						</tr></table>';
			echo($grid);
			break;
	}
}

elseif($_POST['type'] == 3)
{
	$customerdb = $_POST['customerdb'];
	$cusid = $_POST['cusid'];
	
	switch($customerdb)
	{
		case 'call':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User Id</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td
						><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">End Time</td>
					</tr>';
			
			$query = "SELECT ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, 
			ssm_callregister.customername AS customername,  ssm_callregister.customerid AS customerid, 
			ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname,
			ssm_callregister.category AS category ,inv_mas_state.statename AS state, ssm_callregister.callertype AS callertype, 
			ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, 
			ssm_callregister.problem AS problem, ssm_callregister.status AS status,
			ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, 
			ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,
			ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, 
			ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, 
			ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, 
			ssm_callregister.endtime AS endtime 
			FROM ssm_callregister  
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
			LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
			left join inv_mas_state on inv_mas_state.slno = ssm_callregister.state  
			WHERE customerid = '".$cusid."' ORDER BY   `date` DESC, `time` DESC ";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
						else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
					}
					else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister");
			break;
		
		case 'email':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Person Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Subject</td>
						<td nowrap = "nowrap" class="td-border-grid">Content</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Thanking Email</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.anonymous AS anonymous,
			ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,
			ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,
			ssm_emailregister.date AS date,ssm_emailregister.time AS time,
			ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,
			inv_mas_state.statename AS state,
			ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, 
			ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,
			ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,
			ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, 
			ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,
			ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,
			ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,
			ssm_emailregister.authorizeddatetime AS authorizeddatetime,ssm_emailregister.flag AS flag 
			FROM ssm_emailregister  
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
			LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
			left join inv_mas_state on inv_mas_state.slno = ssm_emailregister.state  
			WHERE customerid = '".$cusid."' ORDER BY   `date` DESC, `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 7)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
						else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
					}
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister");
			
			break;
			
		case 'error':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Reported</td>
						<td nowrap = "nowrap" class="td-border-grid">Error Understood by You</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Error File</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution File</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Error ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_errorregister.slno AS slno, ssm_errorregister.flag AS flag,
			ssm_errorregister.anonymous AS anonymous, ssm_errorregister.customername AS customername,
			ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,
			ssm_errorregister.database AS `database`,ssm_errorregister.date AS date, ssm_errorregister.time AS time,
			inv_mas_state.statename AS state,ssm_errorregister.errorreported AS errorreported,
			ssm_errorregister.errorunderstood AS errorunderstood,ssm_errorregister.reportedto AS reportedto,
			ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status,
			ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,
			ssm_errorregister.solutionenteredtime AS solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,
			ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,	ssm_errorregister.errorid AS errorid,
			ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
			ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
			ssm_errorregister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_errorregister 
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup
			left join inv_mas_state on inv_mas_state.slno = ssm_errorregister.state     
			WHERE customerid = '".$cusid."' ORDER BY   `date` DESC, `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 7 || $i == 15)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
						else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
					}				
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister");
			
			break;
			
		case 'inhouse':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_inhouseregister.slno AS slno, ssm_inhouseregister.flag AS flag ,
			ssm_inhouseregister.anonymous AS anonymous, ssm_inhouseregister.customername AS customername, 
			ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, 
			ssm_inhouseregister.time AS time, ssm_products.productname AS productname, 
			ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, 
			inv_mas_state.statename AS state,ssm_inhouseregister.callertype AS callertype, 
			ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, 
			ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, 
			ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, 
			ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
			ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, 
			ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, 
			ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, 
			ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_inhouseregister
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
			LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
			LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup
			left join inv_mas_state on inv_mas_state.slno = ssm_inhouseregister.state   
			WHERE customerid = '".$cusid."' ORDER BY   `date` DESC , `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 5)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister");
			
			break;
			
		case 'onsite':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
						<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved By</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
						<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_onsiteregister.slno AS slno, ssm_onsiteregister.flag AS flag ,
			ssm_onsiteregister.anonymous AS anonymous, ssm_onsiteregister.customername AS customername, 
			ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, 
			ssm_onsiteregister.time AS time, ssm_products.productname AS productname, 
			ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, 
			inv_mas_state.statename AS state, ssm_onsiteregister.callertype AS callertype, 
			ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, 
			ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,
			ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
			ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,
			ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,
			ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
			ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno,
			ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, 
			ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, 
			ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks,
			ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_onsiteregister 
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
			LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
			LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
			LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup 
			left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state 
			WHERE  customerid = '".$cusid."' ORDER BY date DESC, `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 5 || $i == 24 || $i == 26)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else 
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister");
			
			break;
			
		case 'reference':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Reference Through</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact No</td>
						<td nowrap = "nowrap" class="td-border-grid">Contact Address</td>
						<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Reference ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_referenceregister.slno AS slno,ssm_referenceregister.flag AS flag,
			ssm_referenceregister.anonymous AS anonymous,ssm_referenceregister.customername AS customername,
			ssm_products.productname AS productname, ssm_referenceregister.date AS date, 
			ssm_referenceregister.time AS time, ssm_referenceregister.referencethrough AS referencethrough, 
			ssm_referenceregister.category AS category,  inv_mas_state.statename as state,
			 ssm_referenceregister.contactperson AS contactperson, 
			ssm_referenceregister.contactno AS contactno, ssm_referenceregister.contactaddress AS contactaddress, 
			ssm_referenceregister.email AS email, ssm_referenceregister.status AS status, 
			ssm_referenceregister.remarks AS remarks, ssm_users.fullname AS userid, 
			ssm_referenceregister.referenceid AS referenceid, ssm_referenceregister.authorized AS authorized, 
			ssm_category.categoryheading AS authorizedgroup, 
			ssm_referenceregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
			ssm_referenceregister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_referenceregister 
			LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup
			left join inv_mas_state on inv_mas_state.slno = ssm_referenceregister.state   
			WHERE  customerid = '".$cusid."' ORDER BY  `date` DESC, `time` DESC ";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 5)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
						}
						else
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister");
			
			break;
			
		case 'requirement':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Database</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement</td>
						<td nowrap = "nowrap" class="td-border-grid">Reported To</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Solved Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Given</td>
						<td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Requirement ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_requirementregister.slno AS slno, ssm_requirementregister.flag AS flag, 
			ssm_requirementregister.anonymous AS anonymous,ssm_requirementregister.customername AS customername, 
			ssm_products.productname AS productname, ssm_requirementregister.productversion AS productversion, 
			ssm_requirementregister.database AS `database`, ssm_requirementregister.date AS date, 
			ssm_requirementregister.time AS time, inv_mas_state.statename AS state,
			ssm_requirementregister.requirement AS requirement, ssm_requirementregister.reportedto AS reportedto, 
			ssm_requirementregister.status AS status, ssm_requirementregister.solveddate AS solveddate, 
			ssm_requirementregister.solutiongiven AS solutiongiven, 
			ssm_requirementregister.solutionenteredtime AS solutionenteredtime, ssm_requirementregister.remarks AS remarks, 
			ssm_users.fullname AS userid, ssm_requirementregister.requirementid AS requirementid, 
			ssm_requirementregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, 
			ssm_requirementregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, 
			ssm_requirementregister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_requirementregister 
			LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup  
			left join inv_mas_state on inv_mas_state.slno = ssm_requirementregister.state 
			WHERE  customerid = '".$cusid."' ORDER BY  `date` DESC , `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 7)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else 
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister");
			
			break;
			
		case 'skype':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Sender</td>
						<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Category</td>
						<td nowrap = "nowrap" class="td-border-grid">Problem</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype Conversation</td>
						<td nowrap = "nowrap" class="td-border-grid">Attachment</td>
						<td nowrap = "nowrap" class="td-border-grid">Status</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					</tr>';
			
			$query = "SELECT ssm_skyperegister.slno AS slno, ssm_skyperegister.flag AS flag,
			ssm_skyperegister.anonymous AS anonymous, ssm_skyperegister.customername AS customername, 
			ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, 
			ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, 
			ssm_skyperegister.time AS time, inv_mas_state.statename AS state,
			ssm_products.productname AS productname,ssm_skyperegister.productversion AS productversion, 
			ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, 
			ssm_skyperegister.conversation AS conversation, ssm_skyperegister.attachment AS attachment, 
			ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, 
			ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, 
			ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks,
			ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime 
			FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
			LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup 
			left join inv_mas_state on inv_mas_state.slno = ssm_skyperegister.state  
			WHERE customerid = '".$cusid."' ORDER BY  `date` DESC, `time` DESC ";
			$result = runmysqlquery($query);
	
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 7)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 1)
					{
						if($fetch[1] == 'yes')	
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister");
			
			break;
			
		case 'invoice':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">State</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Register Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Given To</td>
						<td nowrap = "nowrap" class="td-border-grid">Amount</td>
						<td nowrap = "nowrap" class="td-border-grid"Tax</td>
						<td nowrap = "nowrap" class="td-border-grid">Total Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Billed By</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Complaint ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					</tr>';
			$query = "SELECT ssm_invoice.slno AS slno,ssm_invoice.customername AS customername,
			ssm_invoice.customerid AS customerid,ssm_invoice.date AS date,ssm_invoice.state AS state, 
			ssm_invoice.time AS time,ssm_products.productname AS productname,ssm_invoice.productversion AS productversion,
			ssm_invoice.billdate AS billdate,ssm_invoice.registername AS registername,ssm_invoice.billno AS billno,
			ssm_invoice.billto AS billto,ssm_invoice.amount AS amount, 
			ssm_invoice.tax AS tax,ssm_invoice.tamount AS tamount,ssm_users1.fullname AS billedby,ssm_invoice.remarks AS remarks,ssm_users2.fullname AS userid,
			ssm_invoice.complaintid AS complaintid,ssm_invoice.authorized AS authorized,
			ssm_category.categoryheading AS authorizedgroup,ssm_invoice.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson,
			ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag FROM ssm_invoice 
			LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
			LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
			LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
			LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
			LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
			LEFT JOIN ssm_category on ssm_category.slno = ssm_invoice.authorizedgroup 
			WHERE customerid = '".$cusid."' ORDER BY   `date` DESC, `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 3)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 23)
					{
						if($fetch[23] == 'yes')	
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else 
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice");
			
			break;
			
		case 'receipt':
		 
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Receipt Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Receipt Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Cheque / Cash</td>
						<td nowrap = "nowrap" class="td-border-grid">Cheque Number</td>
						<td nowrap = "nowrap" class="td-border-grid">Amount</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">User ID</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
						<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
						<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
						<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					</tr>';
			
			$query = "SELECT ssm_receipts.slno AS slno,ssm_receipts.customername AS customername,
			 ssm_receipts.customerid AS customerid, ssm_receipts.date AS date,ssm_receipts.time AS time,
			 ssm_receipts.billdate AS billdate,ssm_receipts.billno AS billno,ssm_receipts.receiptno AS receiptno,
			 ssm_receipts.receiptdate AS receiptdate,ssm_receipts.cheque_cash AS cheque_cash
			 ,ssm_receipts.chequeno AS chequeno,ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,
			 ssm_users1.fullname AS userid,ssm_receipts.authorized AS authorized,
			 ssm_category.categoryheading AS authorizedgroup,ssm_receipts.teamleaderremarks AS teamleaderremarks,
			 ssm_users2.fullname AS authorizedperson,ssm_receipts.authorizeddatetime AS authorizeddatetime,
			 ssm_receipts.flag AS flag 
			 FROM ssm_receipts 
			 LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
			 LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
			 LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
			 LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup 
			 WHERE customerid = '".$cusid."' ORDER BY  `date` DESC , `time` DESC";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 3 || $i == 5 || $i == 8)
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					}
					elseif($i == 19)
					{
						if($fetch[19] == 'yes')	
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";
						}
						else 
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
				
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts");
			break;
	}
	echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
}


?>