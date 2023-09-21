<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/call-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <div class="container mt-5">
    <div class="card">
      <div class="card-header" style="cursor: pointer;">
        <h5 class="mb-0 ">Enter the Details</h5>
      </div>
      <div class="card-body" id="maindiv" style="display: block;">
        <!-- <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;"> -->
        <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">

          <div class="row mb-3">

            <div class="col-md-6">
              <div class="form-group">
                <label>Registers:</label>
                <div class="checkbox-group">
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Call" checked> Calls
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Email" checked="checked"> Emails
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Skype" checked="checked"> Skype
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Errors"> Errors
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Onsite"> Onsite
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="References"> References
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Inhouse"> Inhouse
                  </label>
                  <label class="checkbox-inline">
                    <input name="check[]" type="checkbox" value="Requirements"> Requirements
                  </label>
                  <!-- Add other checkboxes here -->
                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                  <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                  <input type="hidden" name="endtime" id="endtime" value="" />
                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                    value="<?php echo ($reportingauthoritytype); ?>" />

                </div>
              </div>
              <!-- Other input fields -->
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>From Date:</label>
                <input name="fromdate" type="text" id="DPC_fromdate" class="form-control"
                  value="<?php echo (datetimelocal('d-m-Y')); ?>">
              </div>
              <!-- Other input fields -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>To Date:</label>
                <input name="todate" type="text" id="DPC_todate" class="form-control"
                  value="<?php echo (datetimelocal('d-m-Y')); ?>">
              </div>
              <!-- Other input fields -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Entered By:</label>
                <!-- <input name="fromdate" type="date" id="DPC_fromdate" value="2021-07-01" class="form-control"> -->
              </div>
              <!-- Other input fields -->
              <select name="userid" id="userid" class="form-control form-select ">
                <!-- Add other options here -->
                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                  <option value="">ALL</option>
                <?php } ?>
                <?php include('../inc/useridselectionreports.php'); ?>
              </select>

            </div>

          </div>


          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group">
                <label>Caller Type:</label>
                <div>
                  <label class="checkbox-inline">
                    <input name="customer" type="checkbox" id="customer" value="Customer" checked>
                    Customers
                  </label>
                  <label><input name="dealer" type="checkbox" id="dealer" value="Dealer" checked="checked">
                    Dealers</label>
                  <label><input name="employee" type="checkbox" id="employee" value="employee" checked="checked">
                    Employees</label>
                  <label><input name="ssmuser" type="checkbox" id="ssmuser" value="SSMUser" checked="checked">
                    SSM Users</label>
                  <!-- Add other checkboxes here -->
                </div>
              </div>
              <!-- Other input fields -->
            </div>


          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group">
                <label>Category:</label>
                <select name="category" id="category" class="form-control form-select">
                  <option value="" selected>ALL</option>
                  <!-- Add other options here -->
                  <option value="BLR">Bangalore</option>
                  <option value="CSD">CSD</option>
                  <option value="KKG">KKG</option>
                </select>
              </div>
              <!-- Other input fields -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Support Unit:</label>
                <select name="supportunit" class="form-control form-select" id="supportunit">
                  <option value="">ALL</option>
                  <!-- Add other options here -->
                  <?php include('../inc/supportunit.php'); ?>

                </select>
              </div>
              <!-- Other input fields -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Anonymous:</label>
              <div>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield11" value="Yes"> Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield12" value="No"> No
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="databasefield13" value="Both" checked="checked"> Both
                </label>
                <!-- Add other radio buttons here -->
              </div>
            </div>
            <!-- Other input fields -->
            <div class="form-group">
              <label>Report on:</label>
              <div>
                <label class="radio-inline">
                  <input name="reporton" type="radio" id="reporton0" value="statistics" checked>
                  Statistics
                </label>
                <label class="radio-inline">
                  <input name="reporton" type="radio" id="reporton1" value="details">
                  Details
                </label>
                <!-- Add other radio buttons here -->
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-12 p-4 text-end float-right">
          <div id="form-error"></div>
          <button name="view" type="submit" class="btn btn-primary " id="view" onclick="formsubmit('view');">
            View
          </button>
          <button name="toexcel" type="submit" class="btn btn-warning ml-2 " id="toexcel"
            onclick="formsubmit('toexcel');">
            To Excel
          </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="container mt-5">
  <div class="card">
    <div class="card-header" style="cursor: pointer;">
      <h5 class="mb-0 ">View details</h5>
    </div>
    <div class="card-body" id="maindiv" style="display: block;">
      <div id="displaystatsreport" class="overflow-auto" style="height: 300px;">
        <!-- Add your content here -->

        <div id="processingbar"></div>

      </div>
    </div>
  </div>
</div>


<div class="container mt-4">
  <!-- First Section - nameloaddiv -->
  <div id="nameloaddiv" style="display:none;">
    <div class="card">
      <div class="card-header bg-primary text-white">
        Call Register > Get Customer
      </div>
      <div class="card-body">
        <div id="gc-form-error"></div>
        <!-- Include PHP content here if needed -->
      </div>
    </div>
  </div>

  <!-- Second Section - questionload -->
  <div id="questionload" style="display:none;">
    <div class="card mt-4">
      <div class="card-header bg-primary text-white">
        Call Register > Get Problems and Solutions
      </div>
      <div class="card-body">
        <div id="gq-form-error"></div>
        <!-- Include PHP content here if needed -->
      </div>
    </div>
  </div>
</div>