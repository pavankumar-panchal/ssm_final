<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/onsite-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-10">
          <span class="">&nbsp;&nbsp;Enter the Details</span>
        </div>
        <div class="col-2 text-right">
          <div align="right"><img src="../images/minus.jpg" class="img-fluid" border="0" id="toggleimg" name="toggleimg"
              alt="Toggle" /></div>
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
                style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
              <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" /> <br />
            </div>
            <div class="mb-3">
              <label for="todate" class="form-label">To Date:</label>
              <input name="todate" type="date" class="form-control" id="DPC_todate" size="30" autocomplete="off"
                style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>" />
            </div>
            <div class="mb-3">
              <label for="servicecharge" class="form-label">Service Charge:</label>
              <input type="checkbox" name="servicecharge" id="servicecharge"
                onClick="javascript:enableoutstandingbills();" />
            </div>
            <div class="mb-3">
              <label for="solvedby" class="form-label">Solved By:</label>
              <select name="solvedby" id="solvedby" class="form-select">
                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                  <option value="">ALL</option>
                  <!-- Add options dynamically -->
                  <?php include('../inc/useridselectionreports.php');
                } else { ?>
                  <?php include('../inc/useridselectionreports.php');
                } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="solvedthrough" class="form-label">Solved Through:</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="stremoteconnection" id="stremoteconnection"
                  value="">
                <label class="form-check-label" for="stremoteconnection">
                  Remote Connection
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="marketingperson" id="marketingperson" value="">
                <label class="form-check-label" for="marketingperson">
                  Marketing Person
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="onsitevisit" id="onsitevisit" value=""
                  checked="checked">
                <label class="form-check-label" for="onsitevisit">
                  Onsite Visit
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="overphone" id="overphone" value="">
                <label class="form-check-label" for="overphone">
                  Over Phone
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="mail" id="mail" value="">
                <label class="form-check-label" for="mail">
                  Mail
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="anonymous" class="form-label">Anonymous:</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="anonymous" id="databasefield11" value="yes">
                <label class="form-check-label" for="databasefield11">
                  Yes
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="anonymous" id="databasefield12" value="no">
                <label class="form-check-label" for="databasefield12">
                  No
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="anonymous" id="databasefield13" value="Both"
                  checked="checked">
                <label class="form-check-label" for="databasefield13">
                  Both
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="reporton" class="form-label">Reports on:</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reporton" id="reporton0" value="statistics">
                <label class="form-check-label" for="reporton0">
                  Statistics
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reporton" id="reporton1" value="details">
                <label class="form-check-label" for="reporton1">
                  Details
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reporton" id="reporton3" value="pending visits"
                  checked="checked">
                <label class="form-check-label" for="reporton3">
                  Pending Visits
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="customername" class="form-label">Customer Name:</label>
              <input name="customername" type="text" class="form-control" id="customername" size="30"
                autocomplete="off" />
            </div>
            <div class="mb-3">
              <label for="productgroup" class="form-label">Product group:</label>
              <span id="filterprdgroupdisplay">
                <?php include('../inc/productgroup.php');
                productname('s_productgroup', '');
                ?>
                <!-- Details are in javascript.js page as a function prdgroup();-->
              </span>
            </div>
            <div class="mb-3">
              <label for="productname" class="form-label">Product Name:</label>
              <select name="productname" id="productname" class="form-select">
                <option value="">ALL</option>
                <?php include('../inc/productfilter.php'); ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="status" class="form-select" id="status">
                <option value="">ALL</option>
                <option value="notyetattended" selected="selected">Un Attended</option>
                <option value="postponed">Postponed</option>
                <option value="inprocess">In Process</option>
                <option value="solved">Solved</option>
                <option value="skipped">Skipped</option>
                <option value="unsolved">Un Solved</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="userid" class="form-label">Registered By:</label>
              <select name="userid" id="userid" class="form-select">
                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                  <option value="">ALL</option>
                  <?php include('../inc/useridselectionreports.php'); ?>
                <?php } else { ?>
                  <?php include('../inc/useridselectionreports.php'); ?>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="supportunit" class="form-label">Support Unit:</label>
              <select name="supportunit" class="form-select" id="supportunit">
                <option value="">ALL</option>
                <?php include('../inc/supportunit.php'); ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="complaintid" class="form-label">Complaint Id:</label>
              <input name="complaintid" type="text" class="form-control" id="complaintid" size="30"
                autocomplete="off" />
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
            <tr>
              <td width="68%" height="35" align="left" valign="middle">
                <div id="form-error"></div>
              </td>
              <td width="32%" height="35" align="right" valign="middle">
                <input name="view" type="submit" class=" btn btn-primary" id="view" value="View"
                  onClick="formsubmit('toview');" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="toexcel" type="submit" class="btn btn-warning ml-2" id="toexcel" value="To Excel"
                  onClick="formsubmit('toexcel');" />
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>





<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <div class="card " style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
        <div class="card-header">
          View Data:
        </div>
        <div class="card-body">
          <div id="displaystatsreport" class="overflow-auto" style="height: 300px;">
            <!-- Add your content here -->
            <div id="processingbar"></div>
          </div>
        </div>
      </div>
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
      <td class="content-header">Call Register > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>