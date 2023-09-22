<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/requirement-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">







  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <span class="">&nbsp;&nbsp;Enter the Details</span>
          </div>
          <div class="col-2 text-right">
            <div align="right"><img src="../images/minus.jpg" class="img-fluid" border="0" id="toggleimg"
                name="toggleimg" alt="Toggle" /></div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="fromdate" class="form-label">From Date:</label>
                <input name="fromdate" type="date" class="form-control" id="DPC_fromdate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
                <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" />
              </div>
              <div class="mb-3">
                <label for="todate" class="form-label">To Date:</label>
                <input name="todate" type="date" class="form-control" id="DPC_todate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
              </div>
              <div class="mb-3">
                <label for="productgroup" class="form-label">Product Group:</label>
                <!-- <select name="productgroup" id="productgroup" class="form-select"> -->
                  <!-- Add options dynamically -->
                  <?php include('../inc/productgroup.php');
                  productname('s_productgroup', 'color');
                  ?>
                <!-- </select> -->
              </div>
              <div class="mb-3">
                <label for="productname" class="form-label">Product Name:</label>
                <select name="productname" id="productname" class=" form-control form-select " style="background:#FEFFE6;">
                  <option value="">Make A Selection</option>
                  <?php include('../inc/productfilter.php'); ?>

                  <!-- Add options dynamically -->
                </select>
              </div>
              <div class="mb-3">
                <label for="errorreported" class="form-label">Requirement Description:</label>
                <input name="errorreported" type="text" class="form-control" id="errorreported" size="30"
                  autocomplete="off" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select">
                  <option value="">Make A Selection</option>
                  <option value="solved">Solved</option>
                  <option value="unsolved">Un Solved</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="userid" class="form-label">Entered By:</label>
                <select name="userid" id="userid" class="form-select">
                  <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                    <option value="">ALL</option>
                    <!-- Add options dynamically -->
                    <?php include('../inc/useridselectionreports.php');
                  } else { ?>
                    <!-- Add options dynamically -->
                    <?php include('../inc/useridselectionreports.php');
                  } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="reportedto" class="form-label">Reported To:</label>
                <input name="reportedto" type="text" class="form-control" id="reportedto" size="30"
                  autocomplete="off" />
              </div>
              <div class="mb-3">
                <label for="customername" class="form-label">Reported By:</label>
                <input name="customername" type="text" class="form-control" id="customername" size="30"
                  autocomplete="off" />
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <div id="form-error"></div>
            <button name="view" type="submit" class="btn btn-primary" id="view" onClick="formsubmit();">View</button>
          </div>
        </form>
      </div>
    </div>
  </div>





  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <span class="">&nbsp;&nbsp;View Records:</span>
          </div>
          <div class="col-2">
            <!-- No content for right alignment -->
          </div>
        </div>
      </div>
      <div class="card-body">
        <form name="gridformbug" id="gridformbug" action="../reports-excel/requirement-report.php" method="post">
          <div id="tabgroupgridc1" class="overflow-auto" style="height: 300px; width: 1060px; padding: 2px;"
            align="center">
            <!-- Content for your grid here -->
          </div>
          <div id="tabgroupgridc2" style="display: block; padding-right: 15px; border-top: 1px solid #d1dceb;">
            <div class="row">
              <div class="col-8">
                <!-- No content for left alignment -->
              </div>
              <div class="col-4 text-right">
                <input name="toexcel" type="submit" class="btn btn-warning" id="toexcel" value="To Excel" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  >


</div>


<div id="nameloaddiv" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Call Register > Get Customer</td>
    </tr>
    <tr>
      <td>
        <div id="gc-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/nameload.php'); ?>
  </table>
</div>


<div id="questionload" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Bug Statistics > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>