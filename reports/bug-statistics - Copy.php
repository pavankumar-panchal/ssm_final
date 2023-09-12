<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/bug-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Reports > Bug Statistics</td>
    </tr>
    <tr>
      <td></td>
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
                      <td valign="top" style="border-right:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">From Date:</td>
                            <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php datetimelocal('d-m-Y'); ?>" />
                              <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">To Date:</td>
                            <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php datetimelocal('d-m-Y'); ?>" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#f7faff">Product group:</td>
                            <td valign="top" bgcolor="#f7faff">
                              <span id="filterprdgroupdisplay">
                                <?php include('../inc/productgroup.php');
                                productname('s_productgroup', 'color');
                                ?>
                                <!-- Details are in javascript.js page as a function prdgroup();-->
                              </span>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Product Name:</td>
                            <td valign="top"><select name="productname" id="productname" class="swiftselect"
                                style="background:#FEFFE6;">
                                <option value="">Make A Selection</option>
                                <?php include('../inc/productfilter.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Error Description:</td>
                            <td valign="top"><input name="errorreported" type="text" class="swifttext"
                                id="errorreported" size="30" autocomplete="off" /></td>
                          </tr>

                        </table>
                      </td>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Status:</td>
                            <td valign="top"><select name="status" id="status" class="swiftselect">
                                <option value="">Make A Selection</option>
                                <option value="solved">Solved</option>
                                <option value="unsolved">Un Solved</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Entered By:</td>
                            <td valign="top"><select name="userid" id="userid" class="swiftselect">
                                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                                  <option value="">ALL</option>
                                  <?php include('../inc/useridselectionreports.php');
                                } else { ?>
                                  <?php include('../inc/useridselectionreports.php');
                                } ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Reported To:</td>
                            <td valign="top"><input name="reportedto" type="text" class="swifttext" id="reportedto"
                                size="30" autocomplete="off" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Reported By:</td>
                            <td valign="top"><input name="customername" type="text" class="swifttext" id="customername"
                                size="30" autocomplete="off" /></td>
                          </tr>

                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>

                    <tr>
                      <td colspan="2" align="right" valign="middle"
                        style="padding-right:15px; border-top:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                          <tr>
                            <td width="68%" height="35" align="left" valign="middle">
                              <div id="form-error"></div>
                            </td>
                            <td width="32%" height="35" align="right" valign="middle"><input name="view" type="submit"
                                class="swiftchoicebutton" id="view" value="View" onClick="formsubmit();" /></td>
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
    <tr>
      <td style="padding:0">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr>
            <td width="10%" class="header-line" style="padding:0">&nbsp;&nbsp;View Records: </td>
            <td width="75%" class="header-line" style="padding:0"><span id="tabgroupgridwb1"></span><span
                id="tabgroupgridwb2"></span><span id="tabgroupgridwb3"></span><span id="tabgroupgridwb4"></span></td>
            <td width="15%" class="header-line" style="padding:0"></td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top">
              <form name="gridformbug" id="gridformbug" action="../reports-excel/bug-report.php" method="post">
                <div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1060PX; padding:2px;" align="center">
                </div>
                <div id="tabgroupgridc2" style="display:block;padding-right:15px; border-top:1px solid #d1dceb;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                    <tr>
                      <td width="68%" height="35" align="left" valign="middle"></td>
                      <td width="32%" height="35" align="right" valign="middle"><input name="toexcel" type="submit"
                          class="swiftchoicebutton-orange" id="toexcel" value="To Excel" /></td>
                    </tr>
                  </table>
                </div>
              </form>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>


<div id="nameloaddiv" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Call Register > Get Customer</td>
    </tr>
    <tr>
      <td>
        <div id="gc-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/nameload.php'); ?>
  </table>
</div>


<div id="questionload" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Bug Statistics > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>