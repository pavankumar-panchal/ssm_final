<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/call-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">






  <div class="container mt-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center" style="cursor:pointer"
        onclick="showhide('maindiv','toggleimg');">
        <h5 class="card-title m-0">Enter the Details</h5>
        <div class="card-header-actions">
          <img src="../images/minus.jpg" alt="Toggle Image" id="toggleimg" name="toggleimg" class="img-fluid" />
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="registers">Registers:</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="callCheckbox" name="check[]" value="Call"
                    checked="checked">
                  <label class="form-check-label" for="callCheckbox">Calls</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="emailCheckbox" name="check[]" value="Email"
                    checked="checked">
                  <label class="form-check-label" for="emailCheckbox">Emails</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="skypeCheckbox" name="check[]" value="Skype"
                    checked="checked">
                  <label class="form-check-label" for="skypeCheckbox">Skype</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="errorCheckbox" name="check[]" value="Error" />
                  <label class="form-check-label" for="errorCheckbox">Errors</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="onsiteCheckbox" name="check[]" value="Onsite" />
                  <label class="form-check-label" for="onsiteCheckbox">Onsite</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="referenceCheckbox" name="check[]"
                    value="Reference" />
                  <label class="form-check-label" for="referenceCheckbox">References</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inhouseCheckbox" name="check[]" value="Inhouse" />
                  <label class="form-check-label" for="inhouseCheckbox">Inhouse</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="requirementCheckbox" name="check[]"
                    value="Requirement" />
                  <label class="form-check-label" for="requirementCheckbox">Requirements</label>
                </div>

                <!-- Add other checkboxes here -->
              </div>
              <div class="form-group">
                <label for="fromdate">From Date:</label>
                <input type="text" class="form-control" name="fromdate" id="DPC_fromdate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>">
              </div>
              <div class="form-group">
                <label for="todate">To Date:</label>
                <input type="text" class="form-control" name="todate" id="DPC_todate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php echo (datetimelocal('d-m-Y')); ?>">
              </div>
              <div class="form-group">
                <label for="userid">Entered By:</label>
                <select name="userid" id="userid" class="form-control form-select">
                  <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                    <option value="">ALL</option>
                  <?php } ?>
                  <?php include('../inc/useridselectionreports.php'); ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="callertype">Caller Type:</label>
                <div class="form-check">
                  <input class="form-check-input" type='checkbox' id='customer' name='customer' value='Customer'
                    checked="checked" />
                  <label class="form-check-label" for="customer">Customers</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='checkbox' id='dealer' name='dealer' value='Dealer'
                    checked="checked" />
                  <label class="form-check-label" for="dealer">Dealers</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='checkbox' id='employee' name='employee' value='Employee'
                    checked="checked" />
                  <label class="form-check-label" for="employee">Employees</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='checkbox' id='ssmuser' name='ssmuser' value='SSMUser'
                    checked="checked" />
                  <label class="form-check-label" for="ssmuser">SSM Users</label>
                </div>

                <!-- Add other checkboxes here -->
              </div>
              <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control form-select">
                  <option value="" selected="selected">ALL</option>
                  <option value="BLR">Bangalore</option>
                  <option value="CSD">CSD</option>
                  <option value="KKG">KKG</option>
                </select>
              </div>
              <div class="form-group">
                <label for="supportunit">Support Unit:</label>
                <select name="supportunit" class="form-control form-select" id="supportunit">
                  <option value="">ALL</option>
                  <?php include('../inc/supportunit.php'); ?>
                </select>
              </div>
              <div class="form-group">
                <label>Anonymous:</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="anonymous" id="databasefield11" value="yes"
                    checked="checked">
                  <label class="form-check-label" for="databasefield11">Yes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="anonymous" id="databasefield12" value="no">
                  <label class="form-check-label" for="databasefield12">No</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="anonymous" id="databasefield13" value=""
                    checked="checked">
                  <label class="form-check-label" for="databasefield13">Both</label>
                </div>
              </div>
              <div class="form-group">
                <label>Report on:</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="reporton" id="reporton0" value="statistics"
                    checked="checked">
                  <label class="form-check-label" for="reporton0">Statistics</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="reporton" id="reporton1" value="details">
                  <label class="form-check-label" for="reporton1">Details</label>
                </div>
              </div>
            </div>
          </div>


          <div class="text-right">
            <div id="form-error"></div>
            <button type="submit" class="btn btn-primary" id="view" onclick="formsubmit('view');">View</button>
            <button type="submit" class="btn btn-warning" id="toexcel" onclick="formsubmit('toexcel');">To
              Excel</button>
          </div>
        </form>
      </div>
    </div>
  </div>


















  <div id="processingbar"></div>


  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">View Data:</h5>
        <div class="text-end">
          <!-- Add any content for the right side of the header here -->
        </div>
      </div>
      <div class="card-body">
        <div id="displaystatsreport" class="overflow-auto" style="height: 300px; width: 1060px; padding: 2px;"
          align="center"></div>
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