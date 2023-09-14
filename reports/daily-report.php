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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Reports > Daily Report
    </div>
    <div class="card-body">
      <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
        <div class="form-group row">
          <label for="DPC_fromdate" class="col-sm-2 col-form-label">From Date:</label>
          <div class="col-sm-10">
            <input name="fromdate" type="text" class="form-control" id="DPC_fromdate" size="30" autocomplete="off"
              style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
            <input name="username" type="hidden" class="form-control" id="username" value="<?php echo ($user); ?>" />
          </div>
        </div>
        <div class="form-group row">
          <label for="DPC_todate" class="col-sm-2 col-form-label">To Date:</label>
          <div class="col-sm-10">
            <input name="todate" type="text" class="form-control" id="DPC_todate" size="30" autocomplete="off"
              style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
            <input name="usertype" type="hidden" class="form-control" id="usertype"
              value="<?php echo ($usertype); ?>" />
          </div>
        </div>
        <div class="form-group row">
          <label for="userid" class="col-sm-2 col-form-label">User Name:</label>
          <div class="col-sm-10">
            <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
              <select name="userid" id="userid" class="form-control">
                <?php include('../inc/useridselectionreports.php'); ?>
              </select>
            <?php } else { ?>
              <input type="hidden" name="userid" id="userid" value="<?php echo $loggedusername; ?>" />
              <?php echo $loggedusername; ?>
            <?php } ?>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 text-center">
            <div id="form-error"></div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 mt-4 text-end">
            <input name="view" type="submit" class="btn btn-primary" id="view" value="View"
              onclick="formsubmit('view'); " />

            <button name="view" type="submit" class="btn btn-info" id="" value="" src="../images/toexcel.png"
              onclick="formsubmit('toexcel');" value="Excel" style="color:white;"> Excel</button>
          
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-header">
      View Data
    </div>
    <div class="card-body">
      <div id="dailyreport" style="overflow:auto; height:300px; width:100%; padding:2px;"></div>
      <div id="calldataitem" title="Company Detail" style="margin-top:3%;"></div>
      <div id="display_form" title="Complaint Details" style="margin-top:3%;"></div>
    </div>
  </div>
</div>