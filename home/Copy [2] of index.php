<?php
include('../inc/includefiles.php');
if($_GET['a_link'] == 'logout')
	include('../inc/logout.php');
	
$localdate = datetimelocal('d-m-Y');
$localtime = datetimelocal('H:i:s');
$monthnum = date(n);
// logged in Users
$query = "SELECT DISTINCT userid, ssm_users.username ,ssm_users.fullname FROM ssm_usertime join 
(SELECT username,slno,fullname,supportunit,type from ssm_users) as ssm_users 
ON ssm_usertime.userid=ssm_users.slno WHERE ssm_usertime.logindate = CURDATE() 
AND ssm_usertime.logintype = 'IN' AND ssm_users.type <> 'ADMIN' order by field(ssm_users.supportunit,".$loggedsupportunit.") desc, ssm_users.fullname;";
$result = runmysqlquery($query);
$gridrow .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td nowrap="nowrap"><ul style="list-style-image:url(../images/r-bullet.gif);">';
while($fetch = mysqli_fetch_row($result))
{
		$gridrow .= "<li>".$fetch[2]."</li>";
}
$gridrow .= '</ul></td></tr></table>';

//values for in and out time - Last Working Day
$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS yintimedate FROM ssm_usertime WHERE userid = '".$user."' AND logindate <> CURDATE() AND logintype = 'IN'");
if($fetch['yintimedate'] <> '' && $fetch['yintimedate'] <> '0000-00-00')
	$yintimedateresult = $fetch['yintimedate'];
else
	$yintimedateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS lastworkingday FROM ssm_usertime WHERE userid = '".$user."' AND logindate <> CURDATE()"); 
if($fetch['lastworkingday'] <> '' && $fetch['lastworkingday'] <> '0000-00-00')
	$ydateresult = $fetch['lastworkingday']; 
else
	$ydateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '".$user."' AND logindate = '".$ydateresult."' AND logintype = 'IN'");
if($fetch['ylogintime']<>'' && $fetch['ylogintime'] <> '00:00:00')
	$yintimeresult = $fetch['ylogintime'];
else
	$yintimeresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '".$user."' AND logindate = '".$ydateresult."' AND logintype = 'OUT' ");
$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '".$user."' AND logindate = '".$ydateresult."' AND logintype = 'IN' ");
 
if($fetch['ylogouttime']<>'' && $fetch['ylogouttime'] <> '00:00:00' && $fetch['ylogouttime'] > $fetch1['ylogouttime'])
	$youttimeresult = $fetch['ylogouttime'];
else
	$youttimeresult = 'NA';
	

//Today's In Time
$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS tlogintime FROM ssm_usertime WHERE userid = '".$user."' AND logindate = CURDATE() AND logintype = 'IN'");
$tintimeresult = $fetch['tlogintime'];

// Attendance Details ------------------------------------------------------------
$year = date ("Y", mktime(0,0,0,date(n)));
$attendanceCal = attendanceCalendardashboard(date(m),$year,$user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php $pagetilte = getpagetitle($_GET['a_link']); echo($pagetilte); ?></title>
<?php include('../inc/stylesnscripts.php'); ?>
   <script type="text/javascript"> google.load('visualization', '1', {packages: ['orgchart', 'table']}); </script>
<script type="text/javascript">
    var map; var table; var data;

    function drawOrgChartAndTable() 
	{
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Executive Name');
      data.addColumn('string', 'Team Leader');
	  
	  <?php 
		$query = "SELECT username,reportingauthority FROM ssm_users WHERE type <> 'ADMIN' and reportingauthority <> '' and supportunit = '".$loggedsupportunit."'";
		$result = runmysqlquery($query);
		$fetchcount = mysqli_num_rows($result);
		echo("data.addRows(".$fetchcount.");");
		$row=0;
		while($fetch = mysqli_fetch_array($result))
		{
			if($fetch['reportingauthority'] <> '')
			{
				$fetchra = runmysqlqueryfetch("SELECT username FROM ssm_users WHERE slno = '".$fetch['reportingauthority']."'");
				$fetchrausername = $fetchra['username'];
			}
			else
				$fetchrausername = '';
				
			echo("data.setCell(".$row.", 0, '".$fetch['username']."');
			data.setCell(".$row.", 1, '".$fetchrausername."');");
			$row++;
		}
 ?>
    
      var orgchart = new google.visualization.OrgChart(document.getElementById('orgchart'));
      orgchart.draw(data, null);
    
      var table = new google.visualization.Table(document.getElementById('orgtable'));
      table.draw(data, null);
      
      // When the table is selected, update the orgchart.
      google.visualization.events.addListener(table, 'select', function() {
        orgchart.setSelection(table.getSelection());
      });
    
      // When the orgchart is selected, update the table visualization.
      google.visualization.events.addListener(orgchart, 'select', function() {
        table.setSelection(orgchart.getSelection());
      });  
    }

    google.setOnLoadCallback(drawOrgChartAndTable);
    </script>
</head>
<body  marginheight="0" marginwidth="0" onload="bodyonload();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="30%" rowspan="2" valign="top"><img src="../images/ssm-new-logo.jpg" border="0" height="50" /></td>
                <td width="70%" height="20" align="right" valign="bottom" style="padding-right:3px;"><font color="#6C82FA"><strong>Saral SSM - Version 1.51</strong></font></td>
              </tr>
              <tr>
                <td align="right" valign="bottom" class="top-small-text">Logged In as: <?php echo(ucwords(strtolower($loggedusername)).'   &nbsp;[ <u>'.ucwords(strtolower($usertype)).'</u> ]'); ?> | <span class="logout-text"><a href="./index.php?a_link=logout">Logout</a></span></td>
              </tr>
            </table></td>
        </tr>
        <tr height="4">
          <td colspan="2" bgcolor="#FFFFFF"><img src="../images/space.gif" width="1" height="4"></td>
        </tr>
        <tr height="1">
          <td colspan="2" bgcolor="#c6c3c6"><img src="../images/space.gif" width="1" height="1"></td>
        </tr>
        <tr height="4">
          <td colspan="2" bgcolor="#f0f0f0"><img src="../images/space.gif" width="1" height="4"></td>
        </tr>
        <tr>
          <td colspan="2"><?php include('../inc/navigation.php'); ?></td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:#C6C3C6 solid 1px;border-bottom:#C6C3C6 solid 1px;">
              <tr>
                <td width="182" valign="top" style="border-right:#C6C3C6 solid 1px; padding:4px; background-color:#F0EADE;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="lt-top"></td>
                    </tr>
                    <tr>
                      <td valign="top" class="lt-mid"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <?php if($usertype == 'TEAMLEADER' || $usertype == 'ADMIN'  || $usertype == 'MANAGEMENT') { ?><tr>
                            <td height="24" colspan="2" valign="top" style="border-bottom:1px solid #F0EADE"><span class="navtitle"><img src="../images/doublearrowsnav.gif" align="absmiddle" border="0" />&nbsp;<strong>Options</strong></span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="0">
                                <tbody>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td width="1"></td>
                                    <td>  <a href="./index.php?a_link=authorize_records">Authorize/Unauthorize</a> </td>
                                  </tr>
                                 
                                </tbody>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="2" colspan="2" valign="top" style="border-top:#C6C3C6 solid 1px;border-bottom:#C6C3C6 solid 1px; padding:0"></td>
                          </tr>
						  <?php } ?>
                          <tr>
                            <td height="24" colspan="2" valign="top" style="border-bottom:1px solid #F0EADE"><span class="navtitle"><img src="../images/doublearrowsnav.gif" align="absmiddle" border="0" />&nbsp;<strong>Reports</strong></span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="0">
                                <tbody>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td width="1"></td>
                                    <td><a href="./index.php?a_link=attendance_report">Attendance</a></td>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                  <td><a href="./index.php?a_link=report_callstatistics">Call Statistics</a>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                    <td><a href="./index.php?a_link=report_bugstatistics">Bug Statistics</a></td>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                    <td><a href="./index.php?a_link=report_onsitestatistics">Onsite Statistics</a></td>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                    <td><a href="./index.php?a_link=report_onsitependings">Onsite Pendings</a></td>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';" style="cursor: pointer;" onclick="javascript:window.location.href='#';">
                                    <td></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </tbody>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="lt-btm"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                <td valign="top" class="content-box"><input name="navigationtabcount" id="navigationtabcount" type="hidden" value="<?php echo($navigationtabcount); ?>" /> <?php if(!$_GET['a_link'] || $_GET['a_link'] == 'home_dashboard') { ?> 
				    <table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Home > Dashboard</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="78%" valign="top"><table class="dashborder" width="100%" border="0" cellpadding="4" cellspacing="0">
              <tbody>
                <tr style="height: 1em;">
                  <td valign="top" align="left"><table class="dashcontent" width="100%" border="0" cellpadding="2" cellspacing="0" height="300">
                      <tbody>
                        <tr>
                          <td valign="top" align="left" style="padding:4px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%" class="dashboard-active-tab" id="tabgroupgridh1" style="cursor:pointer" onclick="dashboardtab('1','tabgroupgrid');"><strong>Attendance and Login Summary</strong></td>
                              </tr>
                            <tr>
                              <td><div id="tabgroupgridc1" style="display:block;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                    <td class="content-header">Login Summary:</td>
                                  </tr>
                                  <tr>
                                    <td><u>Today - <?php echo(date("F j, Y", mktime (0,0,0,date(n)))); ?></u></td>
                                  </tr>
                                  <tr>
                                    <td>In Time: <?php echo($tintimeresult); ?></td>
                                  </tr>
                                  <tr>
                                    <td><u>Last Working Day: <?php echo(changedateformat($ydateresult)); ?></u></td>
                                  </tr>
                                  <tr>
                                    <td>In Time: <?php echo($yintimeresult); ?> | Out Time: <?php echo($youttimeresult); ?></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td class="content-header">Attendance Summary of this Month:</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><?php echo($attendanceCal); ?></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
              </tbody>
            </table></td>
            <td width="1%" valign="top">&nbsp;</td>
            <td width="21%" valign="top"><table class="dashborder" width="100%" border="0" cellpadding="4" cellspacing="0">
              <tbody>
                <tr style="height: 1em;">
                  <td valign="top" align="left"><table class="dashcontent" width="100%" border="0" cellpadding="2" cellspacing="0" height="300">
                      <tbody>
                        <tr>
                          <td valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                            <tr>
                              <td><strong>About:</strong></td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellpadding="3" cellspacing="0">
                                <tbody>
                                  <tr class="smalltext">
                                    <td width="75" nowrap="nowrap">Product:</td>
                                    <td>Saral SSM</td>
                                  </tr>
                                  <tr class="smalltext">
                                    <td nowrap="nowrap">Version: </td>
                                    <td>1.51</td>
                                  </tr>
                                </tbody>
                              </table></td>
                            </tr>
                            <tr>
                              <td style="padding:0;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><strong>Members, who have/had logged in today:</strong></td>
                            </tr>
                            <tr>
                              <td><?php echo($gridrow); ?></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </table>        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
				
				<?php } else { $pagelink = getpagelink($_GET['a_link']); include($pagelink); }?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="4" colspan="2" bgcolor="#FFFFFF"></td>
        </tr>
        <tr>
          <td height="5" colspan="2" bgcolor="#E1E1E1"></td>
        </tr>
        <tr class="page-footer-others">
          <td align="left"  class="page-footer-link">&nbsp;</td>
          <td height="20">A product of Relyon Web Management | Copyright © 2009 Relyon Softech Ltd. All rights reserved.</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>