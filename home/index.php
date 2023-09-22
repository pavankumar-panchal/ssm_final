<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../inc/includefiles.php');
include('../inc/checktype.php');
include('../inc/teamchart.php');


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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
    <?php $pagetilte = getpagetitle($_GET['a_link']);
    echo ($pagetilte); ?>
  </title>
  <?php
  include('../inc/stylesnscripts.php');
  ?>


  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script>
    google.charts.load('current', { packages: ['annotatedtimeline'] });
    google.charts.setOnLoadCallback(gettimelinedata);
  </script>
</head>

<body marginheight="0" marginwidth="0" onload="bodyonload();">


  <?php
  include('../inc/navigation.php');
  ?>

  <?php if ($usertype == 'TEAMLEADER' || $usertype == 'ADMIN' || $usertype == 'MANAGEMENT') { ?>

    <tr>
      <td height="24" colspan="2" valign="top" style="border-bottom:1px solid #F0EADE"><span class="navtitle"><img
            src="../images/doublearrowsnav.gif" align="absmiddle" border="0" />&nbsp;<strong>Options</strong></span></td>
    </tr>
    <tr>
      <td colspan="2">
        <table width="100%" border="0" cellpadding="3" cellspacing="0">
          <tbody>
            <tr class="smalltext" onmouseover="this.className='hlrow';" onmouseout="this.className='smalltext';"
              style="cursor: pointer;" onclick="javascript:window.location.href='#';">
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

  <td valign="top" class="content-box"><input name="navigationtabcount" id="navigationtabcount" type="hidden"
      value="<?php echo ($navigationtabcount); ?>" />
    <?php
    ?>
    <?php if (!isset($_GET['a_link']) || $_GET['a_link'] == 'home_dashboard') { ?>

      <script type="text/javascript" src="http://www.google.com/jsapi"></script>
      <script language="javascript" src="../functions/annotatedtimeline.js" type="text/javascript"></script>


      <div class="container mt-4 ">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <strong>Chart on Count of Calls and Emails</strong>
              </div>
              <div class="card-body">
                <div id="dash_timeline">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="chart-container">
                        <div id="chart_div" style="width: 100%; height: 350px;"></div>
                      </div>
                    </div>
                    <br />
                    <div class="text-end">
                      <?php if ($usertype !== 'GUEST') { ?>
                        <a href="./index.php?a_link=report_statisticschart" class="btn btn-primary">Advanced</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

      <?php if ($usertype <> 'GUEST') { ?>
        <div class="container mt-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header " style="cursor:pointer;  ">
                  <strong>Attendance Summary of this Month</strong>
                  <button class="btn btn-sm btn-link float-right" type="button" data-toggle="" data-target="#dash_teamchart"
                    aria-expanded="false">
                    <i id="toggleimg3" class="fas fa-plus"></i>
                  </button>
                </div>
                <div class="" id="dash_teamchart">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <?php
                        echo ($attendanceCal);
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php } ?>
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header " style="cursor:pointer;  ">
                <strong>Team Chart</strong>
                <button class="btn btn-sm btn-link float-right" type="button" data-toggle="" data-target="#dash_teamchart"
                  aria-expanded="false">
                  <i id="toggleimg3" class="fas fa-plus"></i>
                </button>
              </div>
              <div class="" id="dash_teamchart">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12" style="padding-left: 10px; height:400px; overflow:hidden; overflow-y:scroll;">
                      <?php echo ($tgrid); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-4 ">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                Login Summary
              </div>
              <div class="card-body">
                <div id="dash_loginsummary">
                  <div class="table-responsive">
                    <table class="table">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } else {
      $pagelink = getpagelink($_GET['a_link']);
      include($pagelink);
    } ?>
</body>

</html>
<?php include("../inc/footer.php");