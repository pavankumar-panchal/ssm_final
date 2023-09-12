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