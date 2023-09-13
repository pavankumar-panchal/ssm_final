<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
function productname($prdname, $style)
{

	if ($prdname == 'productgroup') {
		$onchange = "productnamefunction();";
	} else {
		$onchange = "";
	}

	if ($style != "color") {
		$style = "";
	} else {
		$style = "background:#FEFFE6;";
	}


	$query = "select distinct(productgroup) from ssm_products order by productgroup;";
	$result = runmysqlquery($query);
	if (mysqli_num_rows($result) > 1) {
		$option = ('<select name="' . $prdname . '" class="swiftselect" id="' . $prdname . '" onChange="' . $onchange . '" style="width:100%; height:40px; border-color:lightgray; border-radius:5px; font-size:17px;" class =""><option value="" selected="selected">Make a Selection</option>');
	}
	while ($fetch = mysqli_fetch_array($result)) {
		$option .= ('<option value="' . $fetch['productgroup'] . '">' . $fetch['productgroup'] . '</option>');
	}
	$option .= '</select>';

	echo ($option);
}
?>