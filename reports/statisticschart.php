<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript' src='../functions/annotatedtimeline-adv.js?dummy = <?php echo (rand()); ?>'></script>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


<div class="container mt-5 rounded">
  <div class="card " style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
    <div class="card-header bg-light" style="cursor: pointer;" onclick="showhide('maindiv','toggleimg');">
      <h5 class="mb-0 ">&nbsp;&nbsp;Enter the Details</h5>
    </div>
    <div class="card-body" id="maindiv" style="display: block;">
      <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fromdate">From Date:</label>
              <input name="fromdate" type="text" class="form-control" id="DPC_fromdate" autocomplete="off"
                value="<?php datetimelocal('d-m-Y'); ?>" datepicker_format="DD-MM-YYYY" maxlength="10"
                isdatepicker="true">
            </div>
            <div class="form-group">
              <label for="todate">To Date:</label>
              <input name="todate" type="text" class="form-control" id="DPC_todate" autocomplete="off"
                value="<?php datetimelocal('d-m-Y'); ?>" datepicker_format="DD-MM-YYYY" maxlength="10"
                isdatepicker="true">
            </div>
            <div class="form-group">
              <label>Registers:</label>
              <div class="form-check">

                <label class="form-check-label" for="call">
                  <input class="form-check-input" type="checkbox" name="register[]" id="call" value="call" checked>
                  Calls
                </label>
                <br>

                <label class="form-check-label" for="email">
                  <input class="form-check-input" type="checkbox" name="register[]" id="email" value="email"> Emails
                  Customer
                </label>
                <br>

                <label class="form-check-label" for="emailnc">
                  <input class="form-check-input" type="checkbox" name="register[]" id="emailnc" value="emailnc">
                  Email-NonCustomer
                </label>
                <br>

                <label class="form-check-label" for="error">
                  <input class="form-check-input" type="checkbox" name="register[]" id="error" value="error"> Errors
                </label>
                <br>

                <label class="form-check-label" for="inhouse">
                  <input class="form-check-input" type="checkbox" name="register[]" id="inhouse" value="inhouse">
                  In-House
                </label>
                <br>

                <label class="form-check-label" for="onsite">
                  <input class="form-check-input" type="checkbox" name="register[]" id="onsite" value="onsite"> Onsite
                </label>
                <br>

                <label class="form-check-label" for="reference">
                  <input class="form-check-input" type="checkbox" name="register[]" id="reference" value="reference">
                  References
                </label>
                <br>

                <label class="form-check-label" for="requirement">
                  <input class="form-check-input" type="checkbox" name="register[]" id="requirement"
                    value="requirement"> Requirements
                </label>
                <br>

                <label class="form-check-label" for="skype">
                  <input class="form-check-input" type="checkbox" name="register[]" id="skype" value="skype"> Skype
                </label>
                <br>

                <input type="hidden" name="lastslno" id="lastslno" value="" />
                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                <input type="hidden" name="endtime" id="endtime" value="" />
                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                  value="<?php echo ($reportingauthoritytype); ?>" />
              </div>
              <!-- Add other checkboxes here -->
            </div>

            <!-- Other input fields for the first column -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Category:</label>
              <select name="category" id="category" class="form-control form-select">
                <option value="" selected="selected">ALL</option>
                <option value="BLR">Bangalore</option>
                <option value="CSD">CSD</option>
                <option value="KKG">KKG</option>
              </select>
              [Not Available for Email Non Customers, Errors, References,
              Requirements]
              <!-- Add other checkboxes here -->
            </div>
            <div class="form-group">
              <label>Support Unit:</label>
              <select name="supportunit" id="supportunit" class="form-control form-select">
                <option value="">ALL</option>
                <?php include('../inc/supportunit.php'); ?>

              </select>
            </div>
            <div class="form-group">
              <label>Entered By:</label>
              <select name="userid" id="userid" class="form-control form-select">
                <option value="">ALL</option>
                <?php include('../inc/useridselectionreports.php'); ?>
              </select>
            </div>
            <div class="form-group">
              <label for="todate">Status:</label>
              <input name="status" type="text" class="form-control" id="status" autocomplete="off"
                datepicker_format="DD-MM-YYYY" maxlength="10" isdatepicker="true">
            </div>
            <div class="form-group">
              <label>Caller Type:</label>
              <div class="form-check">

                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="customer" id="customer" value="Customer">
                  Customers
                </label>
                <br>

                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="dealer" id="dealer" value="Dealer">
                  Dealers
                </label>
                <br>

                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="employee" id="employee" value="employee">
                  Employees
                </label>
                <br>

                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ssmuser" id="ssmuser" value="SSMUser" disabled>
                  SSM Users
                </label>
                <br>
                [Not Available for Email Non Customers, Errors, References, Requirements]

              </div>
              <!-- Add other checkboxes here -->
            </div>

            <div class="form-group">
              <label>Anonymous:</label>
              <div>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield11" value="Yes"
                    class="form-check-input"> Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield12" value="No"
                    class="form-check-input"> No
                </label>
                <label class="radio-inline">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield13" value="Both"
                    class="form-check-input" checked="checked"> Both
                </label>
                <!-- Add other radio buttons here -->
              </div>
            </div>

          </div>
        </div>

        <div class="container mt-3">
          <div class="row">
            <div class="col-md-8">
              <div id="form-error"></div>
            </div>
            <div class="col-md-4 text-end float-right">
              <button name="view" type="submit" class="btn btn-primary" id="view" onClick="gettimelinedata()">View
              </button>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="chart_div" style="width: 700px; height: 240px; margin-top:50px;"></div>


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