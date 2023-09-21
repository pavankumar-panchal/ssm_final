<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!--<script language="javascript" src="../functions/invoiceregister.js" type="text/javascript"></script>
-->
  <div class="container">
    <div class="card">
      <div class="card-header">
        Attendance > Advanced
      </div>
      <div class="card-body">
        <form method="post" name="submitform" id="submitform" action="../reports-excel/attendancereport.php">
          <div id="tabgrouponsitec1">
            <div class="form-group row">
              <label for="DPC_fromdate" class="col-sm-2 col-form-label">From Date:</label>
              <div class="col-sm-10">
                <input name="fromdate" type="text" class="form-control" id="DPC_fromdate" size="30" autocomplete="off"
                  value="<?php echo date('01-m-Y'); ?>" style="background:#FEFFE6;">
                <input type="hidden" name="lastslno" id="lastslno" value="" />
                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                  value="<?php echo ($reportingauthority); ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label for="DPC_todate" class="col-sm-2 col-form-label">To Date:</label>
              <div class="col-sm-10">
                <input name="todate" type="text" class="form-control" id="DPC_todate" size="30" autocomplete="off"
                  value="<?php echo date('d-m-Y'); ?>" style="background:#FEFFE6;">
              </div>
            </div>
            <div class="form-group row">
              <label for="userid" class="col-sm-2 col-form-label">User Name:</label>
              <div class="col-sm-10">
                <select name="userid" id="userid" class="form-control form-select">
                  <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                    <!--                      <option value="">ALL</option>
-->
                    <?php include('../inc/useridselectionreports.php');
                  } else { ?>
                    <?php include('../inc/useridselectionreports.php');
                  } ?>
                </select>
              </div>
            </div>
            <div class="form-check">
              <input name="holidays" type="checkbox" class="form-check-input" id="holidays" checked>
              <label class="form-check-label" for="holidays">Include Holidays</label>
            </div>
            <div class="form-check">
              <input name="workingdays" type="checkbox" class="form-check-input" id="workingdays" checked>
              <label class="form-check-label" for="workingdays">Include Working Days</label>
            </div>
            <div class="form-group row">
              <div class="col-sm-12  text-end">
                <div id="form-error"></div>
                <button name="generate" type="submit" class="btn btn-primary">Generate</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>













<?php } ?>