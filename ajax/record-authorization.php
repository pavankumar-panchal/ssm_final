<?php
ob_start("ob_gzhandler");
ini_set('memory_limit', '64M');

include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$type = $_POST['type'];
if(!isset($_POST['lastslno'])){$_POST['lastslno'] = null;}
if(!isset($_POST['databasefield'])){$_POST['databasefield'] = null;}

$lastslno = $_POST['lastslno'];
$databasefield = $_POST['databasefield'];

switch($type)
{
	case 'save':
	{
		$authorizedgroup = $_POST['authorizedgroup'];
		$authorizedatabasefield = $_POST['authorizedatabasefield'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$flagdatabasefield = $_POST['flagdatabasefield'];
		$publishdatabasefield = $_POST['publishdatabasefield'];
		$teamleaderremarks = $_POST['teamleaderremarks'];
		$authorizedperson = $_POST['authorizedperson'];
		
		switch($databasefield)
		{
			case 'call': 
				$query = "UPDATE ssm_callregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				teamleaderremarks = '".$teamleaderremarks."',authorizedperson = '".$authorizedperson."',
				publishrecord = '".$publishdatabasefield."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,
				publishrecord,flag,teamleaderremarks,authorizedgroup,authorized) VALUES('Call Register',
				'".$authorizedperson."','".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."',
				'".$publishdatabasefield."','".$flagdatabasefield."','".$teamleaderremarks."',
				'".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Call Register Record (slno- ".$lastslno.") Saved Successfully.");
				break;
				
			case 'email':
				$query = "UPDATE ssm_emailregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Email Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Email Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'error':
				$query = "UPDATE ssm_errorregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Error Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Error Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'inhouse':
				$query = "UPDATE ssm_inhouseregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',publishrecord = '".$publishdatabasefield."',
				flag = '".$flagdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Inhouse Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Inhouse Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'onsite':
				$query = "UPDATE ssm_onsiteregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',publishrecord = '".$publishdatabasefield."',
				flag = '".$flagdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Onsite Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Onsite Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'reference':
				$query = "UPDATE ssm_referenceregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Reference Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Reference Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'requirement':
				$query = "UPDATE ssm_requirementregister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Requirement Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Requirement Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'skype':
				$query = "UPDATE ssm_skyperegister SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag
				,teamleaderremarks,authorizedgroup,authorized) VALUES('Skype Register','".$authorizedperson."',
				'".$lastslno."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Skype Register Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'invoice':
				$query = "UPDATE ssm_invoice SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks,authorizedgroup,authorized) VALUES('Invoices','".$authorizedperson."','".$lastslno."',
				'".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Invoice Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
			case 'receipt':
				$query = "UPDATE ssm_receipts SET authorizedgroup = '".$authorizedgroup."',
				authorized = '".$authorizedatabasefield."',flag = '".$flagdatabasefield."',
				publishrecord = '".$publishdatabasefield."',teamleaderremarks = '".$teamleaderremarks."',
				authorizedperson = '".$authorizedperson."' WHERE slno = '".$lastslno."'";
				$result = runmysqlquery($query);
				
				$query = "INSERT INTO ssm_authorizationlogs(registername,userid,recordid,date,time,publishrecord,flag,
				teamleaderremarks, authorizedgroup,authorized) VALUES('Receipts','".$authorizedperson."','".$lastslno."',
				'".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$publishdatabasefield."',
				'".$flagdatabasefield."','".$teamleaderremarks."','".$authorizedgroup."','".$authorizedatabasefield."')";
				$result = runmysqlquery($query);
				
				echo("1^"."Receipt Record (slno- ".$lastslno.")  Saved Successfully.");
				break;
				
		}
	}
	break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
	case 'generategrid':
	{
		if(!isset($fromdate)){$fromdate=null;}
		if(!isset($todate)){$todate=null;}
		if(!isset($s_customernamepiece)){$s_customernamepiece=null;}
		if(!isset($s_categorypiece)){$s_categorypiece=null;}
		if(!isset($s_productnamepiece)){$s_productnamepiece=null;}
		if(!isset($s_statuspiece)){$s_statuspiece=null;}
		if(!isset($s_useridpiece)){$s_useridpiece=null;}
		if(!isset($s_compliantidpiece)){$s_compliantidpiece=null;}

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
					<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Problem</td>
					<td nowrap = "nowrap" class="td-border-grid">Status</td>
					<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Transferred To</td>
					<td nowrap = "nowrap" class="td-border-grid">User Id</td>
					<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					<td nowrap = "nowrap" class="td-border-grid">End Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
				</tr>';
		$query = "SELECT ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous, 
		ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, 
		ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, 			        ssm_callregister.category AS category, ssm_callregister.callertype AS callertype,
		ssm_callregister.productgroup AS productgroup, ssm_products.productname  AS productname,         
		ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem,
		ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection,                 
		ssm_callregister.remarks AS remarks, ssm_users.username AS username, ssm_callregister.compliantid AS compliantid,
		ssm_callregister.authorized AS authorized, ssm_category.categoryheading  AS categoryheading,         						
		ssm_callregister.teamleaderremarks AS teamleaderremarks, ssm_users1.username AS username,                 
		ssm_callregister.authorizeddatetime AS authorizeddatetime, ssm_callregister.flag AS flag, 
		ssm_callregister.endtime AS endtime, ssm_callregister.publishrecord AS publishrecord
        FROM ssm_callregister  
		LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
        LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
		LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
		LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup 
		WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.        
		$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.$s_compliantidpiece." ORDER BY  `date` DESC ";
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
					if($fetch[22] == 'yes')	
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
	}
	$fetchcount = mysqli_num_rows($result);
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister");
	echo($grid."|^^|"." ".$fetchcount ." [UN SOLVED] records found from ".$query['count']).".";
	//echo($query);
	break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
	case 'gridtoform':
	{
		switch($databasefield)
		{
			case 'call':
				$query = "SELECT slno,customername,customerid,`date`,`time`,personname,category,callertype,productgroup,
				productname,productversion,problem, `status`, remarks,transferredto,userid,compliantid,authorized,
				authorizedgroup,teamleaderremarks,authorizedperson,authorizeddatetime, flag,endtime,publishrecord 
				FROM ssm_callregister 
				WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query1 = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query1);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products 
				WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font>
											</td><td><strong>Problem</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['problem'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Customer ID</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customerid'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Transferred To:</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['transferredto'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Time</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['time'].'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Person Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['personname'].'</font></td>  
											<td><strong>Entered By</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result1['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Caller Type</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['callertype'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Call End Time</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['endtime'].'</font></td>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Authorized Person</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['authorizedperson'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Product Version</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td><strong>Product Group</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr>
									</table>';

				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'email':
				$query = "SELECT slno,anonymous,customername,customerid,productgroup,productname,productversion,date,
				time,callertype,category,personname,emailid,subject,content,errorfile,status,forwardedto,
				thankingemail,remarks,userid,compliantid,authorized,authorizedgroup,                teamleaderremarks,authorizedperson,authorizeddatetime,flag,publishrecord 
				FROM ssm_emailregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users 
				WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);

				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
									<tr bgcolor="#F7FAFF">
										<td><strong>Anonymous</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['anonymous'].'</font></td>
										<td><strong>Email ID</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['emailid'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Customer Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['customername'].'</font></td>
										<td><strong>Subject</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['subject'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Customer Id</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['customerid'].'</font></td>
										<td><strong>Content</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['content'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Product Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result2['productname'].'</font></td>
										<td><strong>Error File</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">http://'.$_SERVER['HTTP_HOST'].'/sssm/upload/'.$result['errorfile'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Version</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Date</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td bgcolor="#EDF4FF"><strong>Forwarded To</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['forwardedto'].'</font></td>
											</tr>
											<tr bgcolor="#F7FAFF">
												<td><strong>Time</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['time'].'</font></td>
												<td><strong>Thanking Email</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['thankingemail'].'</font></td>
											</tr>
											<tr bgcolor="#EDF4FF">
												<td><strong>Caller Type</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['callertype'].'</font></td>
												<td><strong>Remarks</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['remarks'].'</font></td>
											</tr>
											<tr bgcolor="#F7FAFF">
												<td><strong>Category</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['category'].'</font></td>
												<td><strong>Entered By</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result1['username'].'</font></td>
											</tr>
											<tr bgcolor="#EDF4FF">
												<td><strong>Person Name</strong></td>
												<td><strong>:</strong></td
												><td><font color="#FF0000">'.$result['personname'].'</font></td>
												<td><strong>Compliant Id</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['compliantid'].'</font></td>
											</tr>
											<tr bgcolor="#EDF4FF">
												<td><strong>Product Group</strong></td>
												<td><strong>:</strong></td>
												<td><font color="#FF0000">'.$result['productgroup'].'</font></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>';
				
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'error':
				$query = "SELECT * FROM ssm_errorregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username,                 ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Error File</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">http://'.$_SERVER['HTTP_HOST'].'/ssm/uploads/'.$result['errorfile'].'</font>
											</td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font>
											</td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Version</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td><strong>Solved Date</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['solveddate']).'</font>
											</td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Database</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['database'].'</font></td>
											<td><strong>Solution Given</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['solutiongiven'].'</font>
											</td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Solution Entered Time</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['solutionenteredtime'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Time</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['time'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Solution File</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"> <font color="#FF0000">http://'.$_SERVER['HTTP_HOST'].'/ssm/uploads/'.$result['solutionfile'].' </font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Error Reported</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['errorreported'].'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Entered By</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['username'].'</font></td>
											<td><strong>Product Group</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Reported To</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['reportedto'].'</font></td>
											<td><strong>Error ID</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['errorid'].'</font></td>
										</tr></table>';
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'inhouse':
				$query = "SELECT * FROM ssm_inhouseregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.fullname as assignedto 
				from  ssm_users WHERE ssm_users.slno = '".$result['assignedto']."'";
				$result3 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
										<td><strong>Customer Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['customername'].'</font></td>
										<td><strong>Contact Person</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['contactperson'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Customer Id</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['customerid'].'</font></td>
										<td><strong>Assigned To</strong></td><td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result3['assignedto'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Date</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
										<td><strong>Status</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['status'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Time</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['time'].'</font></td>
										<td><strong>Solved By</strong></td><td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['solvedby'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Product Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result2['productname'].'</font></td>
										<td><strong>Bill Number</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['billno'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td bgcolor="#EDF4FF"><strong>Product Version</strong></td>
										<td bgcolor="#EDF4FF"><strong>:</strong></td>
										<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productversion'].'</font></td>
										<td bgcolor="#EDF4FF"><strong>Acknowledgement Number</strong></td>
										<td bgcolor="#EDF4FF"><strong>:</strong></td>
										<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['acknowledgementno'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Category</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['category'].'</font></td>
										<td><strong>Remarks</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['remarks'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Caller Type</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['callertype'].'</font></td>
										<td><strong>Entered By</strong></td><td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['username'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Service Charge</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['servicecharge'].'</font></td>
										<td><strong>Compliant Id:</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['complaintid'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Problem</strong></td>
										<td>&nbsp;</td>
										<td><font color="#FF0000">'.$result['problem'].'</font></td>
										<td><strong>product Group</strong></td>
										<td>&nbsp;</td>
										<td><font color="#FF0000">'.$result['productgroup'].'</font></td>
									</tr>
								</table>';
				
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'onsite':
				$query = "SELECT * FROM ssm_onsiteregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.fullname as assignedto 
				from  ssm_users WHERE ssm_users.slno = '".$result['assignedto']."'";
				$result3 = runmysqlqueryfetch($query);
				
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Assigned To</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result3['assignedto'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Customer Id</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customerid'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Solved By</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['solvedby'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Time</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['time'].'</font></td>
											<td><strong>Product Group</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Solved Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['solveddate']).'
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Product Version</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Bill Number</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['billno'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Category</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['category'].'</font></td>
											<td><strong>Bill Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['billdate']).'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Caller Type</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['callertype'].'</font></td>
											<td><strong>Acknowledgement Number</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['acknowledgementno'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Service Charge</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['servicecharge'].'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Problem</strong></td>
											<td>&nbsp;</td>
											<td><font color="#FF0000">'.$result['problem'].'</font></td>
											<td><strong>Entered By</strong></td>
											<td><strong>:</strong></td><td><font color="#FF0000">'.$result['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td><strong>Contact Person</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['contactperson'].'</font></td>
											<td><strong>Compliant Id:</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['complaintid'].'</font></td>
										</tr>
										<tr>
											
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										</table>';
				
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'reference':
				$query = "SELECT * FROM ssm_referenceregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
									<tr bgcolor="#F7FAFF">
										<td><strong>Customer Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['customername'].'</font></td>
										<td><strong>Contact Number</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['contactno'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Product Name</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result2['productname'].'</font></td>
										<td><strong>Contact Address</strong></td><td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['contactaddress'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Date</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
										<td><strong>Email</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['email'].'</font></td>
									</tr>
									<tr bgcolor="#EDF4FF">
										<td><strong>Time</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['time'].'</font></td>
										<td><strong>Status</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['status'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Reference Through</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['referencethrough'].'</font></td>
										<td><strong>Remarks</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['remarks'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td bgcolor="#EDF4FF"><strong>Category</strong></td>
										<td bgcolor="#EDF4FF"><strong>:</strong></td>
										<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['category'].'</font></td>
										<td bgcolor="#EDF4FF"><strong>Entered By</strong></td>
										<td bgcolor="#EDF4FF"><strong>:</strong></td>
										<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result1['username'].'</font></td>
									</tr>
									<tr bgcolor="#F7FAFF">
										<td><strong>Contact Person</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['contactperson'].'</font></td>
										<td><strong>Reference ID</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result['referenceid'].'</font></td>
									</tr>
									<tr>
										<td><strong>Product Group</strong></td>
										<td><strong>:</strong></td>
										<td><font color="#FF0000">'.$result2['productgroup'].'</font></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								</table>';
				
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'requirement':
				$query = "SELECT * FROM ssm_requirementregister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Solved Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['solveddate']).'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Version</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td><strong>Solution Given</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['solutiongiven'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Database</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['database'].'</font></td>
											<td><strong>Solution Entered Time</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['solutionenteredtime'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td bgcolor="#EDF4FF"><strong>Time</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['time'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Entered By</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td><strong>Requirement</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['requirement'].'</font></td>
											<td><strong>Requirement Id</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['requirementid'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Reported To</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['reportedto'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Product Group</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr></table>';
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'skype':
				$query = "SELECT * FROM ssm_skyperegister WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Category</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['category'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Customer Id</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customerid'].'</font></td>
											<td><strong>Problem</strong></td>
											<td><strong>Skype Conversation</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['problem'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Sender</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['sender'].'</font></td>
											<td><strong>Attachment</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">http://'.$_SERVER['HTTP_HOST'].'/ssm/uploads/'.$result['attachment'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Caller Type</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['callertype'].'</font></td>
											<td><strong>Status</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['status'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Time</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['time'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Entered By</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result1['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Skype Id</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['skypeid'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Product version</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Product Group</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr></table>';
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'invoice':
				 $query = "SELECT * FROM ssm_invoice WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				$query = "Select ssm_products.slno as slno, ssm_products.productname as productname 
				from  ssm_products WHERE ssm_products.slno = '".$result['productname']."'";
				$result2 = runmysqlqueryfetch($query);
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Bill Number</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['billno'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Customer Id</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customerid'].'</font></td>
											<td><strong>Bill Given To</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['billto'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Amount</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['amount'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF"><td><strong>Time</strong></td>
											<td><strong>:</strong></td><td><font color="#FF0000">'.$result['time'].'</font></td>
											<td><strong>Service Tax</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['tax'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Product Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result2['productname'].'</font></td>
											<td><strong>Total Amount</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['tamount'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td bgcolor="#EDF4FF"><strong>Product version</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['productversion'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Billed By</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['billedby'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Bill Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['billdate'].'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Register Name</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['registername'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Entered By</strong></td>
											<td bgcolor="#EDF4FF">&nbsp;</td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result1['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#F7FAFF"><strong>Compliant ID</strong></td>
											<td bgcolor="#F7FAFF"><strong>:</strong></td>
											<td bgcolor="#F7FAFF"><font color="#FF0000">'.$result['complaintid'].'</font></td>
											<td bgcolor="#F7FAFF"><strong>Product Group</strong></td>
											<td bgcolor="#F7FAFF"><strong>:</strong></td>
											<td bgcolor="#F7FAFF"><font color="#FF0000">'.$result['productgroup'].'</font></td>
										</tr></table>';
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'receipt':
				$query = "SELECT * FROM ssm_receipts WHERE slno = '".$lastslno."'";
				$result = runmysqlqueryfetch($query);
				$query = "Select ssm_users.slno as slno, ssm_users.username as username, 
				ssm_users.reportingauthority as reportingauthority 
				from  ssm_users WHERE ssm_users.slno = '".$result['userid']."'";
				$result1 = runmysqlqueryfetch($query);
				
				$registercontent = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
										<tr bgcolor="#F7FAFF">
											<td><strong>Customer Name</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customername'].'</font></td>
											<td><strong>Receipt Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['receiptdate'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF">
											<td><strong>Customer Id</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['customerid'].'</font></td>
											<td><strong>Paid by</strong></td><td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['cheque_cash'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.changedateformat($result['date']).'</font></td>
											<td><strong>Cheque Number</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['chequeno'].'</font></td>
										</tr>
										<tr bgcolor="#EDF4FF"><td><strong>Time</strong></td>
											<td><strong>:</strong></td><td><font color="#FF0000">'.$result['time'].'</font></td>
											<td><strong>Amount</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['amount'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF"><td><strong>Bill Date</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['billdate'].'</font></td>
											<td><strong>Remarks</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['remarks'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td bgcolor="#EDF4FF"><strong>Bill Number</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result['billno'].'</font></td>
											<td bgcolor="#EDF4FF"><strong>Entered By</strong></td>
											<td bgcolor="#EDF4FF"><strong>:</strong></td>
											<td bgcolor="#EDF4FF"><font color="#FF0000">'.$result1['username'].'</font></td>
										</tr>
										<tr bgcolor="#F7FAFF">
											<td><strong>Receipt Number</strong></td>
											<td><strong>:</strong></td>
											<td><font color="#FF0000">'.$result['receiptno'].'</font></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										</table>';
				echo($result['slno']."^".$registercontent."^".$result['authorized']."^".$result3['authorizedgroup']."^".
				$result['teamleaderremarks']."^".$result['flag']."^".$result1['slno']."^".$result1['reportingauthority']
				."^".$result['publishrecord']);
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
		}
	}
	break;
	
	case 'searchfilter':
	{
		$fromdate = $_POST['fromdate']; 
		$todate = $_POST['todate']; 
		$s_customername = $_POST['s_customername']; 
		$s_category = $_POST['s_category'];	
		$s_productgroup = $_POST['s_productgroup'];
		$s_productname = $_POST['s_productname']; 
		$s_status = $_POST['s_status'];
		$s_userid = $_POST['s_userid']; 
		$s_compliantid = $_POST['s_compliantid']; 
		$s_customerid = $_POST['s_customerid']; 
		$s_problem = $_POST['s_problem']; 
		$s_transferredto = $_POST['s_transferredto']; 
		$s_supportunit = $_POST['s_supportunit']; 
		$orderby = $_POST['orderby']; 
		$s_authorizedatabasefield = $_POST['s_authorizedatabasefield']; 
		$s_flagdatabasefield = $_POST['s_flagdatabasefield'];
		$s_publishdatabasefield = $_POST['s_publishdatabasefield'];
		
		$s_authorizedatabasefieldpiece = ($s_authorizedatabasefield == "")?(""):(" AND authorized  LIKE '%".$s_authorizedatabasefield."%'");
		$s_flagdatabasefieldpiece = ($s_flagdatabasefield == "")?(""):(" AND flag  LIKE '%".$s_flagdatabasefield."%'");
		$s_publishdatabasefieldpiece = ($s_publishdatabasefield == "")?(""):(" AND publishrecord  LIKE '%".$s_publishdatabasefield."%'");
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND customername  LIKE '%".$s_customername."%'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND customerid  LIKE '%".$s_customerid."%'");
		$s_problempiece = ($s_problem == "")?(""):(" AND problem  LIKE '%".$s_problem."%'");
		$s_transferredtopiece = ($s_transferredto == "")?(""):(" AND transferredto  LIKE '%".$s_transferredto."%'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND compliantid  LIKE '%".$s_compliantid."%'");
		$s_supportunitpiece = ($s_supportunit == "")?(""):(" AND ssm_supportunits.slno = '".$s_supportunit."'");
		
		$s_categorypiece = ($s_category == "")?(""):(" AND category  LIKE '%".$s_category."%'");
		$s_productgrouppiece = ($s_productgroup == "")?(""):(" AND ssm_callregister.productgroup  LIKE '%".$s_productgroup."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND ssm_products.slno = '".$s_productname."'");
		$s_statuspiece = ($s_status == "")?(""):(" AND status = '".$s_status."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND userid  = '".$s_userid."'");
		$s_compliantidpiece = ($s_compliantid == "")?(""):(" AND compliantid  LIKE '%".$s_compliantid."%'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'ssm_callregister.customername'; break;
			case 'customerid': $orderbyfield = 'ssm_callregister.customerid'; break;
			case 'date': $orderbyfield = 'ssm_callregister.date'; break;
			case 'category': $orderbyfield = 'ssm_callregister.category'; break;
			case 'callertype': $orderbyfield = 'ssm_callregister.callertype'; break;
			case 'productname': $orderbyfield = 'ssm_callregister.productname'; break;
			case 'productgroup': $orderbyfield = 'ssm_callregister.productgroup'; break;
			case 'problem': $orderbyfield = 'ssm_callregister.problem'; break;
			case 'status': $orderbyfield = 'ssm_callregister.status'; break;
			case 'userid': $orderbyfield = 'ssm_callregister.userid'; break;
			case 'transferredto': $orderbyfield = 'ssm_callregister.transferredto'; break;
			case 'compliantid': $orderbyfield = 'ssm_callregister.compliantid'; break;	
			case 'time': $orderbyfield = 'ssm_callregister.time'; break;	
		}
		switch($databasefield)
		{
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
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
							<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Problem</td>
							<td nowrap = "nowrap" class="td-border-grid">Status</td>
							<td nowrap = "nowrap" class="td-border-grid">Remote Connection</td>
							<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">User Id</td>
							<td nowrap = "nowrap" class="td-border-grid">Compliant ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td
							><td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">End Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_callregister.slno AS slno,ssm_callregister.anonymous AS anonymous,  
				 ssm_callregister.customername AS customername, ssm_callregister.customerid AS customerid, 
				 ssm_callregister.date AS date, ssm_callregister.time AS time, ssm_callregister.personname AS personname, 				                 ssm_callregister.category AS category, ssm_callregister.callertype AS callertype,
				 ssm_callregister.productgroup AS productgroup, ssm_products.productname  AS productname,                 ssm_callregister.productversion AS productversion, ssm_callregister.problem AS problem, 
				 ssm_callregister.status AS status,ssm_callregister.stremoteconnection AS stremoteconnection,                 ssm_callregister.remarks AS remarks, ssm_users.username AS username, 
				 ssm_callregister.compliantid AS compliantid,ssm_callregister.authorized AS authorized,                 ssm_category.categoryheading  AS categoryheading, ssm_callregister.teamleaderremarks AS teamleaderremarks, 
				 ssm_users1.username AS username, ssm_callregister.authorizeddatetime AS authorizeddatetime,                 ssm_callregister.flag AS flag, ssm_callregister.endtime AS endtime, 
				 ssm_callregister.publishrecord AS publishrecord 
				 FROM ssm_callregister  
				 LEFT JOIN ssm_products ON ssm_products.slno = ssm_callregister.productname  
				 LEFT JOIN ssm_users on ssm_users.slno =ssm_callregister.userid 
				 LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_callregister.authorizedperson 
				 LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				 LEFT JOIN ssm_category on ssm_category.slno =ssm_callregister.authorizedgroup
				 WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".                 $s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				 $s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece.$s_customeridpiece.$s_problempiece.$s_transferredtopiece.$s_supportunitpiece." 
				 ORDER BY  `date` DESC, ".$orderbyfield." LIMIT 0,3000";
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
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_emailregister.slno AS slno, ssm_emailregister.anonymous AS anonymous,
				ssm_emailregister.customername AS customername,ssm_emailregister.customerid AS customerid,
				ssm_emailregister.productgroup AS productgroup,ssm_products.productname AS productname,
				ssm_emailregister.productversion AS  productversion,ssm_emailregister.date AS date,
				ssm_emailregister.time AS time,ssm_emailregister.callertype AS callertype, 
				ssm_emailregister.category AS category,ssm_emailregister.personname AS personname,
				ssm_emailregister.emailid AS emailid, ssm_emailregister.subject AS subject,
				ssm_emailregister.content AS content,ssm_emailregister.errorfile AS errorfile, 
				ssm_emailregister.status AS status,ssm_emailregister.thankingemail AS thankingemail,
				ssm_emailregister.remarks AS remarks, ssm_users.fullname AS userid,
				ssm_emailregister.compliantid AS compliantid,
				ssm_emailregister.authorized AS authorized, ssm_category.categoryheading AS authorizedgroup,
				ssm_emailregister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson,ssm_emailregister.authorizeddatetime AS authorizeddatetime,
				ssm_emailregister.flag AS flag, ssm_emailregister.publishrecord AS publishrecord 
				FROM ssm_emailregister  
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_emailregister.productname 
				LEFT JOIN ssm_users on ssm_users.slno=  ssm_emailregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno =ssm_emailregister.authorizedperson  
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_emailregister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.
				$s_flagdatabasefieldpiece.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
						if($i == 7)
						{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 26)
						{
							if($fetch[26] == 'yes')
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
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'error':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Database</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Error Reported</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_errorregister.slno AS slno,ssm_errorregister.anonymous AS anonymous,                  ssm_errorregister.customername AS customername,ssm_errorregister.productgroup AS productgroup,
				ssm_products.productname AS productname,ssm_errorregister.productversion AS productversion,
				ssm_errorregister.database AS `database`,ssm_errorregister.date AS date, 
				ssm_errorregister.time AS time,ssm_errorregister.errorreported AS errorreported,
                ssm_errorregister.reportedto AS reportedto,ssm_errorregister.errorfile AS errorfile,
                ssm_errorregister.status AS status,ssm_errorregister.solveddate AS solveddate,
				ssm_errorregister.solutiongiven AS solutiongiven,ssm_errorregister.solutionenteredtime AS 
				solutionenteredtime,ssm_errorregister.solutionfile AS solutionfile,ssm_errorregister.remarks AS remarks,
				ssm_users.fullname AS userid,ssm_errorregister.errorid AS errorid,ssm_errorregister.authorized AS authorized,
				ssm_category.categoryheading AS authorizedgroup,
				ssm_errorregister.teamleaderremarks AS teamleaderremarks,ssm_users1.fullname AS authorizedperson,
				ssm_errorregister.authorizeddatetime AS authorizeddatetime, ssm_errorregister.flag AS flag, 
				ssm_errorregister.publishrecord AS publishrecord 
				FROM ssm_errorregister 
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_errorregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_errorregister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece
				.$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
						if($i == 7 || $i == 15)
						{
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 25)
						{
							if($fetch[25] == 'yes')	
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
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'inhouse':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_inhouseregister.slno AS slno,ssm_inhouseregister.anonymous AS anonymous,  
				ssm_inhouseregister.customername AS customername, ssm_inhouseregister.customerid AS customerid, 
				ssm_inhouseregister.date AS date, ssm_inhouseregister.time AS time, 
				ssm_inhouseregister.productgroup AS productgroup,  ssm_products.productname AS productname,                 
				ssm_inhouseregister.productversion AS productversion, ssm_inhouseregister.category AS category, 
				ssm_inhouseregister.callertype AS callertype, ssm_inhouseregister.servicecharge AS servicecharge, 
				ssm_inhouseregister.problem AS problem, ssm_inhouseregister.contactperson AS contactperson, 
				ssm_users2.fullname AS assignedto, ssm_inhouseregister.status AS status, ssm_users3.fullname AS solvedby, 
				ssm_inhouseregister.billno AS billno, ssm_inhouseregister.acknowledgementno AS acknowledgementno, 
				ssm_inhouseregister.remarks AS remarks, ssm_users.fullname AS userid,
				ssm_inhouseregister.complaintid AS complaintid, ssm_inhouseregister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup, ssm_inhouseregister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson, ssm_inhouseregister.authorizeddatetime AS authorizeddatetime, 
				ssm_inhouseregister.flag AS flag, ssm_inhouseregister.publishrecord AS publishrecord  
				FROM ssm_inhouseregister
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_inhouseregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_inhouseregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_inhouseregister.authorizedperson 
				LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_inhouseregister.assignedto 
				LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_inhouseregister.solvedby 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_inhouseregister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.		
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'inhouse\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						elseif($i == 27)
						{
							if($fetch[27] == 'yes')	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'onsite':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
							<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td nowrap = "nowrap" class="td-border-grid">Service Charge</td>
							<td nowrap = "nowrap" class="td-border-grid">Problem</td>
							<td nowrap = "nowrap" class="td-border-grid">Contact Person</td>
							<td nowrap = "nowrap" class="td-border-grid">Assigned To</td>
							<td nowrap = "nowrap" class="td-border-grid">Status</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_onsiteregister.slno AS slno ,ssm_onsiteregister.anonymous AS anonymous,  
				ssm_onsiteregister.customername AS customername, ssm_onsiteregister.customerid AS customerid, 
				ssm_onsiteregister.date AS date, ssm_onsiteregister.time AS time, ssm_onsiteregister.productgroup AS 
				productgroup, ssm_products.productname AS productname, ssm_onsiteregister.productversion AS productversion, 
				ssm_onsiteregister.category AS category, ssm_onsiteregister.callertype AS callertype, 
				ssm_onsiteregister.servicecharge AS servicecharge, ssm_onsiteregister.problem AS problem, 
				ssm_onsiteregister.contactperson AS contactperson, ssm_users.fullname AS assignedto,ssm_supportunits1.heading 
				AS supportunit, ssm_onsiteregister.status AS status, ssm_users1.fullname AS solvedby, 
				ssm_onsiteregister.stremoteconnection AS stremoteconnection,ssm_onsiteregister.marketingperson AS 
				marketingperson,ssm_onsiteregister.onsitevisit AS onsitevisit,ssm_onsiteregister.overphone AS 
				overphone,ssm_onsiteregister.mail AS mail, ssm_onsiteregister.solveddate AS solveddate, 
				ssm_onsiteregister.billno AS billno, ssm_onsiteregister.billdate AS billdate, 
				ssm_onsiteregister.acknowledgementno AS acknowledgementno, ssm_onsiteregister.remarks AS remarks, 
				ssm_users2.fullname AS userid, ssm_onsiteregister.complaintid AS complaintid, ssm_onsiteregister.authorized AS 
				authorized, ssm_onsiteregister.authorizedgroup AS authorizedgroup, ssm_onsiteregister.teamleaderremarks AS 
				teamleaderremarks, ssm_users3.fullname AS authorizedperson, ssm_onsiteregister.authorizeddatetime AS 
				authorizeddatetime, ssm_onsiteregister.flag AS flag, ssm_onsiteregister.publishrecord AS publishrecord 
				FROM ssm_onsiteregister 
				LEFT JOIN ssm_products ON ssm_products.slno = ssm_onsiteregister.productname 
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_onsiteregister.assignedto 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_onsiteregister.solvedby 
				LEFT JOIN ssm_users AS ssm_users2 on ssm_users2.slno = ssm_onsiteregister.userid 
				LEFT JOIN ssm_users AS ssm_users3 on ssm_users3.slno = ssm_onsiteregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit = ssm_supportunits.slno 
				LEFT JOIN ssm_supportunits AS ssm_supportunits1 on ssm_supportunits1.slno = ssm_onsiteregister.supportunit 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_onsiteregister.authorizedgroup
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'onsite\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4 || $i == 23|| $i == 25)
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 35)
						{
							if($fetch[35] == 'yes')
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'reference':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Reported By</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Reference Through</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT 
				ssm_referenceregister.slno AS slno,
				ssm_referenceregister.anonymous AS anonymous, 
				ssm_referenceregister.customername AS customername,
				ssm_referenceregister.productgroup AS productgroup,
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
				ssm_referenceregister.authorizeddatetime AS authorizeddatetime, ssm_referenceregister.flag AS flag, 
				ssm_referenceregister.publishrecord AS publishrecord  
				FROM ssm_referenceregister 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_referenceregister.productname  
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_referenceregister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_referenceregister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_referenceregister.authorizedgroup  
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'reference\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 5)
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 22)
						{
							if($fetch[22] == 'yes')	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'requirement':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Reproted By</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Database</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT 
				ssm_requirementregister.slno AS slno, ssm_requirementregister.anonymous AS anonymous, 
				ssm_requirementregister.customername AS customername, 
				ssm_requirementregister.productgroup AS productgroup, 
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
				LEFT JOIN ssm_category on ssm_category.slno =ssm_requirementregister.authorizedgroup
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'requirement\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 7)
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
				$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister");
				
				break;
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'skype':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Anonymous</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Sender</td>
							<td nowrap = "nowrap" class="td-border-grid">Caller Type</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
							<td nowrap = "nowrap" class="td-border-grid">Problem</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Flag</td>
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_skyperegister.slno AS slno,
				ssm_skyperegister.anonymous AS anonymous,  ssm_skyperegister.customername AS customername, 
				ssm_skyperegister.customerid AS customerid, ssm_skyperegister.sender AS sender, 			
				ssm_skyperegister.callertype AS callertype, ssm_skyperegister.date AS date, 
				ssm_skyperegister.time AS time,ssm_skyperegister.productgroup AS productgroup, 
				ssm_products.productname AS productname, ssm_skyperegister.productversion AS productversion, 
				ssm_skyperegister.category AS category, ssm_skyperegister.problem AS problem, 
				ssm_skyperegister.conversation AS conversation, ssm_skyperegister.attachment AS attachment, 	
				ssm_skyperegister.status AS status, ssm_skyperegister.remarks AS remarks, ssm_users.fullname AS userid, 
				ssm_skyperegister.skypeid AS skypeid, ssm_skyperegister.authorized AS authorized, 
				ssm_category.categoryheading AS authorizedgroup, ssm_skyperegister.teamleaderremarks AS teamleaderremarks, 
				ssm_users1.fullname AS authorizedperson, ssm_skyperegister.authorizeddatetime AS authorizeddatetime, 
				ssm_skyperegister.flag AS flag , ssm_skyperegister.publishrecord AS publishrecord 
				FROM ssm_skyperegister 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_skyperegister.productname  
				LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_skyperegister.userid 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users.slno = ssm_skyperegister.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_skyperegister.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'skype\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch)-1; $i++)
					{
						if($i == 6)
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 23)
						{
							if($fetch[23] == 'yes')
							{	$grid .= "<td nowrap='nowrap' class='td-border-grid'><img src='../images/flag.png' width='14' height='14' border='0' /></td>";	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'invoice':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Customer ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Time</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
							
				$query = "SELECT ssm_invoice.slno AS slno, ssm_invoice.customername AS customername,
				ssm_invoice.customerid AS customerid,ssm_invoice.date AS date,
				ssm_invoice.time AS time,ssm_invoice.productgroup AS productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion AS productversion,ssm_invoice.billdate AS billdate,
				ssm_invoice.registername AS registername,ssm_invoice.billno AS billno,ssm_invoice.billto AS 
				billto,ssm_invoice.amount AS amount, 
				ssm_invoice.tax AS tax,ssm_invoice.tamount AS tamount,ssm_users1.fullname AS billedby,
				ssm_invoice.remarks AS remarks,ssm_users2.fullname AS userid,
				ssm_invoice.complaintid AS complaintid,ssm_invoice.authorized AS authorized,
				ssm_category.categoryheading AS authorizedgroup,ssm_invoice.teamleaderremarks AS teamleaderremarks, 
				ssm_users3.fullname AS authorizedperson,
				ssm_invoice.authorizeddatetime AS authorizeddatetime,ssm_invoice.flag AS flag, 
				ssm_invoice.publishrecord AS publishrecord FROM ssm_invoice 
				LEFT JOIN ssm_products ON ssm_products.slno =  ssm_invoice.productname 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_invoice.billedby 
				LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_invoice.userid 
				LEFT JOIN ssm_users AS ssm_users3  on ssm_users3.slno = ssm_invoice.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users1.supportunit =ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_invoice.authorizedgroup 
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".
				$s_customernamepiece.$s_categorypiece.$s_productgrouppiece.$s_productnamepiece.$s_statuspiece.
				$s_useridpiece.$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'invoice\');" bgcolor='.$color.'>';
					for($i = 0; $i < count($fetch); $i++)
					{
						if($i == 4)
						{
							$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
						}
						elseif($i == 24)
						{
							if($fetch[24] == 'yes')	
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
			case 'receipt':
			 
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
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
							<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
						</tr>';
				
				$query = "SELECT ssm_receipts.slno AS slno, ssm_receipts.customername AS customername, 	                
				ssm_receipts.customerid AS customerid, ssm_receipts.date AS date,
				ssm_receipts.time AS time,ssm_receipts.billdate AS billdate,ssm_receipts.billno AS billno,
				ssm_receipts.receiptno AS receiptno,ssm_receipts.receiptdate AS receiptdate,
				ssm_receipts.cheque_cash AS cheque_cash,ssm_receipts.chequeno AS chequeno,
				ssm_receipts.amount AS amount, ssm_receipts.remarks AS remarks,ssm_users1.fullname AS userid,
				ssm_receipts.authorized AS authorized,ssm_category.categoryheading AS authorizedgroup,
				ssm_receipts.teamleaderremarks AS teamleaderremarks,ssm_users2.fullname AS authorizedperson,
				ssm_receipts.authorizeddatetime AS authorizeddatetime,ssm_receipts.flag AS flag, 
				ssm_receipts.publishrecord AS publishrecord 
				FROM ssm_receipts 
				LEFT JOIN ssm_users AS ssm_users1 on ssm_users1.slno = ssm_receipts.userid 
				LEFT JOIN ssm_users AS ssm_users2  on ssm_users2.slno = ssm_receipts.authorizedperson 
				LEFT JOIN ssm_supportunits on ssm_users1.supportunit = ssm_supportunits.slno 
				LEFT JOIN ssm_category on ssm_category.slno =ssm_receipts.authorizedgroup  
				WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".                
				$s_customernamepiece.$s_categorypiece.$s_productnamepiece.$s_statuspiece.$s_useridpiece.
				$s_compliantidpiece.$s_authorizedatabasefieldpiece.$s_flagdatabasefieldpiece.                
				$s_publishdatabasefieldpiece." ORDER BY  `date` DESC ";
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
					$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].',\'receipt\');" bgcolor='.$color.'>';
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
/*-----------------------------------------------------------------------------------------------------------------------------------*/				
		}
		echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
	}
	break;
}
?>