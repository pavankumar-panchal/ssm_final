<?php
if ($usertype <> 'ADMIN') {
  header("location:../index.php?a_link=home_dashboard");
} else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <script language="javascript" src="../functions/createuser.js" type="text/javascript"></script>








  <div class="container users_la" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
          <div class="card-header bg-light">
            Enter/Edit/View Details
          </div>
          <div class="card-body">
            <div id="maindiv" style="display: block;">
              <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                <!-- Your form content goes here -->
                <div class="display" style="display: flex; flex-direction: row; width:100%;">
                  <!-- first div -->

                  <div class="mb-3" style="width: 50%; margin:20px;">
                    <label for="username" class="form-label">User ID:</label>
                    <input name="username" type="text" class="form-control" id="username" autocomplete="off"
                      isdatepicker="true">
                    <input type="hidden" name="lastslno" id="lastslno" value="" />
                    <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                    <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                    <input type="hidden" name="time" id="time" value="" />
                    <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                      value="<?php echo ($reportingauthority); ?>" />

                    <label for="password" class="form-label">Password:</label>

                    <input name="password" type="password" class="form-control" id="password" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" class="form-select swiftselect form-control" id="type" onchange="">
                      <option selected="selected" value="">Make A Selection</option>
                      <option value="ADMIN">Administrator</option>
                      <option value="EXECUTIVE-ONSITE">Executive - Onsite</option>
                      <option value="EXECUTIVE-OTHERS">Executive - Others</option>
                      <option value="GUEST">Guest</option>
                      <option value="HR">HR</option>
                      <option value="MANAGEMENT">Management</option>
                      <option value="TEAMLEADER">Team Leader</option>

                    </select>
                    <label for="locationname" class="form-label">Location:</label>
                    <select name="locationname" class="form-select  form-control" id="locationname" onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                      <?php include('../inc/selectlocation.php'); ?>


                    </select>
                    <label for="reportingauthority" class="form-label">Reporting Authority:</label>
                    <select name="reportingauthority" class="form-select swiftselect form-control" id="reportingauthority"
                      onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                      <?php include('../inc/reportingauthority.php'); ?>


                    </select>
                    <label for="supportunit" class="form-label">Support Unit:</label>
                    <select name="supportunit" class="form-select  form-control" id="supportunit" onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                      <?php include('../inc/supportunit.php'); ?>
                    </select>
                    <label for="existinguser" class="form-label">Existing User:</label>
                    <select name="existinguser" class="form-select form-control" id="existinguser" onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                    <label for="fullname" class="form-label">User name:</label>
                    <input name="fullname" type="text" class="form-control" id="fullname" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="form-select swiftselect form-control" id="gender" onchange="">
                      <option value="">Make A Selection</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>

                    </select>
                    <label for="mobile" class="form-label">Mobile:</label>
                    <input name="mobile" type="tel" class="form-control" id="mobile" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="disablelogin" class="form-label">Disable Login: &nbsp; &nbsp; &nbsp;
                      <input class="form-check-input" type="checkbox" name="disablelogin" id="disablelogin">
                  </div>

                  <!-- second -->
                  <div class="mb-3 " style="width: 50%; margin:20px;">
                    <label for="designation" class="form-label">Designation:</label>
                    <input name="designation" type="text" class="form-control" id="designation" size="20"
                      autocomplete="off" isdatepicker="true">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input name="dob" type="text" class="form-control" id="dob" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="presentaddress" class="form-label">Present Address:</label>
                    <input name="presentaddress" type="text" class="form-control" id="presentaddress" size="20"
                      autocomplete="off" isdatepicker="true">
                    <!-- second div -->
                    <label for="permanentaddress" class="form-label">Permanent Address:</label>
                    <input name="permanentaddress" type="text" class="form-control" id="permanentaddress" size="20"
                      autocomplete="off" isdatepicker="true">



                    <label for="doj" class="form-label">Date of joining:</label>
                    <input name="doj" type="text" class="form-control" id="doj" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="personalemail" class="form-label">Personal Email: </label>
                    <input name="personalemail" type="text" class="form-control" id="personalemail" size="20"
                      autocomplete="off" isdatepicker="true">
                    <label for="officialemail" class="form-label">Official Email:</label>
                    <input name="officialemail" type="text" class="form-control" id="officialemail" size="20"
                      autocomplete="off" isdatepicker="true">
                    <label for="dol" class="form-label">Date of Leaving: </label>
                    <input name="dol" type="text" class="form-control" id="dol" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="emergencynumber" class="form-label">Contact Number:</label>
                    <input name="emergencynumber" type="text" class="form-control" id="emergencynumber" size="20"
                      autocomplete="off" isdatepicker="true" placeholder="In case of Emergency">
                    <label for="emergencyremarks" class="form-label">Emergency Remarks:</label>
                    <input name="emergencyremarks" type="text" class="form-control" id="emergencyremarks" size="20"
                      autocomplete="off" isdatepicker="true">
                    </label>
                  </div>
                  <!-- Add more textarea fields as needed -->
                </div>
                <div class="text-end float-right">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                    <tr>
                      <td width="68%" height="35" align="left" valign="middle">
                        <div id="form-error"></div>
                      </td>
                      <td width="32%" height="35" align="right" valign="middle">
                        <input name="new" type="reset" class="swiftchoicebutton" id="new" value="New"
                          onclick="newentry();clearinnerhtml(); " />
                        &nbsp;&nbsp;&nbsp;
                        <input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save"
                          onclick="formsubmit('save');" />
                        &nbsp;&nbsp;&nbsp;
                        <input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete" value="Delete"
                          onclick="formsubmit('delete')" disabled="disabled" />
                      </td>
                    </tr>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




















  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr style="border-left:none; border-right:none;">
      <td style="padding:0; border:none;" width="26%">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="84px" align="center" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');"
              style="cursor:pointer" class="grid-active-tabclass">Default</td>
            <td width="2">&nbsp;</td>
            <td width="84px" align="center" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');"
              style="cursor:pointer" class="grid-tabclass">Filter</td>
            <td width="2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
      <td> <span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span></td>
    </tr>
  </table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
    <tr>
      <td width="15%" class="header-line" style="padding:0">ViewRecords</td>
      <td width="60%" class="header-line" style="padding:0"></td>
      <td width="25%" class="header-line" style="padding:0"></td>
    </tr>
    <tr>

      <td align="left" valign="top">
        <table>
          <tr>
            <td class="exist cat">E.USER</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="yes cat"></td>
            <td>NO</td>
          </tr>
        </table>
      </td>

      <td align="center" valign="top">
        <div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1000px;" align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
                <div id="tabgroupgridc1_2"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div>
              </td>
            </tr>
          </table>
        </div>
        <div id="tabgroupgridc2" style="overflow:auto; height:300px; width:1000px; display:none" align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
                <div id="tabgroupgridc1_1"> </div>
              </td>
            </tr>
            <tr>
              <td>
                <div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div>
              </td>
            </tr>
          </table>
        </div>
        <div id="regresultgrid" style="overflow:auto; display:none; height:300px; width:1060px;">&nbsp;
        </div>
      </td>

      <td align="right" valign="top">
        <table>
          <tr>
            <td class="type category">TYPE</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="management category"></td>
            <td>MANAGEMENT</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="teamleader category"></td>
            <td>TEAMLEADER</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="general category"></td>
            <td>E.OTHERS</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="onsite category"></td>
            <td>E.ONSITE</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="admin category"></td>
            <td>ADMIN</td>
          </tr>
          <tr>
            <td height="1px">&nbsp;</td>
          </tr>
          <tr>
            <td class="guest category"></td>
            <td>GUEST</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>



<?php } ?>