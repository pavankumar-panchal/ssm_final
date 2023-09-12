<?php
include_once('../inc/checktype.php');
include_once('../inc/stylesnscripts.php');
?>
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="../functions/data_ajax.js"></script>

<script type="text/javascript" language="javascript" src="../functions/daily-report.js"></script>
<script src="../js/jquery-1.4.2.min.js?dummy=<?php echo (rand()); ?>" language="javascript"></script>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Reports > Daily Report</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
            <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter the Details</td>
            <td align="right" class="header-line" style="padding-right:7px">
              <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                  align="absmiddle" /></div>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <div id="maindiv">
                <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#edf4ff">
                            <td valign="top">From Date:</td>
                            <td valign="top">
                              <input name="fromdate" type="text" class="swifttext" id="DPC_fromdate" size="30"
                                autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                              <input name="username" type="hidden" class="swifttext" id="username"
                                value="<?php echo ($user); ?>" />
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">To Date:</td>
                            <td valign="top">
                              <input name="todate" type="text" class="swifttext" id="DPC_todate" size="30"
                                autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                              <input name="usertype" type="hidden" class="swifttext" id="usertype"
                                value="<?php echo ($usertype); ?>" />
                            </td>
                          </tr>

                          <tr bgcolor="#edf4ff">
                            <td valign="top">User Name:</td>
                            <td valign="top">
                              <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') {
                                ?>
                                <select name="userid" id="userid" class="swiftselect">
                                  <?php include('../inc/useridselectionreports.php'); ?>
                                </select>
                                <?php
                              } else {
                                ?>
                                <span style="width:45%">
                                  <input type="hidden" name="userid" id="userid" />
                                  <?php
                                  echo $loggedusername;
                              }
                              ?>
                              </span>
                            </td>

                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                          <tr>
                            <td width="68%" height="35" align="left" valign="middle">
                              <div id="form-error"></div>
                            </td>
                            <td width="15%" height="35" align="right" valign="middle">
                              <input name="view" type="submit" class="swiftchoicebutton" id="view" value="View"
                                onclick="formsubmit('view'); " />
                              &nbsp;&nbsp;&nbsp; <img src="../images/toexcel.png" border="0" align="absmiddle"
                                onclick="formsubmit('toexcel');" style="cursor:pointer" />
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </form>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>sss
      <td style="padding:0">&nbsp;</td>
    </tr>
    <tr>
      <td id="processingbar"></td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr>
            <td class="header-line" style="padding:0">&nbsp;&nbsp;View Data:</td>
            <td align="right" class="header-line" style="padding-right:7px;"></td>
          </tr>
          <tr>
            <td colspan="2" valign="top">

              <div id="dailyreport" style="overflow:auto; height:300px; width:100%; padding:2px;" align="center"></div>
              <div id="calldataitem" title="Company Detail" style="margin-top:3%;"></div>
              <div id="display_form" title="Complaint Details" style="margin-top:3%;"></div>
            </td>

          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding:0">&nbsp;</td>
    </tr>
  </table>
</div>