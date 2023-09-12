<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Motion Chart</title>
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript">
    google.load('visualization', '1', {packages: ['motionchart']});

    function drawVisualization() {
      new google.visualization.Query(
          'http://spreadsheets.google.com/tq?key=pCQbetd-CptE1ZQeQk8LoNw').send(
          function(response) {
            new google.visualization.MotionChart(
                document.getElementById('visualization')).
                draw(response.getDataTable(), {'width': 800, 'height': 400});
          });
    }
    

    google.setOnLoadCallback(drawVisualization);
  </script>
</head>
<body style="font-family: Arial;border: 0 none;">
<div id="visualization" style="width: 800px; height: 400px;"></div>
</body>
</html>