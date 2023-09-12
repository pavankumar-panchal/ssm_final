<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername']; 
		$s_category = $_POST['s_category'];	$s_productname = $_POST['s_productname']; $s_status = $_POST['s_status'];
		$s_userid = $_POST['s_userid']; $s_compliantid = $_POST['s_compliantid'];
		$s_authorizedatabasefield = $_POST['s_authorizedatabasefield']; $s_flagdatabasefield = $_POST['s_flagdatabasefield'];
		$s_publishdatabasefield = $_POST['s_publishdatabasefield'];
		
		$s_authorizedatabasefieldpiece = ($s_authorizedatabasefield == "")?(""):(" AND authorized  LIKE '%".$s_authorizedatabasefield."%'");
		$s_flagdatabasefieldpiece = ($s_flagdatabasefield == "")?(""):(" AND flag  LIKE '%".$s_flagdatabasefield."%'");
		$s_publishdatabasefieldpiece = ($s_publishdatabasefield == "")?(""):(" AND publishrecord  LIKE '%".$s_publishdatabasefield."%'");

		$s_customernamepiece = ($s_customername == "")?(""):(" AND customername  LIKE '%".$s_customername."%'");
		$s_categorypiece = ($s_category == "")?(""):(" AND category  LIKE '%".$s_category."%'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND productname = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND userid  = '".$s_userid."'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND compliantid  LIKE '%".$s_compliantid."%'");
		switch($databasefield)
		{
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'call':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Person Name</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Caller Type</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Problem</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Remote Connection</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User Id</td><td nowrap = "nowrap" class="td-border-grid">Compliant ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">End Time</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT
 ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous,  ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, ssm_callregister.category AS category, ssm_callregister.callertype AS callertype, ssm_products.productname  AS productname, ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection, ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username, ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime, ssm_callregister.publishrecord AS publishrecord FROM ssm_callregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'call\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 22)
						{
							if($fetch[22] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'email':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Caller Type</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Person Name</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Subject</td><td nowrap = "nowrap" class="td-border-grid">Content</td><td nowrap = "nowrap" class="td-border-grid">Error File</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Thanking Email</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Compliant ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_emailregister.slno AS slno,ssm_emailregister.anonymous AS anonymous,ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,ssm_products.productname AS productname,ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,ssm_emailregister.compliantid AS compliantid,ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,ssm_emailregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,ssm_emailregister.flag AS flag, ssm_emailregister.publishrecord AS publishrecord FROM ssm_emailregister  LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'email\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 6)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 25)
						{
							if($fetch[25] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'error':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Reported By</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Database</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Error Reported</td><td nowrap = "nowrap" class="td-border-grid">Reported To</td><td nowrap = "nowrap" class="td-border-grid">Error File</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Solved Date</td><td nowrap = "nowrap" class="td-border-grid">Solution Given</td><td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td><td nowrap = "nowrap" class="td-border-grid">Solution File</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Error ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_errorregister.slno AS slno,ssm_errorregister.anonymous AS anonymous,  ssm_errorregister.customername AS customername,ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,ssm_errorregister.database AS `database`,ssm_errorregister.date AS date, ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,
ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,ssm_errorregister.status AS status,
ssm_errorregister.solveddate AS solveddate,ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS 
solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,ssm_users.fullname AS userid,
ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,ssm_errorregister.authorizeddatetime
 AS authorizeddatetime, ssm_errorregister.flag AS flag, ssm_errorregister.publishrecord AS publishrecord FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'error\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 6 || $i == 13)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 25)
						{
							if($fetch[25] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'inhouse':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Caller Type</td><td nowrap = "nowrap" class="td-border-grid">Service Charge</td><td nowrap = "nowrap" class="td-border-grid">Problem</td><td nowrap = "nowrap" class="td-border-grid">Contact Person</td><td nowrap = "nowrap" class="td-border-grid">Assigned To</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Solved By</td><td nowrap = "nowrap" class="td-border-grid">Solved Through</td><td nowrap = "nowrap" class="td-border-grid">Solved Date</td><td nowrap = "nowrap" class="td-border-grid">Bill Number</td><td nowrap = "nowrap" class="td-border-grid">Bill Date</td><td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Complaint ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_inhouseregister.slno AS slno,ssm_inhouseregister.anonymous AS anonymous,  ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, ssm_products.productname AS productname, ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, ssm_inhouseregister.flag AS flag, ssm_inhouseregister.publishrecord AS publishrecord  FROM ssm_inhouseregister 
LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'inhouse\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 26)
						{
							if($fetch[26] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'onsite':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Caller Type</td><td nowrap = "nowrap" class="td-border-grid">Service Charge</td><td nowrap = "nowrap" class="td-border-grid">Problem</td><td nowrap = "nowrap" class="td-border-grid">Contact Person</td><td nowrap = "nowrap" class="td-border-grid">Assigned To</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Solved By</td><td nowrap = "nowrap" class="td-border-grid">S. T. Remote Connection</td><td nowrap = "nowrap" class="td-border-grid">S. T. Marketing Person</td><td nowrap = "nowrap" class="td-border-grid">S. T. Onsite Visit</td><td nowrap = "nowrap" class="td-border-grid">S. T. Over Phone</td><td nowrap = "nowrap" class="td-border-grid">S. T. Mail</td><td nowrap = "nowrap" class="td-border-grid">Solved Date</td><td nowrap = "nowrap" class="td-border-grid">Bill Number</td><td nowrap = "nowrap" class="td-border-grid">Bill Date</td><td nowrap = "nowrap" class="td-border-grid">Acknowledgement Number</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Complaint ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_onsiteregister.slno AS slno ,ssm_onsiteregister.anonymous AS anonymous,  ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS authorizeddatetime, ssm_onsiteregister.flag AS flag, ssm_onsiteregister.publishrecord AS publishrecord FROM ssm_onsiteregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'onsite\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4 || $i == 17 || $i == 19)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 29)
						{
							if($fetch[29] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'reference':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Reported By</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Reference Through</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Contact Person</td><td nowrap = "nowrap" class="td-border-grid">Contact No</td><td nowrap = "nowrap" class="td-border-grid">Contact Address</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Reference ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT 
ssm_referenceregister.slno AS slno,
ssm_referenceregister.anonymous AS anonymous, 
ssm_referenceregister.customername AS customername,
ssm_products.productname AS productname, 
ssm_referenceregister.date AS date, 
ssm_referenceregister.time AS time, 
ssm_referenceregister.referencethrough AS referencethrough, 
ssm_referenceregister.category AS category, 
ssm_referenceregister.contactperson AS contactperson, 
ssm_referenceregister.contactno AS contactno, 
ssm_referenceregister.contactaddress AS contactaddress, 
ssm_referenceregister.email AS email, 
ssm_referenceregister.status AS status, 
ssm_referenceregister.remarks AS remarks, 
ssm_users.fullname AS userid, 
ssm_referenceregister.referenceid AS referenceid, 
ssm_referenceregister.authorized AS authorized, 
ssm_category.categoryheading AS authorizedgroup, 
ssm_referenceregister.teamleaderremarks AS teamleaderremarks, 
ssm_users1.fullname AS authorizedperson, 
ssm_referenceregister.authorizeddatetime AS authorizeddatetime, ssm_referenceregister.flag AS flag, ssm_referenceregister.publishrecord AS publishrecord  
FROM ssm_referenceregister 
LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'reference\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 21)
						{
							if($fetch[21] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'requirement':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Reproted By</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Database</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Requirement</td><td nowrap = "nowrap" class="td-border-grid">Reported To</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Solved Date</td><td nowrap = "nowrap" class="td-border-grid">Solution Given</td><td nowrap = "nowrap" class="td-border-grid">Solution Entered Time</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Requirement ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT 
ssm_requirementregister.slno AS slno, ssm_requirementregister.anonymous AS anonymous, 
ssm_requirementregister.customername AS customername, 
ssm_products.productname AS productname, 
ssm_requirementregister.productversion AS productversion, 
ssm_requirementregister.database AS `database`, 
ssm_requirementregister.date AS date, 
ssm_requirementregister.time AS time, 
ssm_requirementregister.requirement AS requirement, 
ssm_requirementregister.reportedto AS reportedto, 
ssm_requirementregister.status AS status, 
ssm_requirementregister.solveddate AS solveddate, 
ssm_requirementregister.solutiongiven AS solutiongiven, 
ssm_requirementregister.solutionenteredtime AS solutionenteredtime, 
ssm_requirementregister.remarks AS remarks, 
ssm_users.fullname AS userid, 
ssm_requirementregister.requirementid AS requirementid, 
ssm_requirementregister.authorized AS authorized, 
ssm_category.categoryheading AS authorizedgroup, 
ssm_requirementregister.teamleaderremarks AS teamleaderremarks, 
ssm_users1.fullname AS authorizedperson, 
ssm_requirementregister.authorizeddatetime AS authorizeddatetime, 
ssm_requirementregister.flag AS flag , ssm_requirementregister.publishrecord AS publishrecord 
FROM ssm_requirementregister 
LEFT JOIN ssm_products ON ssm_products.slno =  ssm_requirementregister.productname  
LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_requirementregister.authorizedperson 
LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'requirement\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 6)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 22)
						{
							if($fetch[22] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'skype':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Anonymous</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Sender</td><td nowrap = "nowrap" class="td-border-grid">Caller Type</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Problem</td><td nowrap = "nowrap" class="td-border-grid">Attachment</td><td nowrap = "nowrap" class="td-border-grid">Status</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Skype ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_skyperegister.slno AS slno,ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, ssm_skyperegister.time AS time, ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, ssm_skyperegister.conversation AS conversation, ssm_skyperegister.attachment AS attachment, ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime, ssm_skyperegister.flag AS flag , ssm_skyperegister.publishrecord AS publishrecord FROM ssm_skyperegister LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'skype\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 6)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 22)
						{
							if($fetch[22] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'invoice':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Bill Date</td><td nowrap = "nowrap" class="td-border-grid">Register Name</td><td nowrap = "nowrap" class="td-border-grid">Bill Number</td><td nowrap = "nowrap" class="td-border-grid">Bill Given To</td><td nowrap = "nowrap" class="td-border-grid">Amount</td><td nowrap = "nowrap" class="td-border-grid"Tax</td><td nowrap = "nowrap" class="td-border-grid">Total Amount</td><td nowrap = "nowrap" class="td-border-grid">Billed By</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Complaint ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_invoice.slno AS slno, ssm_invoice.customername AS customername,ssm_invoice.customerid AS customerid,ssm_invoice.date AS date,
ssm_invoice.time AS time,ssm_products.productname AS productname,ssm_invoice.productversion AS productversion,ssm_invoice.billdate AS billdate,
ssm_invoice.registername AS registername,ssm_invoice.billno AS billno,ssm_invoice.billto AS billto,ssm_invoice.amount AS amount, 
ssm_invoice.tax AS tax,ssm_invoice.tamount AS tamount,ssm_users1.fullname AS billedby,ssm_invoice.remarks AS remarks,ssm_users2.fullname AS userid,
ssm_invoice.complaintid AS complaintid,ssm_invoice.authorized AS authorized,
ssm_category.categoryheading AS authorizedgroup,ssm_invoice.teamleaderremarks AS teamleaderremarks, ssm_users3.fullname AS authorizedperson,
ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag, ssm_invoice.publishrecord AS publishrecord FROM ssm_invoice 
 LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'invoice\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 24)
						{
							if($fetch[24] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice");
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'receipt':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Customer Name</td><td nowrap = "nowrap" class="td-border-grid">Customer ID</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Bill Date</td><td nowrap = "nowrap" class="td-border-grid">Bill Number</td><td nowrap = "nowrap" class="td-border-grid">Receipt Number</td><td nowrap = "nowrap" class="td-border-grid">Receipt Date</td><td nowrap = "nowrap" class="td-border-grid">Cheque / Cash</td><td nowrap = "nowrap" class="td-border-grid">Cheque Number</td><td nowrap = "nowrap" class="td-border-grid">Amount</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td><td nowrap = "nowrap" class="td-border-grid">User ID</td><td nowrap = "nowrap" class="td-border-grid">Authorized</td><td nowrap = "nowrap" class="td-border-grid">Authorized Group</td><td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td><td nowrap = "nowrap" class="td-border-grid">Authorized Person</td><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td><td nowrap = "nowrap" class="td-border-grid">Flag</td><td nowrap = "nowrap" class="td-border-grid">Publish Record</td></tr>';
				
				$query = "SELECT ssm_receipts.slno AS slno, ssm_receipts.customername AS customername, ssm_receipts.customerid AS customerid, ssm_receipts.date AS date,ssm_receipts.time AS time,ssm_receipts.billdate AS billdate,ssm_receipts.billno AS billno,ssm_receipts.receiptno AS receiptno,ssm_receipts.receiptdate AS receiptdate,ssm_receipts.cheque_cash AS cheque_cash,ssm_receipts.chequeno AS chequeno,ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,ssm_users1.fullname AS userid,ssm_receipts.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,ssm_receipts.teamleaderremarks AS teamleaderremarks,ssm_users2.fullname AS authorizedperson,ssm_receipts.authorizeddatetime AS authorizeddatetime,ssm_receipts.flag AS flag, ssm_receipts.publishrecord AS publishrecord FROM ssm_receipts LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup  WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'receipt\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch) -1; $i++)
					{
						if($i == 4 || $i == 6 || $i == 9)
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 20)
						{
							if($fetch[20] == 'yes')	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
							else $grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flaginactive.png' width='14' height='14' border='0' /></td>";	
						}
						else
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($fetch[$i], 75, "<br />\n")."</td>";
					}
					$grid .= '</tr>';
				}
				$grid .= '</table>';
				$fetchcount = mysqli_num_rows($result);
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts");
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
		}
	
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_RA".$localdate."-".$localtime.".xls";
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($filepath);
			fclose($fp);
		} 
?>
