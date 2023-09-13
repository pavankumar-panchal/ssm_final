<?php
if (!isset($message)) {
  $message = null;
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script language="javascript" src="../functions/editprofile.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>



<!-- 

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
                          <td valign="top">
                            <input name="dob" type="text" class="swifttext" id="DPC_dob" size="30"
                              maxlength="10" autocomplete="off" value="" />
                            </td>
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
                          <td valign="top">
                            
                            <input name="doj" type="text" class="swifttext" id="DPC_doj" size="30"
                              maxlength="10" autocomplete="off" value="" />
                            </td>
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
</table> -->


<div class="container mt-4 col-lg-12">
  <div class="card rounded-1" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
    <div class="card-header">
      <div class="row">
        <div class="col-md-14">
          Enter/Edit/View Details
        </div>

      </div>
    </div>
    <div class="card-body" id="maindiv">
      <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="customername">Full Name:</label>
              <input name="fullname" type="text" class="form-control " id="fullname" autocomplete="off">
            </div>

            <div class="form-group">
              <label for="s_productgroup">Gender:</label>
              <select name="gender" class="form-select  form-control" id="gender">
                <!-- <option value="" selected="selected">ALL</option> -->
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
              </select>
              <!-- Details are in javascript.js page as a function prdgroup();-->
            </div>

            <div class="form-group">
              <label for="mobile">Mobile:</label>
              <input name="mobile" type="tel" class="form-control " id="mobile" autocomplete="off">
            </div>

            <div class="form-group">
              <label for="mobile ">Designation:</label>
              <input name="designation" type="text" class="form-control " id="designation" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Date of Birth:</label>
              <input name="dob" type="text" class="form-control " id="DPC_dob" autocomplete="off" value="">
            </div>
            <div class="form-group">
              <label for="mobile">Present Address:</label>
              <textarea name="presentaddress" cols="45" class="form-control " id="presentaddress"
                data-gramm="false" wt-ignore-input="true"><?php echo ($d_presentaddress); ?></textarea>
            </div>
            <!-- Repeat similar pattern for other form inputs -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="teamleaderremarks">Present Address:</label>
              <textarea name="permanentaddress" cols="45" class="form-control " id="permanentaddress"
                data-gramm="false" wt-ignore-input="true"><?php echo ($d_permanentaddress); ?></textarea>
            </div>
            <div class="form-group">
              <label for="mobile">Date of Joining:</label>
              <input name="doj" type="text" class="form-control " id="DPC_doj"  value="" autocomplete="off">
             
            </div>
            <div class="form-group">
              <label for="mobile">Personal Email:</label>
              <input name="personalemail" type="email" class="form-control " id="personalemail"
                autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Official Email:</label>
              <input name="officialemail" type="email" class="form-control " id="officialemail"
                autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Contatc Number[In case of Emergency]:</label>
              <input name="emergencynumber" type="text" class="form-control " id="emergencynumber"
                autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Remarks[Details of person in case of Emergency]:</label>
              <input name="emergencyremarks" type="text" class="form-control " id="emergencyremarks"
                autocomplete="off">
            </div>
            <!-- Repeat similar pattern for other form inputs -->
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <div id="form-error"></div>
            </div>
            <div class="col-md-4 text-end mt-3">
              <input name="clear" type="reset" class="btn btn-secondary" id="view" value="New"
                onclick="formsubmit('toview');">
              <input name="update" type="submit" class="btn btn-primary " id="update" value="update"
                onclick="formsubmit('update');">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>





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

<div class="container mt-3 ">
  <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
    <div class="card-header " style="cursor: pointer;">
      Change Password

    </div>
    <div id="maindiv" style="display: block;">
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform">
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Old Password:</label>
            <div class="col-sm-9">
              <input name="password" type="password" class="form-control swifttext" id="password" size="30">
            </div>
          </div> <br>
          <div class="form-group row">
            <label for="newpassword" class="col-sm-3 col-form-label">New Password:</label>
            <div class="col-sm-9">
              <input name="newpassword" type="password" class="form-control swifttext" id="newpassword" size="30">
            </div>
          </div> <br>
          <div class="form-group row">
            <label for="confirmpassword" class="col-sm-3 col-form-label">Confirm Password:</label>
            <div class="col-sm-9">
              <input name="confirmpassword" type="password" class="form-control swifttext" id="confirmpassword"
                size="30">
            </div>
          </div> <br>
          <div class="form-group row">
            <div class="col-sm-9 offset-sm-3" id="form-error">

              <?php
              $message = "";
              echo ($message)
                ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-9 offset-sm-3 ">
              <input name="update" type="submit" class="btn btn-primary up" id="update" value="Update">
              <input name="clear" type="reset" class="btn btn-secondary up" id="clear" value="Clear"
                onclick="document.getElementById('form-error').innerHTML = ''">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->
<div class="col-md-12">
</div>
</div>
</div>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">