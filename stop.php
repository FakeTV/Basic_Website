<?php
$changedir=$_GET['changedir'];

if (strcmp($changedir,"channels")===0) {
	$disp="Master";
} else {
	$disp = preg_replace('/^channels_/', '', $changedir);
}


echo "Stop ALL Channels Executed on $disp";

$executescript = "sudo /home/pi/$changedir/stop-all-channels_r.sh";

exec($executescript);
header('refresh:3,url=http://m2tv.home.local/');
?>