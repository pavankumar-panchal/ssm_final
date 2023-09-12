<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Data Source Request
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['intensitymap']});
    </script>
    <script type="text/javascript">
    var visualization;

    function drawVisualization() {
      var query = new google.visualization.Query(
          'http://192.168.1.94/supportsystem/googlechartapi/usercsv.csv?tqx=reqId:1;out:csv');
      
      // Send the query with a callback function.
      query.send(handleQueryResponse);
    }
    
    function handleQueryResponse(response) {
      if (response.isError()) {
        alert('Error in query: ' + response.getMessage() + '' + response.getDetailedMessage());
        return;
      }
    
      var data = response.getDataTable();
      visualization = new google.visualization.Table(document.getElementById('visualization'));
      visualization.draw(data, null);
    }

    google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="height: 400px; width: 400px;"></div>
  </body>
</html>
