<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Select Event
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['table']});
    </script>
    <script type="text/javascript">
    var visualization;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'Height');
    data.addColumn('boolean', 'Smokes');
    data.addRows(3);
    data.setCell(0, 0, 'Tong Ning mu');
    data.setCell(1, 0, 'Huang Ang fa');
    data.setCell(2, 0, 'Teng nu');
    data.setCell(0, 1, 174);
    data.setCell(1, 1, 523);
    data.setCell(2, 1, 86);
    data.setCell(0, 2, true);
    data.setCell(1, 2, false);
    data.setCell(2, 2, true);

    function drawVisualization() {
      visualization = new google.visualization.Table(document.getElementById('table'));
      visualization.draw(data, null);
      
      // Add our selection handler.
      google.visualization.events.addListener(visualization, 'select', selectHandler);
    }
    
    // The selection handler.
    // Loop through all items in the selection and concatenate
    // a single message from all of them.
    function selectHandler() {
      var selection = visualization.getSelection();
      var message = '';
      for (var i = 0; i < selection.length; i++) {
        var item = selection[i];
        if (item.row != null && item.column != null) {
          message += '{row:' + item.row + ',column:' + item.column + '}';
        } else if (item.row != null) {
          message += '{row:' + item.row + '}';
        } else if (item.column != null) {
          message += '{column:' + item.column + '}';
        }
      }
      if (message == '') {
        message = 'nothing';
      }
      alert('You selected ' + message);
    }

    google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="table"></div>
  </body>
</html>

