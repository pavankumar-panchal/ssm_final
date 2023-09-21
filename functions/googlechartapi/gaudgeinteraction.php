<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Gauge Interactions
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['gauge']});
    </script>
    <script type="text/javascript">
    var gauge;
    var gaugeData;
    var gaugeOptions;
    function drawGauge() {
      gaugeData = new google.visualization.DataTable();
      gaugeData.addColumn('number', 'Engine');
      gaugeData.addColumn('number', 'Torpedo');
      gaugeData.addRows(2);
      gaugeData.setCell(0, 0, 120);
      gaugeData.setCell(0, 1, 80);
    
      gauge = new google.visualization.Gauge(document.getElementById('gauge'));
      gaugeOptions = {
          min: 0,
          max: 280,
          yellowFrom: 200,
          yellowTo: 250,
          redFrom: 250,
          redTo: 280,
          minorTicks: 5
      };
      gauge.draw(gaugeData, gaugeOptions);
    }
    
    function changeTemp(dir) {
      gaugeData.setValue(0, 0, gaugeData.getValue(0, 0) + dir * 25);
      gaugeData.setValue(0, 1, gaugeData.getValue(0, 1) + dir * 20);
      gauge.draw(gaugeData, gaugeOptions);
    }
    
    
    google.setOnLoadCallback(drawGauge);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="gauge" style="width: 300px; height: 300px;"></div>
    <input type="button" value="Go Faster" onclick="changeTemp(1)" />
    <input type="button" value="Slow down" onclick="changeTemp(-1)" />
  </body>
</html>
