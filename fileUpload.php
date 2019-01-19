<?php
    $currentDir = getcwd();
    #$uploadDirectory = "/home/pi/uploads/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['csv']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $channeldir = $_POST['channel'];

    $uploadDirectory = "/home/pi/channels/pseudo-channel_" . $channeldir . "/" ;
    $fileNameOriginal = $fileName ;
    $fileName = "schedule.csv";


    $uploadPath = $uploadDirectory;

    if (! is_dir($uploadPath)) {
	$errors[] = "This channel does not exist for some reason, please confirm existence with the admin.";
    } 

    $uploadPath = $uploadDirectory . basename($fileName);

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a CSV file.";
        }

	#if (basename($fileName) != "schedule.csv") {
	#    $errors[] = "You must upload a file named schedule.csv for this to work. Please try again.";
	#} 

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB.";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);	
	    #echo "attempting to upload   " . basename($fileName) . "   ";
	    #echo "attempting to place in    " . $uploadPath . "   ";
            if ($didUpload) {
                echo "The file " . basename($fileNameOriginal) . " has been uploaded as " . basename($fileName) ;
	  	echo "<br /> to Channel " . $channeldir ;
            } else {
                echo "An error occurred somewhere in transfer (probably a permissions issue). Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo "ERRORS TO REPORT: " . $error . "<br \>" ;
            }
        }
    }
    header('refresh:3;url=http://m2tv.home.local/');


?>