<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Search / Get / View Details</h5>
          <form action="" method="post" name="invoiceregisterloadform" id="invoiceregisterloadform"
            onsubmit="javascript:return invoiceregisterload('invoiceregisterloadform');">
            <div class="form-group">
              <label for="searchcriteria">Search Text:</label>
              <input name="searchcriteria" type="text" id="searchcriteria" class="form-control" size="50" maxlength="25"
                onkeyup="javascript:return invoiceregisterload('invoiceregisterloadform')" autocomplete="off" />
            </div>
            <div class="form-group">
              <label>Search In:</label>
              <div>
                <label for="databasefield0">
                  <input type="radio" name="databasefield" id="databasefield0" value="customername"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Customer Name
                </label>
                <label for="databasefield1">
                  <input type="radio" name="databasefield" id="databasefield1" value="customerid" checked="checked"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Customer Id
                </label>
                <label for="databasefield2">
                  <input type="radio" name="databasefield" value="billno" id="databasefield2"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Bill No
                </label>
                <label for="databasefield3">
                  <input type="radio" name="databasefield" value="date" id="databasefield3"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Registered Date
                </label>
                <label for="databasefield4">
                  <input type="radio" name="databasefield" id="databasefield4" value="solveddate"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Solved Date
                </label>
                <label for="databasefield5">
                  <input type="radio" name="databasefield" value="solvedby" id="databasefield5"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Solved By
                </label>
                <label for="databasefield6">
                  <input type="radio" name="databasefield" value="userid" id="databasefield6"
                    onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
                  Entered By
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="orderby">Order By:</label>
              <select name="orderby" id="orderby" onchange="invoiceregisterload('invoiceinvoiceregisterloadform')"
                class="form-control form-select">
                <option value="customerid">Customer ID</option>
                <option value="customername" selected="selected">Customer Name</option>
              </select>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Filtered Records</h5>
          <div class="table-responsive">
            <div id="invoiceregisterloadgrid" style="overflow:auto; height:150px; padding:2px;" align="center"></div>
          </div>
          <hr>
          <div class="text-right" style="border-top:1px solid #d1dceb;">
            <input type="hidden" name="hiddendbinfo" value="" id="hiddendbinfo" />
            <input type="hidden" name="hiddenregisterinfo" value="" id="hiddenregisterinfo" />
            <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" />
            <button class="btn btn-primary" id="nameload-select" value="" type="button"
              onclick="loadinvoicesubmit('hiddenlastslno'); getcontentdivfunc(); customerrecords('nameloadform');">
              Select
            </button>
            <button class="btn btn-secondary" id="nameload-close" type="button" onclick="getcontentdivfunc();">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>