<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Interaction Using Events
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['orgchart', 'table']});
    </script>
    <script type="text/javascript">
function initialize() {
  // Replace the data source URL on next line with your data source URL.
  var query = new google.visualization.Query('http://nithya/supportsystem/googlechartapi/usercsv.txt');
  
  // Optional request to return only column C and the sum of column B, grouped by C members.
  query.setQuery('select A, B');
  
  // Send the query with a callback function.
  query.send(handleQueryResponse);
}

function handleQueryResponse(response) {
  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }

  var data = response.getDataTable();
var table = new google.visualization.Table(document.getElementById('table'));
      table.draw(data, null);
  

    google.setOnLoadCallback(initialize);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <table>
      <tr>
        <td>
          <div id="orgchart" style="width: 300px; height: 300px;"></div>
        </td>
        <td>
          <div id="table" style="width: 300px; height: 300px;"></div>
        </td>
      </tr>
    </table>
  </body>
</html>
