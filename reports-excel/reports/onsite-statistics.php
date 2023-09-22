<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/onsite-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
  .display {
    display: flex;
    flex-direction: row;
    padding: 20px;
    
  }
</style>
<div class="container mt-5 rounded ">
  <div class="card " style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); width:98%;  margin-left:10px;">
    <div class="card-header bg-light" style="cursor: pointer;" onclick="showhide('maindiv','toggleimg'); ">
      <h5 class="mb-0 ">&nbsp;&nbsp;Enter the Details</h5>
    </div>
    <div class="card-body" id="maindiv" style="display: block;">
      <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
        <div class="display">
          <div class="col-md-5"style="margin:0px 0px 0px 4%;  ">
            <div class="form-group">
              <label for="fromdate">From Date:</label>
              <input name="fromdate" type="text" class="form-control" id="DPC_fromdate" autocomplete="off"
                datepicker_format="DD-MM-YYYY" maxlength="10" isdatepicker="true"
                value="<?php echo (datetimelocal('d-m-Y')); ?>">
              <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" /> <br />

            </div>
            <div class="form-group">
              <label for="todate">To Date:</label>
              <input name="todate" type="text" class="form-control" id="DPC_todate" autocomplete="off"
                datepicker_format="DD-MM-YYYY" maxlength="10" isdatepicker="true"
                value="<?php echo (datetimelocal('d-m-Y')); ?>">
            </div>
            <div class="form-group">
              <label>Service Charge:</label>
              <div class="form-check">

                <label class="form-check-label" for="servicecharge">
                  <input class="form-check-input" type="checkbox" name="servicecharge" id="servicecharge"
                    onClick="javascript:enableoutstandingbills();">
                </label>
              </div>
              <!-- Add other checkboxes here -->
            </div>
            <div class="form-group">
              <label for="solvedby">Solved By:</label>
              <select name="solvedby" id="solvedby" class="form-control form-select swiftselect">
                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                  <option value="">ALL</option>
                  <?php include('../inc/useridselectionreports.php');
                } else { ?>
                  <?php include('../inc/useridselectionreports.php');
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Solved Through:</label>
              <div class="form-check">

                <label class="form-check-label" for="stremoteconnection">
                  <input class="form-check-input" type="checkbox" name="stremoteconnection" id="stremoteconnection"
                    value=""> Remote Connection</label>
              </div>
              <div class="form-check">

                <label class="form-check-label" for="marketingperson">
                  <input class="form-check-input" type="checkbox" name="marketingperson" id="marketingperson" value="">
                  Marketing Person</label>
              </div>
              <div class="form-check">

                <label class="form-check-label" for="onsitevisit">
                  <input class="form-check-input" type="checkbox" name="onsitevisit" id="onsitevisit" value=""
                    checked="checked"> Onsite Visit</label>
              </div>
              <div class="form-check">

                <label class="form-check-label" for="overphone">
                  <input class="form-check-input" type="checkbox" name="overphone" id="overphone" value=""> Over
                  Phone</label>
              </div>
              <div class="form-check">

                <label class="form-check-label" for="mail">
                  <input class="form-check-input" type="checkbox" name="mail" id="mail" value="">
                  Mail</label>
              </div>
              <!-- Add other checkboxes here -->
            </div>
            <div class="form-group">
              <label>Anonymous:</label>
              <div>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield11" value="Yes" class="form-check-input">
                  Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield12" value="No" class="form-check-input"> No
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield13" value="Both" class="form-check-input"
                    checked="checked"> Both
                </label>
                <!-- Add other radio buttons here -->
              </div>
            </div>
            <div class="form-group">
              <label>Reports on:</label>
              <div>
                <label class="radio-inline">
                  <input type="radio" name="reporton" id="reporton0" value="Statistics" class="form-check-input">
                  Statistics
                </label>
                <label class="radio-inline">
                  <input type="radio" name="reporton" id="reporton1" value="Details" class="form-check-input">
                  Details
                </label>
                <label class="radio-inline">
                  <input type="radio" name="reporton" id="reporton3" value="pendingvisits" class="form-check-input"
                    checked="checked"> Pending Visits
                </label>
                <!-- Add other radio buttons here -->
              </div>
            </div>
            <!-- Other input fields for the first column -->
          </div>
          <div class="col-md-5 " style="margin:0px 0px 0px 6%;  ">
            <div class="form-group">
              <label for="customername">Customer Name:</label>
              <input name="customername" type="text" class="form-control " id="customername" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Product group:</label>
              <span name="" class="" id="filterprdgroupdisplay">
                <?php include('../inc/productgroup.php');
                productname('s_productgroup', '');
                ?>
                <!-- Add other options here -->
              </span>
            </div>
            <div class="form-group">
              <label>Product name:</label>
              <select name="productname" id="productname" class="form-control form-select">
                <option value="">ALL</option>
                <!-- Add other options here -->
                <?php include('../inc/productfilter.php'); ?>

              </select>
            </div>
            <div class="form-group">
              <label>Status:</label>
              <select name="status" class="form-control form-select" id="status">
                <option value="">ALL</option>
                <option value="notyetattended" selected="selected">Un Attended</option>
                <option value="postponed">Postponed</option>
                <option value="inprocess">In Process</option>
                <option value="solved">Solved</option>
                <option value="skipped">Skipped</option>
                <option value="unsolved">Un Solved</option>

              </select>
            </div>
            <div class="form-group">
              <label>Registered By:</label>
              <select name="userid" id="userid" class="form-control form-select ">
                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                  <option value="">ALL</option>
                  <?php include('../inc/useridselectionreports.php');
                } else { ?>
                  <?php include('../inc/useridselectionreports.php');
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Support Unit:</label>
              <select name="supportunit" class="form-control form-select " id="supportunit">
                <option value="">ALL</option>
                <?php include('../inc/supportunit.php'); ?>
              </select>
            </div>
            <div class="form-group">
              <label>Complaint Id:</label>
              <input name="complaintid" type="text" class="form-control" id="complaintid" autocomplete="off">
              <!-- Add other checkboxes here -->
            </div>
          </div>
        </div>
        <!-- Other input fields for the second column -->




        <div id="form-error"></div>
        <div class="col-md-12 text-end float-right">

          <input name="view" type="submit" class="btn btn-primary" id="view" value="View"
            onClick="formsubmit('toview');" />
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="toexcel" type="submit" class="btn btn-warning ml-2" id="toexcel" value="To Excel"
            onClick="formsubmit('toexcel');" />
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