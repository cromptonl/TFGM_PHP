<?php
	// Simple TFGM_PHP Example

	require "Tfgm.php";

	// Create a new Tfgm and give it your DevKey, AppKey and Content-type (supported types are text/json or text/xml)
	$tfgm = new Tfgm\API("DevKey=XXX&AppKey=YYY&Content-type=text/json");

	// For example... 
	// $tfgm = new Tfgm\API("DevKey=t123456-f1234-g123-m1234-123456&AppKey=t123456-f1234-g1234-m1234-1234556&Content-type=text/json");

	// Then call it while providing your endpoint as per the TfGM developer documentation
	$tfgm->call('endpoint');

	// For example...
	// $tfgm->call('/api/routes/142/stops');
?>