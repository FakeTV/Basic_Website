<?php
$changedir=$_GET['changedir'];

if (strcmp($changedir,"channels")===0) {
	$disp="Master";
} else {
	$disp = preg_replace('/^channels_/', '', $changedir);
}


echo "Channel DOWN Executed on $disp";

$executescript = "sudo /home/pi/$changedir/channeldown_r.sh";

exec($executescript);
header('refresh:3,url=http://m2tv.home.local/');
?>