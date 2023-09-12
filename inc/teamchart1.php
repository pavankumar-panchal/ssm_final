<script type="text/javascript"> google.load('visualization', '1', {packages: ['orgchart', 'table']}); </script>
<script type="text/javascript">
    var map; var table; var data;

    function drawOrgChartAndTable() 
	{
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Executive Name');
      data.addColumn('string', 'Team Leader');
	  <?php 
	  $supportunitpieces = ($loggedsupportunit == '4')?(""):(" and supportunit = '".$loggedsupportunit."'");
		$query = "SELECT username,reportingauthority FROM ssm_users WHERE type <> 'ADMIN' and reportingauthority <> ''".$supportunitpieces;
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
    
      var table = new google.visualization.Table(document.getElementById('orgtable'));
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

