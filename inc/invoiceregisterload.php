<style>
  .form-check{
    margin-right: 20px;
  }
</style>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Search / Get / View Details
        </div>
        <div class="card-body">
          <form action="" method="post" name="registerloadform" id="registerloadform"
            onsubmit="javascript:return registerloadsearch('registerloadform');">
            <div class="form-group">
              <label>Select the Register [Onsite/Inhouse]:</label>
              <div class="form-check">
                <input name="database" type="radio" id="database0" value="ssm_onsiteregister" checked="checked"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="database0">Onsite</label>
              </div>
              <div class="form-check">
                <input type="radio" name="database" value="ssm_inhouseregister" id="database1"
                  onclick="registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="database1">In-house</label>
              </div>
            </div>
            <div class="form-group mt-2 ">
              <label>Search Text:</label>
              <input name="searchcriteria" type="text" id="searchcriteria" size="50" maxlength="25"
                onkeyup="javascript:return registerloadsearch('registerloadform')" class="form-control"
                autocomplete="off" />
            </div>
            <div class="form-group " style="display:flex; flex-direction:row;">
              <label>In:</label>


              <div class="form-check" >
                <input type="radio" name="databasefield" id="databasefield0" value="customername"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield0">Customer Name</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" id="databasefield1" value="customerid" checked="checked"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield1">Customer Id</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="billno" id="databasefield2"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield2">Bill No</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="status" id="databasefield7"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield7">Status</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="date" id="databasefield3"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield3">Registered Date</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="solveddate" id="databasefield4"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield4">Solved Date</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="solvedby" id="databasefield5"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield5">Solved By</label>
              </div>
              <div class="form-check">
                <input type="radio" name="databasefield" value="userid" id="databasefield6"
                  onclick="javascript:registerloadsearch('registerloadform');" class="form-check-input" />
                <label class="form-check-label" for="databasefield6">Entered By</label>
              </div>


            </div>
            <div class="form-group mt-2">
              <label>Order By:</label>
              <select name="orderby" id="orderby" onchange="javascript:registerloadsearch('registerloadform');"
                class="form-control form-select">
                <option value="customerid">Customer ID</option>
                <option value="customername">Customer Name</option>
                <option value="date" selected="selected">date</option>
              </select>
            </div>

            <div class="container mt-3 text-end" >
              <div class="row">
                <div class="col-md-12 text-right border-top mt-3 pt-3">
                  <input type="hidden" name="hiddendbinfo" value="" id="hiddendbinfo" />
                  <input type="hidden" name="hiddenregisterinfo" value="" id="hiddenregisterinfo" />
                  <input type="hidden" id="selectvaluehidden" name="selectvaluehidden" value="" />
                  <button class="btn btn-primary" id="nameload-select" value="" type="button"
                    onclick="loadpasscuidregister('selectvaluehidden');getcontentdivfunc(); customerrecords('nameloadform');">
                    Select
                  </button>
                  <button class="btn btn-secondary" id="nameload-close" type="button" onclick="getcontentdivfunc();">
                    Cancel
                  </button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-12 mt-4" >
    <div class="card">
      <div class="card-header">
        View Filtered Records: <span id="wait-box"></span>
      </div>
      <div class="card-body" >
        <div id="nameloadgrid1" class="overflow-auto" style="height: 150px;">
        </div>
      </div>
    </div>
  </div>
</div>