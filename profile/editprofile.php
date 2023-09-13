<?php
if (!isset($message)) {
  $message = null;
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script language="javascript" src="../functions/editprofile.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>

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
              <textarea name="presentaddress" cols="45" class="form-control " id="presentaddress" data-gramm="false"
                wt-ignore-input="true"><?php echo ($d_presentaddress); ?></textarea>
            </div>
            <!-- Repeat similar pattern for other form inputs -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="teamleaderremarks">Present Address:</label>
              <textarea name="permanentaddress" cols="45" class="form-control " id="permanentaddress" data-gramm="false"
                wt-ignore-input="true"><?php echo ($d_permanentaddress); ?></textarea>
            </div>
            <div class="form-group">
              <label for="mobile">Date of Joining:</label>
              <input name="doj" type="text" class="form-control " id="DPC_doj" value="" autocomplete="off">

            </div>
            <div class="form-group">
              <label for="mobile">Personal Email:</label>
              <input name="personalemail" type="email" class="form-control " id="personalemail" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Official Email:</label>
              <input name="officialemail" type="email" class="form-control " id="officialemail" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Contatc Number[In case of Emergency]:</label>
              <input name="emergencynumber" type="text" class="form-control " id="emergencynumber" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="mobile">Remarks[Details of person in case of Emergency]:</label>
              <input name="emergencyremarks" type="text" class="form-control " id="emergencyremarks" autocomplete="off">
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