<?php
if ($usertype <> 'TEAMLEADER' && $usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/javascripts.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>
  <script language="javascript" src="../functions/categorymaster.js?dummy = <?php echo (rand()); ?>"
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
                  <label for="categoryheading">Category Heading:</label>
                  <input name="categoryheading" type="text" class="form-control" id="categoryheading" />
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
                  <button name="new" type="reset" id="new" onclick="newentry(); clearinnerhtml();" <?php if ($usertype !== 'ADMIN') { ?> disabled="disabled" <?php } ?>
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
      <div class="col-md-3">
        <div class="flex-column">
          <a class="" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');" style="cursor:pointer">
            Default
          </a>
          <a class="" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');" style="cursor:pointer">
            Filter
          </a>
        </div>
      </div>
      <div class="col-md-9">
        <span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span>
      </div>
    </div>
  </div>



  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card border">
          <div class="card-header">
            View Records : 
            &nbsp; &nbsp;
          </div>


          <div class="card-body">
            <div id="tabgroupgridc1" style="overflow:auto; max-height: 300px;">
              <!-- Your record content here -->
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
            <div id="tabgroupgridc2" style="overflow:auto; max-height: 300px; display: none;">
              <!-- Filtered records content here -->
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
            <div id="regresultgrid" style="overflow:auto; display: none; max-height: 300px;">
              <!-- Result content here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>






<?php } ?>