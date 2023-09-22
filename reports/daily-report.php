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
<div id="contentdiv" style="display:block;">





  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        Enter the Details
        <div align="right">
          <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" align="absmiddle" />
        </div>
      </div>
      <div class="card-body">
        <div id="maindiv">
          <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="DPC_fromdate">From Date:</label>
                  <input name="fromdate" type="date" class="form-control" id="DPC_fromdate" size="30" autocomplete="off"
                    style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                  <input name="username" type="hidden" class="form-control" id="username"
                    value="<?php echo ($user); ?>" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="DPC_todate">To Date:</label>
                  <input name="todate" type="date" class="form-control" id="DPC_todate" size="30" autocomplete="off"
                    style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                  <input name="usertype" type="hidden" class="form-control" id="usertype"
                    value="<?php echo ($usertype); ?>" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="userid">User Name:</label>
                  <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                    <select name="userid" id="userid" class="form-control form-select
                    ">
                      <?php include('../inc/useridselectionreports.php'); ?>
                    </select>
                  <?php } else { ?>
                    <input type="hidden" name="userid" id="userid" />
                    <?php echo $loggedusername; ?>
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="form-error"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group text-right">
                  <div id="processingbar"></div>

                  <input name="view" type="submit" class="btn btn-primary" id="view" value="View"
                    onclick="formsubmit('view'); " />
                  <input type="submit" class="btn btn-info" border="0" align="absmiddle"
                    onclick="formsubmit('toexcel');" style="cursor:pointer" value="ToExcel" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>






  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        View Data
      </div>
      <div class="card-body">
        <div id="dailyreport" class="overflow-auto" style="height: 300px;">
          <!-- Your content for the "dailyreport" goes here -->
        </div>
        <div id="calldataitem" class="mt-3" title="Company Detail"></div>
        <div id="display_form" class="mt-3" title="Complaint Details"></div>
      </div>
    </div>
  </div>




</div>