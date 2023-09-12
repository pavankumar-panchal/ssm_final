<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');

if($_POST['type'] == 1)
{
	$registerdb = $_POST['registerdb'];
	$textfield = $_POST['textfield'];
	$subselection = $_POST['subselection'];
	$orderby = $_POST['orderby'];
	
	
	if($registerdb <> "" && strlen($textfield) > 0)
	{
		switch($registerdb)
		{
			case "ssm_onsiteregister":
			{
				switch($orderby)
				{
					case "customername":
						$orderbyfield = "ssm_onsiteregister.customername";
						break;
					case "customerid":
						$orderbyfield = "ssm_onsiteregister.customerid";
						break;
					default:
						$orderbyfield = "ssm_onsiteregister.date";
						break;
				}
				
				switch($subselection)
				{
					case "customerid":
						$query = "select ssm_onsiteregister.customername AS customername,
						ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date,
						ssm_onsiteregister.time AS time,ssm_onsiteregister.productgroup AS productgroup,
						ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion,
						ssm_onsiteregister.category AS category,ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem, 
						ssm_onsiteregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_onsiteregister.status AS status, s3.username AS solvedby,
						ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS 
						marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,ssm_onsiteregister.teamleaderremarks 
						AS teamleaderremarks,ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state
						FROM ssm_onsiteregister
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.slno = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
 						AND ssm_invoice.registername = 'ssm_onsiteregister' 
						WHERE ssm_invoice.slno IS NULL AND ssm_onsiteregister.acknowledgementno <> '' 
						AND ssm_onsiteregister.billno <> '' AND ssm_onsiteregister.servicecharge='yes' 
						AND ssm_onsiteregister.customerid LIKE '%".$textfield."%' ORDER BY   `date` DESC , ".$orderbyfield;
						break;
					case "customername":
						$query = "select ssm_onsiteregister.customername AS customername,ssm_onsiteregister.customerid AS 
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,	ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid,
						ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup, 
						ssm_onsiteregister.teamleaderremarks AS 
						teamleaderremarks,ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state
						FROM ssm_onsiteregister 
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' 
						WHERE ssm_invoice.slno IS NULL AND ssm_onsiteregister.acknowledgementno <> '' 
						AND ssm_onsiteregister.billno <> ''  AND ssm_onsiteregister.servicecharge='yes' 
						AND ssm_onsiteregister.customername LIKE '%".$textfield."%' ORDER BY   `date` DESC , ".$orderbyfield;
						break;
					case "date":
						$query = "select ssm_onsiteregister.customername AS customername,ssm_onsiteregister.customerid AS 
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup, ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem,
						ssm_onsiteregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_onsiteregister.status AS status, s3.username AS solvedby,
						ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS
						marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,
						ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno 
						AS billno,ssm_onsiteregister.billdate AS billdate,ssm_onsiteregister.acknowledgementno AS 
						acknowledgementno, ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,ssm_onsiteregister.teamleaderremarks AS 
						teamleaderremarks,ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag  ,
						inv_mas_state.statecode as state 
						FROM ssm_onsiteregister
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.date LIKE '%".$textfield."%' 
						ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "billno":
						$query = "select ssm_onsiteregister.customername AS customername,ssm_onsiteregister.customerid AS 
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby,ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,
						ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,
						ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,
						ssm_onsiteregister.teamleaderremarks AS teamleaderremarks,
						ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state 
						FROM ssm_onsiteregister
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.billno LIKE '%".$textfield."%' 
						ORDER BY   `date` DESC , ".$orderbyfield;
						break;
					case "solveddate":
						$query = "select ssm_onsiteregister.customername AS customername,ssm_onsiteregister.customerid AS 
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname,
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,
						problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby,ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,
						ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,
						ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,
						ssm_onsiteregister.teamleaderremarks AS teamleaderremarks,
						ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state 
						FROM ssm_onsiteregister 
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno 
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.solveddate 
						LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "userid":
						$query = "select ssm_onsiteregister.customername AS customername,
						ssm_onsiteregister.customerid AS customerid, 
						ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem, 
						ssm_onsiteregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_onsiteregister.status AS status, s3.username AS solvedby,
						ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,
						ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,
						ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
						ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,ssm_onsiteregister.acknowledgementno AS 
						acknowledgementno, ssm_onsiteregister.remarks AS remarks, s1.username AS userid,
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,
						ssm_onsiteregister.teamleaderremarks AS teamleaderremarks,
						ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state 
						FROM ssm_onsiteregister 
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' 
						WHERE ssm_invoice.slno IS NULL AND ssm_onsiteregister.acknowledgementno <> '' 
						AND ssm_onsiteregister.billno <> ''  AND ssm_onsiteregister.servicecharge='yes' 
						AND ssm_onsiteregister.userid = '".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "solvedby":
						$query = "select ssm_onsiteregister.customername AS customername,
						ssm_onsiteregister.customerid AS
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup, ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,
						problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby,ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,
						ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail,
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,
						ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,
						ssm_onsiteregister.teamleaderremarks AS teamleaderremarks,
						ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag ,
						inv_mas_state.statecode as state 
						FROM ssm_onsiteregister 
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno 
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state 
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.solvedby 
						LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "status":
						$query = "select ssm_onsiteregister.customername AS customername,
						ssm_onsiteregister.customerid AS 
						customerid, ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,
						problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby,ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,
						ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,
						ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks, s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,
						ssm_onsiteregister.teamleaderremarks AS 
						teamleaderremarks,ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,
						ssm_onsiteregister.flag AS flag  ,
						inv_mas_state.statecode as state
						FROM ssm_onsiteregister
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno  
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.status 
						LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					default:
						$query = "select ssm_onsiteregister.customername AS customername,
						ssm_onsiteregister.customerid AS customerid, 
						ssm_onsiteregister.date AS date,ssm_onsiteregister.time AS time,
						ssm_onsiteregister.productgroup AS productgroup,ssm_products.productname AS productname, 
						ssm_onsiteregister.productversion AS productversion,ssm_onsiteregister.category AS category,
						ssm_onsiteregister.servicecharge AS servicecharge,problem AS problem, ssm_onsiteregister.contactperson 
						AS contactperson,s2.username AS assignedto,ssm_onsiteregister.status AS status, 
						s3.username AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,
						ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,
						ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, 
						ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno,
						ssm_onsiteregister.billdate AS billdate,ssm_onsiteregister.acknowledgementno AS acknowledgementno, 
						ssm_onsiteregister.remarks AS remarks,s1.username AS userid, 
						ssm_onsiteregister.complaintid AS complaintid,ssm_onsiteregister.authorized AS authorized,
						ssm_onsiteregister.authorizedgroup AS authorizedgroup,ssm_onsiteregister.teamleaderremarks AS 
						teamleaderremarks,ssm_onsiteregister.authorizedperson AS authorizedperson,
						ssm_onsiteregister.authorizeddatetime AS authorizeddatetime,ssm_onsiteregister.flag AS flag,
						inv_mas_state.statecode as state  
						FROM ssm_onsiteregister 
						LEFT JOIN ssm_products on ssm_onsiteregister.productname = ssm_products.slno 
						left join ssm_users as s1 on ssm_onsiteregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_onsiteregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_onsiteregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_onsiteregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_onsiteregister.complaintid 
						AND ssm_invoice.registername = 'ssm_onsiteregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_onsiteregister.acknowledgementno <> '' AND ssm_onsiteregister.billno <> ''  
						AND ssm_onsiteregister.servicecharge='yes' AND ssm_onsiteregister.date LIKE '%".$textfield."%' 
						ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
							<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap="nowrap" class="td-border-grid">Sl No</td>
							<td nowrap="nowrap" class="td-border-grid">Registered Name</td>
							<td nowrap="nowrap" class="td-border-grid">Customer Id</td>
							<td nowrap="nowrap" class="td-border-grid">Date</td>
							<td nowrap="nowrap" class="td-border-grid">Time</td>
							<td nowrap="nowrap" class="td-border-grid">Product Group</td>
							<td nowrap="nowrap" class="td-border-grid">Product Name</td>
							<td nowrap="nowrap" class="td-border-grid">Product Version</td>
							<td nowrap="nowrap" class="td-border-grid">Category</td>
							<td nowrap="nowrap" class="td-border-grid">State</td>
							<td nowrap="nowrap" class="td-border-grid">Service Charge</td>
							<td nowrap="nowrap" class="td-border-grid">Problem</td>
							<td nowrap="nowrap" class="td-border-grid">Contact Person</td>
							<td nowrap="nowrap" class="td-border-grid">Assigned To</td>
							<td nowrap="nowrap" class="td-border-grid">Status</td>
							<td nowrap="nowrap" class="td-border-grid">Solved By</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
							<td nowrap="nowrap" class="td-border-grid">Solved Date</td>
							<td nowrap="nowrap" class="td-border-grid">Bill Number</td>
							<td nowrap="nowrap" class="td-border-grid">Bill Date</td>
							<td nowrap="nowrap" class="td-border-grid">Acknowledgement Number</td>
							<td nowrap="nowrap" class="td-border-grid">Remarks</td>
							<td nowrap="nowrap" class="td-border-grid">Entered By</td>
							<td nowrap="nowrap" class="td-border-grid">Modified By</td>
							<td nowrap="nowrap" class="td-border-grid">Complaint ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						</tr>';
				
				$result = runmysqlquery($query);
				$i_n = 0;
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
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true;					loadregistersetselect(\''.$fetch['customername'].'\',\''.$fetch['customerid'].'\',\''.changedateformat($fetch['date']).'\',\''.$fetch['time'].'\',\''.$fetch['productgroup'].'\',\''.$fetch['productname'].'\',\''.$fetch['productversion'].'\',\'ssm_onsiteregister\',\''.changedateformat($fetch['billdate']).'\',\''.$fetch['billno'].'\',\''.$fetch['complaintid'].'\',\''.$fetch['state'].'\'); "  
					bgcolor='.$color.'>';
					
					$grid .= "<td nowrap='nowrap'  class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['customerid']." id=".$radioid." 
onclick=\"loadregistersetselect('".$fetch['customername']."','".$fetch['customerid']."','".changedateformat($fetch['date'])."',
'".$fetch['time']."','".$fetch['productgroup']."','".$fetch['productname']."','".$fetch['productversion']."','ssm_onsiteregister','"
.changedateformat($fetch['billdate'])."','".$fetch['billno']."','".$fetch['complaintid']."','".$fetch['state']."');\" />
							</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['customerid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['time']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productgroup']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productversion']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['category']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['state']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['servicecharge']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['contactperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['assignedto']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['status']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['solvedby']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['stremoteconnection']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['marketingperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['onsitevisit']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['overphone']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['mail']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['solveddate']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['billno']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['billdate'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['acknowledgementno']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['userid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['modifiedby']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['complaintid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedgroup']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorized']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['teamleaderremarks']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizeddatetime']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['flag']."</td>";
				
					$grid .= '</tr>';
				}
				$grid .= '</table></form>';
				echo($grid);
				break;
			}
			
			case "ssm_inhouseregister":
			{
				switch($orderby)
				{
					case "customername":
						$orderbyfield = "customername";
						break;
					case "customerid":
						$orderbyfield = "customerid";
						break;
					default:
						$orderbyfield = "date";
						break;
				}
				
				switch($subselection)
				{
					case "customerid":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,
						problem AS problem, ssm_inhouseregister.contactperson AS contactperson,s2.username
						AS assignedto,ssm_inhouseregister.status AS status, s3.username AS solvedby,
						ssm_inhouseregister.billno AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
						ssm_inhouseregister.remarks AS remarks, s1.username AS userid,
						ssm_inhouseregister.complaintid AS complaintid,ssm_inhouseregister.authorized AS authorized, 
						ssm_inhouseregister.authorizedgroup AS authorizedgroup,ssm_inhouseregister.teamleaderremarks AS 
						teamleaderremarks, ssm_inhouseregister.authorizedperson AS authorizedperson,
						ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag AS flag ,
						inv_mas_state.statecode as state 
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes' 
						AND ssm_inhouseregister.customerid LIKE'%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "customername":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,
						problem AS problem, ssm_inhouseregister.contactperson AS contactperson,
						s2.username AS assignedto,ssm_inhouseregister.status AS status, 
						s3.username AS solvedby,ssm_inhouseregister.billno AS billno,
						ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, 
						s1.username AS userid,ssm_inhouseregister.complaintid AS complaintid,
						ssm_inhouseregister.authorized AS authorized, ssm_inhouseregister.authorizedgroup AS authorizedgroup,
						ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_inhouseregister.authorizedperson AS 
						authorizedperson,ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag ,
						inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' 
						WHERE ssm_invoice.slno IS NULL AND ssm_inhouseregister.acknowledgementno <> '' 
						AND ssm_inhouseregister.servicecharge='yes' AND ssm_inhouseregister.customername LIKE '%".$textfield."%'
						ORDER BY ".$orderbyfield;
						break;
					case "date":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem 
						AS problem, ssm_inhouseregister.contactperson AS contactperson,s2.username AS 
						assignedto,ssm_inhouseregister.status AS status, s3.username AS solvedby,
						ssm_inhouseregister.billno AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
						ssm_inhouseregister.remarks AS remarks,s1.username AS userid,
						ssm_inhouseregister.complaintid AS complaintid,ssm_inhouseregister.authorized AS authorized, 
						ssm_inhouseregister.authorizedgroup AS authorizedgroup,ssm_inhouseregister.teamleaderremarks AS 
						teamleaderremarks, ssm_inhouseregister.authorizedperson AS authorizedperson,
						ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag ,
						inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister'
						WHERE ssm_invoice.slno IS NULL AND ssm_inhouseregister.acknowledgementno <> ''
						AND ssm_inhouseregister.servicecharge='yes' AND ssm_inhouseregister.date LIKE '%".$textfield."%' 
						ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "billno":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem AS
						problem, ssm_inhouseregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_inhouseregister.status AS status, s3.username AS solvedby,ssm_inhouseregister.billno 
						AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS 
						remarks, s1.username AS userid,ssm_inhouseregister.complaintid AS complaintid,
						ssm_inhouseregister.authorized AS authorized, ssm_inhouseregister.authorizedgroup AS authorizedgroup,
						ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_inhouseregister.authorizedperson AS 
						authorizedperson,ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag ,
						inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes' 
						AND ssm_inhouseregister.billno LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					case "userid":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem AS 
						problem, ssm_inhouseregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_inhouseregister.status AS status, s3.username AS solvedby,ssm_inhouseregister.billno 
						AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS 
						remarks, s1.username AS userid,ssm_inhouseregister.complaintid AS complaintid,
						ssm_inhouseregister.authorized AS authorized, ssm_inhouseregister.authorizedgroup AS authorizedgroup,
						ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_inhouseregister.authorizedperson 
						AS authorizedperson,ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, 
						ssm_inhouseregister.flag , inv_mas_state.statecode as state FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes' 
						AND ssm_inhouseregister.userid LIKE '%".$textfield."%' ORDER BY   `date` DESC , ".$orderbyfield;
						break;
					case "solvedby":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem 
						AS problem, ssm_inhouseregister.contactperson AS contactperson,s2.username 
						AS assignedto,ssm_inhouseregister.status AS status, s3.username AS solvedby,
						ssm_inhouseregister.billno AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
						ssm_inhouseregister.remarks AS remarks, s1.username AS userid,
						ssm_inhouseregister.complaintid AS complaintid,ssm_inhouseregister.authorized AS authorized, 
						ssm_inhouseregister.authorizedgroup AS authorizedgroup,ssm_inhouseregister.teamleaderremarks 
						AS teamleaderremarks, ssm_inhouseregister.authorizedperson AS authorizedperson,
						ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag ,
						inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes'
						AND ssm_inhouseregister.solvedby LIKE '%".$textfield."%' ORDER BY   `date` DESC , ".$orderbyfield;
						break;
					case "status":
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid 
						AS customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem AS 
						problem, ssm_inhouseregister.contactperson AS contactperson,s2.username AS assignedto,
						ssm_inhouseregister.status AS status,s3.username AS solvedby,ssm_inhouseregister.billno 
						AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS
						remarks, s1.username AS userid,ssm_inhouseregister.complaintid AS complaintid,
						ssm_inhouseregister.authorized AS authorized, ssm_inhouseregister.authorizedgroup AS authorizedgroup,
						ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_inhouseregister.authorizedperson AS
						authorizedperson,ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag ,
						inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes' 
						AND ssm_inhouseregister.status LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
					default:
						$query = "select ssm_inhouseregister.customername AS customername,ssm_inhouseregister.customerid AS 
						customerid, ssm_inhouseregister.date AS date,ssm_inhouseregister.time AS time,
						ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion,
						ssm_inhouseregister.category AS category,ssm_inhouseregister.servicecharge AS servicecharge,problem 
						AS problem, ssm_inhouseregister.contactperson AS contactperson,s2.username
						AS assignedto,ssm_inhouseregister.status AS status, s3.username AS solvedby,
						ssm_inhouseregister.billno AS billno,ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
						ssm_inhouseregister.remarks AS remarks, s1.username AS userid,
						ssm_inhouseregister.complaintid AS complaintid,ssm_inhouseregister.authorized AS authorized, 
						ssm_inhouseregister.authorizedgroup AS authorizedgroup,ssm_inhouseregister.teamleaderremarks AS 
						teamleaderremarks, ssm_inhouseregister.authorizedperson AS authorizedperson,
						ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag , inv_mas_state.statecode as state
						FROM ssm_inhouseregister 
						LEFT JOIN ssm_products on ssm_inhouseregister.productname = ssm_products.slno
						left join ssm_users as s1 on ssm_inhouseregister.userid = s1.slno 
						left join ssm_users as s2 on ssm_inhouseregister.assignedto = s2.slno 
						left join ssm_users as s3 on ssm_inhouseregister.solvedby = s3.slno 
						left join inv_mas_state on inv_mas_state.statename = ssm_inhouseregister.state
						LEFT JOIN ssm_invoice on ssm_invoice.complaintid = ssm_inhouseregister.complaintid 
						AND ssm_invoice.registername = 'ssm_inhouseregister' WHERE ssm_invoice.slno IS NULL 
						AND ssm_inhouseregister.acknowledgementno <> '' AND ssm_inhouseregister.servicecharge='yes' 
						AND ssm_inhouseregister.date LIKE '%".$textfield."%' ORDER BY  `date` DESC ,  ".$orderbyfield;
						break;
				}
				$grid = '<form name="gridformcustomer" id="gridformcustomer">
							<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				
				$grid .= '<tr class="tr-grid-header">
							<td nowrap="nowrap" class="td-border-grid">Sl No</td>
							<td nowrap="nowrap" class="td-border-grid">Registered Name</td>
							<td nowrap="nowrap" class="td-border-grid">Customer Id</td>
							<td nowrap="nowrap" class="td-border-grid">Date</td>
							<td nowrap="nowrap" class="td-border-grid">Time</td>
							<td nowrap="nowrap" class="td-border-grid">Product Group</td>
							<td nowrap="nowrap" class="td-border-grid">Product Name</td>
							<td nowrap="nowrap" class="td-border-grid">Product Version</td>
							<td nowrap="nowrap" class="td-border-grid">Category</td>
							<td nowrap="nowrap" class="td-border-grid">Service Charge</td>
							<td nowrap="nowrap" class="td-border-grid">Problem</td>
							<td nowrap="nowrap" class="td-border-grid">Contact Person</td>
							<td nowrap="nowrap" class="td-border-grid">Assigned To</td>
							<td nowrap="nowrap" class="td-border-grid">Status</td>
							<td nowrap="nowrap" class="td-border-grid">Solved By</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td>
							<td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td>
							<td nowrap="nowrap" class="td-border-grid">Bill Number</td>
							<td nowrap="nowrap" class="td-border-grid">Acknowledgement Number</td>
							<td nowrap="nowrap" class="td-border-grid">Remarks</td>
							<td nowrap="nowrap" class="td-border-grid">Entered By</td>
							<td nowrap="nowrap" class="td-border-grid">Modified By</td>
							<td nowrap="nowrap" class="td-border-grid">Complaint ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
						</tr>';
				
				$result = runmysqlquery($query);
				$i_n = 0;
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
					loadregistersetselect(\''.$fetch['customername'].'\',\''.$fetch['customerid'].'\',
					\''.changedateformat($fetch['date']).'\',\''.$fetch['time'].'\',\''.$fetch['productgroup'].'\',
					\''.$fetch['productname'].'\',\''.$fetch['productversion'].'\',\'ssm_inhouseregister\',
					\''.$fetch['billno'].'\',\''.$fetch['complaintid'].'\',\''.$fetch['state'].'\');
					 " bgcolor='.$color.'>';
					
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>
								<input type='radio' name='nameloadcustomerradio' value=".$fetch['customerid']." id=".$radioid." 
onclick=\"loadregistersetselect('".$fetch['customername']."','".$fetch['customerid']."','".changedateformat($fetch['date'])."',
'".$fetch['time']."','".$fetch['productgroup']."','".$fetch['productname']."','".$fetch['productversion']."','ssm_inhouseregister','".$fetch['billno']."','".$fetch['complaintid']."','".$fetch['state']."');\" />
							</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['customerid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['time']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productgroup']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['productversion']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['category']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['servicecharge']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['contactperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['assignedto']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['status']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['solvedby']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['stremoteconnection']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['marketingperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['onsitevisit']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['overphone']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['mail']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['billno']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['acknowledgementno']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['userid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['modifiedby']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['complaintid']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedgroup']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorized']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['teamleaderremarks']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedperson']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizeddatetime']."</td>
							<td nowrap='nowrap' class='td-border-grid'>".$fetch['flag']."</td>";
				
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

?>