<?php

// decode JSON string to PHP object
$decoded = json_decode($_GET['json']);

// do something with data here
		
// create response object
$json = array();
$json['errorsNum'] = 2;
$json['error'] = array();
$json['error'][] = 'Correct email!';
$json['error'][] = 'Wrong hobby!';

// encode array $json to JSON string
$encoded = json_encode($json);

// send response back to index.html
// and end script execution
die($encoded);

?>