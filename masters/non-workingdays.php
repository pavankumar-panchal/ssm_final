<?php
if ($usertype <> 'ADMIN') {
  header("location:../index.php?a_link=home_dashboard");
} else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/nonworkingdays.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card border ">
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
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="DPC_date">Date:</label>
                      <input name="date" type="text" class="form-control" id="DPC_date" style="background:#FEFFE6;" />
                      <input type="hidden" name="lastslno" id="lastslno" value="" />
                      <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                      <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                      <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                        value="<?php echo ($reportingauthority); ?>" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="occassion">Occasion:</label>
                      <input name="occassion" type="text" class="form-control" id="occassion" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="remarks">Remarks:</label>
                  <textarea name="remarks" class="form-control" id="remarks" rows="4"></textarea>
                </div>
                <div class="text-right">
                  <div id="form-error"></div>
                </div>
                <div class="text-end mt-4">
                  <button name="new" type="reset" id="new" <?php if ($usertype !== 'ADMIN') { ?> disabled="disabled" <?php } ?>
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
        <div class="card border">
          <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#default" id="tabgroupgridh1" data-toggle="tab"
                  onclick="gridtab2('1','tabgroupgrid');">Default</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#filter" id="tabgroupgridh2" data-toggle="tab"
                  onclick="gridtab2('2','tabgroupgrid');">Filter</a>
              </li>
            </ul>
            <!-- Tab Content -->
            <div class="tab-content">
              <!-- Default Tab Content -->
              <div class="tab-pane fade show active" id="default">
                <table class="table table-bordered">
                  <tr>
                    <td class="card-header" style="padding:0;" width="10%">&nbsp;&nbsp;View Records:</td>
                    <td class="card-header" style="padding:0;" width="75%">
                      <span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span>
                    </td>
                    <td class="card-header" style="padding:0;" width="15%"></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" valign="top">
                      <div id="tabgroupgridc1" class="table-responsive">
                        <!-- Default Tab Content Here -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">
                              <div id="tabgroupgridc1_2"> </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- Filter Tab Content -->
              <div class="tab-pane fade" id="filter">
                <table class="table table-bordered">
                  <tr>
                    <td class="header-line" style="padding:0;" width="10%">&nbsp;&nbsp;View Records:</td>
                    <td class="header-line" style="padding:0;" width="75%"></td>
                    <td class="header-line" style="padding:0;" width="15%"></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" valign="top">
                      <div id="tabgroupgridc2" class="table-responsive">
                        <!-- Filter Tab Content Here -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">
                              <div id="tabgroupgridc1_1"> </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                  <div id="regresultgrid" style="overflow:auto; display:none; height:300px; width:1060px; padding:2px;">
                    &nbsp;</div>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<?php } ?>