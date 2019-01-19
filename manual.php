<?php
	
	$channeldir = $_GET['nextChannel'];
	$changedir=$_GET['changedir'];

	if (strcmp($changedir,"channels")===0) {
		$disp="Master";
	} else {
		$disp = preg_replace('/^channels_/', '', $changedir);
	}


	$errors = [];
	#$channeldir = $_POST['nextChannel'];
	$execStatement = "sudo /home/pi/$changedir/manual_r.sh $channeldir";


	# Do some quick sanity checks
	if (! is_numeric($channeldir)) {
		$errors[] = "Please enter ONLY NUMBERS to this box.";
	}

	#if (strlen((string)$channeldir) != 2) {
	#	$errors[] = "Please enter as a two digit number, EVEN IF ONLY ONE DIGIT (01,02,...).";
	#}

	#if ($channeldir > 15) {
	#	$errors[] = "Please enter the number of an existing channel (only up to 15)." ;
	#}

	if (empty($errors)) {
		exec($execStatement);
		echo "Channel has changed to $channeldir on $disp";
		#echo "Channel has changed to " . $channeldir ;
	} else {
		foreach ($errors as $error){
			echo "ERRORS TO REPORT: " . $error . "<br \>" ;
		}
	}


	header('refresh:3;url=http://m2tv.home.local/');

?>