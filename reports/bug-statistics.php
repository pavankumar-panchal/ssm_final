<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/bug-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">


  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <span class="">&nbsp;&nbsp;Enter the Details</span>
          </div>
          <div class="col-2">
            <div align="right">
              <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" align="absmiddle" />
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="DPC_fromdate" class="form-label">From Date:</label>
                <input name="fromdate" type="date" class="form-control" id="DPC_fromdate" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
                <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" />
              </div>
              <div class="mb-3">
                <label for="DPC_todate" class="form-label">To Date:</label>
                <input name="todate" type="date" class="form-control" id="DPC_todate" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
              </div>
              <div class="mb-3">
                <label class="form-label">Product group:</label>
                <span id="filterprdgroupdisplay">
                  <?php include('../inc/productgroup.php');
                  productname('s_productgroup', 'color');
                  ?>
                  <!-- Details are in javascript.js page as a function prdgroup();-->
                </span>
              </div>
              <div class="mb-3">
                <label for="productname" class="form-label">Product Name:</label>
                <select name="productname" id="productname" class="form-select" style="background:#FEFFE6;">
                  <option value="">Make A Selection</option>
                  <?php include('../inc/productfilter.php'); ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="errorreported" class="form-label">Error Description:</label>
                <input name="errorreported" type="text" class="form-control" id="errorreported" autocomplete="off" />
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
                    <?php include('../inc/useridselectionreports.php');
                  } else { ?>
                    <?php include('../inc/useridselectionreports.php');
                  } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="reportedto" class="form-label">Reported To:</label>
                <input name="reportedto" type="text" class="form-control" id="reportedto" autocomplete="off" />
              </div>
              <div class="mb-3">
                <label for="customername" class="form-label">Reported By:</label>
                <input name="customername" type="text" class="form-control" id="customername" autocomplete="off" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-right">
              <div id="form-error"></div>
              <input name="view" type="submit" class="btn btn-primary" id="view" value="View" onClick="formsubmit();" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-2">
            <span class="">View Records:</span>
          </div>
          <div class="col-7">
            <span id="tabgroupgridwb1"></span>
            <span id="tabgroupgridwb2"></span>
            <span id="tabgroupgridwb3"></span>
            <span id="tabgroupgridwb4"></span>
          </div>
          <div class="col-3"></div>
        </div>
      </div>
      <div class="card-body">
        <form name="gridformbug" id="gridformbug" action="../reports-excel/bug-report.php" method="post">
          <div id="tabgroupgridc1" class="overflow-auto" style="height: 300px; width: 1060px; padding: 2px;"
            align="center"></div>
          <div id="tabgroupgridc2" style="display: block; padding-right: 15px; border-top: 1px solid #d1dceb;">
            <div class="row">
              <div class="col-8"></div>
              <div class="col-4 text-end">
                <input name="toexcel" type="submit" class="btn btn-warning" id="toexcel" value="To Excel" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
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