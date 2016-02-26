<?php
	require_once("../config.php");

	/*$target_dir = "../uploads";
	$target_file = $target_dir . basename($_FILES["filepath"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["filepath"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	    	$uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["filepath"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["filepath"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["filepath"]["name"]). " has been uploaded.";

        

	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}*/

	if(isset($_POST['submit'])){
	    $name = $_FILES['file']['name'];  
	    $temp_name = $_FILES['file']['tmp_name'];  
	    if(isset($name)){
	        if(!empty($name)){      
	            $location = '../uploads/';      
	            if(move_uploaded_file($temp_name, $location.$name)){

	            	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
					// Check connection
					if ($conn->connect_error) {
				    	die("Connection failed: " . $conn->connect_error);
					}

					//Get Values
					$destinationId = $_POST["destination"];
					$file = (string)$name;
					$isCover = 0;
					if(isset($_POST["isCover"]) && $_POST["isCover"] == 1) {
						$isCover = 1;
					}

					//Insert into database
					$stmt = $conn->prepare("INSERT INTO images (destinationId, filepath, isCover) VALUES (?, ?, ?)");
					$stmt->bind_param('isi', $destinationId, $file, $isCover);
					$stmt->execute();

					$conn->close();

	                echo 'File uploaded successfully';
	            }
	        }       
	    }  else {
	        echo 'You should select a file to upload !!';

	    }
	}	
?>