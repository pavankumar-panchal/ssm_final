<html>
  <head>
  <title>Table Chart</title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawVisualization);
      function drawVisualization() {
  // Create and populate the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Name');
  data.addColumn('number', 'Height');
  data.addRows(4);
  data.setCell(0, 0, 'Nithya');
  data.setCell(1, 0, 'Rashmi');
  data.setCell(2, 0, 'Ramya');
  data.setCell(3, 0, 'Kavya');
  data.setCell(0, 1, 156);
  data.setCell(1, 1, 154);
  data.setCell(2, 1, 153);
  data.setCell(2, 1, 152);

  // Create and draw the visualization.
  visualization = new google.visualization.Table(document.getElementById('table'));
  visualization.draw(data, null);
}
    </script>
  </head>

  <body>
    <div id="table"></div>
  </body>
</html>
