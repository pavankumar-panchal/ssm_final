<?php
if ($usertype <> 'TEAMLEADER' && $usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT')
  header("location:../index.php");
else {
  ?>
  <!-- <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>"> -->
  <script language="javascript" src="../functions/supportunitmaster.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card border">
          <div class="card-header">
            <strong>Enter / Edit / View Details</strong>
            <button class="btn btn-sm btn-link float-right" type="button" data-toggle="collapse" data-target="#maindiv"
              aria-expanded="false" onclick="toggleMainDiv()">
              <i class="fas fa-minus"></i>
            </button>
          </div>
          <div class="collapse show" id="maindiv">
            <div class="card-body">
              <form action="" method="post" name="submitform" id="submitform">
                <div class="form-group">
                  <label for="heading">Support Unit Heading:</label>
                  <input name="heading" type="text" class="form-control" id="heading" />
                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                  <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                    value="<?php echo ($reportingauthority); ?>" />
                </div>
                <div class="form-group">
                  <label for="remarks">Remarks:</label>
                  <input name="remarks" type="text" class="form-control" id="remarks" />
                </div>
                <div class="text-right">
                  <div id="form-error"></div>
                </div>
                <div class="text-end mt-4">
                  <button name="new" type="reset" id="new" onclick="newentry();clearinnerhtml();" <?php if ($usertype !== 'ADMIN') { ?> disabled="disabled" <?php } ?>
                    class="btn btn-secondary <?php echo ($usertype !== 'ADMIN') ? 'disabled' : ''; ?>">New</button>
                  <button name="save" type="submit" id="save" onclick="formsubmit('save')" <?php if ($usertype !== 'ADMIN') { ?> disabled="disabled" <?php } ?>
                    class="btn btn-primary <?php echo ($usertype !== 'ADMIN') ? 'disabled' : ''; ?>">Save</button>
                  <button name="delete" type="submit" class="btn btn-danger disabled" id="delete"
                    onclick="formsubmit('delete')" disabled="disabled">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <!-- Tab Navigation -->
        <div class="row">
          <div class="col-3">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="tabgroupgridh1" href="#"
                  onclick="gridtab2('1','tabgroupgrid');">Default</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tabgroupgridh2" href="#" onclick="gridtab2('2','tabgroupgrid');">Filter</a>
              </li>
            </ul>
          </div>
          <div class="col-9">
          </div>
        </div>

        <!-- Content -->
        <div class="row mt-2">
          <div class="col-md-12">
            <div class="card border">
              <div class="card-header">
                <strong>View Records</strong>
                &nbsp;&nbsp;
                <span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span>

              </div>
              <div class="card-body">
                <div id="tabgroupgridc1" style="overflow:auto; max-height:300px;">
                  <!-- Content for Default Tab -->
                </div>
                <div id="tabgroupgridc2" style="overflow:auto; max-height:300px; display:none;">
                  No records to be displayed. Please filter the records from the filter form.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>









<?php } ?>