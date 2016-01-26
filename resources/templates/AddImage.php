<?php
	require_once("../config.php");

	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
	
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	//Get Values
	$destinationId = $_POST["destination"];
	$filepath = $_POST["filepath"];
	$name = $_POST["name"];
	$isCover = $_POST["isCover"];

	//Insert into database
	$stmt = $conn->prepare("INSERT INTO images (destinationId, filepath, name, isCover) VALUES (?, ?, ?, ?)");
	$stmt->bind_param('ssss', $destinationId , $filepath, $name, $isCover);
	$stmt->execute();

	$conn->close();
?>