<?php
	$query = "SELECT statecode,statename FROM inv_mas_state order by statename;";
	$result = runmysqlquery($query);
	$count = mysqli_num_rows($result);
	echo '<option value="" selected="selected" id="data">ALL</option>';
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['statecode'].'" id="data">'.$fetch['statename'].'</option>');
	}
?>