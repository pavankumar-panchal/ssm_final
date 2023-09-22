<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript' src='../functions/annotatedtimeline-adv.js?dummy = <?php echo (rand()); ?>'></script>
<div id="contentdiv" style="display:block;">

  <div class="container mt-4">
    <div class="card">
      <div class="card-header" style="cursor:pointer" onclick="showhide('maindiv','toggleimg');">
        <h5 class="card-title m-0">&nbsp;&nbsp;Enter the Details</h5>
        <div class="card-header-actions">
          <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" alt="Toggle Image"
            class="img-fluid">
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label for="registers">Registers:</label>
                <div class="form-check">
                  <input name="selectall" type="checkbox" id="selectall" class="form-check-input">
                  <label class="form-check-label" for="selectall">Select All</label>
                </div>
                <div class="form-check">
                  <input name="register[]" type="checkbox" id="call" value="call" checked="checked"
                    class="form-check-input">
                  <label class="form-check-label" for="call">Calls</label>
                </div>
                <div class="form-check">
                  <input name="register[]" type="checkbox" id="email" value="email" checked="checked"
                    class="form-check-input">
                  <label class="form-check-label" for="email">Emails-Customer</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="emailnc" value="emailnc" class="form-check-input">
                  <label class="form-check-label" for="emailnc">Emails-NonCustomer</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="error" value="error" class="form-check-input">
                  <label class="form-check-label" for="error">Errors</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="inhouse" value="inhouse" class="form-check-input">
                  <label class="form-check-label" for="inhouse">Inhouse</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="onsite" value="onsite" class="form-check-input">
                  <label class="form-check-label" for="onsite">Onsite</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="reference" value="reference" class="form-check-input">
                  <label class="form-check-label" for="reference">Reference</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="requirement" value="requirement"
                    class="form-check-input">
                  <label class="form-check-label" for="requirement">Requirement</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="register[]" id="skype" value="skype" class="form-check-input">
                  <label class="form-check-label" for="skype">Skype</label>
                </div>
              </div>

              <div class="form-group">
                <label for="fromdate">From Date:</label>
                <input name="fromdate" type="date" class="form-control" id="DPC_fromdate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>">
              </div>
              <div class="form-group">
                <label for="todate">To Date:</label>
                <input name="todate" type="date" class="form-control" id="DPC_todate" size="30" autocomplete="off"
                  style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>">
              </div>
              <div class="form-group">
                <label for="enteredby">Entered By:</label>
                <select name="userid" id="userid" class="form-control">
                  <option value="">ALL</option>
                  <?php include('../inc/useridselectionreports.php'); ?>
                </select>
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <input name="status" type="text" class="form-control" id="status" size="30" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label for="callerType">Caller Type:</label>
                <div class="form-check">
                  <input type="checkbox" name="customer" id="customer" value="Customer" class="form-check-input">
                  <label class="form-check-label" for="customer">Customers</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="dealer" id="dealer" value="Dealer" class="form-check-input">
                  <label class="form-check-label" for="dealer">Dealers</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="employee" id="employee" value="Employee" class="form-check-input">
                  <label class="form-check-label" for="employee">Employees</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" name="ssmuser" id="ssmuser" value="SSMUser" class="form-check-input">
                  <label class="form-check-label" for="ssmuser">SSM Users</label>
                </div>
                <small class="text-muted">[Not Available for Email Non Customers, Errors, References,
                  Requirements]</small>
              </div>

              <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control">
                  <option value="" selected="selected">ALL</option>
                  <option value="BLR">Bangalore</option>
                  <option value="CSD">CSD</option>
                  <option value="KKG">KKG</option>
                </select>
              </div>
              <div class="form-group">
                <label for="supportunit">Support Unit:</label>
                <select name="supportunit" class="form-control" id="supportunit">
                  <option value="">ALL</option>
                  <?php include('../inc/supportunit.php'); ?>
                </select>
              </div>
              <div class="form-group">
                <label for="anonymous">Anonymous:</label>
                <div class="form-check">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield11" value="yes"
                    class="form-check-input" />
                  <label class="form-check-label" for="anonymousdatabasefield11">Yes</label>
                </div>
                <div class="form-check">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield12" value="no"
                    class="form-check-input" />
                  <label class="form-check-label" for="anonymousdatabasefield12">No</label>
                </div>
                <div class="form-check">
                  <input type="radio" name="anonymous" id="anonymousdatabasefield13" value="" checked="checked"
                    class="form-check-input" />
                  <label class="form-check-label" for="anonymousdatabasefield13">Both</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12 text-right">
              <div id="form-error"></div>
              <button name="view" type="submit" class="btn btn-primary" id="view"
                onclick="gettimelinedata()">View</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="container text-center">
    <h1>Team Chart</h1>

    <div id="chart_div" class="embed-responsive embed-responsive-2by3" style="max-width: 700px; margin: 0 auto;"></div>
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