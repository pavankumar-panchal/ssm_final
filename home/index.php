<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../inc/includefiles.php');
include('../inc/checktype.php');
include('../inc/teamchart.php');
/*if($_GET['a_link'] == 'logout')
  include('../inc/logout.php');*/

$localdate = datetimelocal('d-m-Y');
$localtime = datetimelocal('H:i:s');
$monthnum = date('n');
// logged in Users
include('../inc/membersloggedin.php');
//values for in and out time - Last Working Day
$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS yintimedate FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate <> CURDATE() AND logintype = 'IN'");
if ($fetch['yintimedate'] <> '' && $fetch['yintimedate'] <> '0000-00-00')
  $yintimedateresult = $fetch['yintimedate'];
else
  $yintimedateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS lastworkingday FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate <> CURDATE()");
if ($fetch['lastworkingday'] <> '' && $fetch['lastworkingday'] <> '0000-00-00')
  $ydateresult = $fetch['lastworkingday'];
else
  $ydateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'IN'");
if ($fetch['ylogintime'] <> '' && $fetch['ylogintime'] <> '00:00:00')
  $yintimeresult = $fetch['ylogintime'];
else
  $yintimeresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'OUT' ");
$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'IN' ");

if ($fetch['ylogouttime'] <> '' && $fetch['ylogouttime'] <> '00:00:00' && $fetch['ylogouttime'] > $fetch1['ylogouttime'])
  $youttimeresult = $fetch['ylogouttime'];
else
  $youttimeresult = 'NA';


//Today's In Time
$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS tlogintime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = CURDATE() AND logintype = 'IN'");
$tintimeresult = $fetch['tlogintime'];

// Attendance Details ------------------------------------------------------------
$year = date("Y", mktime(0, 0, 0, date('n')));
$attendanceCal = attendanceCalendardashboard(date('m'), $year, $user);

?>



<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
    <?php $pagetilte = getpagetitle($_GET['a_link']);
    echo ($pagetilte); ?>
  </title>
  <?php include('../inc/stylesnscripts.php'); ?>


  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', { packages: ['annotatedtimeline'] });
    google.charts.setOnLoadCallback(gettimelinedata);
  </script>

</head>

<body marginheight="0" marginwidth="0" onload="bodyonload();">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td width="30%" rowspan="2" valign="top"><img src="../images/ssm-new-logo.jpg" border="0"
                      height="50" /></td>
                  <td width="70%" height="20" align="right" valign="bottom" style="padding-right:3px;">
                    <font color="#6C82FA"><strong>Saral SSM - Version 2.00</strong></font>
                  </td>
                </tr>
                <tr>
                  <td align="right" valign="bottom" class="top-small-text">Logged In as:
                    <?php echo (ucwords(strtolower($loggedusername)) . '   &nbsp;[ <u>' . ucwords(strtolower($usertype)) . '</u> ]'); ?>
                    | <span class="logout-text"><a href="../logout.php"
                        onclick="<?php if ($usertype == "ADMIN" || $usertype == "MANAGEMENT" || $usertype == "GUEST") { ?> SetCookie('navigationcookie','1|tabgroup1|home-nav|home-nav-div-line|home-nav-sub-div'); <?php } ?>">Logout</a></span>
                  </td>
                </tr>
              </table>
            </td>
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
            <td colspan="2">
              <?php include('../inc/navigation.php'); ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <table width="100%" border="0" cellspacing="0" cellpadding="0"
                style="border-top:#C6C3C6 solid 1px;border-bottom:#C6C3C6 solid 1px;">
                <tr>
                  <td width="182" valign="top"
                    style="border-right:#C6C3C6 solid 1px; padding:4px; background-color:#F0EADE;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="lt-top"></td>
                      </tr>
                      <tr>
                        <td valign="top" class="lt-mid">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <?php if ($usertype == 'TEAMLEADER' || $usertype == 'ADMIN' || $usertype == 'MANAGEMENT') { ?>
                              <tr>
                                <td height="24" colspan="2" valign="top" style="border-bottom:1px solid #F0EADE"><span
                                    class="navtitle"><img src="../images/doublearrowsnav.gif" align="absmiddle"
                                      border="0" />&nbsp;<strong>Options</strong></span></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                    <tbody>
                                      <tr class="smalltext" onmouseover="this.className='hlrow';"
                                        onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                        onclick="javascript:window.location.href='#';">
                                        <td width="1"></td>
                                        <td><a href="./index.php?a_link=authorize_records">Record Authorization</a> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td height="2" colspan="2" valign="top"
                                  style="border-top:#C6C3C6 solid 1px;border-bottom:#C6C3C6 solid 1px; padding:0"></td>
                              </tr>
                            <?php } ?>
                            <tr>
                              <td height="24" colspan="2" valign="top" style="border-bottom:1px solid #F0EADE"><span
                                  class="navtitle"><img src="../images/doublearrowsnav.gif" align="absmiddle"
                                    border="0" />&nbsp;<strong>Reports</strong></span></td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                  <tbody>
                                    <?php if ($usertype <> 'GUEST') { ?>
                                    <?php } ?>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td width="1"></td>
                                      <td><a href="./index.php?a_link=report_callstatistics">Stats &amp; Reports</a>
                                    </tr>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td><a href="./index.php?a_link=report_bugstatistics">Error Report</a></td>
                                    </tr>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td><a href="./index.php?a_link=report_requirementstatistics">Requirement
                                          Report</a></td>
                                    </tr>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td><a href="./index.php?a_link=report_onsitestatistics">Onsite Report</a></td>
                                    </tr>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td><a href="./index.php?a_link=report_statisticschart">Chart View</a></td>
                                    </tr>
                                    <?php if ($usertype <> 'GUEST') { ?>
                                      <tr class="smalltext" onmouseover="this.className='hlrow';"
                                        onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                        onclick="javascript:window.location.href='#';">
                                        <td></td>
                                        <td><a href="./index.php?a_link=attendance_report">Attendance</a></td>
                                      </tr>
                                    <?php } ?>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td><a href="./index.php?a_link=report_dailyreport">Daily Report</a></td>
                                    </tr>
                                    <tr class="smalltext" onmouseover="this.className='hlrow';"
                                      onmouseout="this.className='smalltext';" style="cursor: pointer;"
                                      onclick="javascript:window.location.href='#';">
                                      <td></td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
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
                    </table>
                  </td>
                  <td valign="top" class="content-box"><input name="navigationtabcount" id="navigationtabcount"
                      type="hidden" value="<?php echo ($navigationtabcount); ?>" />
                    <?php
                    // if (!$_GET['a_link'] || $_GET['a_link'] == 'home_dashboard') {
                    ?>
                    <?php if (!isset($_GET['a_link']) || $_GET['a_link'] == 'home_dashboard') { ?>

                      <script type="text/javascript" src="http://www.google.com/jsapi"></script>
                      <script language="javascript" src="../functions/annotatedtimeline.js"
                        type="text/javascript"></script>

                      <table width="100%" border="0" cellspacing="0" cellpadding="4">
                        <tr>
                          <td class="content-header">Home > Dashboard</td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td style="padding:0">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="top">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="81%" valign="top">
                                        <table class="dashborder" width="100%" border="0" cellpadding="4" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td valign="top" align="left">
                                                <table class="dashcontent" width="100%" border="0" cellpadding="2"
                                                  cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <td valign="top" align="left">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                          style="border:1px solid #F09E0A; border-top:none;">
                                                          <tr style="cursor:pointer"
                                                            onclick="showhide('dash_timeline','toggleimg4');">
                                                            <td class="header-line-dash" style="padding:0">
                                                              &nbsp;<strong>&nbsp;Chart on count of Calls and
                                                                emails</strong></td>
                                                            <td align="right" class="header-line-dash"
                                                              style="padding-right:7px">
                                                              <div align="right"><img src="../images/minus.jpg" border="0"
                                                                  id="toggleimg4" name="toggleimg" align="absmiddle" />
                                                              </div>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2">
                                                              <div id="dash_timeline" style="display:block;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                  cellpadding="3">
                                                                  <tr>
                                                                    <td>

                                                                      <div id='chart_div'
                                                                        style='width: 700px; height: 240px;'></div>



                                                                      <br />
                                                                      <div align="right" style='width: 700px;'>
                                                                        <?php if ($usertype <> 'GUEST') { ?><a
                                                                            href="./index.php?a_link=report_statisticschart">Advanced</a>
                                                                        <?php } ?>
                                                                      </div>
                                                                    </td>
                                                                  </tr>
                                                                </table>
                                                              </div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                    <?php if ($usertype <> 'GUEST') { ?>
                                                      <tr valign="top">
                                                        <td align="left">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="top">
                                                        <td align="left" style="padding:4px">
                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            style="border:1px solid #F09E0A; border-top:none;">
                                                            <tr style="cursor:pointer"
                                                              onclick="showhide('dash_attendancesummary','toggleimg2');">
                                                              <td class="header-line-dash" style="padding:0">
                                                                &nbsp;<strong>&nbsp;Attendance Summary of this
                                                                  Month</strong></td>
                                                              <td align="right" class="header-line-dash"
                                                                style="padding-right:7px">
                                                                <div align="right"><img src="../images/plus.jpg" border="0"
                                                                    id="toggleimg2" name="toggleimg" align="absmiddle" />
                                                                </div>
                                                              </td>
                                                            </tr>
                                                            <tr>
                                                              <td colspan="2">
                                                                <div id="dash_attendancesummary" style="display:none;">
                                                                  <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="3">
                                                                    <tr>
                                                                      <td align="center">
                                                                        <?php echo ($attendanceCal); ?>
                                                                      </td>
                                                                    </tr>
                                                                  </table>
                                                                </div>
                                                              </td>
                                                            </tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                    <?php } ?>
                                                    <tr valign="top">
                                                      <td align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr valign="top">
                                                      <td align="left">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                          style="border:1px solid #F09E0A; border-top:none;">
                                                          <tr style="cursor:pointer"
                                                            onclick="showhide('dash_teamchart','toggleimg3');">
                                                            <td class="header-line-dash" style="padding:0">
                                                              &nbsp;<strong>&nbsp;Team Chart</strong></td>
                                                            <td align="right" class="header-line-dash"
                                                              style="padding-right:7px">
                                                              <div align="right"><img src="../images/plus.jpg" border="0"
                                                                  id="toggleimg3" name="toggleimg" align="absmiddle" />
                                                              </div>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2">
                                                              <div id="dash_teamchart" style="display:none;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                  cellpadding="3">
                                                                  <tr>
                                                                    <td style="padding-left:10px; ">
                                                                      <?php echo ($tgrid); ?>
                                                                    </td>
                                                                  </tr>

                                                                </table>
                                                              </div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="top" align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top" style="padding:4px;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                          style="border:1px solid #F09E0A; border-top:none;">
                                                          <tr style="cursor:pointer"
                                                            onclick="showhide('dash_loginsummary','toggleimg');">
                                                            <td class="header-line-dash" style="padding:0">
                                                              &nbsp;<strong>&nbsp;Login Summary</strong></td>
                                                            <td align="right" class="header-line-dash"
                                                              style="padding-right:7px">
                                                              <div align="right"><img src="../images/minus.jpg" border="0"
                                                                  id="toggleimg" name="toggleimg" align="absmiddle" />
                                                              </div>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2">
                                                              <div id="dash_loginsummary" style="display:none;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                  cellpadding="3">
                                                                  <tr>
                                                                    <td><strong>Today -
                                                                        <?php echo (date("F j, Y", mktime(0, 0, 0, date('n')))); ?>
                                                                      </strong></td>
                                                                    <td><strong>Last Working Day -
                                                                        <?php echo (date("d-m-Y", strtotime($ydateresult))); ?>
                                                                      </strong></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>In Time:
                                                                      <?php echo ($tintimeresult); ?>
                                                                    </td>
                                                                    <td>In Time:
                                                                      <?php echo ($yintimeresult); ?> | Out Time:
                                                                      <?php echo ($youttimeresult); ?>
                                                                    </td>
                                                                  </tr>
                                                                </table>
                                                              </div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>

                                                    <tr>
                                                      <td valign="top" align="left">&nbsp;</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                      <td width="1%" valign="top">&nbsp;</td>
                                      <td width="18%" valign="top">
                                        <table class="dashborder" width="100%" border="0" cellpadding="4" cellspacing="0">
                                          <tbody>
                                            <tr style="height: 1em;">
                                              <td valign="top" align="left">
                                                <table class="dashcontent" width="100%" border="0" cellpadding="2"
                                                  cellspacing="0" height="300">
                                                  <tbody>
                                                    <tr>
                                                      <td valign="top" align="left">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                                          <tr>
                                                            <td><strong>About:</strong></td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <table width="100%" border="0" cellpadding="3"
                                                                cellspacing="0">
                                                                <tbody>
                                                                  <tr class="smalltext">
                                                                    <td width="75" nowrap="nowrap">Product:</td>
                                                                    <td>Saral SSM</td>
                                                                  </tr>
                                                                  <tr class="smalltext">
                                                                    <td nowrap="nowrap">Version: </td>
                                                                    <td>2.00</td>
                                                                  </tr>
                                                                </tbody>
                                                              </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td style="padding:0;">&nbsp;</td>
                                                          </tr>
                                                          <tr>
                                                            <td><strong>Members, who have/had logged in today:</strong>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <?php echo ($membergrid); ?>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                      </table>
                    <?php } else {
                      $pagelink = getpagelink($_GET['a_link']);
                      include($pagelink);
                    } ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td height="4" colspan="2" bgcolor="#FFFFFF"></td>
          </tr>
          <tr>
            <td height="5" colspan="2" bgcolor="#E1E1E1"></td>
          </tr>
          <tr class="page-footer-others">
            <td align="left" class="page-footer-link">&nbsp;</td>
            <td height="20">A product of Relyon Web Management | Copyright © 2012 Relyon Softech Ltd. All rights
              reserved.</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>