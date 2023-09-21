<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Ready Event
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['annotatedtimeline']});
    </script>
    <script type="text/javascript">

    function handleButtonClick() {
      alert('button clicked!');
      drawVisualization();
    }
    
    function drawVisualization() {
      var query = new google.visualization.Query(
          'http://spreadsheets.google.com/tq?key=pCQbetd-CptH5QNY89vLtAg&pub=1');
      query.send(handleResponse);
    }
    
    function handleResponse(response) {
      var container = document.getElementById('visualization');
      var annotatedtimeline = new google.visualization.AnnotatedTimeLine(container);
      annotatedtimeline.draw(response.getDataTable(), {'displayAnnotations': true});
      google.visualization.events.addListener(annotatedtimeline, 'ready',
        function(event) {
          alert('annotatedtimeline is ready, master!');
        });
    }

    google.setOnLoadCallback(
        function() {
          document.getElementById('button').style.visibility = 'visible';
        });
    
    </script>
  </head>
  <body style="font-family: Arial; border: 0 none;">
    <div>
      Click on the button, and a chart will be drawn.
      <br />
      When the chart will be ready, you'll be notified.
    </div>
    <br />
    <input id="button" type="button" value="Click me" onclick="drawVisualization();" style="visibility: hidden;"></input>
    <div id="visualization" style="width: 800px; height: 400px;"></div>
  </body>
</html>
