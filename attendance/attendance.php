<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>

  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <script language="javascript" src="../functions/attendancereport.js" type="text/javascript"></script>
  <div id="contentdiv" style="display:block;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Attendance >
          <?php echo (ucwords(strtolower($loggedusername))); ?>
        </td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td style="padding:0">
          <table width="100%" border="0" cellspacing="0" cellpadding="0"
            style="border:1px solid #6393df; border-top:none;">
            <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
              <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter Details</td>
              <td align="right" class="header-line" style="padding-right:7px">
                <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                    align="absmiddle" /></div>
              </td>
            </tr>
            <tr>
              <td colspan="2" valign="top">
                <div id="maindiv">
                  <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">Executive Name:</td>
                              <td valign="top"><select name="userid" id="userid" class="swiftselect">
                                  <option value="" selected="selected">Make A Selection</option>
                                  <?php include('../inc/a-useridselectionreports.php'); ?>
                                </select>
                                <input type="hidden" name="lastslno" id="lastslno" value="" />
                                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                  value="<?php echo ($usertype); ?>" />
                                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                  value="<?php echo ($reportingauthority); ?>" />
                              </td>
                            </tr>

                          </table>
                        </td>
                        <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">Month:</td>
                              <td valign="top"><select name="month" id="month" class="swiftselect">
                                  <option value="">Make A Selection</option>
                                  <option value="01">January</option>
                                  <option value="02">February</option>
                                  <option value="03">March</option>
                                  <option value="04">April</option>
                                  <option value="05">May</option>
                                  <option value="06">June</option>
                                  <option value="07">July</option>
                                  <option value="08">August</option>
                                  <option value="09">September</option>
                                  <option value="10">October</option>
                                  <option value="11">November</option>
                                  <option value="12">December</option>
                                </select></td>
                            </tr>

                          </table>
                        </td>
                        <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">Year:</td>
                              <td valign="top"><select name="year" id="year" class="swiftselect">
                                  <option value="">Make A Selection</option>
                                  <?php
                                  $query = "SELECT DISTINCT LEFT(logindate,4) AS year FROM ssm_usertime WHERE LEFT(logindate,4) <>'0000' ORDER BY LEFT(logindate,4) desc;";
                                  $result = runmysqlquery($query);
                                  while ($fetch = mysqli_fetch_array($result)) {
                                    echo ('<option value="' . $fetch['year'] . '">' . $fetch['year'] . '</option>');
                                  }

                                  ?>
                                </select></td>
                            </tr>

                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="right" valign="middle"
                          style="padding-right:15px; border-top:1px solid #d1dceb;">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                            <tr>
                              <td width="68%" height="35" align="left" valign="middle">
                                <div id="form-error"></div>
                              </td>
                              <td width="32%" height="35" align="right" valign="middle">
                                <input name="display" type="button" class="swiftchoicebutton" id="display" value="Display"
                                  onclick="attendancedisplay()" />&nbsp;&nbsp;&nbsp;
                                <!-- <input name="advanced" type="button" class="swiftchoicebutton-orange" id="advanced" value="Advanced" href="./index.php?a_link=attendance_report_adv'" />-->
                                <a href="./index.php?a_link=attendance_report_adv">Advanced</a>
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
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td style="padding:0">
          <table width="100%" border="0" cellspacing="0" cellpadding="0"
            style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td width="10%" class="header-line" style="padding:0">&nbsp;&nbsp;View Records: </td>
              <td width="75%" class="header-line" style="padding:0"><span id="tabgroupgridwb1"></span></td>
              <td width="15%" class="header-line" style="padding:0"></td>
            </tr>
            <tr>
              <td colspan="3" align="center" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="bottom">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td><img src="../images/white-box.gif" align="absmiddle" style="border:1px solid #666666" />
                            &nbsp;Absent<br />
                            <br />
                            <img src="../images/orange-box.gif" align="absmiddle" style="border:1px solid #666666" />
                            &nbsp;Holiday<br />
                            <br />
                            <img src="../images/blue-box.gif" align="absmiddle" style="border:1px solid #666666" />
                            &nbsp;Present on Holiday<br />
                            <br />
                            <img src="../images/yellow-box.gif" align="absmiddle" style="border:1px solid #666666" />
                            &nbsp;Half Day<br />
                            <br />
                            <img src="../images/green-box.gif" align="absmiddle" style="border:1px solid #666666" />
                            &nbsp;Present
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td valign="top">
                      <div id="tabgroupgridc1" style="height:auto; width:900PX; padding:2px;" align="center"></div>
                    </td>
                  </tr>
                </table>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
<?php } ?>