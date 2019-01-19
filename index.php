<html lang="en" class="no-js">
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="icon" href="images/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your TV Title Goes Here</title>
    <meta name="description" content="TV made for less">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

	<h1><strong>M2TV: TV Made for Less</strong></span></h1>

	<h2>Channel Lineup: Click on links to explore what is playing</h2>
	<h2>Did you remember to replace my URL's with your specific url?</h2>
	<h2>For the lineups, did you remember to make alias elements in your conf file?</h2>
	<h2>For the php execution, do you even have php installed?</h2>
	<h2>Did you remember to set 777 permissions if you have a permissions error?</h2>
	<nav>  
		<ul>
			<li><a href="http://m2tv.home.local/ch01/">Channel 01: Name 1</a>
			<li><a href="http://m2tv.home.local/ch02/">Channel 02: Name 2</a>
			<li><a href="http://m2tv.home.local/ch03/">Channel 03: Name 3</a>
		</ul>
	</nav>
	<?php
		function filterChannels($string){
			return strpos($string, 'channels') !== false && substr($string,0,strlen('channels')) === 'channels';
		}
		
		function filterNumbers($string){
			$strip = preg_replace('/^pseudo-channel/', '', $string);
			$char = '_';
			return strpos($string, 'pseudo-channel') !== false && substr($string,0,strlen('pseudo-channel')) === 'pseudo-channel' && $strip[0] === $char;
		}
		
		$files=array_map("htmlspecialchars", scandir("/home/pi"));
		
		$folderloc = array_filter($files,'filterChannels');
		
		$foldername = $folderloc;
		
		
		
		foreach ($foldername as $key => $file){
			if (strcmp($file,"channels")===0) {
				$foldername[$key]="Master";
			}
			else {
				$foldername[$key] = preg_replace('/^channels_/', '', $file);
			}
		}	
		
		

		foreach ($foldername as $key => $file){
			$filename ="/home/pi/$folderloc[$key]/.prevplaying";
			$strinfo=file_get_contents($filename);
			if (file_exists($filename)) {
    				echo "<h2>Playing on $file: Channel $strinfo</h2>";
			} else {
	 	   		echo "<h2>$file is off</h2>";
			}



		}
	?>

	<br><br><br>

	<h2>TV Controls:</h2>
	<p>
	<?php
		$files=array_map("htmlspecialchars", scandir("/home/pi"));
		
		$folderloc = array_filter($files,'filterChannels');
		
		$foldername = $folderloc;
		
		
		
		foreach ($foldername as &$file){
			if (strcmp($file,"channels")===0) {
				$file="Master";
			}
			else {
				$file = preg_replace('/^channels_/', '', $file);
			}
		}	

		echo "<form action=\"masterController.php\" method=\"post\">";
		echo "Select a cable box: ";
		echo "<select name=\"changedir\">";
		foreach ($foldername as $key => $yummy) {
			echo "<option value=\"$folderloc[$key]\">$yummy</option>" ;
		}
		echo "</select>";
		echo "<br><br>";
		echo "Select an action from the choices below: <br />";
		echo "<button type=\"submit\" name=\"action\" value=\"chup\">Channel Up</button>";
		echo "<button type=\"submit\" name=\"action\" value=\"chdwn\">Channel Down</button> <br />";
		echo "Change to channel: <br /> <input type=\"text\" name=\"nextChannel\">";
		echo "<input type=\"submit\" name=\"action\" value=\"change\"> <br />OR<br />";
		echo "<button type=\"submit\" name=\"action\" value=\"stop\">Stop Channels</button> <br />";
		echo "</form>";	
		
		
	?>
		
		<!--- Maintenance Specific Commands (for main server or global purposes only): <br /> --->
		<!--- The below commands are really only useful if you're going to run an AdaFruit Touchscreen --->
		<!--- <a href="http://m2tv/screenOn.php">Screen ON</a> <a href="http://m2tv/screenOff.php">Screen OFF</a> <br /> --->
		
	</p>

	<br><br><br>

	<h2>New Schedule Uploading Tool</h2>
	<p>
	The following tool can be used to upload new "schedule.csv" files to the various channels. Please make sure to select the channel AND the file.
	Note: it really won't matter what the file is called, it will be renamed correctly.  Just make sure it is a csv and smaller than 2MB.
	<form action="fileUpload.php" method="post" enctype="multipart/form-data">
	Channel uploading for:
	<select name="channel">
	<?php
		$files2=array_map("htmlspecialchars", scandir("/home/pi/channels"));
		
		$folderloc2 = array_filter($files2,'filterNumbers');
		
		$foldername2 = $folderloc2;
		
		
		
		foreach ($foldername2 as &$file){
			$file = preg_replace('/^pseudo-channel_/', 'Channel ', $file);
		}
		
		foreach($folderloc2 as &$file){
			$file = preg_replace('/^pseudo-channel_/', '', $file);
		}

		foreach ($foldername2 as $key => $yummy) {
			echo "<option value=\"$folderloc2[$key]\">$yummy</option>" ;
		}
	?>
	</select>
	<br />
        Upload a File:
        <input type="file" name="myfile" id="fileToUpload">
	<br />
        <input type="submit" name="submit" value="Upload File Now" >
   	</form>
	</p>

	<br><br><br>

	<h2>Important channel notes:</h2>
	<p>
	- You may want to consider putting some notes here just in case
	- Something like when you're system will update
	</p>

</body>

</html>
