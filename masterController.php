<?php
	$changedir = $_POST['changedir'];
	$action = $_POST['action'];
	$channeldir = $_POST['nextChannel'];
	
	if (strcmp($changedir,"channels")===0) {
		$disp="Master";
	} else {
		$disp = preg_replace('/^channels_/', '', $changedir);
	}
	
	echo "we are seeing $disp, REALLY $changedir <br />";
	
	
	if (strcmp($action,"chup")===0) {
		echo "CHANNEL UP <br />";
		header("Location:http://m2tv.home.local/chup.php?changedir=".$changedir );
	} elseif (strcmp($action,"chdwn")===0) {
		echo "CHANNEL DOWN";
		header("Location:http://m2tv.home.local/chdown.php?changedir=".$changedir );
	} elseif (strcmp($action,"stop")===0) {
		echo "STOPPING CHANNELS";
		header("Location:http://m2tv.home.local/stop.php?changedir=".$changedir );
	} elseif (strcmp($action,"change")===0) {
		echo "CHANGING TO CHANNEL $channeldir";
		header("Location:http://m2tv.home.local/manual.php?changedir=$changedir&nextChannel=$channeldir");
	} else {
	echo "ERROR: No valid selection";
	}
	header('refresh:3;url=http://m2tv.home.local/');
?>