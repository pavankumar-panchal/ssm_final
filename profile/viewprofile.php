

<?php
if (!isset($message)) {
  $message = null;
}

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/editprofile.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Profile > Edit Profile</td>
  </tr>
  <tr>
    <td>
      <div>
        <?php echo ($message); ?>
      </div>
    </td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
        <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
          <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
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
                    <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr bgcolor="#f7faff">
                          <td valign="top">Full Name:</td>
                          <td valign="top"><input name="fullname" type="text" class="swifttext" id="fullname" size="30"
                              autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Gender:</td>
                          <td valign="top"><select name="gender" id="gender" class="swiftselect">
                              <?php if ($d_gender == '') { ?>
                                <option value="" selected="selected">Make A Selection</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                              <?php } elseif ($d_gender == 'male') { ?>
                                <option value="">Make A Selection</option>
                                <option value="male" selected="selected">Male</option>
                                <option value="female">Female</option>
                              <?php } elseif ($d_gender == 'female') { ?>
                                <option value="">Make A Selection</option>
                                <option value="male">Male</option>
                                <option value="female" selected="selected">Female</option>
                              <?php } ?>
                            </select></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Mobile:</td>
                          <td valign="top"><input name="mobile" type="text" class="swifttext" id="mobile" size="30"
                              autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Designation:</td>
                          <td valign="top"><input name="designation" type="text" class="swifttext" id="designation"
                              size="30" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Date of Birth:</td>
                          <td valign="top"><input name="dob" type="text" class="swifttext" id="DPC_dob" size="30"
                              maxlength="10" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Present Address:</td>
                          <td valign="top"><textarea name="presentaddress" cols="45" class="swifttextarea"
                              id="presentaddress" autocomplete="off"><?php echo ($d_presentaddress); ?></textarea></td>
                        </tr>
                      </table>
                    </td>
                    <td width="50%" valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr bgcolor="#f7faff">
                          <td valign="top">Permanent Address:</td>
                          <td valign="top"><textarea name="permanentaddress" cols="45" class="swifttextarea"
                              id="permanentaddress" autocomplete="off"><?php echo ($d_permanentaddress); ?></textarea>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Date of joining:</td>
                          <td valign="top"><input name="doj" type="text" class="swifttext" id="DPC_doj" size="30"
                              maxlength="10" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Personal Email:</td>
                          <td valign="top"><input name="personalemail" type="text" class="swifttext" id="personalemail"
                              size="30" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Official Email:</td>
                          <td valign="top"><input name="officialemail" type="text" class="swifttext" id="officialemail"
                              size="30" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Contact Number:<br />
                            [In case of Emergency]</td>
                          <td valign="top"><input name="emergencynumber" type="text" class="swifttext"
                              id="emergencynumber" size="30" autocomplete="off" value="" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Remarks [Details of Person in case of Emergency]:</td>
                          <td valign="top"><input name="emergencyremarks" type="text" class="swifttext"
                              id="emergencyremarks" size="30" autocomplete="off" value="" /></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right" valign="middle"
                      style="padding-right:15px; border-top:1px solid #d1dceb;" height="35">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="68%" id="form-error">&nbsp;</td>
                          <td width="32%"><input name="update" type="submit" class="swiftchoicebutton" id="update"
                              value="Update" onclick="formsubmit('update');" />
                            &nbsp;&nbsp;&nbsp;
                            <input name="clear" type="reset" class="swiftchoicebutton" id="clear" value="Reset"
                              onclick="datagrid();" />
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
</table>



<?php
if (!isset($_POST['fullname'])) {
  $_POST['fullname'] = null;
}
if (!isset($_POST['presentaddress'])) {
  $_POST['presentaddress'] = null;
}
if (!isset($_POST['permanentaddress'])) {
  $_POST['permanentaddress'] = null;
}
if (!isset($_POST['emergencynumber'])) {
  $_POST['emergencynumber'] = null;
}
if (!isset($_POST['emergencyremarks'])) {
  $_POST['emergencyremarks'] = null;
}
if (!isset($_POST['dob'])) {
  $_POST['dob'] = null;
}
if (!isset($_POST['doj'])) {
  $_POST['doj'] = null;
}
if (!isset($_POST['designation'])) {
  $_POST['designation'] = null;
}
if (!isset($_POST['personalemail'])) {
  $_POST['personalemail'] = null;
}
if (!isset($_POST['officialemail'])) {
  $_POST['officialemail'] = null;
}
if (!isset($_POST['mobile'])) {
  $_POST['mobile'] = null;
}
if (!isset($_POST['gender'])) {
  $_POST['gender'] = null;
}
if (!isset($message)) {
  $message = null;
}


$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$presentaddress = $_POST['presentaddress'];
$permanentaddress = $_POST['permanentaddress'];
$mobile = $_POST['mobile'];
$emergencynumber = $_POST['emergencynumber'];
$emergencyremarks = $_POST['emergencyremarks'];
$dob = $_POST['dob'];
$doj = $_POST['doj'];
$designation = $_POST['designation'];
$personalemail = $_POST['personalemail'];
$officialemail = $_POST['officialemail'];

$query = "SELECT * FROM ssm_users where slno = '" . $user . "'";
$fetch = runmysqlqueryfetch($query);

$d_fullname = $fetch['fullname'];
$d_gender = $fetch['gender'];
$d_presentaddress = $fetch['presentaddress'];
$d_permanentaddress = $fetch['permanentaddress'];
$d_mobile = $fetch['mobile'];
$d_emergencynumber = $fetch['emergencynumber'];
$d_emergencyremarks = $fetch['emergencyremarks'];
$d_dob = changedateformat($fetch['dob']);
$d_doj = changedateformat($fetch['doj']);
$d_designation = $fetch['designation'];
$d_personalemail = $fetch['personalemail'];
$d_officialemail = $fetch['officialemail'];

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Profile > View Profile</td>
  </tr>
  <tr>
    <td>
      <div id="form-error">
        <?php echo ($message); ?>
      </div>
    </td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
        <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
          <td class="header-line" style="padding:0">&nbsp;&nbsp; View Profile</td>
          <td align="right" class="header-line" style="padding-right:7px">
            <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                align="absmiddle" /></div>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <div id="maindiv">
              <form action="" method="post" name="submitform" id="submitform">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr bgcolor="#f7faff">
                          <td width="50%" valign="top">User Name:</td>
                          <td width="50%" valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_fullname); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Gender:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_gender); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Mobile:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_mobile); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Designation:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_designation); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Date of Birth:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_dob); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Present Address:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_presentaddress); ?>
                            </font>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td width="50%" valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr bgcolor="#f7faff">
                          <td width="50%" valign="top">Permanent Address:</td>
                          <td width="50%" valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_permanentaddress); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Date of joining:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_doj); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Personal Email:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_personalemail); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Official Email:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_officialemail); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Contact Number:
                            [In case of Emergency]</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_emergencynumber); ?>
                            </font>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">Emergency Remarks:</td>
                          <td valign="top">
                            <font color="#FF6200">
                              <?php echo ($d_emergencyremarks); ?>
                            </font>
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
</table>





<?php
if (isset($_POST["update"])) {
  $password = trim($_POST["password"]);
  $newpassword = trim($_POST["newpassword"]);
  $confirmpassword = trim($_POST["confirmpassword"]);
  $message = '';

  $query = "SELECT  AES_DECRYPT(loginpassword,'imaxpasswordkey') as password FROM ssm_users where slno = '" . $user . "'";
  $fetch = runmysqlqueryfetch($query);
  if ($password == '' || $newpassword == '' || $confirmpassword == '')
    $message = '<div class="errorbox"> Enter the old and/or new and/or confirm passwords </div>';
  elseif ($password <> $fetch['password'])
    $message = '<div class="errorbox"> The Password does not match with the user </div>';
  elseif ($newpassword == $fetch['password'])
    $message = '<div class="errorbox"> Please Enter a different password as old and new passwords are same </div>';
  elseif ($newpassword <> $confirmpassword)
    $message = '<div class="errorbox"> New and confirms passwords does not match. </div>';
  else {
    $query = "UPDATE ssm_users SET loginpassword = AES_ENCRYPT('" . $newpassword . "','imaxpasswordkey') WHERE slno = '" . $user . "'";
    $result = runmysqlquery($query);
    $message = '<div class="successbox"> Password changed sucessfully. </div>';
  }
}
?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Profile > Change Password</td>
  </tr>

  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
        <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
          <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
          <td align="right" class="header-line" style="padding-right:7px">
            <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                align="absmiddle" /></div>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <div id="maindiv">
              <form action="" method="post" name="submitform" id="submitform">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2" valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr bgcolor="#f7faff">
                          <td valign="top">Old Password:</td>
                          <td valign="top"><input name="password" type="password" class="swifttext" id="password"
                              size="30" /></td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top">New Password:</td>
                          <td valign="top"><input name="newpassword" type="password" class="swifttext" id="newpassword"
                              size="30" /></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Confirm Password:</td>
                          <td valign="top"><input name="confirmpassword" type="password" class="swifttext"
                              id="confirmpassword" size="30" /></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border-top:1px solid #d1dceb">&nbsp;</td>
                  <tr>

                    <td width="75%" align="left" valign="middle">
                      <div id="form-error">
                        <?php
                        $message = "";
                        echo ($message)
                          ?>
                      </div>
                    </td>
                    <td width="25%" align="right" valign="middle" style="padding-right:15px; ">
                      <input name="update" type="submit" class="swiftchoicebutton" id="update" value="Update" />
                      &nbsp;&nbsp;&nbsp;
                      <input name="clear" type="reset" class="swiftchoicebutton" id="clear" value="Clear"
                        onclick="document.getElementById('form-error').innerHTML = ''" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" height="5px"></td>
                </table>
              </form>
            </div>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>