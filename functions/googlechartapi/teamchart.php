
<?php include("../functions/phpfunctions.php"); ?>
<link rel="stylesheet" type="text/css" href="../style/main.css">
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript"> google.load('visualization', '1', {packages: ['orgchart', 'table']}); </script>
    <script type="text/javascript">
    var map; var table; var data;

    function drawOrgChartAndTable() 
	{
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Executive Name');
      data.addColumn('string', 'Team Leader');
	  <?php 
		$query = "SELECT username,reportingauthority FROM ssm_users WHERE type <> 'ADMIN'";
		$result = runmysqlquery($query);
		$fetchcount = mysqli_num_rows($result);
		echo("data.addRows(".$fetchcount.");");
		$row=0;
		while($fetch = mysqli_fetch_array($result))
		{
			if($fetch['reportingauthority'] <> '')
			{
				$fetchra = runmysqlqueryfetch("SELECT username FROM ssm_users WHERE slno = '".$fetch['reportingauthority']."'");
				$fetchrausername = $fetchra['username'];
			}
			else
				$fetchrausername = '';
				
			echo("data.setCell(".$row.", 0, '".$fetch['username']."');
			data.setCell(".$row.", 1, '".$fetchrausername."');");
			$row++;
		}
 ?>
    
      var orgchart = new google.visualization.OrgChart(document.getElementById('orgchart'));
      orgchart.draw(data, null);
    
      var table = new google.visualization.Table(document.getElementById('table'));
      table.draw(data, null);
      
      // When the table is selected, update the orgchart.
      google.visualization.events.addListener(table, 'select', function() {
        orgchart.setSelection(table.getSelection());
      });
    
      // When the orgchart is selected, update the table visualization.
      google.visualization.events.addListener(orgchart, 'select', function() {
        table.setSelection(orgchart.getSelection());
      });  
    }

    google.setOnLoadCallback(drawOrgChartAndTable);
    </script>
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Home > Dashboard</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>

