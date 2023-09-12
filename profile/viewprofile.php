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